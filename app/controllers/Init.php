<?php

define("ROOT", "/easy_ride_hub");
/**
 * 
 */
class Init extends Controller
{
	private $salt = SECURE_SALT;
	
	function __construct(){
		$this->initModel = $this->model('inits');
		$this->userModel = $this->model('user');	
	}

	public function adminSetup(){
		if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {		
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			$data = [
				'status'=> '',
				'DB_HOST'=>trim($_POST['hostName']),
				'DB_NAME'=>trim($_POST['databaseName']),
				'DB_USER'=>trim($_POST['userName']),
				'DB_PASS'=>trim($_POST['userPass']),
				'DB_HOST_err'=>'',
				'DB_NAME_err'=>'',
				'DB_USER_err'=>'',
				'DB_PASS_err'=>''
			];
			// DB_HOST validation
			if (empty($data['DB_HOST'])) {
				$data['DB_HOST_err'] = 'Please enter your Site Name';
			}
			
			// DB_NAME validation
			if (empty($data['DB_NAME'])) {
				$data['DB_NAME_err'] = 'Please enter your Site Name';
			}
			
			// DB_USER validation
			if (empty($data['DB_USER'])) {
				$data['DB_USER_err'] = 'Please enter your Site Name';
			}
			

			if (empty($data['DB_HOST_err']) && empty($data['DB_NAME_err']) && empty($data['DB_USER_err']) && empty($data['DB_PASS_err'])) {

				$data['status'] = 1;
				echo json_encode($data);
			} else {
				$data['status'] = 0;
				echo json_encode($data);
			}

		}
	}

	/*For generating Config File for Core value Definition*/
	public function configGen(){
		if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {		
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			$data = [
				'status'=> '',
				'DB_HOST'=>trim($_POST['hostName']),
				'DB_NAME'=>trim($_POST['databaseName']),
				'DB_USER'=>trim($_POST['userName']),
				'DB_PASS'=>trim($_POST['userPass'])
			];

			$dataFile = "
			<?php
			// DB params

			define('DB_HOST', '" . $data['DB_HOST'] . "');
			define('DB_USER', '" . $data['DB_USER'] . "');
			define('DB_PASS', '" . $data['DB_PASS'] . "');
			define('DB_NAME', '" . $data['DB_NAME'] . "');

			//APP ROOT
			define('APP_ROOT', dirname(dirname(__FILE__)));

			//URL ROOT
			define('URL_ROOT', 'http://" . $_SERVER['HTTP_HOST']  . ROOT ."');

			//SITE NAME
			define('SITE_NAME', 'Help Agency');

			//SALT
			define('SECURE_SALT', 'k<UL?Gxr%6bTv[IX5h>s)vaEurK]4Sn');

			?>";

			if (file_put_contents(dirname(__FILE__) .'../../configs/config.php', $dataFile)) {
				$data['status'] = 1;
				echo json_encode($data);
			}else{
				$data['status'] = 0;
				echo json_encode($data);
			}
		}
	}

	/*This method is to check is there is an error in connecting to the DB*/
	public function err(){
		$data = [
			"error" => 0
		];

		if ($this->initModel->connError()) {
			$data['error'] = 1;
			unlink(dirname(__FILE__) .'../../configs/config.php');
		}
		echo json_encode($data);
	}

	public function uploadTable(){
		$data = [
			"error" => 1
		];

		if ($this->initModel->dbLoad()) {
			$data['error'] = 0;			
		}
		echo json_encode($data);
	}

