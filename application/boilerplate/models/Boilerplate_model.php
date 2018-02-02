<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Boilerplate_model extends CI_Model {

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
		// $dbo = new Database_Object('boilerplate');
		// return $dbo->getAll();

		$this->db->from('boilerplate');
		return $this->db->get()->result_array();
	}
}
