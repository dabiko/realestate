<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\DetailDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\DetailCreateRequest;
use App\Http\Requests\Backend\DetailUpdateRequest;
use App\Models\Detail;
use App\Traits\EncryptDecrypt;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class DetailController extends Controller
{
    use EncryptDecrypt;
    /**
     * Display a listing of the resource.
     */
    public function index(DetailDataTable $dataTable)
    {
        $details = Detail::all();

        return $dataTable->render('admin.detail.index',
            [
                'details' => $details
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return View('admin.detail.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DetailCreateRequest $request): RedirectResponse
    {
        $validate = $request->validated();

        Detail::create([
            'name' => $validate['name'],
            'status' => $validate['status'],
        ]);

        return Redirect::route('admin.detail.index')
            ->with([
                'status' => 'success',
                'message' => 'Detail created Successfully'
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

        $detail = Detail::findOrFail($decrypted_id);

        return View('admin.detail.edit',
            [
                'detail' => $detail
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DetailUpdateRequest $request, string $id): RedirectResponse
    {
        $validate = $request->validated();
        $decrypted_id =  $this->decryptId($id);

        Detail::findOrFail($decrypted_id)->update([
            'name' => $validate['name'],
            'status' => $validate['status'],
        ]);


        return Redirect::route('admin.detail.index')
            ->with([
                'status' => 'success',
                'message' => 'Detail Updated Successfully'
            ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): Response
    {
        $decrypted_id = $this->decryptId($id);

        $detail = Detail::findOrFail($decrypted_id);

        if ($detail->status === 1){
            return response([
                'status' => 'error',
                'title' => 'Cant delete '.$detail->name,
                'message' => 'This Detail is still active. Deactivate before deleting',
            ]);
        }

        $detail->delete();
        return response([
            'status' => 'success',
            'message' => 'Detail Deleted successfully !!',
        ]);
    }

    /**
     * Update the status resource in storage.
     */
    public function updateStatus(Request $request): Response
    {
        $decrypted_id = $this->decryptId($request->id);
        $detail = Detail::findOrFail($decrypted_id);

        $detail->status = $request->status === 'true' ? 1 : 0;
        $detail->save();

        return response([
            'status' => 'success',
            'message' => $request->status === 'true' ? 'Status Activated Successfully !!' : 'Status Deactivated Successfully !!',
        ]);
    }
}
