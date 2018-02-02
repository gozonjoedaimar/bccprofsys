<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Core_model extends CI_Model
{
	/**
	 *
	 *
	 */
	public function __construct()
	{
		parent::__construct();

		if ( ! $this->session->userdata(SITE_CODE)) { // SITE_CODE is defined in application/config/constant.php
			$this->session->set_userdata(SITE_CODE, array());
		}
	}

	/**
	 *
	 *
	 */
	public function addAlert($type, $text)
	{
		$flashdata = $this->session->flashdata();

		$alerts = isset($flashdata['alerts']) ? $flashdata['alerts']: array();

		$alerts[] = array(
			"type"=>$type,
			"text"=>$text
		);

		$flashdata['alerts'] = $alerts;

		$this->session->set_flashdata($flashdata);
	}

	/**
	 * CI compat. method for addAlert
	 *
	 */
	public function add_alert($type, $text)
	{
		return $this->addAlert($type, $text);
	}

	/**
	 *
	 *
	 */
	public function getAlerts()
	{
		$flashdata = $this->session->flashdata('alerts');

		$flashdata = $flashdata ? $flashdata: array();

		return $flashdata;
	}

	/**
	 * CI compat. method for getAlerts
	 *
	 */
	public function get_alerts()
	{
		return $this->getAlerts();
	}

	/**
	 *
	 *
	 */
	public function set_session($name, $value)
	{
		$session = $this->session->userdata(SITE_CODE);

		$session[$name] = $value;

		$this->session->set_userdata(SITE_CODE, $session);

		return $this;
	}

	/**
	 *
	 *
	 */
	public function get_session($name = NULL)
	{
		$session = $this->session->userdata(SITE_CODE);

		if ( ! $name) return $session; 

		return isset($session[$name]) ? $session[$name]: NULL;
	}

	/**
	 *
	 *
	 */
	public function unset_session($name)
	{
		$session = $this->session->userdata(SITE_CODE);

		if (isset($session[$name])) unset($session[$name]);

		$this->session->set_userdata(SITE_CODE, $session);

		return $this;
	}
}
