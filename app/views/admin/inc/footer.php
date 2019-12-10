	</main>	
	<!-- <div id="sound"></div> -->
	<script src="<?=URL_ROOT;?>/js/jquery.mCustomScrollbar.concat.min.js"></script>
	<script type="text/javascript" src="<?=URL_ROOT;?>/js/MovingMarker.js"></script>
	<script type="text/javascript" src="<?=URL_ROOT;?>/js/leaflet/dragmarker.js"></script>
	<script src="<?=URL_ROOT;?>/js/script.js"></script>
	<script src="<?=URL_ROOT;?>/js/push.min.js"></script>
	<script src="<?=URL_ROOT;?>/js/main.js"></script>
	<script src="<?=URL_ROOT;?>/js/routeMap.js"></script>
	<script src="<?=URL_ROOT;?>/js/admin_script.js"></script>
	<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
	<script>
		var socket = io.connect('http://192.168.0.28:4000');
		var routingControl = false;

		var greenIcon = L.icon({
		iconUrl: URLL_ROOT + "/img/icons/bus.png",
		// shadowUrl: 'leaf-shadow.png',
		iconSize: [32, 37], // size of the icon
		iconAnchor: [15, 30], // point of the icon which will correspond to marker's location
		shadowAnchor: [4, 62], // the same for the shadow
		popupAnchor: [-3, -76] // point from which the popup should open relative to the iconAnchor
		});

		$(document).ready(function() {
			$('#example').DataTable();
		} );

		socket.on("message", function(data){
			var busId = $('#coordinatte').attr("data-checkid");

			if(busId == data['bus_id']){
				$('#coordinatte').append("<li>"+ data['latitude'] +"</li>");
				if(routingControl){
					rousteMap.removeLayer(routingControl);
					routingControl = L.marker([data['latitude'], data['longitude']], { icon: greenIcon, draggable: false })
					.addTo(rousteMap)
					.bindPopup(data['bodyNum']);
					
				}else{
					routingControl = true;
					routingControl = L.marker([data['latitude'], data['longitude']], { icon: greenIcon, draggable: false })
					.addTo(rousteMap)
					.bindPopup(data['bodyNum']);
				}
				// routingControl = L.marker([data['latitude'], data['longitude']]).addTo(rousteMap);

			}
			// console.log(data);
		});
	</script>
	<!-- <script src="https://cdn.tiny.cloud/1/hhu3aczt7p034dcjnizjwnns5faj5u4s14e894midesztea0/tinymce/5/tinymce.min.js"></script>  -->
</body>
</html>