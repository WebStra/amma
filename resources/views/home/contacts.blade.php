@extends('layout')
@section('content')
    <div class="container">
        <h1>Contactele noastre</h1>
        <h4>Dacă aveți întrebări scrie un mesaj!</h4>
    </div>
    <div id="map"></div>
    <div class="container">
        <div class="row">
            <div class="col l6 m12 s12">
                <h3 class="styled1">Datele de contact</h3>
                <ul class="contacts">
                    <li>
                        <i class="icon-pin"></i>
                        <h4 class="styled2">Adresa noastră</h4>
                        <p class="c_base">{{ settings()->getOption('contact_info::adress') }}</p>
                    </li>
                    <li>
                        <i class="icon-email"></i>
                        <h4 class="styled2">Adresa electronică</h4>
                        <p class="c_base">{{ settings()->getOption('contact_info::email') }}</p>
                    </li>
                    <li>
                        <i class="icon-phone"></i>
                        <h4 class="styled2">Telefon de contact</h4>
                        <p><strong class="small">Departamentul de vânzări /</strong><span
                                    class="c_base">{{ settings()->getOption('contact_info::sellPhone') }}</span></p>
                        <p><strong class="small">Departamentul tehnic /</strong><span
                                    class="c_base">{{ settings()->getOption('contact_info::tehnicPhone') }}</span></p>
                    </li>
                </ul>
            </div>
            <div class="col l6 m12 s12">
                <div class="wrapp_form styled1 on_map">
                    <form class="form styled2 row" action="{{ route('send_contact') }}" method="POST">
                        <h5 class="col s12">Formă de contact</h5>

                        <div class="col s12">
                            <div class="input-field">
                                <input type="text" name="name" placeholder="Numele prenumele"
                                       value="{{ old('name') ? : ((Auth::check()) ? Auth::user()->present()->renderName() : '') }}">
                                @include('partials.errors.error-field', ['field' => 'name'])
                            </div>
                        </div>
                        <div class="col s12">
                            <div class="input-field">
                                <input type="email" name="email" placeholder="Adresa electronica"
                                       value="{{ old('email') ? : ((Auth::check()) ? Auth::user()->email : '') }}">
                                @include('partials.errors.error-field', ['field' => 'email'])
                            </div>
                        </div>
                        <div class="col s12">
                            <div class="input-field">
                                <div class="inline-inputs">
                                    <input type="text" name="phone" placeholder="Telefon"
                                           value="{{ old('phone') ? : ((Auth::check()) ? Auth::user()->profile->phone : '') }}">
                                    @include('partials.errors.error-field', ['field' => 'phone'])
                                </div>
                            </div>
                        </div>
                        <div class="col s12">
                            <div class="input-field">
                                <div class="inline-inputs">
                                    <textarea name="message" placeholder="Mesajul Dvs">{{ old('message') }}</textarea>
                                    @include('partials.errors.error-field', ['field' => 'message'])
                                </div>
                            </div>
                        </div>
                        {{csrf_field()}}
                        <div class="col s12">
                            <input type="submit" class="btn btn_base center-block full_width" value="Trimite mesajul">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    {!!Html::script('https://maps.googleapis.com/maps/api/js?key=AIzaSyAyO2eCqw0WoNVb_fkoRNPfDnJkjRxwInk')!!}

    <script>
        function initialize() {
            var mapCanvas = document.getElementById('map');
            var latlng = new google.maps.LatLng({{ settings()->getOption('contact_map::coords', '47.046820,28.888806') }});
            /*  console.log(cordonate);*/
            var mapOptions = {
                center: latlng,
                zoom: 15,
                scrollwheel: false,
                scaleControl: false,
                draggable: false,
                zoomControl: true,

                zoomControlOptions: {
                    position: google.maps.ControlPosition.RIGHT_TOP
                },
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            var image = '/assets/images/ico/pin.png';
            var map = new google.maps.Map(mapCanvas, mapOptions);
            map.set('styles', [{
                "featureType": "landscape",
                "stylers": [{
                    "saturation": -100
                }, {
                    "lightness": 65
                }, {
                    "visibility": "on"
                }]
            }, {
                "featureType": "poi",
                "stylers": [{
                    "saturation": -100
                }, {
                    "lightness": 51
                }, {
                    "visibility": "simplified"
                }]
            }, {
                "featureType": "road.highway",
                "stylers": [{
                    "saturation": -100
                }, {
                    "visibility": "simplified"
                }]
            }, {
                "featureType": "road.arterial",
                "stylers": [{
                    "saturation": -100
                }, {
                    "lightness": 30
                }, {
                    "visibility": "on"
                }]
            }, {
                "featureType": "road.local",
                "stylers": [{
                    "saturation": -100
                }, {
                    "lightness": 40
                }, {
                    "visibility": "on"
                }]
            }, {
                "featureType": "transit",
                "stylers": [{
                    "saturation": -100
                }, {
                    "visibility": "simplified"
                }]
            }, {
                "featureType": "administrative.province",
                "stylers": [{
                    "visibility": "off"
                }]
            }, {
                "featureType": "water",
                "elementType": "labels",
                "stylers": [{
                    "visibility": "on"
                }, {
                    "lightness": -25
                }, {
                    "saturation": -100
                }]
            }, {
                "featureType": "water",
                "elementType": "geometry",
                "stylers": [{
                    "hue": "#ffff00"
                }, {
                    "lightness": -25
                }, {
                    "saturation": -97
                }]
            }]);
            var beachMarker = new google.maps.Marker({
                position: latlng,
                map: map,
                icon: image
            });

        }
        if (($("#map").length != 0)) {
            google.maps.event.addDomListener(window, 'load', initialize);
        }
    </script>
@endsection