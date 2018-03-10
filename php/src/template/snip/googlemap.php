<!-- Google Map -->
<?php
if ( !empty( $vars['googlemap_token'] )) { ?>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=<?= $vars['googlemap_token'] ?>&amp;callback=initMap" type="text/javascript"></script>
<?php } else { ?>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
<?php } ?>
    <div style="overflow:hidden;height:400px;width:auto;">
        <div id="gmap_canvas" style="height:400px;width:auto;color:black;"></div>
    </div>
    <script type="text/javascript">
    function initMap() {
        var myOptions =  {
            zoom: 16,
            center: new google.maps.LatLng(<?= $vars['googlemap_latlng'] ?>),
            scrollwheel: false,
            draggable: false,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map(
            document.getElementById('gmap_canvas'), myOptions);
        marker = new google.maps.Marker( {
            map: map,position: new google.maps.LatLng(<?= $vars['googlemap_latlng'] ?>)});
        infowindow = new google.maps.InfoWindow( {
            content: '<strong><?= $site['name'] ?></strong><br><?= $site['city'] ?>, <?= $site['country'] ?><br>'});
        google.maps.event.addListener(marker, 'click', function() {
            infowindow.open(map,marker);
        });
        infowindow.open(map,marker);
    }
<?php
if ( empty( $vars['googlemap_token'] )) { ?>
    google.maps.event.addDomListener(window, 'load', initMap);
<?php } ?>
    </script>
