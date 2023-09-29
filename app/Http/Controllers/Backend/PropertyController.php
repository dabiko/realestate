<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\PropertyDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\PropertyCreateRequest;
use App\Http\Requests\Backend\PropertyUpdateRequest;
use App\Models\Amenity;
use App\Models\Property;
use App\Models\Category;
use App\Models\PropertyDetail;
use App\Models\PropertyFacility;
use App\Models\PropertyLocation;
use App\Models\PropertyMessage;
use App\Models\PropertyPlan;
use App\Models\State;
use App\Models\User;
use App\Traits\EncryptDecrypt;
use App\Traits\ImageUploadTraits;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class PropertyController extends Controller
{
    use ImageUploadTraits;
    use EncryptDecrypt;
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
        $states = State::where('status', 1)->get();
        $agents = User::where('status', 'active')
            ->where('role', 'agent')
            ->latest()
            ->get();
        $amenities = Amenity::where('status', 1)->get();

        return view('admin.property.create',
            [
                'states' => $states,
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
            'length' => 8,
            'prefix' => 'PROP-'
        ]);


        $imagePath = $this->uploadImage($request, 'image', 'upload/property/admin');

        Property::create([
            'thumbnail' => $imagePath,
            'user_id' => Auth::id(),
            'agent_id' => $validate['agent_id'],
            'category_id' => $validate['category_id'],
            'state_id' => $validate['state'],
            'amenity_id' => $format_amenity,
            'name' => $validate['name'],
            'beds' => $validate['beds'],
            'bath' => $validate['bath'],
            'size' => $validate['size'],
            'slug' => Str::slug($validate['name'], '-'),
            'code' => $code,
            'low_price' => $validate['low_price'],
            'max_price' => $validate['max_price'],
            'video_link' => $validate['video_link'],
            'purpose' => $validate['purpose'],
            'tag' => $validate['tag'],
            'short_desc' => $validate['short_desc'],
            'long_desc' => $validate['long_desc'],
            'created_at' => now()

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
    public function edit(string $id): View
    {
        $decrypted_id =  $this->decryptId($id);

        $property = Property::findOrFail($decrypted_id);
        $states = State::where('status', 1)->get();
        $categories = Category::where('status', 1)->get();
        $agents = User::where('status', 'active')
            ->where('role', 'agent')
            ->latest()
            ->get();
        $amenities = Amenity::where('status', 1)->get();

        $array_amenity = explode(",", $property->amenity_id);

        return view('admin.property.edit',
            [
                'states' => $states,
                'property' => $property,
                'categories' => $categories,
                'agents' => $agents,
                'amenities' => $amenities,
                'array_amenity' => $array_amenity,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PropertyUpdateRequest $request, string $id): RedirectResponse
    {

        $validate = $request->validated();

        $decrypted_id =  $this->decryptId($id);

        $property = Property::findOrFail($decrypted_id);

        $format_amenity = implode(",", $validate['amenity_id']);


        $imagePath = $this->updatePropertyImage($request, 'image', 'upload/property/admin', $property->thumbnail);
        $updatePath =  empty(!$request->image) ? $imagePath : $property->thumbnail;

        Property::findOrFail($decrypted_id)->update([
            'thumbnail' => $updatePath,
            'user_id' => $property->user_id,
            'agent_id' => $validate['agent_id'],
            'category_id' => $validate['category_id'],
            'state_id' => $validate['state'],
            'amenity_id' => $format_amenity,
            'name' => $validate['name'],
            'beds' => $validate['beds'],
            'bath' => $validate['bath'],
            'size' => $validate['size'],
            'slug' => Str::slug($validate['name'], '-'),
            'code' => $property->code,
            'status' => $property->status,
            'low_price' => $validate['low_price'],
            'max_price' => $validate['max_price'],
            'video_link' => $validate['video_link'],
            'purpose' => $validate['purpose'],
            'tag' => $validate['tag'],
            'short_desc' => $validate['short_desc'],
            'long_desc' => $validate['long_desc'],
            'updated_at' => now()
        ]);

        return Redirect::route('admin.property.index')
            ->with(
                [
                    'status' => 'success',
                    'message' => 'property Updated Successfully!!'
                ]
            );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): Response
    {

        $decrypted_id = $this->decryptId($id);

        $property = Property::findOrFail($decrypted_id);
        $details = PropertyDetail::where('property_id', $decrypted_id)->count();
        $plans = PropertyPlan::where('property_id', $decrypted_id)->count();
        $locations = PropertyLocation::where('property_id', $decrypted_id)->count();
        $facility = PropertyFacility::where('property_id', $decrypted_id)->count();

        if ($details > 0 || $plans > 0 || $locations > 0 || $facility > 0){
            return response([
                'status' => 'error',
                'title' => 'Cant delete this Property',
                'message' => 'It contains information on Details, location , plan and facilities.
                 Delete all sub variant items before deleting this property',
            ]);
        }

        if ($property->is_approved === 1){
            return response([
                'status' => 'error',
                'title' => 'Cant delete '.$property->name,
                'message' => 'This Property is still active and live. Deactivate before deleting',
            ]);
        }

        $property->delete();
        return response([
            'status' => 'success',
            'message' => 'Property Deleted successfully !!',
        ]);
    }

    /**
     * Update the status resource in storage.
     */
    public function checkIsApproved(Request $request): Response
    {
        $decrypted_id = $this->decryptId($request->id);
        $property = Property::findOrFail($decrypted_id);

        return response([
            'status' => 'success',
            'response' =>  $property->is_approved,

        ]);
    }


    /**
     * Update the status resource in storage.
     */
    public function updateStatus(Request $request): Response
    {
        $decrypted_id = $this->decryptId($request->id);
        $property = Property::findOrFail($decrypted_id);

        $property->is_approved = $request->status === 'true' ? 1 : 0;
        $property->save();

        return response([
            'status' => 'success',
            'message' => $request->status === 'true' ? 'Project Approved' : 'Project Suspended',
        ]);
    }


    public function messages(): View
    {
        $agentMessages = PropertyMessage::with(['user','property'])->get();


        $count = PropertyMessage::count();


        return View('admin.property.messages.index',
            [
                'count' => $count,
                'agentMessages' => $agentMessages
            ]
        );

    }

    public function messageDetails(string $id): View
    {
        $message_id = $this->decryptId($id);
        $agentMessages = PropertyMessage::with(['user','property'])->get();

        $count = PropertyMessage::count();

        $details = PropertyMessage::findOrFail($message_id);


        return View('admin.property.messages.index',
            [
                'count' => $count,
                'agentMessages' => $agentMessages,
                'details' => $details,

            ]
        );

    }


}
