<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\BlogPostComment;
use App\Traits\EncryptDecrypt;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class BlogPostController extends Controller
{
    use EncryptDecrypt;

    public function index(): View
    {
        $blog_post = BlogPost::where('status', 1)
            ->orderBy('id', 'DESC')
            ->paginate(8);

        $categories = BlogCategory::where('status', 1)
            ->orderBy('id', 'DESC')
            ->get();



        return view('frontend.pages.blog.posts',
            [
                'blog_post' => $blog_post,
                'categories' => $categories
            ]
        );
    }


    public function blogPostDetail(string $id): View
    {
        $decrypt_id = $this->decryptId($id);

        $post = BlogPost::findOrFail($decrypt_id);

        $categories = BlogCategory::where('status', 1)
            ->orderBy('id', 'DESC')
            ->get();

        $blog_post = BlogPost::where('status', 1)
            ->orderBy('id', 'DESC')
            ->get();

        $array_tags = explode(",", $post->tags);

        $blog_post_comments = BlogPostComment::where('status', 1)
            ->where('blog_posts_id', $post->id)
            ->orderBy('id', 'DESC')
            ->get();

        return View('frontend.pages.blog.post-detail',
            [
                'post' => $post,
                'array_tags' => $array_tags,
                'categories' => $categories,
                'blog_post' => $blog_post,
                'blog_post_comments' => $blog_post_comments,
            ]

        );
    }

    public function filterBlogPostCategory(Request $request): View
    {
        $category_id = $this->decryptId($request->category);

        $category_name = BlogCategory::findOrFail($category_id);

        $categories = BlogCategory::where('status', 1)
            ->orderBy('id', 'DESC')
            ->get();

        $blog_post = BlogPost::where('status', 1)
            ->orderBy('id', 'DESC')
            ->get();

        $post_category_filter  = BlogPost::where('blog_category_id', $category_id)->paginate(8);



        return View('frontend.pages.blog.post-filter-category',
            [
                'post_category_filter' => $post_category_filter,
                'blog_post' => $blog_post,
                'category_name' => $category_name,
                'categories' => $categories,

            ]
        );
    }


    public function filterBlogPostTags(Request $request): View
    {
        $category_id = $this->decryptId($request->category);

        $category_name = BlogCategory::findOrFail($category_id);

        $categories = BlogCategory::where('status', 1)
            ->orderBy('id', 'DESC')
            ->get();

        $blog_post = BlogPost::where('status', 1)
            ->orderBy('id', 'DESC')
            ->get();

        $array_tags = explode(",", $blog_post->tags);




        return View('frontend.pages.blog.post-filter-category',
            [
                'array_tags' => $array_tags,
                'blog_post' => $blog_post,
                'category_name' => $category_name,
                'categories' => $categories,

            ]
        );
    }

    public function blogPostComment(Request $request): RedirectResponse
    {

        $validate = $request->validate([
            'subject' => ['required', 'string',],
            'blog_posts_id' => ['required', 'string',],
            'comment' => ['required', 'string'],
        ]);

        $blog_post_id = $this->decryptId($validate['blog_posts_id']);


        BlogPostComment::create([
            'user_id' => Auth::id(),
            'blog_posts_id' => $blog_post_id,
            'subject' => $validate['subject'],
            'comment' => $validate['comment'],
        ]);

        return Redirect::back()->with([
            'status' => 'success',
            'message' => 'commented successfully'
        ]);

    }

}
