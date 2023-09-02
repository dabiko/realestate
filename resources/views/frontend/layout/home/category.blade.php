<section class="category-section centred">
    <div class="auto-container">
        <div class="inner-container wow slideInLeft animated" data-wow-delay="00ms" data-wow-duration="1500ms">
            <ul class="category-list clearfix">

                @foreach($categories as $category)
                    @php
                        $count = \App\Models\Property::where('category_id',$category->id )->count();
                    @endphp
                    <li>
                        <div class="category-block-one">
                            <div class="inner-box">
                                <div class="icon-box"><i class="{{$category->icon}}"></i></div>
                                <h5><a href="property-details.html">{{$category->name}}</a></h5>
                                <span>{{$count}}</span>
                            </div>
                        </div>
                    </li>
                @endforeach



            </ul>
            <div class="more-btn"><a href="{{route('categories')}}" class="theme-btn btn-one">All Categories</a></div>
        </div>
    </div>
</section>
