<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teacher_load_model extends CI_Model {

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
	public function listing($_id = NULL, $module = NULL)
	{
		// $dbo = new Database_Object('teacher_load');
		// return $dbo->getAll();

		$teacher_id  = $_id;

		$sql = "SELECT *, (SELECT code FROM subjects WHERE subjects.id = teacher_load.subject) subject_code FROM `teacher_load` WHERE teacher_id = '{$teacher_id}'";


		if ($module == "student")
		{
			$sql = "SELECT *, (SELECT code FROM subjects WHERE subjects.id = teacher_load.subject) subject_code FROM `teacher_load` WHERE classroom IN (SELECT classroom FROM `class_list` where student = '{$_id}')";			
		}

		// $this->db->from('teacher_load');

		// if ($teacher_id) {
		// 	$this->db->where('teacher_id', $teacher_id);
		// }

		$result = $this->db->query($sql)->result_array();

		foreach ($result as $idx => $info) {
			$class = $this->get_class_disp($info['classroom']);
			$teacher = $this->user->get_user($info['teacher_id']);
			$result[$idx]['classroom_disp'] = $class;
			$first_name = $teacher->first_name;
			$last_name = $teacher->last_name;
			$result[$idx]['teacher_disp'] = "{$first_name} {$last_name}";

		}

		return $result;
	}

	public function get_subject($id) 
	{
		$this->db->from('subjects');
		$this->db->where('id', $id);
		$result = $this->db->get()->row();
		return $result;
	}

	public function get_subject_name($id)
	{
		$subject = $this->get_subject($id);
		if ($subject) {
			return $subject->name;
		}

		return "";
	}

	public function get_subject_code($id)
	{
		$subject = $this->get_subject($id);
		if ($subject) {
			return $subject->code;
		}

		return "";
	}

	public function get_class($id) 
	{
		$this->db->from('classroom');
		$this->db->where('id', $id);
		$result = $this->db->get()->row();
		return $result;
	}

	public function get_class_disp($id)
	{
		$class = $this->get_class($id);
		$year = $class->level;
		$section = $class->section;
		$batch = $class->batch;

		return "{$year} - {$section} | {$batch}";
	}
}
