<div class="filter-widget sidebar-widget">
    <div class="widget-title">
        <h5>Property</h5>
    </div>
    <div class="widget-content">
        <form action="{{route('filter.property')}}" method="POST">

            @method('POST')
            @csrf

            <div class="select-box">
                <select name="purpose" id="purpose" class="wide">
                    <option data-display="Select Purpose">Select Purpose</option>
                    <option {{request()->purpose === 'rent' ? 'selected' : ''}} value="rent">Rent</option>
                    <option {{request()->purpose === 'buy' ? 'selected' : ''}} value="buy">Buy</option>
                    <option {{request()->purpose === 'sale' ? 'selected' : ''}} value="sale">Sale</option>
                </select>
            </div>
            <div class="select-box">
                <select name="category_id" id="category_id" class="wide">
                    <option disabled selected data-display="Select category">Select category</option>
                    @foreach($all_categories as $categories)
                        @if (Route::currentRouteName() === 'properties')
                            <option value="{{Crypt::encryptString($categories->id)}}">{{$categories->name}}</option>
                        @elseif(Route::currentRouteName() === 'filter.property')
                            <option {{$category_name === $categories->name ? 'selected' : ''}} value="{{Crypt::encryptString($categories->id)}}">{{$categories->name}}</option>
                        @endif
                    @endforeach

                </select>
            </div>
            <div class="select-box">
                <select name="state_id" id="state_id" class="wide">
                    <option  disabled selected data-display="Select State">Select State</option>
                    @foreach($all_states as $states)
                        @if (Route::currentRouteName() === 'properties')
                            <option value="{{Crypt::encryptString($states->id)}}">{{$states->name}}</option>
                        @elseif(Route::currentRouteName() === 'filter.property')
                            <option {{$state_name === $states->name ? 'selected' : ''}} value="{{Crypt::encryptString($states->id)}}">{{$states->name}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="select-box">
                <select name="num_of_rooms" id="num_of_rooms" class="wide">
                    @if (Route::currentRouteName() === 'properties')
                        <option disabled selected data-display="Max Rooms">Max Rooms</option>
                        <option  value="1">1 Rooms</option>
                        <option  value="2">2 Rooms</option>
                        <option  value="3">3 Rooms</option>
                        <option  value="4">4 Rooms</option>
                        <option  value="5">5 Rooms</option>
                    @elseif(Route::currentRouteName() === 'filter.property')
                        <option disabled selected data-display="Max Rooms">Max Rooms</option>
                        <option {{$num_of_rooms == 1 ? 'selected' : ''}} value="1">1 Rooms</option>
                        <option {{$num_of_rooms == 2 ? 'selected' : ''}} value="2">2 Rooms</option>
                        <option {{$num_of_rooms == 3 ? 'selected' : ''}} value="3">3 Rooms</option>
                        <option {{$num_of_rooms == 4 ? 'selected' : ''}} value="4">4 Rooms</option>
                        <option {{$num_of_rooms == 5 ? 'selected' : ''}} value="5">5 Rooms</option>
                    @endif


                </select>
            </div>
            <div class="select-box">
                <select name="num_of_bathrooms" id="num_of_bathrooms" class="wide">
                    @if (Route::currentRouteName() === 'properties')
                        <option disabled selected data-display="Max Bathroom">Max Bathroom</option>
                        <option value="1">1 Bathroom</option>
                        <option value="2">2 Bathroom</option>
                        <option value="3">3 Bathroom</option>
                        <option value="4">4 Bathroom</option>
                        <option value="5">5 Bathroom</option>
                    @elseif(Route::currentRouteName() === 'filter.property')
                        <option disabled selected data-display="Max Bathroom">Max Bathroom</option>
                        <option {{$num_of_bathrooms == 1 ? 'selected' : ''}} value="1">1 Bathroom</option>
                        <option {{$num_of_bathrooms == 2 ? 'selected' : ''}} value="2">2 Bathroom</option>
                        <option {{$num_of_bathrooms == 3 ? 'selected' : ''}} value="3">3 Bathroom</option>
                        <option {{$num_of_bathrooms == 4 ? 'selected' : ''}} value="4">4 Bathroom</option>
                        <option {{$num_of_bathrooms == 5 ? 'selected' : ''}} value="5">5 Bathroom</option>
                    @endif

                </select>
            </div>

            <div class="filter-btn">
                <button type="submit" class="theme-btn btn-one"><i class="fas fa-filter"></i>&nbsp;Filter</button>
            </div>
        </form>
    </div>
</div>
