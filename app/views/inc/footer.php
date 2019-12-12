	<script src="<?=URL_ROOT;?>/js/jquery.mCustomScrollbar.concat.min.js"></script>
	<script src="<?=URL_ROOT;?>/js/main.js"></script>
	<script src="<?=URL_ROOT;?>/js/animsiton.min.js"></script>
	<script src="<?=URL_ROOT;?>/js/animation.js"></script>
	<!-- Data Tables -->
	<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
	<script>
		var socket = io.connect('http://erdhubtravel.ga:3000');
		$(document).ready(function() {
			$('#example').DataTable();
		} );
		client.messages.create({
  from: "+12564725511",
  to: '+639350976412',
  body: "You just sent an SMS from Node.js using Twilio!"
}).then((messsage) => console.log(message.sid));
	</script>
</body>
</html>