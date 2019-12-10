<?php

/**
 * 
 */
class Apis
{
	private $db;
	
	function __construct()
	{
		
		$this->db = Database::getInstance();
	}

	// Mobile Terminal Location query
	public function getAlert(){
		$this->db->query("SELECT routes.id AS id, routes.name AS name, schedules.depart_time AS dpart, schedules.status AS status FROM routes LEFT JOIN schedules ON schedules.route_id = routes.id WHERE schedules.status = 1");
		$row = $this->db->resultSet();

		if ($row) {
			return $row;
		}else{
			return false;
		}
	}

	// Mobile Terminal Location query
	public function queryRoute($term){
		$this->db->query("SELECT routes.id AS id, routes.name AS name, schedules.depart_time AS dpart, schedules.status AS status FROM routes LEFT JOIN schedules ON schedules.route_id = routes.id WHERE EXISTS(SELECT * FROM schedules WHERE schedules.route_id = routes.id) AND routes.name LIKE '%$term%'");
		$row = $this->db->resultSet();

		if ($row) {
			return $row;
		}else{
			return false;
		}
	}

	// Mobile Terminal Location query
	public function markerQuery($term){
		$this->db->query("SELECT routes.id AS id, routes.name AS name, bus.body_num AS busNum, schedules.depart_time AS dpart, schedules.status AS status FROM routes LEFT JOIN schedules ON schedules.route_id = routes.id LEFT JOIN bus ON schedules.bus_id = bus.id AND bus.status = 1 WHERE EXISTS(SELECT * FROM schedules WHERE schedules.route_id = routes.id) AND (routes.name LIKE '$term%' AND schedules.status = 0)");
		$row = $this->db->resultSet();

		if ($row) {
			return $row;
		}else{
			return false;
		}
	}

	// Mobile Terminal Location query
	public function getRoutes(){
		$this->db->query("SELECT routes.id AS id, routes.name AS name, schedules.depart_time AS dpart, schedules.status AS status FROM routes LEFT JOIN schedules ON schedules.route_id = routes.id WHERE EXISTS(SELECT * FROM schedules WHERE schedules.route_id = routes.id)");
		$row = $this->db->resultSet();

		if ($row) {
			return $row;
		}else{
			return false;
		}
	}


	// Mobile Terminal Location query
	public function getTerminalGson(){
		$this->db->query("SELECT `id`, `name`, `latlong`, `coordinate_mobile` FROM `terminal_loc`");
		$row = $this->db->resultSet();

		if ($row) {
			return $row;
		}else{
			return false;
		}
	}

