<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Tagapi extends CI_Controller{
	function __construct(){
		parent:: __construct();
		$this->load->model('Tag_m', 'm');
	}

	public function tags(){
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'GET'){
			echo json_encode(array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->m->check_auth_client();
			if($check_auth_client == true){ 
				$result = $this->m->showAllTags();
				echo json_encode($result);
			} else {
				echo json_encode(array('status' => false,'message' => 'Unauthorized request.'));
			}
		}
	}

	public function postTags(){
		$method = $_SERVER['REQUEST_METHOD'];
		// echo $method;exit;
		if($method != 'POST'){
			echo json_encode(array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->m->check_auth_client();
			if($check_auth_client == true){ 
				$result = $this->m->addTags();
				$msg['success'] = false;
				$msg['type'] = 'add';
				if($result){
					$msg['success'] = true;
				}
				echo json_encode($msg);
			} else {
				echo json_encode(array('status' => false,'message' => 'Unauthorized request.'));
			}
		}
	}

	public function updateTags(){
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			echo json_encode(array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->m->check_auth_client();
			if($check_auth_client == true){ 
				$result = $this->m->updateTags();
				$msg['success'] = false;
				$msg['type'] = 'update';
				if($result){
					$msg['success'] = true;
				}
				echo json_encode($msg);
			} else {
				echo json_encode(array('status' => false,'message' => 'Unauthorized request.'));
			}
		}
	}

	public function deleteTags(){
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'GET'){
			echo json_encode(array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->m->check_auth_client();
			if($check_auth_client == true){
				$result = $this->m->deleteTags();
				$msg['success'] = false;
				if($result){
					$msg['success'] = true;
				}
				echo json_encode($msg);
			} else {
				echo json_encode(array('status' => false,'message' => 'Unauthorized request.'));
			}
		}
	}

}