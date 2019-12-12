<?php
/**
 * Pages
 */
class Pages extends Controller
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
		// $this->view('pages/index');
		redirect('admin');
	}

	public function about(){
		$data = [
			'title' => 'Fuckkkkk'
		];

		$this->view('pages/about', $data);
	}

}