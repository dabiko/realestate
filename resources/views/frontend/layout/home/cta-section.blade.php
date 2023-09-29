<section class="cta-section bg-color-2">
    <div class="pattern-layer" style="background-image: url(frontend/assets/images/shape/shape-2.png);"></div>
    <div class="auto-container">
        <div class="inner-box clearfix">
            <div class="text pull-left">
                <h2>Looking to Buy a New Property, Rent a New Property or <br />Sell an Existing One?</h2>
            </div>
            <div class="btn-box pull-center">
                <a href="{{route('property.listing', ['purpose' => 'rent', ])}}" class="theme-btn btn-three">Rent Properties</a>
                <a href="{{route('property.listing', ['purpose' => 'buy', ])}}" class="theme-btn btn-one mr-3">Buy Properties</a>
                <a href="{{route('property.listing', ['purpose' => 'sale', ])}}" class="theme-btn btn-three">Sale Properties</a>
            </div>
        </div>
    </div>
</section>
