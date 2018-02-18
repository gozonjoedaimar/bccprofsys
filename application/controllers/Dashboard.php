<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 */
	public function index($module = NULL)
	{
		
		$data = array(
			'user'=>array(
				'full_name'=>'Juan Dela Cruz III',
			)
		);
		
		if ($module) {
			$data['module'] = $module;

			if ($module == "student") $data['user']['role'] = "Student";
			elseif ($module == "teacher") $data['user']['role'] = "Teacher";
			elseif ($module == "dept_coordinator") $data['user']['role'] = "Dept. Coordinator";
			elseif ($module == "admin") $data['user']['role'] = "Admin";
		}

		if ($this->core->get_session('role_code') == 'registrar')
		{
			// redirect('registrar'); exit;
		}
		elseif ($this->core->get_session('role_code') == 'student')
		{
			redirect('student'); exit;
		}

		$this->load->view('head', $data);
		$this->load->view('dashboard');
		$this->load->view('footer');
	}

	/**
	 *
	 *
	 */
	public function admin()
	{
		$this->index('admin');
	}

	/**
	 *
	 *
	 */
	public function student()
	{
		$this->index('student');
	}

	/**
	 *
	 *
	 */
	public function teacher()
	{
		$this->index('teacher');
	}

	/**
	 *
	 *
	 */
	public function dept_coordinator()
	{
		$this->index('dept_coordinator');
	}
}
