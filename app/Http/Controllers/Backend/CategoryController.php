<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\CategoryDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\CreateCategoryRequest;
use App\Http\Requests\Backend\UpdateCategoryRequest;
use App\Models\Category;
use App\Traits\CategoriesAuthPermissions;
use App\Traits\EncryptDecrypt;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class CategoryController extends Controller
{
    use EncryptDecrypt;
    use CategoriesAuthPermissions;

    /**
     * Display a listing of the resource.
     */
    public function index(CategoryDataTable $dataTable)
    {
        $categories = Category::all();

        return $dataTable->render('admin.category.index',
            [
                'categories' => $categories
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCategoryRequest $request): RedirectResponse
    {
        $validate = $request->validated();

        Category::create([
            'user_id' => Auth::id(),
            'name' => $validate['name'],
            'icon' => $validate['icon'],
            'status' => $validate['status'],
        ]);

        return Redirect::route('admin.category.index')
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

        $category = Category::findOrFail($decrypted_id);

        return view('admin.category.edit',
            [
                'category' => $category
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, string $id): RedirectResponse
    {
        $validate = $request->validated();

        $decrypted_id =  $this->decryptId($id);

        Category::findOrFail($decrypted_id)->update([
            'icon' => $validate['icon'],
            'name' => $validate['name'],
            'status' => $validate['status'],
        ]);


        return Redirect::route('admin.category.index')
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

        $propertyCat = Category::findOrFail($decrypted_id);

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
            'message' => 'Category Deleted successfully !!',
        ]);
    }

    /**
     * Update the status resource in storage.
     */
    public function updateStatus(Request $request): Response
    {
        $decrypted_id = $this->decryptId($request->id);
        $propertyCat = Category::findOrFail($decrypted_id);

        $propertyCat->status = $request->status === 'true' ? 1 : 0;
        $propertyCat->save();

        return response([
            'status' => 'success',
            'message' => $request->status === 'true' ? 'Status Activated Successfully !!' : 'Status Deactivated Successfully !!',
        ]);
    }
}
