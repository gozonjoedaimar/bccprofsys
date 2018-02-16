<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Controller {

	/**
	 *
	 *
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('student_model', 'student');
	}


	public function index() 
	{
		$data = array(
			'title'=>'Student'
		);

		$this->load->view('head', $data);
		$this->load->view('pages/student/quicklinks');
		$this->load->view('footer');
	}

	public function listing($module = NULL, $id = NULL)
	{
		$data = $this->student->listing($module, $id);
		$this->output->set_content_type('json')->set_output(json_encode(['data'=>$data]));
	}

	public function add_list($classroom, $student)
	{
		$this->student->add_list($classroom, $student);
		$this->output->set_content_type('json')->set_output(json_encode(['data'=>[], 'success'=>TRUE]));
	}

	public function delete_from_list($classroom, $student)
	{
		$this->student->delete_from_list($classroom, $student);
		$this->output->set_content_type('json')->set_output(json_encode(['data'=>[], 'success'=>TRUE]));
	}

}