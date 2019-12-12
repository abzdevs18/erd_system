	<?php
	require __DIR__ . '/vendor/autoload.php';
	use Twilio\Rest\Client;
	
	// Your Account SID and Auth Token from twilio.com/console
	$account_sid = 'AC41a05b1c14d7656db36da1b69df879aa';
	$auth_token = 'bc7fa43ea8564869d3b6f1bafdef4958';
	// In production, these should be environment variables. E.g.:
	// $auth_token = $_ENV["TWILIO_AUTH_TOKEN"]
	
	// A Twilio number you own with SMS capabilities
	$twilio_number = "+12564725511";
	
	$client = new Client($account_sid, $auth_token);
	$client->messages->create(
		// Where to send a text message (your cell phone?)
		'+639350976412',
		array(
			'from' => $twilio_number,
			'body' => 'I sent this message in under 10 minutes!'
		)
	);
	?>
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
	</script>
</body>
</html>