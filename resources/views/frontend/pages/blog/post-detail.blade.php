@extends('frontend.layout.master')

@section('title')

    {{ config('app.name') }} | Post Detail

@endsection

{{--@section('switcher')--}}
{{--    @include('frontend.layout.switcher')--}}
{{--@endsection--}}

@section('preloader')
    @include('frontend.layout.preloader')
@endsection



@section('content')
    <section class="page-title centred" style="background-image: {{asset('frontend/assets/images/background/page-title-5.jpg')}};">
        <div class="auto-container">
            <div class="content-box clearfix">
                <h1>{{$post->title}}</h1>
                <ul class="bread-crumb clearfix">
                    <li><a href="{{route('home')}}">Home</a></li>
                    <li>{{$post->user->name}} Post Detail</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- sidebar-page-container -->
    <section class="sidebar-page-container blog-details sec-pad-2">
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                    <div class="blog-details-content">
                        <div class="news-block-one">
                            <div class="inner-box">
                                <div class="image-box">
                                    <figure class="image"><img src="{{asset($post->image)}}" alt=""></figure>
                                    <span class="category">{{$post->category->name}}</span>
                                </div>
                                <div class="lower-content">
                                    <h3>{{$post->title}}</h3>
                                    <ul class="post-info clearfix">
                                        <li class="author-box">
                                            <figure class="author-thumb"><img src="{{asset($post->user->photo)}}" alt=""></figure>
                                            <h5><a href="">{{$post->user->name}}</a></h5>
                                        </li>
                                        <li>{{$post->created_at->format('M d Y')}}</li>
                                    </ul>
                                    <div class="text">
                                        <p>{{ strip_tags($post->long_desc)}}</p>
                                        <blockquote>
                                            <h4>“{{strip_tags($post->short_desc)}}}}”</h4>
                                        </blockquote>
                                    </div>
                                    <div class="post-tags">
                                        <ul class="tags-list clearfix">
                                            <li><h5>Tags:</h5></li>
                                            @foreach($array_tags as $tags)
                                                <li><a href="blog-details.html">{{ucwords($tags)}}</a></li>
                                            @endforeach

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="comments-area">
                            <div class="group-title">
                                <h4> {{count($blog_post_comments)}} {{count($blog_post_comments) > 1 ? 'Comments' : 'Comment'}}</h4>
                            </div>
                            <div class="comment-box">
                                @if(count($blog_post_comments) > 0)
                                    @foreach($blog_post_comments as $comment)
                                        <div class="comment">
                                            <figure class="thumb-box">
                                                <img src="{{asset($comment->user->photo)}}" alt="">
                                            </figure>
                                            <div class="comment-inner">
                                                <div class="comment-info clearfix">
                                                    <h5>{{$comment->user->name}}</h5>
                                                    <span>{{$comment->created_at->format('M d Y')}}</span>
                                                </div>
                                                <div class="text">
                                                    <p>{{$comment->comment}}.</p>
                                                    <a href="javascript:void(0)"><i class="fas fa-share"></i>Reply</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="alert alert-primary" role="alert">
                                        <i data-feather="alert-circle"></i>
                                        <strong>This Blog Post has {{count($blog_post_comments)}} Comments </strong>
                                    </div>
                                @endif


