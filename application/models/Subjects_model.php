<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subjects_model extends CI_Model {

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
		// $dbo = new Database_Object('subjects');
		// return $dbo->getAll();

		$this->db->from('subjects');
		$result = $this->db->get()->result_array();

		if ($this->core->get_session('role_code') == 'teacher') {
			$teacher_id = $this->core->get_session('user_id');
			$sql = "
			SELECT * FROM subjects WHERE id IN (
				SELECT subject FROM teacher_load WHERE teacher_id = {$teacher_id}
			)
			";

			$result = $this->db->query($sql)->result_array();
		}

		return $result;
	}

	public function selection() 
	{
		$sql = "SELECT id as code, name FROM `subjects`";
		return $this->db->query($sql)->result_array();
	}
}
