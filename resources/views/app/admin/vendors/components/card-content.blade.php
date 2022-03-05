<div class="card-content collapse show">
    <div class="card-body">
        <!--------------------------- Form -------------------------->
        <form class="form" action="{{ route($formPostRouteName, $formPostRoutePara) }}" method="POST"
            enctype="multipart/form-data">
            @csrf

            <div class="form-body">
                <h5 class="form-section"><i class="ft-home"></i> Categories information </h5>
                @if ($job == 'edit')
                    <input type="hidden" name="id" value="{{ $category->id }}">
                @endif

                <!--------------------------- Row 1 -------------------------->
                <div class="row">
                    <!------------------ Col 1-1 -------------------->
                    <div class="col-md-6">
                        <!------------ name field --------------->
                        <div class="form-group">
                            <label for="name"> name </label>
                            <input type="text" id="name" class="form-control"
                                @if ($job == 'edit') value = "{{ $category->name }}" @else value = "{{ old('name') }}" @endif
                                placeholder="name of the Category" name="name">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <!------------------ Col 1-2 -------------------->
                    <div class="col-md-6">
                        <!------------ description field --------------->
                        <div class="form-group">
                            <label for="description"> description</label>
                            <input type="description" id="description" class="form-control"
                                @if ($job == 'edit') value = "{{ $category->description }}" @else value = "{{ old('description') }}" @endif
                                placeholder="description" name="description">
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <!--------------------------- END Row 1 -------------------------->

                <!--------------------------- Row 2 -------------------------->
                <div class="row">
                    <!------------------ Col 2-1 -------------------->
                    <div class="col-md-6">
                        <!------------ mobile field --------------->
                        <div class="form-group">
                            <div class="form-group mt-1">
                                <input type="checkbox"
                                    @if ($job == 'edit') value = "{{ $category->is_main }}" @else value = "{{ old('is_main') }}" @endif "
                            name=" is_main" id="switcheryColor4" class="switchery" data-color="success"
                                    @if ($job == 'edit') @if ($category->is_main == 1) checked @endif
                                    @endif
                                />
                                <label for="switcheryColor4" class="ml-1">main
                                </label>
                                @error('is_main')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                    </div>
                    <!------------------ Col 2-2 -------------------->
                    <div class="col-md-6">
                        <!------------ main category field --------------->
                        <div class="form-group">
                            <label for="parent_category_id"> parent </label>
                            <select name="parent_category_id" class="select2 form-control"
                                @if ($job == 'edit') value = "{{ $category->parent_category_id }}" @else value = "{{ old('parent_category_id') }}" @endif>
                                <optgroup label="parent_category_id ">
                                    @isset($mainCategories)
                                    @foreach ($mainCategories as $category)
                                        <option @if ($job == 'edit' and $vendor->main_category_id == $category->id) selected @endif
                                            value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                    @endisset
                                </optgroup>
                            </select>
                            @error('parent_category_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                </div>
                <!--------------------------- END Row 2 -------------------------->

                <!--------------------------- Row 3 -------------------------->

                {{-- <div class="row">
                    <!------------------ Col 3-1 -------------------->
                    <div class="col-md-6">
                        <!------------ address field --------------->
                        <div class="form-group">
                            <label for="address"> العنوان </label>
                            <input type="text" id="pac-input" class="form-control mb-1"
                                @if ($job == 'edit') value = "{{ $vendor->address }}" @else value = "{{ old('address') }}" @endif
                                name="address">
                            @error('address')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <!------------------ Col 3-2 -------------------->
                    <div class="col-md-6">
                        <!------------ password field --------------->
                        <div class="form-group">
                            <label for="password"> كلمة السر </label>
                            <input type="password" id="password" class="form-control"
                                @if ($job == 'edit') value = "" @else value = "" @endif name="password">
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div> --}}
                <!--------------------------- END Row 3 -------------------------->

                <!--------------------------- Row 4 -------------------------->
                <div class="row">
                    <!------------------ Col 4-1 -------------------->
                    <div class="col-md-6">
                        <!------------ logo field --------------->
                        <div class="form-group">
                            <label for="image">image</label>
                            <input class="form-control-file" type="file" id="file" name="image"
                                @if ($job == 'edit') value = "{{ $category->image }}" @else value = "{{ old('image') }}" @endif>
                            <span class="file-custom"></span>
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        @if ($job == 'edit')
                            <img src="{{ $category->getPhoto() }}" alt="{{$category->name}}-photo"
                                class="img-fluid rounded-circle width-150 height-150">
                        @endif
                    </div>
                    <!------------------ Col 3-2 -------------------->
                    <div class="col-md-6">
                        <div class="form-group mt-1">
                            <input type="checkbox"
                                @if ($job == 'edit') value = "{{ $category->actice }}" @else value = "{{ old('actice') }}" @endif "
                                name=" actice" id="switcheryColor4" class="switchery" data-color="success"
                                @if ($job == 'edit') @if ($category->actice == 1) checked @endif
                                @endif
                            />
                            <label for="switcheryColor4" class="ml-1">Actice
                            </label>
                            @error('actice')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <!--------------------------- END Row 4 -------------------------->

                {{-- <!--------------------------- Row 5 -------------------------->
                <div class="row">
                    <!------------------ Col 5-1 -------------------->
                    <div class="col-md-6">
                        <div id="map" style="height: 500px;width: 900px;"></div>
                    </div>
                </div>
                <!--------------------------- END Row 5 --------------------------> --}}

                <!--------------------------- Actions -------------------------->
                <div class="form-actions flex-row-reverse">
                    <button type="button" class="btn btn-warning mr-1" onclick="history.back();">
                        <i class="ft-x"></i> go back
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="la la-check-square-o"></i> Submit
                    </button>
                </div>

        </form>
        <!--------------------------- END Form -------------------------->
    </div>
</div>

{{-- @section('script')

    <script>
        $("#pac-input").focusin(function() {
            $(this).val('');
        });
        $('#latitude').val('');
        $('#longitude').val('');
        // This example adds a search box to a map, using the Google Place Autocomplete
        // feature. People can enter geographical searches. The search box will return a
        // pick list containing a mix of places and predicted search terms.
        // This example requires the Places library. Include the libraries=places
        // parameter when you first load the API. For example:
        // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
        function initAutocomplete() {
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {
                    lat: 24.740691,
                    lng: 46.6528521
                },
                zoom: 13,
                mapTypeId: 'roadmap'
            });
            // move pin and current location
            infoWindow = new google.maps.InfoWindow;
            geocoder = new google.maps.Geocoder();
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                    map.setCenter(pos);
                    var marker = new google.maps.Marker({
                        position: new google.maps.LatLng(pos),
                        map: map,
                        title: 'موقعك الحالي'
                    });
                    markers.push(marker);
                    marker.addListener('click', function() {
                        geocodeLatLng(geocoder, map, infoWindow, marker);
                    });
                    // to get current position address on load
                    google.maps.event.trigger(marker, 'click');
                }, function() {
                    handleLocationError(true, infoWindow, map.getCenter());
                });
            } else {
                // Browser doesn't support Geolocation
                console.log('dsdsdsdsddsd');
                handleLocationError(false, infoWindow, map.getCenter());
            }
            var geocoder = new google.maps.Geocoder();
            google.maps.event.addListener(map, 'click', function(event) {
                SelectedLatLng = event.latLng;
                geocoder.geocode({
                    'latLng': event.latLng
                }, function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        if (results[0]) {
                            deleteMarkers();
                            addMarkerRunTime(event.latLng);
                            SelectedLocation = results[0].formatted_address;
                            console.log(results[0].formatted_address);
                            splitLatLng(String(event.latLng));
                            $("#pac-input").val(results[0].formatted_address);
                        }
                    }
                });
            });

            function geocodeLatLng(geocoder, map, infowindow, markerCurrent) {
                var latlng = {
                    lat: markerCurrent.position.lat(),
                    lng: markerCurrent.position.lng()
                };
                /* $('#branch-latLng').val("("+markerCurrent.position.lat() +","+markerCurrent.position.lng()+")");*/
                $('#latitude').val(markerCurrent.position.lat());
                $('#longitude').val(markerCurrent.position.lng());
                geocoder.geocode({
                    'location': latlng
                }, function(results, status) {
                    if (status === 'OK') {
                        if (results[0]) {
                            map.setZoom(8);
                            var marker = new google.maps.Marker({
                                position: latlng,
                                map: map
                            });
                            markers.push(marker);
                            infowindow.setContent(results[0].formatted_address);
                            SelectedLocation = results[0].formatted_address;
                            $("#pac-input").val(results[0].formatted_address);
                            infowindow.open(map, marker);
                        } else {
                            window.alert('No results found');
                        }
                    } else {
                        window.alert('Geocoder failed due to: ' + status);
                    }
                });
                SelectedLatLng = (markerCurrent.position.lat(), markerCurrent.position.lng());
            }

            function addMarkerRunTime(location) {
                var marker = new google.maps.Marker({
                    position: location,
                    map: map
                });
                markers.push(marker);
            }

            function setMapOnAll(map) {
                for (var i = 0; i < markers.length; i++) {
                    markers[i].setMap(map);
                }
            }

            function clearMarkers() {
                setMapOnAll(null);
            }

            function deleteMarkers() {
                clearMarkers();
                markers = [];
            }
            // Create the search box and link it to the UI element.
            var input = document.getElementById('pac-input');
            $("#pac-input").val("");
            var searchBox = new google.maps.places.SearchBox(input);
            map.controls[google.maps.ControlPosition.TOP_RIGHT].push(input);
            // Bias the SearchBox results towards current map's viewport.
            map.addListener('bounds_changed', function() {
                searchBox.setBounds(map.getBounds());
            });
            var markers = [];
            // Listen for the event fired when the user selects a prediction and retrieve
            // more details for that place.
            searchBox.addListener('places_changed', function() {
                var places = searchBox.getPlaces();
                if (places.length == 0) {
                    return;
                }
                // Clear out the old markers.
                markers.forEach(function(marker) {
                    marker.setMap(null);
                });
                markers = [];
                // For each place, get the icon, name and location.
                var bounds = new google.maps.LatLngBounds();
                places.forEach(function(place) {
                    if (!place.geometry) {
                        console.log("Returned place contains no geometry");
                        return;
                    }
                    var icon = {
                        url: place.icon,
                        size: new google.maps.Size(100, 100),
                        origin: new google.maps.Point(0, 0),
                        anchor: new google.maps.Point(17, 34),
                        scaledSize: new google.maps.Size(25, 25)
                    };
                    // Create a marker for each place.
                    markers.push(new google.maps.Marker({
                        map: map,
                        icon: icon,
                        title: place.name,
                        position: place.geometry.location
                    }));
                    $('#latitude').val(place.geometry.location.lat());
                    $('#longitude').val(place.geometry.location.lng());
                    if (place.geometry.viewport) {
                        // Only geocodes have viewport.
                        bounds.union(place.geometry.viewport);
                    } else {
                        bounds.extend(place.geometry.location);
                    }
                });
                map.fitBounds(bounds);
            });
        }

        function handleLocationError(browserHasGeolocation, infoWindow, pos) {
            infoWindow.setPosition(pos);
            infoWindow.setContent(browserHasGeolocation ?
                'Error: The Geolocation service failed.' :
                'Error: Your browser doesn\'t support geolocation.');
            infoWindow.open(map);
        }

        function splitLatLng(latLng) {
            var newString = latLng.substring(0, latLng.length - 1);
            var newString2 = newString.substring(1);
            var trainindIdArray = newString2.split(',');
            var lat = trainindIdArray[0];
            var Lng = trainindIdArray[1];
            $("#latitude").val(lat);
            $("#longitude").val(Lng);
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDKZAuxH9xTzD2DLY2nKSPKrgRi2_y0ejs&libraries=places&callback=initAutocomplete&language=ar&region=PS
                                                 async defer"></script>
@stop --}}
