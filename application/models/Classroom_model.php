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
		$result = $this->db->get()->result_array();

		if ($this->core->get_session('role_code') == 'teacher') {
			$teacher_id = $this->core->get_session('user_id');
			$sql = "
			SELECT * FROM classroom WHERE id IN (
				SELECT classroom FROM teacher_load WHERE teacher_id = {$teacher_id}
			)
			";

			$result = $this->db->query($sql)->result_array();
		}

		return $result;
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

	public function selection() 
	{
		$list = $this->listing();

		$selection = [];

		foreach ($list as $class) {

			$year_level =$class['level'];
			$section =$class['section'];
			$batch =$class['batch'];

			$selection[] = [
				'code'=>$class['id'],
				'name'=>"{$year_level} - {$section} | $batch"
			];
		}

		return $selection;
	}
}
