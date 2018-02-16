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

		// $this->db->from('grades');
		// return $this->db->get()->result_array();

		return $this->demo();
	}

	public function demo()
	{
		$list = [
			[
				"subject_code"=>'IT100',
				"subject_title"=>'Basic Programming',
				"first_semister"=>95,
				'second_semister'=>81,
				'final_grades'=>95,
				'teacher'=>"",
				'remarks'=>'Passed'
			],
			[
				"subject_code"=>'IT100',
				"subject_title"=>'Basic Programming',
				"first_semister"=>95,
				'second_semister'=>81,
				'final_grades'=>95,
				'teacher'=>"",
				'remarks'=>'Passed'
			],
			[
				"subject_code"=>'IT100',
				"subject_title"=>'Basic Programming',
				"first_semister"=>95,
				'second_semister'=>81,
				'final_grades'=>95,
				'teacher'=>"",
				'remarks'=>'Passed'
			],
		];

		return $list;
	}
}
