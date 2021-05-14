<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Tag extends CI_Controller{
	function __construct(){
		parent:: __construct();
		$this->load->model('Tag_m', 'm');
	}

	function index(){
		$this->load->view('layout/header');
		$this->load->view('employee/index');
		$this->load->view('layout/footer');
	}

	public function showAllTags(){
		$result = $this->m->showAllTags();
		echo json_encode($result);
	}

	public function addTags(){
		$result = $this->m->addTags();
		$msg['success'] = false;
		$msg['type'] = 'add';
		if($result){
			$msg['success'] = true;
		}
		echo json_encode($msg);
	}

	public function editTags(){
		$result = $this->m->editTags();
		echo json_encode($result);
	}

	public function updateTags(){
		$result = $this->m->updateTags();
		$msg['success'] = false;
		$msg['type'] = 'update';
		if($result){
			$msg['success'] = true;
		}
		echo json_encode($msg);
	}

	public function deleteTags(){
		$result = $this->m->deleteTags();
		$msg['success'] = false;
		if($result){
			$msg['success'] = true;
		}
		echo json_encode($msg);
	}

}