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
		return $this->db->get()->result_array();
	}
}