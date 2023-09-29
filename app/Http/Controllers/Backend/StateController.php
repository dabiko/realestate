<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\StateDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\StateCreateRequest;
use App\Http\Requests\Backend\StateUpdateRequest;
use App\Models\State;
use App\Traits\EncryptDecrypt;
use App\Traits\ImageUploadTraits;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class StateController extends Controller
{
    use  EncryptDecrypt;
    use ImageUploadTraits;

    /**
     * Display a listing of the resource.
     */
    public function index(StateDataTable $dataTable)
    {
        $states = State::all();

        return $dataTable->render('admin.state.index',
            [
                'states' => $states
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.state.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StateCreateRequest $request): RedirectResponse
    {
        $validate = $request->validated();

        $imagePath = $this->uploadImage($request, 'image', 'upload/state/admin');

        State::create([
            'image' => $imagePath,
            'name' => $validate['name'],
            'status' => $validate['status'],
        ]);

        return Redirect::route('admin.state.index')
            ->with([
                'status' => 'success',
                'message' => 'State created Successfully'
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

        $state = State::findOrFail($decrypted_id);

        return view('admin.state.edit',
            [
                'state' => $state
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StateUpdateRequest $request, string $id): RedirectResponse
    {
        $validate = $request->validated();

        $decrypted_id =  $this->decryptId($id);
        $state = State::findOrFail($decrypted_id);

        $imagePath = $this->updateStateImage($request, 'image', 'upload/state/admin', $state->image);
        $updatePath =  empty(!$request->image) ? $imagePath : $state->image;

        State::findOrFail($decrypted_id)->update([
            'image' => $updatePath,
            'name' => $validate['name'],
            'status' => $validate['status'],
        ]);


        return Redirect::route('admin.state.index')
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

        $state = State::findOrFail($decrypted_id);

        if ($state->status === 1){
            return response([
                'status' => 'error',
                'title' => 'Cant delete '.$state->name,
                'message' => 'This State is still active. Deactivate before deleting',
            ]);
        }
        $this->deleteImage($state->image);
        $state->delete();
        return response([
            'status' => 'success',
            'message' => 'State Deleted successfully !!',
        ]);
    }


    /**
     * Update the status resource in storage.
     */
    public function updateStatus(Request $request): Response
    {
        $decrypted_id = $this->decryptId($request->id);
        $amenity = State::findOrFail($decrypted_id);

        $amenity->status = $request->status === 'true' ? 1 : 0;
        $amenity->save();

        return response([
            'status' => 'success',
            'message' => $request->status === 'true' ? 'Status Activated Successfully !!' : 'Status Deactivated Successfully !!',
        ]);
    }
}
