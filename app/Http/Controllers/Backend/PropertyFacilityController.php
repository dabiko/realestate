<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\PropertyFacilityDataTable;
use App\Http\Controllers\Controller;
use App\Models\Facility;
use App\Models\Property;
use App\Models\PropertyFacility;
use App\Traits\EncryptDecrypt;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PropertyFacilityController extends Controller
{
    use EncryptDecrypt;
    /**
     * Display a listing of the resource.
     */
    public function index( Request $request,PropertyFacilityDataTable $dataTable)
    {
        $decrypted_id = $this->decryptId($request->property);

        $property = Property::findOrFail($decrypted_id);
        $property_facility = PropertyFacility::all();

        return $dataTable->render('admin.property.facility.index',
            [
                'property' => $property,
                'property_facility' => $property_facility
            ]

        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request):View
    {
         $decrypted_id = $this->decryptId($request->property);

         $property = Property::findOrFail($decrypted_id);
         $facilities = Facility::all();

        return View('admin.property.facility.create',
            [
                'property' =>  $property,
                'facilities' =>  $facilities
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function destroy(string $id)
    {
        //
    }
}
