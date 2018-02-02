<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bccprofsys extends CI_Controller
{
	/**
	 * Defaults
	 *
	 */
	private $_notif = array(
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
	private function create($module_name = NULL, $template_loc = TEMPLATE_LOC)
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

		$template = @ file_get_contents(implode(PHP_SEP, array($template_loc, "controllers", "Boilerplate_controller.php"))) OR die("Oooops! Unable to open template!" . PHP_EOL);

		/* Change controller name */
		$template = str_replace("class Boilerplate_controller", "class " . ucfirst($name), $template);
		$template = str_replace("Boilerplate", ucfirst($name), $template);
		$template = str_replace("boilerplate", strtolower($name), $template);

		$file_name = ucfirst($name) . ".php";
		$ctrlpath = APPPATH . "controllers" . PHP_SEP . $file_name;

		if (file_exists($ctrlpath)) die("Controller `" . ucfirst($name) . "` already exists." . PHP_EOL);

		$file = @ fopen($ctrlpath, 'w') OR die("Unable to create file: " . $file_name . PHP_EOL);

		@ fwrite($file, $template) OR die("Unable to write file: " . $file_name . PHP_EOL);

		echo "Controller creation successful!" . PHP_EOL;
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

		$template = @ file_get_contents(implode(PHP_SEP, array($template_loc, "models", "Boilerplate_model.php"))) OR die("Oooops! Unable to open template!" . PHP_EOL);

		/* Change controller name */
		$template = str_replace("class Boilerplate_model", "class " . ucfirst($name) . "_model", $template);
		$template = str_replace("Boilerplate", ucfirst($name), $template);
		$template = str_replace("boilerplate", strtolower($name), $template);

		$file_name = ucfirst($name) . "_model.php";
		$ctrlpath = APPPATH . "models" . PHP_SEP . $file_name;

		if (file_exists($ctrlpath)) die("Controller `" . ucfirst($name) . "` already exists." . PHP_EOL);

		$file = fopen($ctrlpath, 'w') OR die("Unable to create file: " . $file_name . PHP_EOL);

		fwrite($file, $template);

		echo "Model creation successful!" . PHP_EOL;
	}

	/**
	 *
	 */
	public function make_view($name = NULL, $template_loc = TEMPLATE_LOC)
	{
		if ( ! $name) {
			echo $this->_notif['error'];
			return;
		}

		$form_template = @ file_get_contents($template_loc . PHP_SEP . "views" . PHP_SEP . "pages" . PHP_SEP . "boilerplate_view" . PHP_SEP . "form_view.php") OR die("Oooops! Unable to open template!" . PHP_EOL);
		$form_template = str_replace("Boilerplate", ucfirst($name), $form_template);
		$form_template = str_replace("boilerplate", strtolower($name), $form_template);

		$table_template = @ file_get_contents($template_loc . PHP_SEP . "views" . PHP_SEP . "pages" . PHP_SEP . "boilerplate_view.php") OR die("Oooops! Unable to open template!" . PHP_EOL);
		$table_template = str_replace("Boilerplate", ucfirst($name), $table_template);
		$table_template = str_replace("boilerplate", strtolower($name), $table_template);

		$file_name = strtolower($name) . ".php";
		$ctrlpath = APPPATH . "views" . PHP_SEP . "pages" . PHP_SEP . $file_name;

		if (file_exists($ctrlpath)) die("File `" . $file_name . "` already exists." . PHP_EOL);

		$file = @ fopen($ctrlpath, 'w') OR die("Unable to create file: " . $file_name . PHP_EOL);

		fwrite($file, $table_template);

		$dir_path = strtolower($name);
		$ctrlpath = APPPATH . "views" . PHP_SEP . "pages" . PHP_SEP . $dir_path;

		if ( ! file_exists($ctrlpath)) mkdir($ctrlpath);

		$ctrlpath = $ctrlpath . PHP_SEP . "form.php";

		if (file_exists($ctrlpath)) die("File `" . $file_name . "` already exists." . PHP_EOL);

		$file = @ fopen($ctrlpath, 'w') OR die("Unable to create file: " . $dir_path . PHP_SEP . "form.php" . PHP_EOL);

		fwrite($file, $form_template);

		echo "View successfully created!" . PHP_EOL;
	}

	/**
	 * 
	 *
	 */
	public function make_db($name = NULL) 
	{
		if ( ! $name) {
			echo $this->_notif['error'];
			return;
		}

		if ( ! $this->db->table_exists($name)) {
			$this->db->query("CREATE TABLE `{$name}` LIKE `boilerplate`");
			echo "Database table sucessfully created." . PHP_EOL;
		}
		else {
			echo "Database table already exists." . PHP_EOL;
		}

	}

	/**
	 *
	 */
	public function make_module($module = NULL)
	{
		$this->make_model($module);
		$this->make_view($module);
		$this->make_controller($module);
		$this->make_db($module);
	}
}