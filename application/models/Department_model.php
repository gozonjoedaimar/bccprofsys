<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Department_model extends CI_Model {

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
		// $dbo = new Database_Object('department');
		// return $dbo->getAll();

		$this->db->from('department');
		$this->db->order_by('code');
		return $this->db->get()->result_array();
	}
}
