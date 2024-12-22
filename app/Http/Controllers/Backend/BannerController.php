<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\BannerDataTable;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class BannerController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(BannerDataTable $dataTable)
    {
        return $dataTable->render('admin.banner.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.banner.create');
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
            'btn_url' => ['url'],
            'status' => ['required']
       ]);

       $banner = new Banner();

       /** Handle file upload */
       $imagePath = $this->uploadImage($request, 'image', 'uploads');

       $banner->image = $imagePath;
       $banner->type = $request->type;
       $banner->title = $request->title;
       $banner->btn_url = $request->btn_url;
       $banner->status = $request->status;
       $banner->save();

       Cache::forget('banner');

       toastr('Created Successfully!', 'success');

       return redirect()->route('banner.index');

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
        $banner = Banner::findOrFail($id);
        return view('admin.banner.edit', compact('banner'));
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
            'btn_url' => ['url'],
            'status' => ['required']
       ]);

       $banner = Banner::findOrFail($id);

       /** Handle file upload */
       $imagePath = $this->updateImage($request, 'image', 'uploads', $banner->image);

       $banner->image =  empty(!$imagePath) ? $imagePath : $banner->image;
       $banner->type = $request->type;
       $banner->title = $request->title;
       $banner->btn_url = $request->btn_url;
       $banner->status = $request->status;
       $banner->save();

       Cache::forget('banner');

       toastr('Updated Successfully!', 'success');

       return redirect()->route('banner.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $banner = Banner::findOrFail($id);
        $this->deleteImage($banner->image);
        $banner->delete();

        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }

    public function changeStatus(Request $request)
    {
        $banner = Banner::findOrFail($request->id);
        $banner->status = $request->status == 'true' ? 1 : 0;
        $banner->save();

        return response(['message' => 'Status has been updated!']);
    }
}
