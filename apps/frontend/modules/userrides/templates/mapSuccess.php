<?php use_helper('Object'); ?>
<?php use_helper('Javascript') ?>
<?php slot('gmapheader'); ?>
<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=true_or_false
    &amp;key=ABQIAAAA51qrup5yuVkv3Mf5ufMuShT2yXp_ZAY8_ufC3CFXhHIE1NvwkxSx-BFmOhTVyvqOoirDH_b4piLWug"
    type="text/javascript">
  </script>


<script type="text/javascript">
        var map;
        var routePoints = new Array();
        var routeMarkers = new Array();
        var routeOverlays = new Array();
        var totalDistance = 0.0;
        var lineIx = 0;
        var polyline = null;
        var editable = false;
        var start = null;
        var units =1;//default to miles(1), kilo(0)
function initialize()
{
if (GBrowserIsCompatible()) {
        map = new GMap2(document.getElementById("map"));
        var lat = document.getElementById("lat").value;
        var lon = document.getElementById("long").value;
        map.setCenter(new GLatLng(lat, lon), 13);
        map.setUIToDefault();
        map.disableDoubleClickZoom();
        map.enableContinuousZoom();
        GEvent.addListener(map, "click", mapClick);
      }
 //set up units
 units = document.getElementById("mileagePref").value;
//check for existing route
var existing = document.getElementById("coords").value;
loadExistingRoute(existing);
if(start !=null){
    map.setCenter(start, 13);
}
}

function loadExistingRoute(routeString){
    if(routeString!=null){
        var coordsArray = routeString.split("*");
        for(i = 0; i < coordsArray.length; i++){
            var coords = coordsArray[i].split("^");
            if(coords.length==2){
               var ll = new GLatLng(coords[0],coords[1]);
               if(i==0){
                   start = ll;
               }
               addRoutePoint(ll);
            }else{
                if(i==0){
                    editable = true;
                }
            }
        }
    }
}

function mapClick(marker, point) {
 if (!marker && editable) {
 addRoutePoint(point);
 }
}

function addRoutePoint(point) {

 var dist = 0;

 if (!routePoints[lineIx]) {
 routePoints[lineIx] = Array();
 routeMarkers[lineIx] = Array();
 }

 routePoints[lineIx].push(point);

 if (routePoints[lineIx].length > 1) {
 plotRoute();
 dist = routePoints[lineIx][routePoints[lineIx].length-2].distanceFrom(point);
 totalDistance += dist;
 printUnits(totalDistance);
 }
 else {
 routeMarkers[lineIx][routePoints[lineIx].length-1] = new GMarker(point,{title:'Start'});
 map.addOverlay(routeMarkers[lineIx][routePoints[lineIx].length-1]);

 }
// document.getElementById("route").innerHTML += point.y.toFixed(6) + ' ' + point.x.toFixed(6) + ' : ' + dist.toFixed(3) +"<br>";
}

function printUnits(distance){
     var unitString = 'miles';
 if(units==0){
     distance = distance/1000;
     unitString = 'km';
 }else{
    distance = distance*.000621371192;
 }
 document.getElementById("dist").innerHTML = 'Total Distance: '+ distance.toFixed(3) + ' '+unitString;
}

function plotRoute() {
//this breaks for some reason
 //map.removeOverlay(routeOverlays[lineIx]);
 if(polyline)
     map.removeOverlay(polyline);
 polyline = new GPolyline(routePoints[lineIx],'#C602C8',3,1);
 routeOverlays[lineIx] = polyline;
 //routeOverlays[lineIx] = new GPolyline(routePoints[lineIx],'#C602C8',3,1);
// map.addOverlay(routeOverlays[lineIx]);
 map.addOverlay(polyline);

}

function resetRoute() {
 //   alert("routePoints"+routePoints);
 //   alert("routeOver"+routeOverlays);
 //   alert("routeMark"+routeMarkers);
 if (!routePoints[lineIx] || routePoints[lineIx].length == 0) {
     
 lineIx--;
 }

if(polyline)
     map.removeOverlay(polyline);
 routeOverlays[lineIx]=null;
 routePoints[lineIx]=null;
 polyline = null;
 //map.removeOverlay(routeOverlays[lineIx]);

 for (var n = 0 ; n < routeMarkers[lineIx].length ; n++ ) {
 var marker = routeMarkers[lineIx][n];
 map.removeOverlay(marker);
 }
 routeMarkers[lineIx] = null;
 start = null;

 totalDistance =0;
 printUnits(totalDistance);

 //var html = document.getElementById("route").innerHTML;
 //html = html.replace(/<br>[^<]+<br>$/,'<br>');
 //document.getElementById("route").innerHTML = html;

}

