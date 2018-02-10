<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registrar extends CI_Controller {

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
			'title'=>'Registrar'
		);

		$this->load->view('head', $data);
		$this->load->view('pages/registrar/quicklinks');
		$this->load->view('footer');
	}

}