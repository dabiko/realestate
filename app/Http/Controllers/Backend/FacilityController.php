<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\FacilityDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\FacilityCreateRequest;
use App\Http\Requests\Backend\FacilityUpdateRequest;
use App\Models\Facility;
use App\Traits\EncryptDecrypt;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class FacilityController extends Controller
{
    use EncryptDecrypt;
    /**
     * Display a listing of the resource.
     */
    public function index(FacilityDataTable $dataTable)
    {
        $facilities = Facility::all();

        return $dataTable->render('admin.facility.index',
            [
                'facilities' => $facilities
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return View('admin.facility.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FacilityCreateRequest $request): RedirectResponse
    {
        $validate = $request->validated();

        Facility::create([
            'name' => $validate['name'],
            'status' => $validate['status'],
        ]);

        return Redirect::route('admin.facility.index')
            ->with([
                'status' => 'success',
                'message' => 'Facility created Successfully'
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
        $decrypted_id = $this->decryptId($id);

        $facility = Facility::findOrFail($decrypted_id);

        return View('admin.facility.edit',
            [
                'facility' => $facility
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FacilityUpdateRequest $request, string $id): RedirectResponse
    {
        $validate = $request->validated();
        $decrypted_id =  $this->decryptId($id);

        Facility::findOrFail($decrypted_id)->update([
            'name' => $validate['name'],
            'status' => $validate['status'],
        ]);


        return Redirect::route('admin.facility.index')
            ->with([
                'status' => 'success',
                'message' => 'Facility Updated Successfully'
            ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): Response
    {

        $decrypted_id = $this->decryptId($id);

        $facility = Facility::findOrFail($decrypted_id);

        if ($facility->status === 1){
            return response([
                'status' => 'error',
                'title' => 'Cant delete '.$facility->name,
                'message' => 'This Facility is still active. Deactivate before deleting',
            ]);
        }

        $facility->delete();
        return response([
            'status' => 'success',
            'message' => 'Facility Deleted successfully !!',
        ]);
    }

    /**
     * Update the status resource in storage.
     */
    public function updateStatus(Request $request): Response
    {
        $decrypted_id = $this->decryptId($request->id);
        $facility = Facility::findOrFail($decrypted_id);

        $facility->status = $request->status === 'true' ? 1 : 0;
        $facility->save();

        return response([
            'status' => 'success',
            'message' => $request->status === 'true' ? 'Status Activated Successfully !!' : 'Status Deactivated Successfully !!',
        ]);
    }
}
