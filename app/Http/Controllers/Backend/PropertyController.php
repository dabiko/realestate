<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\PropertyDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\PropertyCreateRequest;
use App\Models\Amenity;
use App\Models\Property;
use App\Models\Category;
use App\Models\User;
use App\Traits\ImageUploadTraits;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class PropertyController extends Controller
{
    use ImageUploadTraits;
    /**
     * Display a listing of the resource.
     */
    public function index(PropertyDataTable $dataTable)
    {
        $properties = Property::all();
        return $dataTable->render('admin.property.index',
            [
                'properties' => $properties
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $categories = Category::where('status', 1)->get();
        $agents = User::where('status', 'active')
            ->where('role', 'agent')
            ->latest()
            ->get();
        $amenities = Amenity::where('status', 1)->get();

        return view('admin.property.create',
            [
                'categories' => $categories,
                'agents' => $agents,
                'amenities' => $amenities
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     * @throws Exception
     */
    public function store(PropertyCreateRequest $request): RedirectResponse
    {
        $validate = $request->validated();

        $format_amenity = implode(",", $validate['amenity_id']);

        $code = IdGenerator::generate([
            'table' => 'properties',
            'field' => 'code',
            'length' => 7,
            'prefix' => 'PROP-'
        ]);


        $imagePath = $this->uploadImage($request, 'image', 'upload/property');

        Property::create([
            'thumbnail' => $imagePath,
            'user_id' => Auth::id(),
            'agent_id' => $validate['agent_id'],
            'category_id' => $validate['category_id'],
            'amenity_id' => $format_amenity,
            'name' => $validate['name'],
            'slug' => Str::slug($validate['name'], '-'),
            'code' => $code,
            'status' => $validate['status'],
            'low_price' => $validate['low_price'],
            'max_price' => $validate['max_price'],
            'video_link' => $validate['video_link'],
            'purpose' => $validate['purpose'],
            'tag' => $validate['tag'],
            'short_desc' => $validate['short_desc'],
            'long_desc' => $validate['long_desc'],
            'created_at' => Carbon::now()

        ]);


        return Redirect::route('admin.property.index')
            ->with(
                [
                    'status' => 'success',
                    'message' => 'property Created Successfully!!'
                ]
            );
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
