<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tag_m extends CI_Model{
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
			'created_at'=>date('Y-m-d H:i:s')
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