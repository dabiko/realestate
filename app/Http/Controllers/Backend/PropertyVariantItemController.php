<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\PropertyVariantItemDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\PropertyVariantItemCreateRequest;
use App\Http\Requests\Backend\PropertyVariantItemUpdateRequest;
use App\Models\Property;
use App\Models\PropertyVariant;
use App\Models\PropertyVariantItem;
use App\Traits\EncryptDecrypt;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class PropertyVariantItemController extends Controller
{
    use EncryptDecrypt;

    public function index(PropertyVariantItemDataTable $dataTable, $propertyId, $variantId)
    {
        $property_Id =  $this->decryptId($propertyId);
        $variant_Id =  $this->decryptId($variantId);

        $property = Property::findOrFail($property_Id);
        $variant = PropertyVariant::findOrFail($variant_Id);
        $variantItems = PropertyVariantItem::all();

        return $dataTable->render('admin.property.variant-item.index',
            [
                'property' => $property,
                'variant' => $variant,
                'variantItems' => $variantItems
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PropertyVariantItemCreateRequest $request): RedirectResponse
    {
        $validate = $request->validated();

        $property_id = $this->decryptId($validate['property_id']);
        $variant_id  = $this->decryptId($validate['property_variant_id']);

        PropertyVariantItem::create([
            'property_id' => $property_id,
            'property_variant_id' => $variant_id,
            'name' => $validate['name'],
            'status' => $validate['status'],
        ]);

        return Redirect::route('admin.variant-item.index',
            ['propertyId' => $validate['property_id'], 'variantId' => $validate['property_variant_id'] ]
         )
          ->with([
              'status' => 'success',
              'message' => 'Variant Item created successfully'
          ]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $decrypted_id = $this->decryptId($id);

        $variant_item = PropertyVariantItem::findOrFail($decrypted_id);

        return view('admin.property.variant-item.edit',
            [
                'variant_item' => $variant_item,

            ]
        );
    }

    public function update(PropertyVariantItemUpdateRequest $request, string $id) : RedirectResponse
    {
        $validate = $request->validated();

        $decrypted_id = $this->decryptId($id);

        $Ids = PropertyVariantItem::findOrFail($decrypted_id);

        PropertyVariantItem::findOrFail($decrypted_id)->update([
            'name' => $validate['name'],
            'status' => $validate['status'],
        ]);



        return Redirect::route('admin.variant-item.index',
            ['propertyId' => $this->encryptId($Ids->property_id), 'variantId' => $this->encryptId($Ids->property_variant_id)]
        )
            ->with([
                'status' => 'success',
                'message' => 'Variant Item updated successfully'
            ]);

    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): Response
    {
        $decrypted_id = $this->decryptId($id);
        $variant_id = PropertyVariantItem::findOrFail($decrypted_id);


        if ($variant_id->status === 1){
            return response([
                'status' => 'error',
                'title' => 'Cant delete '.$variant_id->name,
                'message' => 'This Item is still active. Deactivate before deleting',
            ]);
        }

        $variant_id->delete();
        return response([
            'status' => 'success',
            'message' => 'Variant Item Deleted successfully !!',
        ]);
    }


    /**
     * Update the status resource in storage.
     */
    public function updateStatus(Request $request): Response
    {
        $decrypted_id = $this->decryptId($request->id);
        $item = PropertyVariantItem::findOrFail($decrypted_id);

        $item->status = $request->status === 'true' ? 1 : 0;
        $item->save();

        return response([
            'status' => 'success',
            'message' => $request->status === 'true' ? 'Item enabled' : 'Item disabled',
        ]);
    }


}
