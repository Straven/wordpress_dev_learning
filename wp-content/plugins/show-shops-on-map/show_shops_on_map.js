var geocoder;
var map;

function showShopOnMap_init(zoom) {
    geocoder = new google.maps.Geocoder();
    var LatLng = new google.maps.LatLng(50.0396, 36.22028299999999);
    var mapOptions = {
        zoom: zoom,
        center: LatLng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
}

function addMarkersOnMap(address) {
    var content = '<div id="content">' + address + '</div>';
    var infowindow = new google.maps.InfoWindow({
        content: content
    });
    geocoder.geocode({
            'address': address
        },
        function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                map.setCenter(results[0].geometry.location);
                var marker = new google.maps.Marker({
                    map: map,
                    position: results[0].geometry.location,
                    clickable: true,
                    title: address
                });
                infowindow.open(map, marker);
                google.maps.event.addListener(marker, 'click',
                    function () {
                        infowindow.open(map, marker);
                    });
            } else {
                alert("Error.");
            }
        });
}