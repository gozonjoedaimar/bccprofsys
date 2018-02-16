<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Class_list_model extends CI_Model {

	/**
	 * 
	 *
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 *
	 *
	 */
	public function listing()
	{
		// $dbo = new Database_Object('class_list');
		// return $dbo->getAll();

		$this->db->from('class_list');
		return $this->db->get()->result_array();
	}

	public function add_list($classroom, $student)
	{
		$this->db->from('class_list');
		$this->db->set('classroom', $classroom);
		$this->db->set('student', $student);
		$this->db->insert();

		return $this->db->insert_id();	
	}
}
