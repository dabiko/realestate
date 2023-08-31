<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\PropertyVariantDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\PropertyVariantCreateRequest;
use App\Http\Requests\Backend\PropertyVariantUpdateRequest;
use App\Models\Property;
use App\Models\PropertyVariant;
use App\Models\PropertyVariantItem;
use App\Traits\EncryptDecrypt;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class PropertyVariantController extends Controller
{
    use EncryptDecrypt;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, PropertyVariantDataTable $dataTable)
    {
        $decrypted_id = $this->decryptId($request->property);

        $property = Property::findOrFail($decrypted_id);
        $count = PropertyVariant::where('property_id', $decrypted_id)->count();
        $propertyVariant = PropertyVariant::all();

        return $dataTable->render('admin.property.variant.index',
            [
                'property' => $property,
                'propertyVariant' => $propertyVariant,
                'count' => $count
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {

        $id = $this->decryptId($request->property);
        $property = Property::findOrFail($id);

        return View('admin.property.variant.create',
            [
                'property' => $property
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PropertyVariantCreateRequest $request): RedirectResponse
    {
        $validate = $request->validated();

        $property_id = $this->decryptId($validate['property_id']);

        PropertyVariant::create([
            'property_id' => $property_id,
            'name' => $validate['name'],
            'status' => $validate['status'],
        ]);

        return Redirect::route('admin.property-variant.index', ['property' => $validate['property_id']])
            ->with([
                'status' => 'success',
                'message' => 'Variant '.$validate['name'].' created successfully'
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
    public function edit(string $id): View
    {

        $decrypted_id = $this->decryptId($id);

        $variant = PropertyVariant::findOrFail($decrypted_id);



        return view('admin.property.variant.edit',
            [
                'variant' => $variant,

            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PropertyVariantUpdateRequest $request, string $id): RedirectResponse
    {
        $validate = $request->validated();

        $decrypted_id =  $this->decryptId($id);
        $property_id = PropertyVariant::findOrFail($decrypted_id);

        PropertyVariant::findOrFail($decrypted_id)->update([
            'name' => $validate['name'],
            'status' => $validate['status'],
        ]);


        return Redirect::route('admin.property-variant.index', ['property' => $this->encryptId($property_id->property_id)])
            ->with([
                'status' => 'success',
                'message' => $validate['name']. ' Updated Successfully'
            ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): Response
    {
        $decrypted_id = $this->decryptId($id);

        $variant_id = PropertyVariant::findOrFail($decrypted_id);
        $variant_item = PropertyVariantItem::where('property_variant_id', $variant_id->id)->count();

        if ($variant_item > 0){
            return response([
                'status' => 'error',
                'title' => 'Cant delete this variant',
                'message' => 'It contains '.$variant_item.' variant items. Delete  variant items before deleting
                                  the variant',
            ]);
        }

        if ($variant_id->status === 1){
            return response([
                'status' => 'error',
                'title' => 'Cant delete'.$variant_id->name.' variant',
                'message' => 'This variant is still active. Deactivate it before deleting',
            ]);
        }

        $variant_id->delete();

        return response([
            'status' => 'success',
            'message' => 'Variant Deleted successfully !!',
        ]);
    }


    /**
     * Update the status resource in storage.
     */
    public function updateStatus(Request $request): Response
    {
        $decrypted_id = $this->decryptId($request->id);

        $property_variant = PropertyVariant::findOrFail($decrypted_id);


        $property_variant->status = $request->status === 'true' ? 1 : 0;
        $property_variant->save();

        return response([
            'status' => 'success',
            'message' => $request->status === 'true' ? 'Variant Enabled' : 'Variant Disabled',
        ]);
    }
}
