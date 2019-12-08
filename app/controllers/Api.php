<?php

/**
 * Admin Account Controller
 */
class Api extends Controller
{

	function __construct()
	{
        $this->apiModel = $this->model('Apis');
    }

	public function terminalLocations(){

        $row = $this->apiModel->getTerminalGson();

		if($row){
            echo json_encode($row);
        }
	}

	public function alert(){
        
        $row = $this->apiModel->getAlert();

		if($row){
            echo json_encode($row);
        }
	}

	public function places(){
        
        $row = $this->apiModel->places();

		if($row){
            echo json_encode($row);
        }
	}

	public function getRoutes(){
        
        $row = $this->apiModel->getRoutes();

		if($row){
            echo json_encode($row);
        }
	}

	public function queryRoute(){
		if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {		
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        
            $row = $this->apiModel->queryRoute(trim($_POST['query']));

            if($row){
                echo json_encode($row);
            }
        }
	}

	public function appCoor(){
		if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
			//timezone is set to manila
			date_default_timezone_set('Asia/Manila');
  			// echo date("h:i a");
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			// $time = date("D, M d, g:i A");
			$date = date("M. d, Y");
			$time = date("h:i a");
			$data = [
				"bus_id" => trim($_POST['bus_id']),
				"app_coor" => trim($_POST['app_coor']),
				"sendDate" => $date,
				"sendTime" => $time
				// TODO need to add web coordinates for admin monitoring in the browser
			];
            $row = $this->apiModel->setLocation($data);

            if($row){
                echo json_encode($row);
            }
        }
	}

	public function markerQuery(){
		if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {		
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        
            $row = $this->apiModel->markerQuery(trim($_POST['query']));

            if($row){
                echo json_encode($row);
            }
        }
	}

	public function sendMessage(){

		if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
			//timezone is set to manila
			date_default_timezone_set('Asia/Manila');
  			// echo date("h:i a");
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			// $time = date("D, M d, g:i A");
			$date = date("M. d, Y");
			$time = date("h:i a");

			$data = [
				"status" => 0,
				"sender" => 3,
				// "sender" => trim($_POST['sender']),
				"receiver" => 1,
				// "receiver" => trim($_POST['receiver']),
				"message" => trim($_POST['message']),
				"sendDate" => $date,
				"sendTime" => $time
			];

			if($this->apiModel->sendMessage($data)){
				$data['status'] = 1;
				echo json_encode($data);
			}else{
				echo json_encode($data);
			}
		}
	}

	public function getMessages(){
		if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {		
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

			$data = [
				"status" => 0,
				"sender" => trim($_POST['sender']),
				"receiver" => trim($_POST['receiver'])
			];
        
            $row = $this->apiModel->getMessages($data);

            if($row){
                echo json_encode($row);
            }
        }
	}

}