<?php

namespace App\Http\Controllers\Agent;

use App\DataTables\PropertyStatsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\PropertyStats;
use App\Traits\EncryptDecrypt;
use App\Traits\ImageUploadTraits;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules\File;

class AgentPropertyStatsController extends Controller
{

    use EncryptDecrypt;
    use ImageUploadTraits;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, PropertyStatsDataTable $dataTable)
    {
        $decrypted_id = $this->decryptId($request->property);

        $property = Property::findOrFail($decrypted_id);
        $count = PropertyStats::where('property_id', $decrypted_id)->count();
        $propertyStats = PropertyStats::all();

        return $dataTable->render('agent.property.stats.index',
            [
                'property' => $property,
                'propertyStats' => $propertyStats,
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

        $imgPaths = $this->uploadMultiImage($request, 'image', 'upload/property/agent/stats');
        $property_id = $this->decryptId($request->property_id);

        foreach ($imgPaths as $path){

            PropertyStats::create([
                'property_id' =>  $property_id,
                'image' =>  $path
            ]);
        }

        return Redirect::route('agent.property-stats-index', ['property' => $request->property_id])
            ->with([
                'status' => 'success',
                'message' => 'Stats upload was successful'
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

        $gallery_id = PropertyStats::findOrFail($decrypted_id);

        $this->deleteImage($gallery_id->image);
        $gallery_id->delete();

        return response([
            'status' => 'success',
            'message' => 'Image Deleted successfully !!',
        ]);
    }
}
