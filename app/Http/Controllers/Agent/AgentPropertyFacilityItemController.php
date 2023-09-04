<?php

namespace App\Http\Controllers\Agent;

use App\DataTables\PropertyFacilityItemDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\PropertyFacilityItemCreateRequest;
use App\Http\Requests\Backend\PropertyFacilityItemUpdateRequest;
use App\Models\Property;
use App\Models\PropertyFacility;
use App\Models\PropertyFacilityItem;
use App\Traits\EncryptDecrypt;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class AgentPropertyFacilityItemController extends Controller
{
    use EncryptDecrypt;
    /**
     * Display a listing of the resource.
     */
    public function index(PropertyFacilityItemDataTable $dataTable, $propertyId, $facilityId)
    {
        $property_Id =  $this->decryptId($propertyId);
        $facility_Id =  $this->decryptId($facilityId);

        $property = Property::findOrFail($property_Id);
        $property_facility = PropertyFacility::findOrFail($facility_Id);
        $count = PropertyFacilityItem::where('property_facility_id', $facility_Id)->count();
        $facilityItems = PropertyFacilityItem::all();

        return $dataTable->render('agent.property.facility.item.index',
            [
                'property' => $property,
                'property_facility' => $property_facility,
                'facilityItems' => $facilityItems,
                'count' => $count
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create( $propertyId,  $facilityId): View
    {
        $property_Id =  $this->decryptId($propertyId);
        $facility_Id =  $this->decryptId($facilityId);

        $property = Property::findOrFail($property_Id);
        $property_facility = PropertyFacility::findOrFail($facility_Id);

        return View('agent.property.facility.item.create',
            [
                'property' => $property,
                'property_facility' => $property_facility,
            ]
        );
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(PropertyFacilityItemCreateRequest $request): RedirectResponse
    {
        $validate = $request->validated();

        $property_id = $this->decryptId($validate['property_id']);
        $variant_id = $this->decryptId($validate['property_facility_id']);

        PropertyFacilityItem::create([
            'property_id' => $property_id,
            'property_facility_id' => $variant_id,
            'name' => $validate['name'],
            'distance' => $validate['distance'],
            'rating' => $validate['rating'],
            'status' => $validate['status'],
        ]);

        return Redirect::route('agent.facility-item.index',
            ['propertyId' => $validate['property_id'], 'facilityId' => $validate['property_facility_id']]
        )
            ->with([
                'status' => 'success',
                'message' => 'Facility Item created successfully'
            ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $decrypted_id = $this->decryptId($id);

        $facility_item = PropertyFacilityItem::findOrFail($decrypted_id);

        return view('agent.property.facility.item.edit',
            [
                'facility_item' => $facility_item,

            ]
        );
    }

    public function update(PropertyFacilityItemUpdateRequest $request, string $id) : RedirectResponse
    {
        $validate = $request->validated();

        $decrypted_id = $this->decryptId($id);

        $Ids = PropertyFacilityItem::findOrFail($decrypted_id);

        PropertyFacilityItem::findOrFail($decrypted_id)->update([
            'name' => $validate['name'],
            'distance' => $validate['distance'],
            'rating' => $validate['rating'],
            'status' => $validate['status'],
        ]);



        return Redirect::route('agent.facility-item.index',
            ['propertyId' => $validate['property_id'], 'facilityId' => $validate['property_facility_id']]
        )
            ->with([
                'status' => 'success',
                'message' => 'Facility Item updated successfully'
            ]);

    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): Response
    {

        $decrypted_id = $this->decryptId($id);
        $item_id = PropertyFacilityItem::findOrFail($decrypted_id);


        if ($item_id->status == 1){
            return response([
                'status' => 'error',
                'title' => 'Cant delete '.$item_id->name,
                'message' => 'This Item is still active. Deactivate before deleting',
            ]);
        }

        $item_id->delete();
        return response([
            'status' => 'success',
            'message' => 'Facility Item Deleted successfully !!',
        ]);
    }

    /**
     * Update the status resource in storage.
     */
    public function updateStatus(Request $request): Response
    {
        $decrypted_id = $this->decryptId($request->id);
        $item = PropertyFacilityItem::findOrFail($decrypted_id);

        $item->status = $request->status === 'true' ? 1 : 0;
        $item->save();

        return response([
            'status' => 'success',
            'message' => $request->status === 'true' ? $item->name.' enabled' : $item->name.' disabled',
        ]);
    }
}
