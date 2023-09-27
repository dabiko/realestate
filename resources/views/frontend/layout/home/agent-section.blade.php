<section class="team-section sec-pad centred bg-color-1">
    <div class="pattern-layer" style="background-image: url(frontend/assets/images/shape/shape-1.png);"></div>
    <div class="auto-container">
        <div class="sec-title">
            <h5>Our Agents</h5>
            <h2>Meet Our Excellent Agents</h2>
        </div>

            <div class="single-item-carousel owl-carousel owl-theme owl-dots-none nav-style-one">
                @foreach($property_agents as $agent)
                    <div class="team-block-one">
                        <div class="inner-box">
                            <figure class="image-box"><img src="{{asset(empty(!$agent->photo) ? $agent->photo : url('upload/no_image.jpg'))}}" alt=""></figure>
                            <div class="lower-content">
                                <div class="inner">
                                    <h4><a href="{{route('agent.details', Crypt::encryptString($agent->id) )}}">{{$agent->name}}</a></h4>
                                    <span class="designation">{{$agent->username}} <<<b>{{$agent->email}}</b>>></span>
                                    <ul class="social-links clearfix">
                                        <li><a href="javascript:void(0);"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="javascript:void(0);"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="javascript:void(0);"><i class="fab fa-google-plus-g"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
    </div>
</section>
