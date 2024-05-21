<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Slider;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    private $product;
    private $slider;
    private $menu;
    private $productImage;

    private $order;


    public function __construct(Product $product, Slider $slider, Menu $menu, ProductImage $productImage, Order $order)
    {
        $this->product = $product;
        $this->productImage = $productImage;
        $this->slider = $slider;
        $this->menu = $menu;
        $this->order = $order;
    }

    public function index()
    {
        $product_featured = $this->product->where('is_featured', 1)->get();
        $menus = $this->menu->where('parent_id', 0)->orderBy('id', 'asc')->get();
        $imageSlider = $this->slider->get();
        $categories = Category::all();
        return view('client.index', compact('product_featured', 'imageSlider', 'menus', 'categories'));
    }

    public function productDetail($slug)
    {
        $product = $this->product->where('slug', $slug)->first();
        $productImages = $this->productImage->where('product_id', $product->id)->get();
        $product_featured = $this->product->where('is_featured', 1)->orderBy('created_at', 'desc')->take(4)->get();
        return view('client.pages.product-detail', compact('product_featured', 'product', 'productImages'));
    }

    public function showShop()
    {
        $products = $this->product->latest()->paginate(6);
        $categoryMenu = Category::where('parent_id', 0)->get();
        return view('client.pages.shop', compact('products', 'categoryMenu'));
    }

    public function getProductByCategory($slugCategory)
    {
        $category = Category::where('slug', $slugCategory)->first();
        $categoryMenu = Category::where('parent_id', 0)->get();
        $products = $this->product->where('category_id', $category->id)->latest()->paginate(6);
        return view('client.pages.shop', compact('products', 'categoryMenu'));
    }

    public function thankYou()
    {
        session()->flush('cart');
        return view('client.pages.confirm');
    }

    public function confirmOrder($token)
    {
        $order = $this->order->where('token', $token)->firstOrFail();

        if ($order) {
            $order->status = 1;
            $order->save();
            return view('mail.order-success', compact('order'));
        } else {
            abort(404);
        }
    }




}
