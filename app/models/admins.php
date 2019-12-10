<?php

/**
 * 
 */
class Admins
{
	private $db;
	private $error;
	
	function __construct()
	{
		
		$this->db = Database::getInstance();
		$this->error = Database::conError();

	}

	public function connError(){
		return $this->error;
	}

	public function isAdminFound(){
		$this->db->query("SELECT * FROM user WHERE is_admin = 1");
		$row = $this->db->single();

		if ($this->db->rowCount() > 0) {
			return true;
		}

		return false;
		// echo $this->db;
	}
	// public function getUserMsg($id){
	// 	$this->db->query("SELECT DISTINCT user.id,user.firstname AS firstN, user.lastname AS lastN, user.user_availability AS uStatus,(SELECT messages.msg_content FROM messages WHERE messages.user_sender_id = user.id ORDER BY messages.timestamp DESC LIMIT 1) AS latestM,(SELECT messages.timestamp FROM messages WHERE messages.user_sender_id = user.id ORDER BY messages.timestamp DESC LIMIT 1) AS mStamp, user_profile.img_path AS imagePath FROM messages LEFT JOIN user ON user.id = messages.user_sender_id LEFT JOIN user_profile ON user_profile.user_id = user.id WHERE user.id != 1 AND messages.user_receiver_id = $id ORDER BY mStamp DESC");
	// 	$row = $this->db->resultSet();
	// 	if($row){
	// 		return $row;
	// 	}else{
	// 		return false;
	// 	}
	// }

	public function getLatestSender($id)
	{
		$this->db->query("SELECT messages.user_sender_id AS rId FROM messages WHERE messages.user_sender_id != $id AND messages.user_receiver_id = $id ORDER BY messages.timestamp DESC LIMIT 1");
		$row = $this->db->resultSet();
	   if ($row) {
		   return $row;
	   } else {
		   return false;
	   }
	}

	
	public function getUserMsg($id){
		$this->db->query("SELECT DISTINCT user.id,user.firstname AS firstN, user.lastname AS lastN, user.user_availability AS uStatus,(SELECT messages.msg_content FROM messages WHERE messages.user_sender_id = user.id ORDER BY messages.timestamp DESC LIMIT 1) AS latestM,(SELECT messages.timestamp FROM messages WHERE messages.user_sender_id = user.id ORDER BY messages.timestamp DESC LIMIT 1) AS mStamp, user_profile.img_path AS imagePath FROM messages LEFT JOIN user ON user.id = messages.user_sender_id LEFT JOIN user_profile ON user_profile.user_id = user.id WHERE user.id != 1 AND (messages.user_receiver_id = 1 AND user.user_type = $id ) ORDER BY mStamp DESC");
		$row = $this->db->resultSet();
		if($row){
			return $row;
		}else{
			return false;
		}
	}

	public function getLatestMessages($receiverId, $senderId){
		$this->db->query("SELECT user.firstname AS firstN, user.lastname AS lastN, messages.user_receiver_id AS receiverId, messages.user_sender_id AS senderId, messages.msg_content as msgContent, messages.msg_date AS msgDate, user_profile.img_path AS sendIconImage FROM messages LEFT JOIN user ON user.id = messages.user_receiver_id LEFT JOIN user_profile ON user_profile.user_id = messages.user_receiver_id AND user_profile.profile_status = 1 WHERE (messages.user_receiver_id = :userReceiverId AND messages.user_sender_id = :userSenderId) OR (messages.user_receiver_id = :userSenderId AND messages.user_sender_id = :userReceiverId) ORDER BY messages.timestamp DESC");
		$this->db->bind(":userReceiverId", $receiverId);
		$this->db->bind(":userSenderId", $senderId);
		$row = $this->db->resultSet();
	   if ($row) {
		   return $row;
	   } else {
		   return false;
	   }
	}
}