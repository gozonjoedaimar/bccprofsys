<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Classroom_model extends CI_Model {

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
		// $dbo = new Database_Object('classroom');
		// return $dbo->getAll();

		$this->db->from('classroom');
		return $this->db->get()->result_array();
	}

	/**
	 *
	 */
	public function level_selection()
	{
		$level = [
			[
				'code'=>'1',
				'name'=>'1st'
			],
			[
				'code'=>'2',
				'name'=>'2nd'
			],
			[
				'code'=>'3',
				'name'=>'3rd'
			],
			[
				'code'=>'4',
				'name'=>'4th'
			]
		];

		return $level;
	}
}