function undoPoint() {
 if (!routePoints[lineIx] || routePoints[lineIx].length == 0) {
 lineIx--;
 }

 if (routePoints[lineIx].length > 1) {

//in meters
 var dist = routePoints[lineIx][routePoints[lineIx].length-2].distanceFrom(routePoints[lineIx][routePoints[lineIx].length-1]);
 totalDistance -= dist;
 printUnits(totalDistance);

// var html = document.getElementById("route").innerHTML;
 //html = html.replace(/<br>[^<]+<br>(<br>)*$/,'<br>');
 //document.getElementById("route").innerHTML = html;

 if (routeMarkers[lineIx][routePoints[lineIx].length-1]) {
 var marker = routeMarkers[lineIx].pop();
 map.removeOverlay(marker);
 }
 routePoints[lineIx].pop();
 plotRoute();
 }
 else {
 resetRoute();
 }
}

function done(){
if(polyline){
    var count = polyline.getVertexCount();
    var tempArray = new Array();
    var points="";
    for (var n = 0 ; n < count ; n++ ) {
        var latLong = polyline.getVertex(n);
        tempArray.push(latLong);
        points = points+latLong.lat()+","+latLong.lng()+"*"
    }

    document.getElementById("coords").value =points;
    document.getElementById("totalMileage").value =totalDistance;
    return true;
    //alert("total points "+count+" actual points -"+tempArray+" TotalDistance-"+polyline.getLength());
}else{
    return false;
}
}

function doEdit(){
editable=true;
hideDivNoAjax("control");
showDiv("editcontrols");
}

function editDone(){
editable=false;
hideDivNoAjax("editcontrols");
showDiv("control");
}

</script>

<script type="text/javascript">
    window.onload=function(){
        if(!NiftyCheck())
            return;
        Rounded("div.main","#FFF","#A9D467");
        Rounded("div.mapcontrols","#A9D467","#555555");
        Rounded("div.mapheader","#A9D467","#555555");
        initialize();
    }
    window.onunload=function(){
        GUnload();
    }
</script>
<?php end_slot();?>
<div id="wrapper-1" >
    <div id="wrapper-content-1" class="main">
    <div id="mapheader" class="mapheader">
     <?php echo $rideName." - " ?>
    <label id="dist" for="distance" style="text-align:right"></label>
    </div>

    <div id="ElevationChart">
<?php if ($elevationChart): ?>
  <object data="<?php echo '/'.$elevationChart ?>" type="image/svg+xml">
        You need a browser capeable of SVG to display this image.
</object>
<?php endif; ?>
</div>
   
   <div id="map" style="width: 720px; height: 500px"></div>

   <div id="mapcontrols" class="mapcontrols">
       <?php echo form_tag('userrides/map',Array('onsubmit' => 'return done()')) ?>
       <?php echo input_hidden_tag('rideId',$rideId) ?>
       <?php echo input_hidden_tag('coords',$coords) ?>
       <?php echo input_hidden_tag('mileagePref',$mileagePref) ?>
       <?php echo input_hidden_tag('totalMileage',$totalMileage) ?>
        <?php echo input_hidden_tag('lat',$lat) ?>
       <?php echo input_hidden_tag('long',$long) ?>

       <div id="editcontrols" style="display:none">
           <?php echo button_to_function('Clear', "resetRoute()")."Clear all points on the map." ?>
           <br>
           <?php echo button_to_function('Undo', "undoPoint()")."Undo the last point on the map." ?>
           <br>
           <?//php echo button_to_function('Done', "done()") ?>
           <?php echo button_to_function('Cancel', "editDone()")."Cancel editing." ?>
           <br><br>
           <?php echo checkbox_tag('mapMileage')."Use map mileage - Check this if you want to use the mileage from the map for the ride." ?>
           <div class="submit-row">
               <?php echo submit_tag('Save Map')."Save the map as it currently is." ?>
           </div>
           </form>
       </div>
       <div id="control">
           <?php echo button_to_function('Edit', "doEdit()")."Edit existing map." ?>
       </div>
   </div>
   
</div>
</div>
