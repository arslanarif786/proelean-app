<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCpfWMKfe2_9VO80AfeAfqI3YmEr9DnWE8&libraries=places&callback=initAutocomplete"
        async ></script>

        function initAutocomplete() {

            var map = new google.maps.Map(document.getElementById('map'), {
                center: {
                    lat: '{{ isset(Auth::user()->latitude) && !is_null($user->latitude) ?  Auth::user()->latitude : 0.00 }}',
                    lng: '{{ isset(Auth::user()->longitude)&& !is_null(Auth::user()->longitude) ? Auth::user()->longitude : 0.00 }}'
                },
                zoom: 14,
                mapTypeId:google.maps.MapTypeId.ROADMAP  ,// 29.387682,71.712591
                disableDefaultUI: true
            });
            var input = document.getElementById('pac-input');
            var searchBox = new google.maps.places.SearchBox(input);
            map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
            // Bias the SearchBox results towards current map's viewport.
            map.addListener('bounds_changed', function() {
            searchBox.setBounds(map.getBounds());
            });

            var markers = [];
            searchBox.addListener('places_changed', function() {
            var places = searchBox.getPlaces();
            $(".map_loader,#lattitude_span,#longitude_span").html('<i class="fa fa-cog fa-spin" style="font-size:24px"></i>');

            get_coordinates(input.value);
            if (places.length == 0) {
                return;
            }
            markers.forEach(function(marker) {
                marker.setMap(null);
            });
            markers = [];

            var bounds = new google.maps.LatLngBounds();
            places.forEach(function(place) {
            if (!place.geometry) {
                console.log("Returned place contains no geometry");
                return;
            }
            var icon = {
                  url: place.icon,
                  size: new google.maps.Size(71, 71),
                  origin: new google.maps.Point(0, 0),
                  anchor: new google.maps.Point(17, 34),
                  scaledSize: new google.maps.Size(25, 25)
                 };
                 markers.push(new google.maps.Marker({
                    map: map,
                    icon: icon,
                    title: place.name,
                    position: place.geometry.location
                }));

                    if (place.geometry.viewport)
                    {
                        bounds.union(place.geometry.viewport);
                    }
                    else
                    {
                        bounds.extend(place.geometry.location);
                    }
              });

                    map.fitBounds(bounds);
                });
            }
