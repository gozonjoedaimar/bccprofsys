<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{
	/**
	 * 
	 *
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Index Page for this controller.
	 *
	 */
	public function index()
	{
		
		if ($this->core->get_session('logged_in')) {
			$r_url = $this->core->get_session('referrer') OR site_url();
			redirect($r_url);
			exit;
		}

		$this->load->view('login');
	}

	/**
	 *
	 *
	 */
	public function verify()
	{
		$post = $this->input->post();

		$this->session->set_flashdata('login_activity', TRUE);
		
		if ( ! $post) {
			$this->layout->add_alert('warning', 'Fields must not be empty!');
			redirect('login');
			exit;
		}

		if ($id = $this->user->verify_login($post['username'], $post['password'])) {
			$this->core->set_session('logged_in', $id);
			$this->user->load_info($id);
			$r_url = $this->core->get_session('referrer') OR site_url();

			redirect($r_url);
		}
		else {
			$this->core->add_alert('danger', "Invalid username/password.");
			redirect('login');
		}
	}

	/**
	 * Logout
	 *
	 */
	public function logout() 
	{
		$this->session->set_flashdata('login_activity', TRUE);

		$this->core->unset_session('logged_in');
		$this->core->add_alert('info', "Session ended. You've been logged out.");
		redirect('login');
		exit;
	}
}