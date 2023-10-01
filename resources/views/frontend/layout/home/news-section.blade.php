<section class="news-section sec-pad">
    <div class="auto-container">
        <div class="sec-title centred">
            <h5>News & Article</h5>
            <h2>Stay Update With Realshed</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing sed do eiusmod tempor incididunt <br />labore dolore magna aliqua enim.</p>
        </div>
        <div class="row clearfix">
            @foreach($blog_post as $post)
                <div class="col-lg-4 col-md-6 col-sm-12 news-block">
                    <div class="news-block-one wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="image-box">
                                <figure class="image"><a href="{{route('blog-post-detail',Crypt::encryptString($post->id))}}"><img src="{{empty(!$post->image) ? $post->image : url('upload/no_image.jpg')}}" alt=""></a></figure>
                                <span class="category">{{$post->category->name}}</span>
                            </div>
                            <div class="lower-content">
                                <h4><a href="{{route('blog-post-detail',Crypt::encryptString($post->id))}}">{{$post->title}}</a></h4>
                                <ul class="post-info clearfix">
                                    <li class="author-box">
                                        <figure class="author-thumb"><img src="{{asset($post->user->photo)}}" alt=""></figure>
                                        <h5><a href="">{{$post->user->name}}</a></h5>
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
    </div>
</section>
