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

}