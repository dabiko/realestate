<?php

namespace App\Http\Controllers\Agent;

use App\DataTables\PropertyAmenityDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\PropertyAmenityCreateRequest;
use App\Models\Amenity;
use App\Models\Property;
use App\Models\PropertyAmenity;
use App\Traits\EncryptDecrypt;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;

class AgentPropertyAmenityController extends Controller
{
    use EncryptDecrypt;
    /**
     * Display a listing of the resource.
     */
    public function index(PropertyAmenityDataTable $dataTable)
    {
        $property_id = $this->decryptId(request()->property);

        $property = Property::findOrFail($property_id);
        $count = PropertyAmenity::where('property_id', $property_id)->count();

        $property_amenity = PropertyAmenity::all();

        $amenities = Amenity::where('status', 1)->get();


        return $dataTable->render('agent.property.amenity.index',
            [
                'property' => $property,
                'property_amenity' => $property_amenity,
                'count' => $count,
                'amenities' => $amenities,

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
    public function store(PropertyAmenityCreateRequest $request): RedirectResponse
    {
        $validate = $request->validated();

        $property_id = $this->decryptId($validate['property_id']);

        PropertyAmenity::create([
            'property_id' =>  $property_id,
            'amenity_id' =>  $validate['amenity_id'],
            'status' =>  $validate['status']
        ]);


        return Redirect::route('agent.property-amenity.index', ['property' => $validate['property_id']])
            ->with([
                'status' => 'success',
                'message' => 'Amenity created successfully'
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

        $property_amenity = PropertyAmenity::findOrFail($decrypted_id);

        if ($property_amenity->status == 1){
            return response([
                'status' => 'error',
                'title' => 'Cant delete '.$property_amenity->amenity->name,
                'message' => 'This is still active and live. Deactivate before deleting',
            ]);
        }

        $property_amenity->delete();
        return response([
            'status' => 'success',
            'message' => $property_amenity->amenity->name. ' Deleted successfully !!',
        ]);
    }


    /**
     * Update the status resource in storage.
     */
    public function updateStatus(Request $request): Response
    {

        $decrypted_id = $this->decryptId($request->id);

        $property_amenity = PropertyAmenity::findOrFail($decrypted_id);

        $property_amenity->status = $request->status == 'true' ? 1 : 0;
        $property_amenity->save();

        return response([
            'status' => 'success',
            'message' => $request->status === 'true' ? $property_amenity->amenity->name. ' Activated Successfully !!' : $property_amenity->amenity->name. ' Deactivated Successfully !!',
        ]);
    }
}
