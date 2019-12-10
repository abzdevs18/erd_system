<?php

/**
 * 
 */
class user
{
	private $db;

	function __construct()
	{
		$this->db = Database::getInstance();
	}

	public function login($email, $password) {
		$this->db->query("SELECT user_email.user_id AS fId, user_email.email_add AS usrEmail, user.id AS usr_id, user.user_pass AS usrPass, user.is_admin AS is_admin, user.username AS usrName, user.user_type AS uType FROM user_email LEFT JOIN user ON user.id = user_email.user_id WHERE user.username = :email OR user_email.email_add = :email");

			$this->db->bind(':email', $email);
			$row = $this->db->single();


		// if ($row->id == $user_id->user_id) {
			$hashed_pass = $row->usrPass;
			if (password_verify($password,$row->usrPass)) {
				return $row;
				// return true;

			}else{
				return false;
			}
		// }

	}
	

	public function dispatcherLogin($email, $password) {
		$this->db->query("SELECT user_email.user_id AS fId, user_email.email_add AS usrEmail, user.id AS usr_id, user.user_pass AS usrPass, terminal_loc.latlong AS terminalName, user.is_admin AS is_admin, user.username AS usrName, user.user_type AS uType FROM dispatcher LEFT JOIN user ON user.id = dispatcher.user_id LEFT JOIN terminal_loc ON terminal_loc.id = dispatcher.terminal_id LEFT JOIN user_email ON user_email.user_id = dispatcher.user_id WHERE user.user_type = 2 AND (user.username = :email OR user_email.email_add = :email)");
		$this->db->bind(':email', $email);
		$row = $this->db->single();


		// if ($row->id == $user_id->user_id) {
			$hashed_pass = $row->usrPass;
			if (password_verify($password,$row->usrPass)) {
				return $row;
				// return true;

			}else{
				return false;
			}
		// }

	}

	public function findUserEmail($email){
		$this->db->query("SELECT * FROM user_email WHERE email_add = :email_add");
		$this->db->bind(':email_add', $email);

		$row = $this->db->single();

		if ($this->db->rowCount() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function findUserName($userName){
		$this->db->query("SELECT * FROM user WHERE username = :userName");
		$this->db->bind(':userName', $userName);

		$row = $this->db->single();

		if ($this->db->rowCount() > 0) {
			return true;
		} else {
			return false;
		}
	}
}