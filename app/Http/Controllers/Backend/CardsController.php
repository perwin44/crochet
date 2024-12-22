<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\CardDataTable;
use App\Http\Controllers\Controller;
use App\Models\Card;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CardsController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(CardDataTable $dataTable)
    {
        return $dataTable->render('admin.card.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.card.create');
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

       $card = new Card();

       /** Handle file upload */
       $imagePath = $this->uploadImage($request, 'image', 'uploads');

       $card->image = $imagePath;
       $card->type = $request->type;
       $card->title = $request->title;
       $card->btn_url = $request->btn_url;
       $card->status = $request->status;
       $card->save();

       Cache::forget('card');

       toastr('Created Successfully!', 'success');

       return redirect()->route('card.index');

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
        $card = Card::findOrFail($id);
        return view('admin.card.edit', compact('card'));
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

       $card = Card::findOrFail($id);

       /** Handle file upload */
       $imagePath = $this->updateImage($request, 'image', 'uploads', $card->image);

       $card->image =  empty(!$imagePath) ? $imagePath : $card->image;
       $card->type = $request->type;
       $card->title = $request->title;
       $card->btn_url = $request->btn_url;
       $card->status = $request->status;
       $card->save();

       Cache::forget('card');

       toastr('Updated Successfully!', 'success');

       return redirect()->route('card.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $card = Card::findOrFail($id);
        $this->deleteImage($card->image);
        $card->delete();

        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }

    public function changeStatus(Request $request)
    {
        $card = Card::findOrFail($request->id);
        $card->status = $request->status == 'true' ? 1 : 0;
        $card->save();

        return response(['message' => 'Status has been updated!']);
    }
}
