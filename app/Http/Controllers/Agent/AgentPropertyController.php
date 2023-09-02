<?php

namespace App\Http\Controllers\Agent;

use App\DataTables\PackagePlanDataTable;
use App\DataTables\PropertyDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\PropertyCreateRequest;
use App\Http\Requests\Backend\PropertyUpdateRequest;
use App\Models\Amenity;
use App\Models\Category;
use App\Models\PackagePlan;
use App\Models\Property;
use App\Models\PropertyDetail;
use App\Models\PropertyFacility;
use App\Models\PropertyLocation;
use App\Models\PropertyPlan;
use App\Models\User;
use App\Traits\EncryptDecrypt;
use App\Traits\ImageUploadTraits;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AgentPropertyController extends Controller
{
    use ImageUploadTraits;
    use EncryptDecrypt;
    /**
     * Display a listing of the resource.
     */
    public function index(PropertyDataTable $dataTable)
    {
        //$properties = Property::all();
        $properties = Property::where('agent_id', Auth::id())->get();
        return $dataTable->render('agent.property.index',
            [
                'properties' => $properties
            ]
        );
    }

    /**
     * Display a listing of the resource.
     */
    public function history(PackagePlanDataTable $dataTable)
    {
        //$properties = Property::all();
        $package = PackagePlan::where('user_id', Auth::id())->get();
        return $dataTable->render('agent.package.history.index',
            [
                'package' => $package
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): RedirectResponse | View
    {
        $categories = Category::where('status', 1)->get();
        $agent = User::where('id', Auth::id())
            ->where('role', 'agent')
            ->first();

        $amenities = Amenity::where('status', 1)->get();

        if ($agent->credit == 1 || $agent->credit == 7){

            return Redirect::route('agent.packages');

        }else{

            return view('agent.property.create',
                [
                    'categories' => $categories,
                    'agent' => $agent,
                    'amenities' => $amenities
                ]
            );
        }

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


        $imagePath = $this->uploadImage($request, 'image', 'upload/property/agent');

        Property::create([
            'thumbnail' => $imagePath,
            'user_id' => Auth::id(),
            'agent_id' => $validate['agent_id'],
            'category_id' => $validate['category_id'],
            'amenity_id' => $format_amenity,
            'name' => $validate['name'],
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

        $user = User::findOrFail(Auth::id());

        User::where('id',$user->id)->update([
            'credit' => DB::raw('1 + '.$user->credit)
        ]);

        return Redirect::route('agent.property.index')
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
        $categories = Category::where('status', 1)->get();
        $agents = User::where('id', Auth::id())
            ->where('role', 'agent')
            ->latest()
            ->get();
        $amenities = Amenity::where('status', 1)->get();

        $array_amenity = explode(",", $property->amenity_id);

        return view('agent.property.edit',
            [
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


        $imagePath = $this->updatePropertyImage($request, 'image', 'upload/property/agent', $property->thumbnail);
        $updatePath =  empty(!$request->image) ? $imagePath : $property->thumbnail;

        Property::findOrFail($decrypted_id)->update([
            'thumbnail' => $updatePath,
            'user_id' => $property->user_id,
            'agent_id' => $validate['agent_id'],
            'category_id' => $validate['category_id'],
            'amenity_id' => $format_amenity,
            'name' => $validate['name'],
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

        return Redirect::route('agent.property.index')
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

    public function package(): View
    {
        $agent = User::where('id', Auth::id())
            ->where('role', 'agent')
            ->first();

        return View('agent.package.packages',
            [
                'agent' => $agent
            ]
        );
    }

    public function business(): View
    {
        $agent = User::where('id', Auth::id())
            ->where('role', 'agent')
            ->first();

        return View('agent.package.business.business-package',
            [
                'agent' => $agent
            ]
        );
    }

    public function professional(): View
    {
        $agent = User::where('id', Auth::id())
            ->where('role', 'agent')
            ->first();

        return View('agent.package.professional.professional-package',
            [
                'agent' => $agent
            ]
        );
    }

    public function processBusiness(Request $request): RedirectResponse
    {

        PackagePlan::create([
            'user_id' => Auth::id(),
            'name' => 'Business',
            'credit' => '3',
            'invoice' => 'HOMES'.mt_rand(10000000,99999999),
            'amount' => '20'
        ]);

        $user = User::findOrFail(Auth::id());

        User::where('id',$user->id)->update([
            'credit' => DB::raw('3 + '.$user->credit)
        ]);

        return Redirect::route('agent.packages')
            ->with([
                'status' => 'success',
                'message' => 'Business Package Purchased'
            ]);
    }

    public function processProfessional(Request $request): RedirectResponse
    {

        PackagePlan::create([
            'user_id' => Auth::id(),
            'name' => 'Professional',
            'credit' => '10',
            'invoice' => 'HOMES'.mt_rand(10000000,99999999),
            'amount' => '50'
        ]);

        $user = User::findOrFail(Auth::id());

        User::where('id',$user->id)->update([
            'credit' => DB::raw('10 + '.$user->credit)
        ]);

        return Redirect::route('agent.packages')
            ->with([
                'status' => 'success',
                'message' => 'professional Package Purchased'
            ]);
    }


    public function invoice(string $id): Response
    {
        $decrypted_id = $this->decryptId($id);

        $package_plan = PackagePlan::where('id', $decrypted_id)->first();

        $pdf = Pdf::loadView('agent.package.print.index',
            [
                'package_plan' => $package_plan
            ]
        )
            ->setPaper('a4')
            ->setOption([
                'tempDir' => public_path(),
                'chroot' => public_path(),
                'defaultFont' => 'sans-serif'
            ]);

        return $pdf->download($package_plan->name.'_'.$package_plan->invoice.'_'.'invoice.pdf');
    }
}
