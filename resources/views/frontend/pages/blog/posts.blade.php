@extends('frontend.layout.master')

@section('title')

    {{ config('app.name') }} | All Blog Post

@endsection

{{--@section('switcher')--}}
{{--    @include('frontend.layout.switcher')--}}
{{--@endsection--}}

@section('preloader')
    @include('frontend.layout.preloader')
@endsection



@section('content')
    <section class="page-title centred" style="background-image: url({{asset('frontend/assets/images/background/page-title-5.jpg')}})">
        <div class="auto-container">
            <div class="content-box clearfix">
                <h1>All Blog Post</h1>
                <ul class="bread-crumb clearfix">
                    <li><a href="{{route('home')}}">Home</a></li>
                    <li>Blog Post </li>
                </ul>
            </div>
        </div>
    </section>


    <section class="sidebar-page-container blog-grid sec-pad-2">
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                    <div class="blog-grid-content">
                        <div class="row clearfix">
                            @foreach($blog_post as $post)
                                <div class="col-lg-6 col-md-6 col-sm-12 news-block">
                                    <div class="news-block-one wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                                        <div class="inner-box">
                                            <div class="image-box">
                                                <figure class="image"><a href="{{route('blog-post-detail',Crypt::encryptString($post->id))}}">
                                                        <img src="{{empty(!$post->image) ? $post->image : url('upload/no_image.jpg')}}" alt=""></a></figure>
                                                <span class="category">{{$post->category->name}}</span>
                                            </div>
                                            <div class="lower-content">
                                                <h4><a href="{{route('blog-post-detail',Crypt::encryptString($post->id))}}">{{$post->title}}</a></h4>
                                                <ul class="post-info clearfix">
                                                    <li class="author-box">
                                                        <figure class="author-thumb"><img src="{{asset($post->user->photo)}}" alt=""></figure>
                                                        <h5><a href="blog-details.html">{{$post->user->name}}</a></h5>
                                                    </li>
                                                    <li>{{$post->created_at->format('M d Y')}}</li>
                                                </ul>
                                                <div class="text">
                                                    <p>{{truncate($post->short_desc, 100)}}</p>
                                                </div>
                                                <div class="btn-box">
                                                    <a href="{{route('blog-post-detail',Crypt::encryptString($post->id))}}" class="theme-btn btn-two">See Details</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="pagination-wrapper">
                            {{ $blog_post->links('vendor.pagination.custom') }}
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
                                    <li><a href="{{route('blog-post.all')}}">All Categories <span>({{count($blog_post)}})</span></a></li>
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
{{--                                        @foreach($amenities as $amenity)--}}
{{--                                            <option {{(in_array($tags->tags, $array_tags)) ? 'selected' : ''}} value="{{$amenity->id}}">{{$amenity->name}}</option>--}}
{{--                                        @endforeach--}}
                                        <li><a href="blog-details.html">{{$tags->tags}}</a></li>
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
