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
	public function listing($student_id = NULL)
	{
		// $dbo = new Database_Object('grades');
		// return $dbo->getAll();

		if ( ! $student_id) $student_id = $this->core->get_session('user_id');

		$this->db->from('grades');
		$this->db->where('student', $student_id);
		$result = $this->db->get()->result_array();

		$grades = [];
		foreach ($result as $grade_info) {
			$teacher_load = $this->core->get_teacher_load($grade_info['teacher_load']);
			$subject_info = $this->core->get_subject($teacher_load->subject);
			$grade_info['subject_code'] = $subject_info ? $subject_info->code: "";
			$grade_info['subject_title'] = $subject_info ? $subject_info->name: "";
			$grades[] = $grade_info;
		}

		return $grades;

		// return $this->demo();
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

	public function get_grades($student, $teacher_load)
	{
		$this->db->from('grades');
		$this->db->where('student', $student);
		$this->db->where('teacher_load', $teacher_load);
		return $this->db->get()->row_array();
	}
}
