<?php

namespace App\Http\Controllers;

use App\Components\Rescusive;
use App\Helpers\Traits\StorageImageTrait;
use App\Http\Requests\ProductCreateRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductTag;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    use StorageImageTrait;
    private $category;
    private $product;
    private $productImage;
    private $tag;
    private $productTag;

    public function __construct(Category $category, Product $product, ProductImage $productImage, Tag $tag, ProductTag $productTag)
    {
        $this->category = $category;
        $this->product = $product;
        $this->productImage = $productImage;
        $this->tag = $tag;
        $this->productTag = $productTag;
    }
    public function index()
    {
        $products = $this->product->latest()->paginate(5);
        return view('admin.product.index', compact('products'));
    }

    public function create()
    {
        $htmlOption = $this->getCategory(0);
        $tagOption = $this->tag->all();
        return view('admin.product.create', compact('htmlOption', 'tagOption'));
    }

    public function getCategory ($parent_id)
    {
        $data = $this->category->all();
        $rescusive = new Rescusive($data);
        $htmlOption = $rescusive->categoryRecusive($parent_id);
        return $htmlOption;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ProductCreateRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Exception
     */

    public function store (ProductCreateRequest $request)
    {
        try {
            DB::beginTransaction();
            $dataProduct = [
                'name' => $request->name,
                'price' => $request->price,
                'content' => $request->content,
                'user_id' => auth()->user()->id,
                'category_id' => $request->product_category_id,
            ];

            $dataUpload = $this->storageTraitUpload($request, 'feature_image_path', 'products');

            if (!empty($dataUpload)) {
                $dataProduct['feature_image_name'] = $dataUpload['file_name'];
                $dataProduct['feature_image_path'] = $dataUpload['file_path'];
            }

            $product = $this->product->create($dataProduct);

            //Insert data to product image: Thêm hình ảnh phụ

            if ($request->hasFile('image_path')) {
                foreach ($request->image_path as $fileItem) {
                    $dataProductImageDetail = $this->storageTraitUploadMultiple($fileItem, 'products');
                    $product->images()->create([
                        'image_path' => $dataProductImageDetail['file_path'],
                        'image_name' => $dataProductImageDetail['file_name'],
                    ]);
                }
            }

            //Insert tag for
            if (!empty($request->product_tags)) {
                foreach ($request->product_tags as $tagItem) {
                    //insert to tag table
                    $tagInstance = $this->tag->firstOrCreate([
                        'name' => $tagItem
                    ]);

                    $tagIds[] = $tagInstance->id;
                }
            }

            $product->tags()->attach($tagIds);
            DB::commit();
            return redirect()->route('products.index');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Message: ' . $e->getMessage() . 'Line: ' . $e->getLine());
        }
    }

    public function edit($id)
    {
        $product = $this->product->find($id);
        $htmlOption = $this->getCategory($product->category_id);
        $tagOption = $this->tag->all();
        return view('admin.product.edit', compact('product', 'tagOption', 'htmlOption'));
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $dataProductUpdate = [
                'name' => $request->product_name,
                'price' => $request->product_price,
                'content' => $request->product_content,
                'user_id' => auth()->user()->id,
                'category_id' => $request->product_category_id,
            ];


            $dataImgUpload = $this->storageTraitUpload($request, 'feature_image_path', 'products');

            if (!empty($dataImgUpload)) {
                $dataProductUpdate['feature_image_name'] = $dataImgUpload['file_name'];
                $dataProductUpdate['feature_image_path'] = $dataImgUpload['file_path'];
            }

            $this->product->find($id)->update($dataProductUpdate);

            $product = $this->product->find($id);
            //Insert data to product image: Update hình ảnh phụ

            if ($request->hasFile('image_path')) {
                $this->productImage->where('product_id', $id)->delete();
                foreach ($request->image_path as $fileItem) {
                    $dataProductImageDetail = $this->storageTraitUploadMultiple($fileItem, 'products');
                    $product->images()->create([
                        'image_path' => $dataProductImageDetail['file_path'],
                        'image_name' => $dataProductImageDetail['file_name'],
                    ]);
                }
            }

            //Insert tag for
            if (!empty($request->product_tags)) {
                foreach ($request->product_tags as $tagItem) {
                    //insert to tag table
                    $tagInstance = $this->tag->firstOrCreate([
                        'name' => $tagItem
                    ]);

                    $tagIds[] = $tagInstance->id;
                }
            }

            $product->tags()->sync($tagIds);
            DB::commit();
            return redirect()->route('products.index');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Message: ' . $e->getMessage() . 'Line: ' . $e->getLine());
        }
    }

    public function delete($id)
    {
        try {
            $this->product->find($id)->delete();
            return response()->json([
                'code' => 200,
                'message' => 'Delete product successfully!',
            ], status: 200);

        } catch (\Exception $e) {
            Log::error('Message: ' . $e->getMessage() . 'Line: ' . $e->getLine());
            return response()->json([
                'code' => 500,
                'message' => 'Delete product failed!',
            ], status: 500);
        }
    }
}
