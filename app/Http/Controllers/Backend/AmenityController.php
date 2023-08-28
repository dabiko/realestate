<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\AmenityDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\CreateAmenityRequest;
use App\Http\Requests\Backend\UpdateAmenityRequest;
use App\Models\Amenity;
use App\Traits\EncryptDecrypt;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class AmenityController extends Controller
{
    use EncryptDecrypt;
    /**
     * Display a listing of the resource.
     */
    public function index(AmenityDataTable $dataTable)
    {
        $amenities = Amenity::all();

        return $dataTable->render('admin.amenity.index',
            [
                'amenities' => $amenities
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.amenity.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateAmenityRequest $request): RedirectResponse
    {
        $validate = $request->validated();

        Amenity::create([
            'user_id' => Auth::id(),
            'name' => $validate['name'],
            'status' => $validate['status'],
        ]);

        return Redirect::route('admin.amenity.index')
            ->with([
                'status' => 'success',
                'message' => 'Amenity Successfully'
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

        $amenity = Amenity::findOrFail($decrypted_id);

        return view('admin.amenity.edit',
            [
                'amenity' => $amenity
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAmenityRequest $request, string $id): RedirectResponse
    {
        $validate = $request->validated();

        $decrypted_id =  $this->decryptId($id);

        Amenity::findOrFail($decrypted_id)->update([
            'name' => $validate['name'],
            'status' => $validate['status'],
        ]);


        return Redirect::route('admin.amenity.index')
            ->with([
                'status' => 'success',
                'message' => $validate['name']. ' Updated Successfully'
            ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): Response
    {
        $decrypted_id = $this->decryptId($id);

        $amenity = Amenity::findOrFail($decrypted_id);

        if ($amenity->status === 1){
            return response([
                'status' => 'error',
                'title' => 'Cant delete '.$amenity->name,
                'message' => 'This Amenity is still active. Deactivate before deleting',
            ]);
        }

        $amenity->delete();
        return response([
            'status' => 'success',
            'message' => 'Amenity Deleted successfully !!',
        ]);
    }


    /**
     * Update the status resource in storage.
     */
    public function updateStatus(Request $request): Response
    {
        $decrypted_id = $this->decryptId($request->id);
        $amenity = Amenity::findOrFail($decrypted_id);

        $amenity->status = $request->status === 'true' ? 1 : 0;
        $amenity->save();

        return response([
            'status' => 'success',
            'message' => $request->status === 'true' ? 'Status Activated Successfully !!' : 'Status Deactivated Successfully !!',
        ]);
    }
}
