<?php

/**
 * 
 */
class Post
{
	private $db;
	
	public function __construct()
	{
		$this->db = new Database;
	}

	public function getDrivers(){
		$this->db->query("SELECT * FROM `user` WHERE `user_type` = 3");
		$row = $this->db->resultSet();
		if($row){
			return $row;
		}else{
			return false;
		}
	}

	public function getBus(){
		$this->db->query("SELECT * FROM `bus` WHERE `status` = 0");
		$row = $this->db->resultSet();
		if($row){
			return $row;
		}else{
			return false;
		}
	}

	public function addPlace($data)
	{
		try {
			$this->db->beginTransaction();
			$this->db->query("INSERT INTO `places_attraction`(`terminal_id`, `name`, `address`, `coordinates`) VALUES (:termId, :placeN, :placeAdd, :placeCoor)");
			$this->db->bind(':termId', $data['placeTerminal']);
			$this->db->bind(':placeN', $data['placeName']);
			$this->db->bind(':placeAdd', $data['placeAdd']);
			$this->db->bind(':placeCoor', $data['placeCoor']);
			$this->db->execute();

			$lastInsertId = $this->db->lastInsert();

			$this->db->query("INSERT INTO `place_image`(`place_id`, `img_path`, `profile_status`) VALUES (:place_id, :img_path, 1)");
			$this->db->bind(':place_id', $lastInsertId);
			$this->db->bind(':img_path', $data['photoData']);
			$this->db->execute();

			$this->db->commit();
			return true;

		} catch (Exception $e) {
			$this->db->rollBack();
			return false;
		}		
	}

	public function addRoute($data)
	{
		try {
			$this->db->beginTransaction();
			$this->db->query("INSERT INTO `routes`(`name`, `from_terminal`, `to_terminal`) VALUES (:name, :to, :from)");
			$this->db->bind(':name', $data['routeNames']);
			$this->db->bind(':to', $data['to']);
			$this->db->bind(':from', $data['from']);
			$this->db->execute();

			$this->db->commit();
			return true;

		} catch (Exception $e) {
			$this->db->rollBack();
			return false;
		}		
	}  

	public function getPlaces()
	{
		$this->db->query("SELECT places_attraction.*, place_image.img_path AS place_img FROM places_attraction LEFT JOIN place_image ON place_image.place_id = places_attraction.id");
		$row = $this->db->resultSet();
		if($row){
			return $row;
		}else{
			return false;
		}
	}

	public function getPlacesId($id)
	{
		$this->db->query("SELECT places_attraction.*, place_image.img_path AS place_img FROM places_attraction LEFT JOIN place_image ON place_image.place_id = places_attraction.id WHERE places_attraction.id = $id");
		$row = $this->db->resultSet();
		if($row){
			return $row;
		}else{
			return false;
		}
	}

	public function getRoutes()
	{
		$this->db->query("SELECT * FROM `routes`");
		$row = $this->db->resultSet();
		if($row){
			return $row;
		}else{
			return false;
		}
	}

	public function listSchedule()
	{
		$this->db->query("SELECT schedules.id AS id, bus.body_num AS busNum, user.username AS driver, schedules.depart_time AS Time, routes.name AS routeName FROM schedules LEFT JOIN bus ON schedules.bus_id = bus.id LEFT JOIN user ON bus.user_id = user.id LEFT JOIN routes ON schedules.route_id = routes.id");
		$row = $this->db->resultSet();
		if($row){
			return $row;
		}else{
			return false;
		}
	}

	public function searchlistSchedule($term)
	{
		$this->db->query("SELECT schedules.id AS id, bus.body_num AS busNum, user.username AS driver, schedules.depart_time AS Time, routes.name AS routeName FROM schedules LEFT JOIN bus ON schedules.bus_id = bus.id LEFT JOIN user ON bus.user_id = user.id LEFT JOIN routes ON schedules.route_id = routes.id WHERE bus.body_num LIKE '%$term%' OR user.username LIKE '%$term%' OR routes.name LIKE '%$term%'");
		$this->db->bind(":term", $term);
		$row = $this->db->resultSet();
		if($row){
			return $row;
		}else{
			return false;
		}
	}
	

	public function getBusForSched()
	{
		$this->db->query("SELECT * FROM `bus` WHERE `status` = 1");
		$row = $this->db->resultSet();
		if($row){
			return $row;
		}else{
			return false;
		}
	}

