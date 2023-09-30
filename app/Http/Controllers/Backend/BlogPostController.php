<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\BlogPostDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\BlogPostCreateRequest;
use App\Http\Requests\Backend\BlogPostUpdateRequest;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Traits\EncryptDecrypt;
use App\Traits\ImageUploadTraits;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BlogPostController extends Controller
{
    use EncryptDecrypt;
    use ImageUploadTraits;

    /**
     * Display a listing of the resource.
     */
    public function index(BlogPostDataTable $dataTable)
    {
        $posts = BlogPost::all();

        return $dataTable->render('admin.blog.post.index',
            [
                'posts' => $posts
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $categories = BlogCategory::where('status', 1)->get();
        return View('admin.blog.post.create',
            [
                'categories' => $categories,
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogPostCreateRequest $request): RedirectResponse
    {
        $validate = $request->validated();

        $tags = implode(",", $validate['tags']);



        $imagePath = $this->uploadImage($request, 'image', 'upload/blog/post');

        BlogPost::create([
            'image' => $imagePath,
            'user_id' => Auth::id(),
            'blog_category_id' => $validate['blog_category_id'],
            'tags' => $tags,
            'title' => $validate['title'],
            'slug' => Str::slug($validate['title'], '-'),
            'short_desc' => $validate['short_desc'],
            'long_desc' => $validate['long_desc'],
            'status' => $validate['status'],
        ]);


        return Redirect::route('admin.blog-post.index')
            ->with(
                [
                    'status' => 'success',
                    'message' => 'Post Created Successfully!!'
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

        $post = BlogPost::findOrFail($decrypted_id);

        $categories = BlogCategory::where('status', 1)->get();
        return View('admin.blog.post.edit',
            [
                'categories' => $categories,
                'post' => $post,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogPostUpdateRequest $request, string $id): RedirectResponse
    {
        $validate = $request->validated();

        $decrypted_id =  $this->decryptId($id);
        $tags = implode(",", $validate['tags']);

        $post = BlogPost::findOrFail($decrypted_id);

        $imagePath = $this->updateBlogPostImage($request, 'image', 'upload/blog/post', $post->image);
        $updatePath =  empty(!$request->image) ? $imagePath : $post->image;

        BlogPost::findOrFail($decrypted_id)->update([
            'image' => $updatePath,
            'user_id' => Auth::id(),
            'blog_category_id' => $validate['blog_category_id'],
            'tags' => $tags,
            'title' => $validate['title'],
            'slug' => Str::slug($validate['title'], '-'),
            'short_desc' => $validate['short_desc'],
            'long_desc' => $validate['long_desc'],
            'status' => $validate['status'],
        ]);


        return Redirect::route('admin.blog-post.index')
            ->with([
                'status' => 'success',
                'message' => $validate['title']. ' Updated Successfully'
            ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): Response
    {
        $decrypted_id = $this->decryptId($id);

        $blog_post = BlogPost::findOrFail($decrypted_id);

        if ($blog_post->status === 1){
            return response([
                'status' => 'error',
                'title' => 'Cant delete '.$blog_post->title,
                'message' => 'This Blog Post is still active. Deactivate before deleting',
            ]);
        }
        $this->deleteImage($blog_post->image);
        $blog_post->delete();
        return response([
            'status' => 'success',
            'message' => 'State Deleted successfully !!',
        ]);
    }


    /**
     * Update the status resource in storage.
     */
    public function updateBlogPost(Request $request): Response
    {
        $decrypted_id = $this->decryptId($request->id);
        $post_id = BlogPost::findOrFail($decrypted_id);

        $post_id->status = $request->status === 'true' ? 1 : 0;
        $post_id->save();

        return response([
            'status' => 'success',
            'message' => $request->status === 'true' ? 'Status Activated Successfully !!' : 'Status Deactivated Successfully !!',
        ]);
    }
}
