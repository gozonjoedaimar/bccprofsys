<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student_information_model extends CI_Model {

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
		// $dbo = new Database_Object('student_information');
		// return $dbo->getAll();

		$this->db->from('student_information');
		return $this->db->get()->result_array();
	}
}