	public function addSchedule($data)
	{
		try {
			$this->db->beginTransaction();
			$this->db->query("INSERT INTO `schedules`(`bus_id`, `route_id`, `depart_time`, `status`) VALUES (:bus_id, :route_id, :depart_time, 0)");
			$this->db->bind(':bus_id', $data['busNum']);
			$this->db->bind(':route_id', $data['busRoute']);
			$this->db->bind(':depart_time', $data['departTime']);
			$this->db->execute();

			$this->db->commit();
			return true;

		} catch (Exception $e) {
			$this->db->rollBack();
			return false;
		}		
	}

	public function addBus($data)
	{
		try {
			$this->db->beginTransaction();
			$this->db->query("INSERT INTO `bus`(`user_id`, `body_num`, `status`) VALUES (:uId, :bodyNum, :status)");
			$this->db->bind(':uId', $data['driveId']);
			$this->db->bind(':bodyNum', $data['driverN']);
			if($data['driveId']){
				$this->db->bind(':status', 1);
			}else{
				$this->db->bind(':status', 0);
			}
			$this->db->execute();

			$this->db->commit();
			return true;

		} catch (Exception $e) {
			$this->db->rollBack();
			return false;
		}		
	}

	public function addDriver($data)
	{
		try {
			$this->db->beginTransaction();
			$this->db->query("INSERT INTO `user` (`username`,`user_type`) VALUES (:uName, :uType)");
			$this->db->bind(':uName', $data['driverN']);
			$this->db->bind(':uType', $data['uType']);
			$this->db->execute();

			$lastInsertId = $this->db->lastInsert();

			$this->db->query("INSERT INTO `user_contact` (`user_id`, `contact`, `status`) VALUES (:uId, :contact, 1)");
			$this->db->bind(':uId', $lastInsertId);
			$this->db->bind(':contact', $data['driverCon']);
			$this->db->execute();

			$this->db->commit();

			return true;

		} catch (Exception $e) {
			$this->db->rollBack();
			return false;
		}		
	}

	public function getDriverRoute($id)
	{
		$this->db->query("SELECT routes.name AS routeName, routes.from_terminal AS routeF, routes.to_terminal AS routeT FROM schedules LEFT JOIN bus ON schedules.bus_id = bus.id LEFT JOIN routes ON schedules.route_id = routes.id WHERE bus.id = :busId");
		$this->db->bind(":busId", $id);
		$row = $this->db->resultSet();
		if($row){
			return $row;
		}else{
			return false;
		}
	}

	public function getDriverList()
	{
		$this->db->query("SELECT bus.id AS id, user.username AS name, user_contact.contact AS phone, bus.body_num AS busNum FROM user LEFT JOIN bus ON bus.user_id = user.id LEFT JOIN user_contact ON user_contact.user_id = user.id WHERE user.user_type = 3");
		$row = $this->db->resultSet();
		if($row){
			return $row;
		}else{
			return false;
		}
	}

	public function addTerminal($data)
	{
		$coor = explode(", ", $data['latlong']);
		$coorFormat = $coor[1] . ", " . $coor[0];

		$this->db->query("INSERT INTO `terminal_loc`(`name`, `latlong`, `coordinate_mobile`) VALUES (:term_loc, :latlong, :coordinateMobile)");
		$this->db->bind(':term_loc', $data['term_loc']);
		$this->db->bind(':latlong', $data['latlong']);
		$this->db->bind(':coordinateMobile', $coorFormat);
		if($this->db->execute()){
			return true;
		}else{
			return false;
		}		
	}

	public function assignDispatcher($data)
	{
		try {
			$this->db->beginTransaction();
			$this->db->query("INSERT INTO `user` (`username`,`user_type`) VALUES (:uName, :uType)");
			$this->db->bind(':uName', $data['dispatcherName']);
			$this->db->bind(':uType', $data['uType']);
			$this->db->execute();

			$lastInsertId = $this->db->lastInsert();

			$this->db->query("INSERT INTO `user_contact` (`user_id`, `contact`, `status`) VALUES (:uId, :contact, 1)");
			$this->db->bind(':uId', $lastInsertId);
			$this->db->bind(':contact', $data['dispatcherContact']);
			$this->db->execute();

			$this->db->query("INSERT INTO `dispatcher` (`user_id`, `terminal_id`) VALUES (:uId, :termId)");
			$this->db->bind(':uId', $lastInsertId);
			$this->db->bind(':termId', $data['assignTerminal']);
			$this->db->execute();

			$this->db->commit();

			return true;

		} catch (Exception $e) {
			$this->db->rollBack();
			return false;
		}		
	}

	public function getTerminals()
	{
		$this->db->query("SELECT * FROM `terminal_loc`");
		$row = $this->db->resultSet();
		if($row){
			return $row;
		}else{
			return false;
		}
	}
}