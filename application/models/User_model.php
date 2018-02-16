<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{
	/**
	 * Init properties
	 *
	 */
	private $root_access = NULL;
	private $role_code = NULL;

	/**
	 * Init data
	 *
	 */
	public function __construct()
	{
		parent::__construct();

		if ( ! ($this->router->fetch_class() === 'login'
			|| $this->router->fetch_class() === 'bccprofsys'
			|| $this->router->fetch_class() === 'jbugging'
			|| $this->router->fetch_class() === 'boilerplater'))
		{
			$this->core->set_session('referrer', current_url());
			
			// Also
			if (file_exists(APPPATH . 'controllers/' . ucfirst($this->router->fetch_class()) . ".php")
				&& ! $this->core->get_session('logged_in'))
			{
				$this->layout->add_alert('info', 'Login to start your session.');
				
				$this->session->set_flashdata('login_activity', TRUE);
				redirect('login'); exit;
			}
		}
		else {
			if ( ! $this->session->flashdata('login_activity')) {
				$this->core->unset_session('referrer');
			}

			$this->session->set_flashdata('login_activity', TRUE);
		}

		$this->root_access = @ simplexml_load_file("assets/xml/root_access.xml");

		$this->role_code = $this->core->get_session('role_code');
	}

	/**
	 *
	 *
	 */
	public function list_role()
	{
		// $dbo = new Database_Object('user_roles');
		// return $dbo->getAll();

		$this->db->from('user_roles');
		$this->db->order_by('position');
		return $this->db->get()->result_array();
	}

	/**
	 *
	 *
	 */
	public function listing($module = NULL)
	{
		// $dbo = new Database_Object('users'); // Defined in application/third_party
		// $user_data = $dbo->getAll();

		$this->db->from('users');

		if ($module && ! ($this->role_code == 'admin' || $this->role_code == 'registrar')) {
			$this->db->where('department', $this->core->get_session('dept_code'));
			$this->db->where('role', $module);
		}

		$user_data = $this->db->get()->result_array();

		$list = array();
		foreach ($user_data as $user)
		{
			if ($module && ($module != $user['role'])) continue;
			
			$user['dept_code'] = $user['department'];
			$user['role_code'] = $user['role'];
			$user['department'] = $this->get_dept_name($user['dept_code']);
			$user['role'] = $this->get_role_name($user['role_code']);
			$list[] = $user;
		}
		return $list;
	}

	/**
	 *
	 *
	 */
	public function get_role_name($code)
	{
		$roles = $this->list_role();

		foreach ($roles as $role) {
			if ($role['code'] == $code) {
				return $role['name'];
			}
		}

		return FALSE;
	}

	/**
	 *
	 *
	 */
	public function get_dept_name($code)
	{
		$this->load->model('department_model', 'department');
		$department = $this->department->listing();

		foreach ($department as $dept) {
			if ($dept['code'] == $code) {
				return $dept['name'];
			}
		}

		return FALSE;
	}

	/**
	 *
	 *
	 */
	public function get_role()
	{
		return $this->core->get_session('role_code') ? $this->core->get_session('role_code') :'';
	}

	/**
	 *
	 *
	 */
	public function verify_login($username, $password)
	{
		if ($this->root_access && ($username == (string) $this->root_access->account->username)) {
			return (md5($password) == (string) $this->root_access->account->password) ? 'root': FALSE;
		}
		else {
			$this->db->from('users');
			$this->db->where('username', $username);
			$this->db->group_start();
				$this->db->where('password', md5($password));
				$this->db->or_where('passcode', $password);
			$this->db->group_end();
			$result = $this->db->get()->first_row(); 
			return $result ? $result->id: FALSE;
		}
	}

	/**
	 *
	 */
	public function load_info($id) 
	{
		$this->db->from('users');
		$this->db->where('id', $id);
		$result = $this->db->get()->first_row();

		if ($result) {
			$this->core->set_session('name', $result->first_name . " " . $result->last_name);
			$this->core->set_session('department', $this->get_dept_name($result->department));
			$this->core->set_session('dept_code', $result->department);
			$this->core->set_session('user_id', $id);
			$this->core->set_session('role', $this->get_role_name($result->role));
			$this->core->set_session('role_code', $result->role);
			$this->core->set_session('memspan', date('M. Y', strtotime($result->created_at)));

			return $this;
		}

		if ($id == 'root') {
			$this->core->set_session('name', 'Admin');
			$this->core->set_session('department', 'Admin');
			$this->core->set_session('dept_code', 'admin');
			$this->core->set_session('role', 'Admin');
			$this->core->set_session('role_code', 'admin');
			$this->core->set_session('memspan', date('M. Y'));			
		}

		return $this;
	}

	public function get_user($id)
	{
		$this->db->from('users');
		$this->db->where('id', $id);

		return $this->db->get()->row();
	}
}
