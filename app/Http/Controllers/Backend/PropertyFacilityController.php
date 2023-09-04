<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\PropertyFacilityDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\PropertyFacilityCreateRequest;
use App\Http\Requests\Backend\PropertyFacilityUpdateRequest;
use App\Models\Facility;
use App\Models\Property;
use App\Models\PropertyFacility;
use App\Traits\EncryptDecrypt;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class PropertyFacilityController extends Controller
{
    use EncryptDecrypt;
    /**
     * Display a listing of the resource.
     */
    public function index(PropertyFacilityDataTable $dataTable)
    {
        $property_id = $this->decryptId(request()->property);
        $property = Property::findOrFail($property_id);
        $count = PropertyFacility::where('property_id', $property_id)->count();
        $property_facility = PropertyFacility::all();
        $facilities = Facility::where('status', 1)->get();


        return $dataTable->render('admin.property.facility.index',
            [
                'property' => $property,
                'property_facility' => $property_facility,
                'count' => $count,
                'facilities' => $facilities,
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {

        $property_id = $this->decryptId(request()->property);

        $property = Property::findOrFail($property_id);
        $facilities = Facility::all();


        return View('admin.property.facility.create',
            [
                'property' => $property,
                'facilities' => $facilities,
                'property_id' => request()->property
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PropertyFacilityCreateRequest $request): RedirectResponse
    {
        $validate = $request->validated();

        $property_id = $this->decryptId($validate['property_id']);

        PropertyFacility::create([
            'facility_id' => $validate['facility_id'],
            'property_id' => $property_id,
            'status' => $validate['status'],
        ]);

        return Redirect::route('admin.property-facility.index', ['property' => $validate['property_id']])
            ->with([
                'status' => 'success',
                'message' => 'Facility created successfully'
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

        $property_facility = PropertyFacility::findOrFail($decrypted_id);

        if ($property_facility->status === 1){
            return response([
                'status' => 'error',
                'title' => 'Cant delete '.$property_facility->name,
                'message' => 'This is still active and live. Deactivate before deleting',
            ]);
        }

        $property_facility->delete();
        return response([
            'status' => 'success',
            'message' => $property_facility->name. ' Deleted successfully !!',
        ]);
    }

    /**
     * Update the status resource in storage.
     */
    public function updateStatus(Request $request): Response
    {
        $decrypted_id = $this->decryptId($request->id);

        $property_facility = PropertyFacility::findOrFail($decrypted_id);

        $property_facility->status = $request->status === 'true' ? 1 : 0;
        $property_facility->save();

        return response([
            'status' => 'success',
            'message' => $request->status === 'true' ? $property_facility->name. ' Activated Successfully !!' : $property_facility->name. ' Deactivated Successfully !!',
        ]);
    }
}
