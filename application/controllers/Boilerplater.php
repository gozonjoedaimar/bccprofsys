<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Boilerplater extends CI_Controller
{
	/**
	 * Defaults
	 *
	 */
	public $_notif = array(
		"error" => "Oooops! There may be some confusion! Try again!" . PHP_EOL
	);

	/**
	 *
	 *
	 */
	public function __construct() 
	{
		parent::__construct();
		defined('TEMPLATE_LOC')    OR define('TEMPLATE_LOC', APPPATH . "boilerplate");
		defined('PHP_SEP')         OR define('PHP_SEP', DIRECTORY_SEPARATOR);
	}

	/**
	 * Index Page for this controller.
	 *
	 */
	public function index()
	{
		echo "Hello there!";
	}

	/**
	 *
	 *
	 */
	public function create($module_name = NULL, $template_loc = TEMPLATE_LOC)
	{
		if ( ! $module_name) {
			echo $this->_notif['error'];
			return;
		}

		var_dump($module_name);
		var_dump($template_loc);
	}

	/**
	 *
	 */
	public function make_controller($name = NULL, $template_loc = TEMPLATE_LOC)
	{
		if ( ! $name) {
			echo $this->_notif['error'];
			return;
		}

		$template = @ file_get_contents($template_loc . PHP_SEP . "controllers" . PHP_SEP . "Boilerplate_controller.php") OR die("Oooops! Unable to open template!" . PHP_EOL);

		/* Change controller name */
		$template = str_replace("class Boilerplate_controller", "class " . ucfirst($name), $template);

		$file_name = ucfirst($name) . ".php";
		$ctrlpath = APPPATH . "controllers" . PHP_SEP . $file_name;

		if (file_exists($ctrlpath)) die("Controller `" . ucfirst($name) . "` already exists." . PHP_EOL);

		$file = fopen($ctrlpath, 'w') OR die("Unable to create file: " . $file_name . PHP_EOL);

		fwrite($file, $template);

		var_dump("Execution successful!");
	}

	/**
	 *
	 */
	public function make_model($name = NULL, $template_loc = TEMPLATE_LOC)
	{
		if ( ! $name) {
			echo $this->_notif['error'];
			return;
		}

		$template = @ file_get_contents($template_loc . PHP_SEP . "models" . PHP_SEP . "Boilerplate_model.php") OR die("Oooops! Unable to open template!" . PHP_EOL);

		/* Change controller name */
		$template = str_replace("class Boilerplate_model", "class " . ucfirst($name), $template);

		$file_name = ucfirst($name) . ".php";
		$ctrlpath = APPPATH . "models" . PHP_SEP . $file_name;

		if (file_exists($ctrlpath)) die("Controller `" . ucfirst($name) . "` already exists." . PHP_EOL);

		$file = fopen($ctrlpath, 'w') OR die("Unable to create file: " . $file_name . PHP_EOL);

		fwrite($file, $template);

		var_dump("Execution successful!");
	}
}