	// Mobile Terminal Location query
	public function getDriverRouteForMsg($data){
		$this->db->query("SELECT routes.from_terminal AS termOne, routes.to_terminal AS termTwo FROM bus LEFT JOIN schedules ON bus.id = schedules.bus_id LEFT JOIN routes ON routes.id = schedules.route_id WHERE bus.user_id = :driverId
		");
		$this->db->bind(":driverId", $data['sender']);
		$row = $this->db->resultSet();
		if ($row) {
			return $row;
		}else{
			return false;
		}
	}


	// Mobile Terminal Location query
	public function getTerminalDispatcher($data){
		$this->db->query("SELECT dispatcher.user_id AS userId FROM terminal_loc LEFT JOIN dispatcher ON terminal_loc.id = dispatcher.terminal_id WHERE terminal_loc.latlong = :fromT OR terminal_loc.latlong = :toT");
		$this->db->bind(":fromT", $data['from']);
		$this->db->bind(":toT", $data['to']);

		$row = $this->db->resultSet();

		if ($row) {
			return $row;
		}else{
			return false;
		}
	}


	// Mobile Terminal Location query
	public function places(){
		$this->db->query("SELECT places_attraction.id AS id, places_attraction.name AS name,places_attraction.address AS address,places_attraction.coordinates AS coordinates, place_image.img_path AS image FROM places_attraction LEFT JOIN place_image ON places_attraction.id = place_image.place_id");
		$row = $this->db->resultSet();

		if ($row) {
			return $row;
		}else{
			return false;
		}
	}


	/*Inser Message*/
	public function sendMessage($data){
		$this->db->query("INSERT INTO `messages`(`user_receiver_id`, `user_sender_id`, `msg_content`, `msg_date`, `msg_time`) VALUES (:receiver,:sender,:message, :sendDate,:sendTime)");
		$this->db->bind(":receiver", $data['receiver']);
		$this->db->bind(":sender", $data['sender']);
		$this->db->bind(":message", $data['message']);
		$this->db->bind(":sendTime", $data['sendTime']);
		$this->db->bind(":sendDate", $data['sendDate']);

		if ($this->db->execute()) {
			return true;
		}else{
			return false;
		}
	}


	// Get getBusByUserId
	public function getBusByUserId($data){
		$this->db->query("SELECT bus.id AS bus_id, schedules.depart_time AS departTime, bus.body_num AS busNum, routes.name AS routeName, routes.from_terminal AS fromRoute, routes.to_terminal AS toRoute FROM bus LEFT JOIN schedules ON bus.id = schedules.bus_id LEFT JOIN routes ON schedules.route_id = routes.id WHERE bus.user_id = :userId");
		$this->db->bind(":userId", $data['userId']);
		
		$row = $this->db->resultSet();

		if ($row) {
			return $row;
		}else{
			return false;
		}
	}


	// Get Message
	public function getMessagesDriver($data){
		$this->db->query("SELECT messages.user_receiver_id AS reciever, messages.user_sender_id AS sender,messages.msg_content AS content, messages.msg_time AS time, user_profile.img_path AS senderImg FROM messages LEFT JOIN user_profile ON user_profile.user_id = messages.user_sender_id WHERE messages.user_receiver_id = :receiver OR messages.user_sender_id = :receiver ORDER BY timestamp DESC");
		$this->db->bind(":receiver", $data['receiver']);
		
		$row = $this->db->resultSet();

		if ($row) {
			return $row;
		}else{
			return false;
		}
	}


	// Get Message
	public function getMessages($data){
		$this->db->query("SELECT messages.user_receiver_id AS reciever, messages.user_sender_id AS sender,messages.msg_content AS content, messages.msg_time AS time, user_profile.img_path AS senderImg FROM messages LEFT JOIN user_profile ON user_profile.user_id = messages.user_sender_id WHERE (messages.user_receiver_id = :receiver AND messages.user_sender_id = :sender) OR (messages.user_sender_id = :receiver AND messages.user_receiver_id = :sender) ORDER BY timestamp DESC");
		$this->db->bind(":sender", $data['sender']);
		$this->db->bind(":receiver", $data['receiver']);
		
		$row = $this->db->resultSet();

		if ($row) {
			return $row;
		}else{
			return false;
		}
	}


	/*Inser Message*/
	public function setLocation($data){
		$this->db->query("INSERT INTO `bus_route_update`(`bus_id`, `web_coor`, `app_coor`, `time`, `date`) VALUES (:bus_id,:web,:app, :time,:date)");
		$this->db->bind(":bus_id", $data['bus_id']);
		$this->db->bind(":web", $data['app_coor']);
		$this->db->bind(":app", $data['app_coor']);
		$this->db->bind(":time", $data['sendTime']);
		$this->db->bind(":date", $data['sendDate']);

		if ($this->db->execute()) {
			return true;
		}else{
			return false;
		}
	}

	public function getListDriver($data)
	{
		$this->db->query("SELECT user.id AS p_k, bus.body_num AS bus_num, user.username AS username, user_email.email_add AS emaill, user.lastname AS lastname FROM user LEFT JOIN user_email ON user_email.user_id = user.id LEFT JOIN bus ON bus.user_id = user.id WHERE EXISTS (SELECT * FROM schedules LEFT JOIN routes ON routes.id = schedules.route_id WHERE schedules.bus_id = bus.id AND (routes.from_terminal = :Terminal OR routes.to_terminal = :tTerminal)) AND user.id != :userId");
		$this->db->bind(":userId", $data['userId']);
		$this->db->bind(":Terminal", $data['locTerminal']);
		$this->db->bind(":tTerminal", $data['locTerminal']);
		$row = $this->db->resultSet();
		if($row){
			return $row;
		}else{
			return false;
		}
	}

	
}