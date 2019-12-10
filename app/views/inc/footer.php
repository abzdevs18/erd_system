	
	<script src="<?=URL_ROOT;?>/js/jquery.mCustomScrollbar.concat.min.js"></script>
	<script src="<?=URL_ROOT;?>/js/main.js"></script>
	<script src="<?=URL_ROOT;?>/js/animsiton.min.js"></script>
	<script src="<?=URL_ROOT;?>/js/animation.js"></script>
	<!-- Data Tables -->
	<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
	<script>
		var socket = io.connect('http://192.168.0.28:4000');
		$(document).ready(function() {
			$('#example').DataTable();
		} );
	</script>
</body>
</html>