{{--                                <div class="comment replay-comment">--}}
{{--                                    <figure class="thumb-box">--}}
{{--                                        <img src="assets/images/news/comment-2.jpg" alt="">--}}
{{--                                    </figure>--}}
{{--                                    <div class="comment-inner">--}}
{{--                                        <div class="comment-info clearfix">--}}
{{--                                            <h5>Elizabeth Winstead</h5>--}}
{{--                                            <span>April 10, 2020</span>--}}
{{--                                        </div>--}}
{{--                                        <div class="text">--}}
{{--                                            <p>Lorem ipsum dolor sit amet, consectur adipisicing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam quis nos</p>--}}
{{--                                            <a href="blog-details.html"><i class="fas fa-share"></i>Reply</a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

                            </div>
                        </div>
                        <div class="comments-form-area">
                            <div class="group-title">
                                <h4>Leave a Comment</h4>
                            </div>
                            <form
                                action="{{route('user.blog-post.message')}}"
                                method="post" class="comment-form default-form"
                                id="commentForm"
                            >

                                @csrf
                                @method('POST')

                                <div class="row">

                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                        <input type="text" name="subject" id="subject" class="form-control @error('subject') is-invalid @enderror" placeholder="Subject">
                                        <input type="hidden" name="blog_posts_id" id="blog_posts_id" value="{{Crypt::encryptString($post->id)}}" >
                                        @error('subject')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                        <textarea name="comment" id="comment" class="form-control @error('subject') is-invalid @enderror" placeholder="Your message"></textarea>
                                        @error('comment')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group message-btn">
                                        <button type="submit" class="theme-btn btn-one">Submit Now</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                    <div class="blog-sidebar">
                        <div class="sidebar-widget search-widget">
                            <div class="widget-title">
                                <h4>Search</h4>
                            </div>
                            <div class="search-inner">
                                <form action="blog-1.html" method="post">
                                    <div class="form-group">
                                        <input type="search" name="search_field" placeholder="Search" required="">
                                        <button type="submit"><i class="fas fa-search"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="sidebar-widget social-widget">
                            <div class="widget-title">
                                <h4>Follow Us On</h4>
                            </div>
                            <ul class="social-links clearfix">
                                <li><a href="blog-1.html"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="blog-1.html"><i class="fab fa-google-plus-g"></i></a></li>
                                <li><a href="blog-1.html"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="blog-1.html"><i class="fab fa-linkedin-in"></i></a></li>
                                <li><a href="blog-1.html"><i class="fab fa-instagram"></i></a></li>
                            </ul>
                        </div>
                        <div class="sidebar-widget category-widget">
                            <div class="widget-title">
                                <h4>Category</h4>
                            </div>
                            <div class="widget-content">
                                <ul class="category-list clearfix">
                                    @foreach($categories as $category)
                                        @php
                                            $category_post = \App\Models\BlogPost::where('blog_category_id',$category->id)->get();
                                        @endphp
                                        <li><a href="{{ count($category_post) > 0 ? route('blog-post-filter-category', ['category' => Crypt::encryptString($category->id)]) : 'javascript:void(0)'}}">{{$category->name}}<span>({{count($category_post)}})</span></a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="sidebar-widget post-widget">
                            <div class="widget-title">
                                <h4>Recent Posts</h4>
                            </div>
                            <div class="post-inner">
                                @foreach($blog_post as $post)
                                    <div class="post">
                                        <figure class="post-thumb"><a href="{{route('blog-post-detail',Crypt::encryptString($post->id))}}"><img src="{{asset($post->image)}}" alt=""></a></figure>
                                        <h5><a href="{{route('blog-post-detail',Crypt::encryptString($post->id))}}">{{$post->title}}</a></h5>
                                        <span class="post-date">{{$post->created_at->format('M d Y')}}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="sidebar-widget category-widget">
                            <div class="widget-title">
                                <h4>Archives</h4>
                            </div>
                            <div class="widget-content">
                                <ul class="category-list clearfix">
                                    @foreach($blog_post as $post)

                                    @endforeach
                                    <li><a href="blog-details.html">November 2016<span>(9)</span></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="sidebar-widget tags-widget">
                            <div class="widget-title">
                                <h4>Popular Tags</h4>
                            </div>
                            <div class="widget-content">
                                <ul class="tags-list clearfix">
                                    @foreach($blog_post as $tags)
                                        <li><a href="">{{ucwords($tags->tags)}}</a></li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('frontend.layout.subscription')
@endsection
@push('scripts')
    <script>
        $(function() {
            'use strict';

            // $.validator.setDefaults({
            //     submitHandler: function() {
            //         alert("submitted!");
            //     }
            // });
            $(function() {
                // validate form on keyup and submit
                $("#commentForm").validate({
                    rules: {
                        subject: {
                            required: true,
                            minlength: 4,
                            maxlength: 20
                        },

                        comment: {
                            required: true,
                        },

                    },

                    messages: {
                        subject: {
                            required: "Please enter a subject",
                            minlength: "Message must consist of at least 2 characters",
                            maxlength: "Message must consist of at most 20 characters"
                        },

                        comment: {
                            required: "Comment is required",
                        },


                    },
                    errorPlacement: function(error, element) {
                        error.addClass( "invalid-feedback" );

                        if (element.parent('.input-group').length) {
                            error.insertAfter(element.parent());
                        }
                        else if (element.prop('type') === 'radio' && element.parent('.radio-inline').length) {
                            error.insertAfter(element.parent().parent());
                        }
                        else if (element.prop('type') === 'checkbox' || element.prop('type') === 'radio') {
                            error.appendTo(element.parent().parent());
                        }
                        else {
                            error.insertAfter(element);
                        }
                    },
                    highlight: function(element, errorClass) {
                        if ($(element).prop('type') !== 'checkbox' && $(element).prop('type') !== 'radio') {
                            $( element ).addClass( "is-invalid" ).removeClass( "is-valid" );
                        }
                    },
                    unhighlight: function(element, errorClass) {
                        if ($(element).prop('type') !== 'checkbox' && $(element).prop('type') !== 'radio') {
                            $( element ).addClass( "is-valid" ).removeClass( "is-invalid" );
                        }
                    }
                });
            });
        });
    </script>
@endpush
