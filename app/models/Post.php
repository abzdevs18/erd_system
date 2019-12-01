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

	public function addTerminal($data)
	{
		$this->db->query("INSERT INTO `terminal_loc`(`name`, `latlong`) VALUES (:term_loc, :latlong)");
		$this->db->bind(':term_loc', $data['term_loc']);
		$this->db->bind(':latlong', $data['latlong']);
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