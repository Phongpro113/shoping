<?php

namespace App\Http\Controllers;

use App\Http\Requests\SliderAddRequest;
use App\Models\Slider;
use App\Traits\StorageImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminSliderController extends Controller
{
    use StorageImageTrait;
    private $slider;
    public function __construct(Slider $slider)
    {
        $this->slider = $slider;
    }

    public function index() {
        $slider = $this->slider->latest()->paginate(5);
        return view('admin.slider.index', compact('slider'));
    }
    public function create() {
        return view('admin.slider.add');
    }
    public function store(SliderAddRequest $request) {
        try {
            $dataInsert = [
                'name' => $request->name,
                'description' => $request->description,
            ];
            $dataImageSlider = $this->storageTraitUpload($request, 'image_path', 'slider');
            if (!empty($dataImageSlider)) {
                $dataInsert['image_name'] = $dataImageSlider['file_name'];
                $dataInsert['image_path'] = $dataImageSlider['file_path'];
            }
            $this->slider->create($dataInsert);
            return redirect()->route('slider.index');
        } catch (\Exception $exception) {
            Log::error('error: ' . $exception->getMessage(). '---Line' . $exception->getLine());
        }
    }
    public function edit($id) {
        $data = $this->slider->find($id);
        return view('admin.slider.edit', compact('data'));
    }
    public function update(Request $request, $id) {
        try {
            $dataUpdate = [
                'name' => $request->name,
                'description' => $request->description,
            ];
            $dataImageSlider = $this->storageTraitUpload($request, 'image_path', 'slider');
            if (!empty($dataImageSlider)) {
                $dataUpdate['image_name'] = $dataImageSlider['file_name'];
                $dataUpdate['image_path'] = $dataImageSlider['file_path'];
            }
            $this->slider->create($dataUpdate);
            return redirect()->route('slider.index');
        } catch (\Exception $exception) {
            Log::error('error: ' . $exception->getMessage(). '---Line' . $exception->getLine());
        }
    }
    public function delete($id) {
        $this->slider->find($id)->delete();
        return response()->json([
            'data' => 200,
            'message' => 'success'
        ], 200);
    }
}
