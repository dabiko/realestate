<?php

namespace App\Http\Controllers\Agent;

use App\DataTables\PropertyPlanDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\PropertyPlanCreateRequest;
use App\Http\Requests\Backend\PropertyPlanUpdateRequest;
use App\Models\Property;
use App\Models\PropertyPlan;
use App\Traits\EncryptDecrypt;
use App\Traits\ImageUploadTraits;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class AgentPropertyPlanController extends Controller
{
    use EncryptDecrypt;
    use ImageUploadTraits;
    /**
     * Display a listing of the resource.
     */
    public function index(PropertyPlanDataTable $dataTable)
    {
        $property_id = $this->decryptId(request()->property);
        $property = Property::findOrFail($property_id);

        $count = PropertyPlan::where('property_id', $property_id)->count();
        $propertyPlan = PropertyPlan::all();


        return $dataTable->render('agent.property.plan.index',
            [
                'property' => $property,
                'propertyPlan' => $propertyPlan,
                'count' => $count
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

        return View('agent.property.plan.create',
            [
                'property' => $property,
                'property_id' => request()->property
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PropertyPlanCreateRequest $request): RedirectResponse
    {
        $validate = $request->validated();

        $property_id = $this->decryptId($validate['property_id']);
        $imagePath = $this->uploadPlanImage($request,'image', 'upload/property/agent/plan');

        PropertyPlan::create([
            'property_id' => $property_id,
            'name' => $validate['name'],
            'image' => $imagePath,
            'short_desc' => $validate['short_desc'],
            'status' => $validate['status'],
        ]);

        return Redirect::route('agent.property-plan.index', ['property' => $validate['property_id']])
            ->with([
                'status' => 'success',
                'message' => 'Plan created successfully'
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

        $property_plan = PropertyPlan::findOrFail($decrypted_id);

        return view('agent.property.plan.edit',
            [
                'property_plan' => $property_plan,

            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PropertyPlanUpdateRequest $request, string $id): RedirectResponse
    {
        $validate = $request->validated();

        $decrypted_id = $this->decryptId($id);
        $old_path = PropertyPlan::findOrFail($decrypted_id);

        $imagePath = $this->updatePlanImage($request, 'image', 'upload/property/agent/plan', $old_path->image);
        $updatePath =  empty(!$request->image) ? $imagePath : $old_path->image;


        PropertyPlan::findOrFail($decrypted_id)->update([
            'image' => $updatePath,
            'name' => $validate['name'],
            'short_desc' => $validate['short_desc'],
            'status' => $validate['status'],
        ]);


        return Redirect::route('agent.property-plan.index', ['property' => $validate['property_id'] ])
            ->with([
                'status' => 'success',
                'message' => 'Plan Updated successfully'
            ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): Response
    {
        $decrypted_id = $this->decryptId($id);

        $property_plan = PropertyPlan::findOrFail($decrypted_id);

        if ($property_plan->status === 1){
            return response([
                'status' => 'error',
                'title' => 'Cant delete '.$property_plan->name,
                'message' => 'This is still active and live. Deactivate before deleting',
            ]);
        }

        $property_plan->delete();
        return response([
            'status' => 'success',
            'message' => $property_plan->name. ' Deleted successfully !!',
        ]);
    }

    /**
     * Update the status resource in storage.
     */
    public function updateStatus(Request $request): Response
    {
        $decrypted_id = $this->decryptId($request->id);
        $property_plan = PropertyPlan::findOrFail($decrypted_id);

        $property_plan->status = $request->status === 'true' ? 1 : 0;
        $property_plan->save();

        return response([
            'status' => 'success',
            'message' => $request->status === 'true' ? 'Plan Approved' : 'Plan Suspended',
        ]);
    }



    /**
     * Update the status resource in storage.
     */
    public function updateDefault(Request $request): Response
    {
        $decrypted_id = $this->decryptId($request->id);
        $property_plan = PropertyPlan::findOrFail($decrypted_id);

        $property_plan->is_default = $request->status === 'true' ? 1 : 0;
        $property_plan->save();

        return response([
            'status' => 'success',
            'message' => $request->status === 'true' ? $property_plan->name.' set to default' : $property_plan->name.' removed from default',
        ]);
    }

}
