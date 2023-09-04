<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\PropertyMapDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\PropertyMapUpdateRequest;
use App\Models\Property;
use App\Models\PropertyMap;
use App\Traits\EncryptDecrypt;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PropertyMapController extends Controller
{
    use EncryptDecrypt;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, PropertyMapDataTable $dataTable)
    {
        $decrypted_id = $this->decryptId($request->property);

        $property = Property::findOrFail($decrypted_id);
        $count = PropertyMap::where('property_id', $decrypted_id)->count();
        $propertyMaps = PropertyMap::all();
        $coordinates = PropertyMap::where('property_id', $decrypted_id)->first();

        return $dataTable->render('admin.property.map.index',
            [
                'property' => $property,
                'propertyMaps' => $propertyMaps,
                'count' => $count,
                'coordinates' => $coordinates
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
    public function store(PropertyMapUpdateRequest $request): RedirectResponse
    {
        $validate = $request->validated();

        $property_id = $this->decryptId($validate['property_id']);

        PropertyMap::updateOrCreate(
            ['id' => 1],
            [
                'property_id' => $property_id,
                'longitude' => $validate['longitude'],
                'latitude' => $validate['latitude']
            ]
        );

        return Redirect::route('admin.property-map.index', ['property' => $validate['property_id']])
            ->with([
                'status' => 'success',
                'message' => 'Coordinates updated'
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
    public function destroy(string $id)
    {
        //
    }
}
