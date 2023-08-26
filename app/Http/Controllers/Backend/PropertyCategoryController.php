<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreatePropertyCategoryRequest;
use App\Http\Requests\Backend\UpdatePropertyCategoryRequest;
use App\Models\PropertyCategory;
use App\Traits\EncryptDecrypt;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class PropertyCategoryController extends Controller
{
    use EncryptDecrypt;

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $propertyCat = PropertyCategory::all();
        return view('admin.property-category.index',
            [
                'propertyCat' => $propertyCat
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.property-category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreatePropertyCategoryRequest $request): RedirectResponse
    {
        $validate = $request->validated();

        PropertyCategory::create([
            'name' => $validate['name'],
            'icon' => $validate['icon'],
            'status' => $validate['status'],
        ]);

        return Redirect::route('admin.property-category.index')
            ->with([
                'status' => 'success',
                'message' => 'Property category Successfully'
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

        $propertyCat = PropertyCategory::findOrFail($decrypted_id);

        return view('admin.property-category.edit',
            [
                'propertyCat' => $propertyCat
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePropertyCategoryRequest $request, string $id): RedirectResponse
    {
        $validate = $request->validated();

        $decrypted_id =  $this->decryptId($id);

        PropertyCategory::findOrFail($decrypted_id)->update([
            'icon' => $validate['icon'],
            'name' => $validate['name'],
            'status' => $validate['status'],
        ]);


        return Redirect::route('admin.property-category.index')
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

        $propertyCat = PropertyCategory::findOrFail($decrypted_id);

        if ($propertyCat->status === 1){
            return response([
                'status' => 'error',
                'title' => 'Cant delete '.$propertyCat->name,
                'message' => 'This Category is still active. Deactivate before deleting',
            ]);
        }

        $propertyCat->delete();
        return response([
            'status' => 'success',
            'message' => 'Property Category Deleted successfully !!',
        ]);
    }

    /**
     * Update the status resource in storage.
     */
    public function updateStatus(Request $request): Response
    {
        $propertyCat = PropertyCategory::findOrFail($request->id);

        $propertyCat->status = $request->status === 'true' ? 1 : 0;
        $propertyCat->save();

        return response([
            'status' => 'success',
            'message' => $request->status === 'true' ? 'Status Activated Successfully !!' : 'Status Deactivated Successfully !!',
        ]);
    }
}