	public function chSetup(){
		if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {		
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

			$target = $_SERVER['DOCUMENT_ROOT'] . ROOT . "/public/img/default/" . basename($_FILES['siteLogo']['name']);

			$salted_pass = $this->salt . trim($_POST['adminUserPass']);
			$data = [
				'status' =>'',
				'siteLogo' => $_FILES['siteLogo']['name'],
				'siteName'=>trim($_POST['siteName']),
				'adminEmail'=>trim($_POST['adminEmail']),
				'adminUserName'=>trim($_POST['adminUserName']),
				'adminUserPass'=>trim($_POST['adminUserPass']),
				'adminUserCPass'=>trim($_POST['adminUserCPass']),
				'siteName_err'=>'',
				'adminEmail_err'=>'',
				'adminUserName_err'=>'',
				'adminUserCPass_err'=>'',
				'adminUserPass_err'=>''
			];


			// siteName validation
			if (empty($data['siteName'])) {
				$data['siteName_err'] = 'Please enter your Site Name';
			}
			// adminEmail validation
			if (empty($data['adminEmail'])) {
				$data['adminEmail_err'] = 'Please enter your Site Name';
			}else {
				if ($this->userModel->findUserEmail($data['adminEmail'])) {
					$data['adminEmail_err'] = 'Email is already taken';
				}
			}

			// adminUserName validation
			if (empty($data['adminUserName'])) {
				$data['adminUserName_err'] = 'Please enter your Username';
			}else {
				if ($this->userModel->findUserName($data['adminUserName'])) {
					$data['adminUserName_err'] = 'Username is already taken';
				}
			}


			// Password validation
			if (empty($data['adminUserPass'])) {
				$data['adminUserPass_err'] = 'Please enter your Password';
			}elseif ( strlen($data['adminUserPass']) < 8 ) {
				$data['adminUserPass_err'] = 'Password must be atleast 8 characters';
			}

			if (empty($data['adminUserCPass'])) {
				$data['adminUserCPass_err'] = 'Please confirm your password';
			}else {
				if ($data['adminUserPass'] != $data['adminUserCPass']) {
					$data['adminUserCPass_err'] = 'Passwords do not match';
				}
			}

			if (empty($data['siteName_err']) && empty($data['adminEmail_err']) && empty($data['adminUserName_err']) && empty($data['adminUserPass_err']) && empty($data['adminUserCPass_err'])) {

				if (move_uploaded_file($_FILES["siteLogo"]["tmp_name"], $target)) {
					$data['adminUserPass'] = password_hash($salted_pass, PASSWORD_DEFAULT);
					if($this->initModel->setSite($data)){
						$data['status'] = 1;
						echo json_encode($data);
					}
				}
			} else {
				$data['status'] = 0;
				echo json_encode($data);
			}
		}
	}

	public function adminLogin(){
		if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {		
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			
			$data = [
				'status'=> '',
				'adminUserName'=>trim($_POST['adminUserName']),
				'adminUserPass'=>trim($_POST['adminUserPass']),
				'adminUserName_err'=>'',
				'adminUserPass_err'=>''
			];


			// adminUserPass validation
			if (empty($data['adminUserPass'])) {
				$data['adminUserPass_err'] = 'Please enter your password';
			}else{
				$data['adminUserPass'] = SECURE_SALT . trim($_POST['adminUserPass']);
			}

			// siteName validation
			if (empty($data['adminUserName'])) {
				$data['adminUserName_err'] = 'Please enter Admin userName';
			}else{
				//First check if email is use to sign in
				if (filter_var($data['adminUserName'], FILTER_VALIDATE_EMAIL)) {
					if ($this->userModel->findUserEmail($data['adminUserName']) == false) {
						// $data['status'] = 0;
						$data['adminUserName_err'] = "Email/username doesn't exist!";
					}
				}else {
					if (!$this->userModel->findUserName($data['adminUserName'])) {
						$data['adminUserName_err'] = "Email/username doesn't exist!";
					}
				}
			}

			if (empty($data['adminUserName_err']) && empty($data['adminUserPass_err'])) {

				$loggedIn = $this->userModel->login($data['adminUserName'], $data['adminUserPass']);
				
				if ($loggedIn) {
					$data['status'] = 1;
					$this->createUserSession($loggedIn);
					// var_dump($loggedIn);
					$arr = [
						"data" => $data,
						"row" => $loggedIn
					];
					echo json_encode($arr);
				}else{
					$data['status'] = 2;

					$arr = [
						"data" => $data,
						"row" => ""
					];
					
					echo json_encode($arr);
				}

			} else {
				$data['status'] = 0;
				$arr = [
					"data" => $data,
					"row" => ""
				];
				echo json_encode($arr);
			}
		}	
	}

	public function createUserSession($user) {
		
		$_SESSION['uId'] = $user->usr_id;
		$_SESSION['userName'] = $user->usrName;
		$_SESSION['email'] = $user->usrEmail;
		$_SESSION['user_type'] = $user->uType;
		$_SESSION['is_admin'] = $user->is_admin;
	}

	public function signout() {
		unset($_SESSION['uId']);
		unset($_SESSION['userName']);
		unset($_SESSION['email']);
		unset($_SESSION['user_type']);
		session_destroy();

		redirect('users/signin');
	}

}