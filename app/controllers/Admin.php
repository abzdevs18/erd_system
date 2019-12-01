<?php

define("ROOT", "/easy_ride_hub");
/**
 * Admin Account Controller
 */
class Admin extends Controller
{
	function __construct()
	{
		if (file_exists( dirname(__FILE__) . '/../configs/config.php')) {
			$this->postModel = $this->model('Post');
			$this->adminModel = $this->model('admins');
			// $this->userModel = $this->model('user');
			if (!isLoggedIn()) {
				if (!$this->adminModel->isAdminFound() || $this->adminModel->connError()) {
					$this->setup();
					die();
				}else{
					$this->login();
					die();
				}
			}
		}else {
			$this->setup();
			die();
		}	
	}

	public function index(){
		$row = $this->postModel->getTerminals();
		$drivers = $this->postModel->getDrivers();
		$bus = $this->postModel->getBus();
		$data = [
			"terminal"=>$row,
			"drivers"=>$drivers,
			"bus"=>$bus
		];
		// no other solution this is for the Left sidebar navigation
		// the active state is dependent to this SESSION we are setting.
		unset($_SESSION['menu_active']);
		$_SESSION['menu_active'] = "home";

		$this->view('admin/index',$data);
	}

	public function login(){
		if (isLoggedIn() && $_SESSION['is_admin'] == 1) {
			$this->view('admin/index');
		}else if(isLoggedIn() && $_SESSION['user_type'] == 1){
			redirect("dashboard/index");
		}else{
		$this->view('admin/login');
		}
	}

	public function setup(){
		$this->view('admin/setup/ch_admin');
	}

	public function profile(){
		
		// no other solution this is for the Left sidebar navigation
		// the active state is dependent to this SESSION we are setting.
		unset($_SESSION['menu_active']);
		$_SESSION['menu_active'] = "profile";

		$this->view('admin/update-prof');
	}

	public function posted(){
		$data = [
			"one" => $this->breadcrump()
		];
		// no other solution this is for the Left sidebar navigation
		// the active state is dependent to this SESSION we are setting.
		unset($_SESSION['menu_active']);
		$_SESSION['menu_active'] = "request";

		$this->view('admin/request',$data);
	}

	public function biddings(){
		
		// no other solution this is for the Left sidebar navigation
		// the active state is dependent to this SESSION we are setting.
		unset($_SESSION['menu_active']);
		$_SESSION['menu_active'] = "messages";

		$this->view('admin/messages');
	}

	public function routes(){
		$routes = $this->postModel->getRoutes();
		$data = [
			"routes" => $routes
		];
		// no other solution this is for the Left sidebar navigation
		// the active state is dependent to this SESSION we are setting.
		unset($_SESSION['menu_active']);
		$_SESSION['menu_active'] = "routes";

		$this->view('admin/route', $data);
	}

	public function addPlace(){
		if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {		
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

			$target = $_SERVER['DOCUMENT_ROOT'] . ROOT . "/public/img/places/" . basename($_FILES['placeImage']['name']);

			$data = [
				"status" => "",
				'photoData' => $_FILES['placeImage']['name'],
				"placeCoor" => substr(trim($_POST['placeCoor']), 7, -1),
				"placeName" => trim($_POST['placeName']),
				"placeAdd" => trim($_POST['placeAdd']),
				"placeTerminal" => trim($_POST['placeTerminal'])
			];

			if (move_uploaded_file($_FILES["placeImage"]["tmp_name"], $target)) {

				if($this->postModel->addPlace($data)){
					$data['status'] = 1;
					echo json_encode($data);
				}
			}else{
				$data['status'] = 0;
				echo json_encode($data[0]);
			}
		}
	}

	public function addRoute(){
		if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {		
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			$data = [
				"status" => "",
				"from" => trim($_POST['from']),
				"routeNames" => trim($_POST['routeNames']),
				"to" => trim($_POST['to'])
			];
			if($this->postModel->addRoute($data)){
				$data['status'] = 1;
				echo json_encode($data);
			}else{
				$data['status'] = 0;
				echo json_encode($data);
			}
		}
	}

	public function addBus(){
		if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {		
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			$data = [
				"status" => "",
				"driveId" => trim($_POST['driveId']),
				"driverN" => trim($_POST['driverN'])
			];
			if($this->postModel->addBus($data)){
				$data['status'] = 1;
				echo json_encode($data);
			}else{
				$data['status'] = 0;
				echo json_encode($data);
			}
		}
	}

	public function addDriver(){
		if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {		
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			$data = [
				"status" => "",
				"driverCon" => trim($_POST['driverCon']),
				"uType" => trim($_POST['uType']),
				"driverN" => trim($_POST['driverN'])
			];
			if($this->postModel->addDriver($data)){
				$data['status'] = 1;
				echo json_encode($data);
			}else{
				$data['status'] = 0;
				echo json_encode($data);
			}
		}
	}

	public function addTerminal(){
		if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {		
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			$data = [
				"status" => "",
				"term_loc" => trim($_POST['termN']),
				// "latlong" => trim($_POST['terminalCoor'])
				"latlong" => substr(trim($_POST['terminalCoor']), 7, -1)
			];
			if($this->postModel->addTerminal($data)){
				$data['status'] = 1;
				echo json_encode($data);
			}else{
				$data['status'] = 0;
				echo json_encode($data);
			}
		}
	}
	public function assignDispatcher(){
		if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {		
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			$data = [
				"status" => "",
				"assignTerminal" => trim($_POST['assignTerminal']),
				"uType" => trim($_POST['uType']),
				"dispatcherName" => trim($_POST['dispatcherName']),
				"dispatcherContact" => trim($_POST['dispatcherContact'])
			];
			if($this->postModel->assignDispatcher($data)){
				$data['status'] = 1;
				echo json_encode($data);
			}else{
				$data['status'] = 0;
				echo json_encode($data);
			}
		}
	}

	public function privacy(){
		
		// no other solution this is for the Left sidebar navigation
		// the active state is dependent to this SESSION we are setting.
		unset($_SESSION['menu_active']);
		$_SESSION['menu_active'] = "privacy";

		$this->view('admin/privacy');
	}

	public function logout(){
		
		// no other solution this is for the Left sidebar navigation
		// the active state is dependent to this SESSION we are setting.
		unset($_SESSION['menu_active']);

		$this->view('admin/index');
	}

	public function add_student(){
		$this->view('admin/add_student');
	}

	public function add_user_ad(){
		$this->view('admin/add_user_ad');
	}

}