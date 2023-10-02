<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\BlogPostCommentDataTable;
use App\Http\Controllers\Controller;
use App\Models\BlogPostComment;
use App\Traits\EncryptDecrypt;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BlogPostCommentController extends Controller
{
    use EncryptDecrypt;
    /**
     * Display a listing of the resource.
     */
    public function index(BlogPostCommentDataTable $dataTable)
    {
        $comments = BlogPostComment::all();

        return $dataTable->render('admin.blog.comment.index',
            [
                'comments' => $comments
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): Response
    {
        $decrypted_id = $this->decryptId($id);

        $blog_comment = BlogPostComment::findOrFail($decrypted_id);

        if ($blog_comment->status === 1){
            return response([
                'status' => 'error',
                'title' => 'Cant delete '.$blog_comment->subject,
                'message' => 'This Blog Post Comment is still active. Deactivate before deleting',
            ]);
        }

        $blog_comment->delete();
        return response([
            'status' => 'success',
            'message' => 'Comment Deleted successfully !!',
        ]);
    }


    /**
     * Update the status resource in storage.
     */
    public function updateBlogPostComment(Request $request): Response
    {
        $decrypted_id = $this->decryptId($request->id);
        $comment_id = BlogPostComment::findOrFail($decrypted_id);

        $comment_id->status = $request->status === 'true' ? 1 : 0;
        $comment_id->save();

        return response([
            'status' => 'success',
            'message' => $request->status === 'true' ? 'Status Activated Successfully !!' : 'Status Deactivated Successfully !!',
        ]);
    }
}
