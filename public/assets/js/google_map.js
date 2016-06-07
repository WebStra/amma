$(document).ready(function() {

    function initialize() {
        var mapCanvas = document.getElementById('map');


        var iconBase = 'https://maps.google.com/mapfiles/kml/shapes/';
        var myLatLng = {
            lat: 47.0589148,
            lng: 28.86464513
        };


        var mapOptions = {
            center: new google.maps.LatLng(47.0589148, 28.86464513),
            zoom: 16,
            mapTypeId: google.maps.MapTypeId.HYBRID
        }
        var map = new google.maps.Map(mapCanvas, mapOptions);

        var marker = new google.maps.Marker({
            position: myLatLng,
            map: map,
        });


    }
    if ($("#map").length != 0) {
        initialize();
    }
});
