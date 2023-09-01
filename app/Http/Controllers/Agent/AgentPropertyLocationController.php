<?php

namespace App\Http\Controllers\Agent;

use App\DataTables\PropertyLocationDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\PropertyLocationCreateRequest;
use App\Http\Requests\Backend\PropertyLocationUpdateRequest;
use App\Models\Property;
use App\Models\PropertyLocation;
use App\Traits\EncryptDecrypt;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class AgentPropertyLocationController extends Controller
{
    use EncryptDecrypt;
    /**
     * Display a listing of the resource.
     */
    public function index(PropertyLocationDataTable $dataTable)
    {
        $property_id = $this->decryptId(request()->property);
        $property = Property::findOrFail($property_id);
        $count = PropertyLocation::where('property_id', $property_id)->count();
        $propertyLocation = PropertyLocation::all();


        return $dataTable->render('agent.property.location.index',
            [
                'property' => $property,
                'propertyLocation' => $propertyLocation,
                'count' => $count
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create():View
    {
        $property_id = $this->decryptId(request()->property);

        $property = Property::findOrFail($property_id);


        return View('agent.property.location.create',
            [
                'property' => $property,
                'property_id' => request()->property
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PropertyLocationCreateRequest $request): RedirectResponse
    {
        $validate = $request->validated();

        $property_id = $this->decryptId($validate['property_id']);

        PropertyLocation::create([
            'property_id' => $property_id,
            'name' => $validate['name'],
            'value' => $validate['value'],
            'status' => $validate['status'],
        ]);

        return Redirect::route('agent.property-location.index', ['property' => $validate['property_id']])
            ->with([
                'status' => 'success',
                'message' => 'Location created successfully'
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
        $decrypted_id =  $this->decryptId($id);

        $property_location = PropertyLocation::findOrFail($decrypted_id);


        return view('agent.property.location.edit',
            [
                'property_location' => $property_location,


            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PropertyLocationUpdateRequest $request, string $id): RedirectResponse
    {
        $validate = $request->validated();

        $decrypted_id = $this->decryptId($id);

        PropertyLocation::findOrFail($decrypted_id)->update([
            'name' => $validate['name'],
            'value' => $validate['value'],
            'status' => $validate['status'],
        ]);

        return Redirect::route('agent.property-location.index', ['property' => $validate['property_id'] ])
            ->with([
                'status' => 'success',
                'message' => 'Location updated successfully'
            ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): Response
    {
        $decrypted_id = $this->decryptId($id);

        $property_location = PropertyLocation::findOrFail($decrypted_id);

        if ($property_location->status === 1){
            return response([
                'status' => 'error',
                'title' => 'Cant delete '.$property_location->name,
                'message' => 'This is still active and live. Deactivate before deleting',
            ]);
        }

        $property_location->delete();
        return response([
            'status' => 'success',
            'message' => $property_location->name. ' Deleted successfully !!',
        ]);
    }

    /**
     * Update the status resource in storage.
     */
    public function updateStatus(Request $request): Response
    {
        $decrypted_id = $this->decryptId($request->id);

        $property_location = PropertyLocation::findOrFail($decrypted_id);

        $property_location->status = $request->status === 'true' ? 1 : 0;
        $property_location->save();

        return response([
            'status' => 'success',
            'message' => $request->status === 'true' ? $property_location->name. ' Activated Successfully !!' : $property_location->name. ' Deactivated Successfully !!',
        ]);
    }

}
