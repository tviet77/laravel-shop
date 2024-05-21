<?php

namespace App\Http\Controllers;

use App\Helpers\Traits\StorageImageTrait;
use App\Http\Requests\SliderCreateRequest;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SliderController extends Controller
{
    use StorageImageTrait;
    private $slider;

    public function __construct(Slider $slider)
    {
        $this->slider = $slider;
    }

    public function index()
    {
        $sliders = $this->slider->latest()->paginate(8);
        return view('admin.slider.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.slider.create');
    }

    public function store(SliderCreateRequest $request)
    {
        try {
            $dataInsert = [
                'title' => $request->title,
                'description' => $request->description,
            ];

            $dataImgSlider = $this->storageTraitUpload($request, 'image_path', 'slider');

            if (!empty($dataImgSlider)) {
                $dataInsert['image_path'] = $dataImgSlider['file_path'];
                $dataInsert['image_name'] = $dataImgSlider['file_name'];
            }

            $this->slider->create($dataInsert);
            return redirect()->route('sliders.index');

        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    public function edit($id)
    {
        $slider = $this->slider->find($id);
        return view('admin.slider.edit', compact('slider'));

    }

    public function update(Request $request, $id)
    {
        try {
            $slider = $this->slider->find($id);
            $dataUpdate = [
                'title' => $request->title,
                'description' => $request->description,
                'status' => $request->status
            ];

            $dataImgSlider = $this->storageTraitUpload($request, 'image_path', 'slider');
            if (!empty($dataImgSlider)) {
                $dataUpdate['image_path'] = $dataImgSlider['file_path'];
                $dataUpdate['image_name'] = $dataImgSlider['file_name'];
            }
            $slider->update($dataUpdate);
            return redirect()->route('sliders.index');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $this->slider->find($id)->delete();
            return response()->json([
                'code' => 200,
                'message' => 'Xoá item thành công!',
            ], status: 200);
        } catch (\Exception $e) {
            Log::error('Message: ' . $e->getMessage() . 'Line: ' . $e->getLine());
            return response()->json([
                'code' => 500,
                'message' => 'Xoá item thất bại!',
            ], status: 500);
        }
    }

}
