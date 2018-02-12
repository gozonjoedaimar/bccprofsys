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
		// $this->load->model('notifications_model', 'notifications');
		/*$this->notifications->save(array(
			"message"=>"Grades were updated",
			"icon"=>"fa-area-chart",
			"color"=>"aqua",
			"roles"=>serialize(array("_all"))
		));*/
		/*$this->notifications->save(array(
			"message"=>"Subject schedule was updated",
			"icon"=>"fa-book",
			"color"=>"yellow",
			"roles"=>serialize(array("_all"))
		));*/
		/*$this->notifications->save(array(
			"message"=>"New Teacher has been added",
			"icon"=>"fa-slideshare",
			"color"=>"blue",
			"roles"=>serialize(array("_all"))
		));*/

		// echo "<pre>";
		// var_dump(property_exists($this->notifications, 'listing'));
		// var_dump($this->core);
	}
}	