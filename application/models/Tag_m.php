<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tag_m extends CI_Model{
	var $client_service = "frontend-client";
    var $auth_key       = "tags_api";

    /*For checking Authorization*/
    public function check_auth_client(){
        $client_service = $this->input->get_request_header('Client-Service', TRUE);
        $auth_key  = $this->input->get_request_header('Auth-Key', TRUE);
        if($client_service == $this->client_service && $auth_key == $this->auth_key){
            return true;
        } else {
            return false;
        }
    }

	public function showAllTags(){
		$this->db->order_by('created_at', 'desc');
		$query = $this->db->get('tbl_tags');
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}

	public function addTags(){
		$field = array(
			'tag_name'=>$this->input->post('tagName'),
			'tag_color'=>$this->input->post('tagColor'),
			'tag_category'=>$this->input->post('Category'),
			'created_at'=> date('Y-m-d H:i:s')
			);
		$this->db->insert('tbl_tags', $field);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}

	public function editTags(){
		$id = $this->input->get('id');
		$this->db->where('id', $id);
		$query = $this->db->get('tbl_tags');
		if($query->num_rows() > 0){
			return $query->row();
		}else{
			return false;
		}
	}

	public function updateTags(){
		$id = $this->input->post('txtId');
		$field = array(
		'tag_name'=>$this->input->post('tagName'),
		'tag_color'=>$this->input->post('tagColor'),
		'tag_category'=>$this->input->post('Category'),
		'updated_at'=>date('Y-m-d H:i:s')
		);
		$this->db->where('id', $id);
		$this->db->update('tbl_tags', $field);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}

	function deleteTags(){
		$id = $this->input->get('id');
		$this->db->where('id', $id);
		$this->db->delete('tbl_tags');
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
}