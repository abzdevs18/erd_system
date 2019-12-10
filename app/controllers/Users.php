<?php

/**
 * 
 */
class Users extends Controller
{
	
	function __construct()
	{

		if (file_exists( dirname(__FILE__) . '/../configs/config.php')) {
			$this->userModel = $this->model('user');
			$this->adminModel = $this->model('admins');
			if (!$this->adminModel->isAdminFound()) {
				redirect('admin/sf_admin');
			}
		}else {
			setupRedirect('admin');
			die();
		}
	}

	public function index(){
		if (isLoggedIn()) {
			redirect("dashboard");
		}
		$this->view("users/signin");
	}

	public function signout() {
		unset($_SESSION['uId']);
		unset($_SESSION['userName']);
		unset($_SESSION['email']);
		unset($_SESSION['user_type']);
		unset($_SESSION['is_admin']);
		session_destroy();

		redirect('pages/index');
	}
}