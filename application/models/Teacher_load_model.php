<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teacher_load_model extends CI_Model {

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
	public function listing($teacher_id = NULL)
	{
		// $dbo = new Database_Object('teacher_load');
		// return $dbo->getAll();

		$this->db->from('teacher_load');

		if ($teacher_id) {
			$this->db->where('teacher_id', $teacher_id);
		}

		return $this->db->get()->result_array();
	}
}
