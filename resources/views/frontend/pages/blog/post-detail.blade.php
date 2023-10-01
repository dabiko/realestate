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
                                <h4>3 Comments</h4>
                            </div>
                            <div class="comment-box">
                                <div class="comment">
                                    <figure class="thumb-box">
                                        <img src="assets/images/news/comment-1.jpg" alt="">
                                    </figure>
                                    <div class="comment-inner">
                                        <div class="comment-info clearfix">
                                            <h5>Rebeka Dawson</h5>
                                            <span>April 10, 2020</span>
                                        </div>
                                        <div class="text">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam quis nos trud exerc.</p>
                                            <a href="blog-details.html"><i class="fas fa-share"></i>Reply</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="comment replay-comment">
                                    <figure class="thumb-box">
                                        <img src="assets/images/news/comment-2.jpg" alt="">
                                    </figure>
                                    <div class="comment-inner">
                                        <div class="comment-info clearfix">
                                            <h5>Elizabeth Winstead</h5>
                                            <span>April 10, 2020</span>
                                        </div>
                                        <div class="text">
                                            <p>Lorem ipsum dolor sit amet, consectur adipisicing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam quis nos</p>
                                            <a href="blog-details.html"><i class="fas fa-share"></i>Reply</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="comment">
                                    <figure class="thumb-box">
                                        <img src="assets/images/news/comment-3.jpg" alt="">
                                    </figure>
                                    <div class="comment-inner">
                                        <div class="comment-info clearfix">
                                            <h5>Benedict Cumbatch</h5>
                                            <span>April 10, 2020</span>
                                        </div>
                                        <div class="text">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam quis nos trud exerc.</p>
                                            <a href="blog-details.html"><i class="fas fa-share"></i>Reply</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="comments-form-area">
                            <div class="group-title">
                                <h4>Leave a Comment</h4>
                            </div>
                            <form action="blog-details.html" method="post" class="comment-form default-form">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                        <input type="text" name="name" placeholder="Your name" required="">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                        <input type="email" name="email" placeholder="Your email" required>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                        <input type="text" name="phone" placeholder="Phone number" required="">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                        <input type="text" name="subject" placeholder="Subject" required="">
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                        <textarea name="message" placeholder="Your message"></textarea>
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
