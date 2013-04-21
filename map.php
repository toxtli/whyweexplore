<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <style type="text/css">
      html { height: 100% }
      body { height: 100%; margin: 0; padding: 0 }
      #map-canvas { height: 100% }
    </style>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAg7IzVKDUH740JyMwxhahjVMJZM96xlEU&sensor=true"></script>
	<script type="text/javascript" src="./markerclusterer.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    <script type="text/javascript">
	var map;
	
      function initialize() {
        var mapOptions = {
          center: new google.maps.LatLng(40.397, 10.644),
          zoom: 2,
          mapTypeId: google.maps.MapTypeId.SATELLITE
        };
        map = new google.maps.Map(document.getElementById("map-canvas"),
            mapOptions);
      }
	  
      google.maps.event.addDomListener(window, 'load', initialize);

	function toggleBounce() {

	  if (marker.getAnimation() != null) {
		marker.setAnimation(null);
	  } else {
		marker.setAnimation(google.maps.Animation.BOUNCE);
	  }
	}
	  
		var j = 0;
		var marker = [];
		var infowindow = [];
		var markerCluster;
		var threads = 0;
		var maxThreads = 2;
	  
	  $(function(){
		$.getJSON('./data.js', function(data){
			data = data.data;
			for(i in data)
			{
				marker[j] = new google.maps.Marker({
					map:map,
					title:data[i].name,
					draggable:true,
					animation: google.maps.Animation.DROP,
					position: new google.maps.LatLng(parseFloat(data[i].lat), data[i].lng),
					icon: {url:'http://img.youtube.com/vi/'+data[i].youtube+'/1.jpg',scaledSize:new google.maps.Size(32, 32)},
					extraId: j
				});
				infowindow[j] = new google.maps.InfoWindow({
						content: '<iframe width="560" height="315" src="http://www.youtube.com/embed/'+data[i].youtube+'" frameborder="0" allowfullscreen></iframe>'
				});
				//google.maps.event.addListener(marker, 'click', toggleBounce);;
				google.maps.event.addListener(marker[j], 'click', function(evt) {
				    infowindow[this.extraId].open(map,this);
				});
				j++;
			}
			onEnd();
		});
		$.getJSON('http://gdata.youtube.com/feeds/api/videos?alt=json&q=whyweexplore', function(data){
			data = data.feed.entry;
			for(i in data)
			{
				if(typeof data[i]["georss$where"] != 'undefined')
				{
					if(typeof data[i]["georss$where"]["gml$Point"]["gml$pos"]["$t"] != 'undefined')
					{
						var coords = data[i]["georss$where"]["gml$Point"]["gml$pos"]["$t"].split(' ');
						var videoId = data[i]["id"]["$t"].split('/').pop();
						marker[j] = new google.maps.Marker({
							map:map,
							title:data[i]["title"]["$t"],
							draggable:true,
							animation: google.maps.Animation.DROP,
							position: new google.maps.LatLng(parseFloat(coords[0]), parseFloat(coords[1])),
							icon: {url:'http://img.youtube.com/vi/'+videoId+'/1.jpg',scaledSize:new google.maps.Size(32, 32)},
							extraId: j
						});
						infowindow[j] = new google.maps.InfoWindow({
								content: '<iframe width="560" height="315" src="http://www.youtube.com/embed/'+videoId+'" frameborder="0" allowfullscreen></iframe>'
						});
						//google.maps.event.addListener(marker, 'click', toggleBounce);;
						google.maps.event.addListener(marker[j], 'click', function(evt) {
							infowindow[this.extraId].open(map,this);
						});
						console.debug(data[i]["georss$where"]["gml$Point"]["gml$pos"]["$t"]);
						j++;
					}
				}
			}
			onEnd();
		});
	  });
	  
	  function onEnd()
	  {
		threads++;
		if(threads==maxThreads)
		{
			markerCluster = new MarkerClusterer(map, marker);
		}
	  }
	
    </script>
	<script src="https://apis.google.com/js/client.js?onload=handleClientLoad"></script>
  </head>
  <body>
    <div id="map-canvas"/>	
  </body>
</html>