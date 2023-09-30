<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\BlogCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\BlogCategoryCreateRequest;
use App\Http\Requests\Backend\BlogCategoryUpdateRequest;
use App\Models\BlogCategory;
use App\Traits\EncryptDecrypt;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BlogCategoryController extends Controller
{
    use EncryptDecrypt;

    /**
     * Display a listing of the resource.
     */
    public function index(BlogCategoryDataTable $dataTable)
    {
        $categories = BlogCategory::all();

        return $dataTable->render('admin.blog.category.index',
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
        return view('admin.blog.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogCategoryCreateRequest $request): RedirectResponse
    {
        $validate = $request->validated();

        BlogCategory::create([
            'user_id' => Auth::id(),
            'name' => $validate['name'],
            'slug' => Str::slug($validate['name'], '-'),
            'status' => $validate['status'],
        ]);

        return Redirect::route('admin.blog-category.index')
            ->with([
                'status' => 'success',
                'message' => 'Blog category Successfully'
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

        $category = BlogCategory::findOrFail($decrypted_id);

        return view('admin.blog.category.edit',
            [
                'category' => $category
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogCategoryUpdateRequest $request, string $id): RedirectResponse
    {
        $validate = $request->validated();

        $decrypted_id =  $this->decryptId($id);

        BlogCategory::findOrFail($decrypted_id)->update([
            'name' => $validate['name'],
            'slug' => Str::slug($validate['name'], '-'),
            'status' => $validate['status'],
        ]);


        return Redirect::route('admin.blog-category.index')
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

        $category_id = BlogCategory::findOrFail($decrypted_id);

        if ($category_id->status === 1){
            return response([
                'status' => 'error',
                'title' => 'Cant delete '.$category_id->name,
                'message' => 'This Blog Category is still active. Deactivate before deleting',
            ]);
        }

        $category_id->delete();
        return response([
            'status' => 'success',
            'message' => 'Blog Category Deleted successfully !!',
        ]);
    }

    /**
     * Update the status resource in storage.
     */
    public function updateBlogCategory(Request $request): Response
    {
        $decrypted_id = $this->decryptId($request->id);
        $category_id = BlogCategory::findOrFail($decrypted_id);

        $category_id->status = $request->status === 'true' ? 1 : 0;
        $category_id->save();

        return response([
            'status' => 'success',
            'message' => $request->status === 'true' ? 'Status Activated Successfully !!' : 'Status Deactivated Successfully !!',
        ]);
    }
}
