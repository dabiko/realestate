<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\PropertyDetailDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\PropertyDetailCreateRequest;
use App\Http\Requests\Backend\PropertyDetailUpdateRequest;
use App\Models\Detail;
use App\Models\Property;
use App\Models\PropertyDetail;
use App\Models\PropertyVariant;
use App\Traits\EncryptDecrypt;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class PropertyDetailController extends Controller
{
    use EncryptDecrypt;
    /**
     * Display a listing of the resource.
     */
    public function index(PropertyDetailDataTable $dataTable)
    {
        $property_id = $this->decryptId(request()->property);
        $property = Property::findOrFail($property_id);
        $count = PropertyDetail::where('property_id', $property_id)->count();
        $propertyDetail = PropertyDetail::all();


        return $dataTable->render('admin.property.detail.index',
            [
                'property' => $property,
                'propertyDetail' => $propertyDetail,
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
        $details = Detail::where('status', 1)->get();

        return View('admin.property.detail.create',
             [
                 'property' => $property,
                 'details' => $details,
                 'property_id' => request()->property
             ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PropertyDetailCreateRequest $request): RedirectResponse
    {
        $validate = $request->validated();
        $property_id = $this->decryptId($validate['property_id']);

        PropertyDetail::create([
            'property_id' => $property_id,
            'detail_id' => $validate['detail_id'],
            'value' => $validate['value'],
            'status' => $validate['status'],
        ]);

       return Redirect::route('admin.property-detail.index', ['property' => $validate['property_id']])
            ->with([
                'status' => 'success',
                'message' => 'Detail created successfully'
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

        $property_detail = PropertyDetail::findOrFail($decrypted_id);
        $details = Detail::where('status', 1)->get();
        $all_detail = PropertyDetail::all('detail_id');

        return view('admin.property.detail.edit',
            [
                'property_detail' => $property_detail,
                'details' => $details,
                'all_detail' => $all_detail,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PropertyDetailUpdateRequest $request, string $id):Response | RedirectResponse
    {
        $validate = $request->validated();

        $decrypted_id = $this->decryptId($id);
        $detail_id = $this->decryptId($validate['detail_id']);

//        $detail_count = PropertyDetail::where('detail_id', $detail_id)->get();
//
//        if ($detail_count === $detail_id){
//            return Redirect::route('admin.property-detail.index', ['property' => ['property' => $validate['property_id'] ]])
//            ->with([
//                'status' => 'error',
////                'title' => $detail_count->detail->name,
//                'message' => 'This is already existing. You can only modify now',
//            ]);
//        }

        PropertyDetail::findOrFail($decrypted_id)->update([
            'detail_id' => $detail_id,
            'value' => $validate['value'],
            'status' => $validate['status'],
        ]);

        return Redirect::route('admin.property-detail.index', ['property' => $validate['property_id'] ])
            ->with([
                'status' => 'success',
                'message' => 'Detail created successfully'
            ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): Response
    {
        $decrypted_id = $this->decryptId($id);

        $property_detail = PropertyDetail::findOrFail($decrypted_id);

        if ($property_detail->status === 1){
            return response([
                'status' => 'error',
                'title' => 'Cant delete '.$property_detail->detail->name,
                'message' => 'This is still active and live. Deactivate before deleting',
            ]);
        }

        $property_detail->delete();
        return response([
            'status' => 'success',
            'message' => $property_detail->detail->name. ' Deleted successfully !!',
        ]);
    }

    /**
     * Update the status resource in storage.
     */
    public function updateStatus(Request $request): Response
    {
        $decrypted_id = $this->decryptId($request->id);

        $property_detail = PropertyDetail::findOrFail($decrypted_id);

        $property_detail->status = $request->status === 'true' ? 1 : 0;
        $property_detail->save();

        return response([
            'status' => 'success',
            'message' => $request->status === 'true' ? 'Status Activated Successfully !!' : 'Status Deactivated Successfully !!',
        ]);
    }
}
