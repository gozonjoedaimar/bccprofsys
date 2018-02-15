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
	public function listing($non_mngt = FALSE)
	{
		// $dbo = new Database_Object('department');
		// return $dbo->getAll();

		$this->db->from('department');
		$this->db->order_by('code');
		if ($non_mngt) {
			$this->db->where_not_in('code', [
				'admin',
			]);
		}
		return $this->db->get()->result_array();
	}
}
