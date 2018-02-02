<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grades_model extends CI_Model {

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
		// $dbo = new Database_Object('grades');
		// return $dbo->getAll();

		$this->db->from('grades');
		return $this->db->get()->result_array();
	}
}
