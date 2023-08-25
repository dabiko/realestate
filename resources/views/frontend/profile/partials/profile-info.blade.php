<div class="col-lg-8 col-md-12 col-sm-12 content-side">
    <div class="blog-details-content">
        <div class="news-block-one">
            <div class="inner-box">

                <div class="lower-content">
                    <h3>Including Animation In Your Design System.</h3>
                    <ul class="post-info clearfix">
                        <li class="author-box">
                            <figure class="author-thumb"><img src="assets/images/news/author-1.jpg" alt=""></figure>
                            <h5><a href="blog-details.html">Eva Green</a></h5>
                        </li>
                        <li>April 10, 2020</li>
                    </ul>




                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card-body" style="background-color: #1baf65;">
                                <h1 class="card-title" style="color: white; font-weight: bold;">0</h1>
                                <h5 class="card-text"style="color: white;"> Approved properties</h5>

                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card-body" style="background-color: #ffc107;">
                                <h1 class="card-title" style="color: white; font-weight: bold; ">0</h1>
                                <h5 class="card-text"style="color: white;"> Pending approve properties</h5>

                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="card-body" style="background-color: #002758;">
                                <h1 class="card-title" style="color: white; font-weight: bold;">0</h1>
                                <h5 class="card-text"style="color: white; "> Rejected properties</h5>

                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>

    </div>


    <div class="blog-details-content">
        <div class="news-block-one">
            <div class="inner-box">

                @if ( Route::currentRouteName() === 'user.dashboard')

                    <div class="lower-content">
                        <h3>Activity Logs</h3>
                        <hr>


                    </div>

                @elseif(Route::currentRouteName() === 'user.profile.edit')

                    @include('profile.partials.update-profile-information-form')

                @endif




            </div>
        </div>


    </div>

</div>
