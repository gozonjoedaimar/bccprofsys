<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class No_page extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 */
	public function index()
	{
		$this->load->view('404');
	}

	/**
	 *
	 *
	 */
	public function jbug()
	{
		echo "<pre>";
		var_dump($_SERVER);
	}
}