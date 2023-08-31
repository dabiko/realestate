<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\PropertyGalleryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\PropertyGallery;
use App\Traits\EncryptDecrypt;
use App\Traits\ImageUploadTraits;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules\File;
class PropertyGalleryController extends Controller
{
    use EncryptDecrypt;
    use ImageUploadTraits;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, PropertyGalleryDataTable $dataTable)
    {
        $decrypted_id = $this->decryptId($request->property);

        $property = Property::findOrFail($decrypted_id);
        $count = PropertyGallery::where('property_id', $decrypted_id)->count();
        $propertyGallery = PropertyGallery::all();

        return $dataTable->render('admin.property.gallery.index',
            [
                'property' => $property,
                'propertyGallery' => $propertyGallery,
                'count' => $count
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {

        $request->validate([
            'image.*' => [
                'required', 'image',
                File::types(['jpeg', 'jpg', 'png']),

            ],
        ]);

        $imgPaths = $this->uploadMultiImage($request, 'image', 'upload/property/gallery');
        $property_id = $this->decryptId($request->property_id);

        foreach ($imgPaths as $path){

            PropertyGallery::create([
                 'property_id' =>  $property_id,
                  'image' =>  $path
            ]);
        }

        return Redirect::route('admin.property-gallery-index',
            ['property' => $request->property_id])
            ->with([
                'status' => 'success',
                'message' => 'Gallery upload was successful'
            ]);
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): Response
    {
        $decrypted_id = $this->decryptId($id);

        $gallery_id = PropertyGallery::findOrFail($decrypted_id);

        $this->deleteImage($gallery_id->image);
        $gallery_id->delete();

        return response([
            'status' => 'success',
            'message' => 'Image Deleted successfully !!',
        ]);
    }
}
