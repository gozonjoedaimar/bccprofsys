<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sidebar_model extends CI_Model {

	/**
	 * 
	 *
	 */
	public function get_user_menu($user_role = null)
	{
		$file_loc = "assets/xml/sidebar.xml";

		$sidebar_xml = @ simplexml_load_file($file_loc);

		if ( ! $user_role) {
			$user_role = 'demouser';
		}

		if ( ! $sidebar_xml) return;

		foreach ($sidebar_xml->user as $user) {
			if ($user->name == $user_role) {
				$this->load->view('components/sidebar-link', array('links'=>$user->menu->link, 'main'=>true));
			}
		}
	}
}
