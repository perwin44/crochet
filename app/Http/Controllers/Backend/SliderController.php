<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\SliderDataTable;
use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SliderController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(SliderDataTable $dataTable)
    {
        return $dataTable->render('admin.slider.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $request->validate([
            'image' => ['required','image', 'max:2000'],
            'type' => ['string', 'max:200'],
            'title' => ['required','max:200'],
            'description' => ['required'],
            'btn_url' => ['url'],
            'serial' => ['required', 'integer'],
            'status' => ['required']
       ]);

       $slider = new Slider();

       /** Handle file upload */
       $imagePath = $this->uploadImage($request, 'image', 'uploads');

       $slider->image = $imagePath;
       $slider->type = $request->type;
       $slider->title = $request->title;
       $slider->description = $request->description;
       $slider->btn_url = $request->btn_url;
       $slider->serial = $request->serial;
       $slider->status = $request->status;
       $slider->save();

       Cache::forget('sliders');

       toastr('Created Successfully!', 'success');

       return redirect()->route('slider.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $slider = Slider::findOrFail($id);
        return view('admin.slider.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'image' => ['nullable','image', 'max:2000'],
            'type' => ['string', 'max:200'],
            'title' => ['required','max:200'],
            'description' => ['required'],
            'btn_url' => ['url'],
            'serial' => ['required', 'integer'],
            'status' => ['required']
       ]);

       $slider = Slider::findOrFail($id);

       /** Handle file upload */
       $imagePath = $this->updateImage($request, 'image', 'uploads', $slider->image);

       $slider->image =  empty(!$imagePath) ? $imagePath : $slider->image;
       $slider->type = $request->type;
       $slider->title = $request->title;
       $slider->description = $request->description;
       $slider->btn_url = $request->btn_url;
       $slider->serial = $request->serial;
       $slider->status = $request->status;
       $slider->save();

       Cache::forget('sliders');

       toastr('Updated Successfully!', 'success');

       return redirect()->route('slider.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $slider = Slider::findOrFail($id);
        $this->deleteImage($slider->image);
        $slider->delete();

        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }
}
