<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller
{
	/**
	 *
	 *
	 */
	private $role_code = NULL;

	/**
	 *
	 *
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model', 'user');
		$this->load->model('department_model', 'department');

		$this->role_code = $this->core->get_session('role_code');

		if ($this->role_code == 'student') {
			show_404(); exit;
		} 
	}

	/**
	 * Index Page for this controller.
	 *
	 */
	public function index($module = "")
	{
		
		$data = array(
			'user'=>array(
				'full_name'=>'Juan Dela Cruz III',
			),
			'title'=>"Users",
			'ch_btns'=>array(
				$this->layout->getPrintBtn(array(
						array(
							'name'=>'onclick',
							'value'=>'print()'
						)
					)
				),
				array(
					'name'=>'New <i class="fa fa-ch fa-plus"></i>',
					'class'=>'btn-success',
					'attr'=>array(
						array(
							'name'=>'onclick',
							'value'=>'location.href=\'' . site_url("users/add/{$module}") . '\';'
						)
					)
				)
			)
		);
		
		if ($module) {
			$data['module'] = $module;
			$data['by_role'] = TRUE;

			if ($module == "student") {
				$data['user']['role'] = "Student";
				$data['title'] = "Students";
			}
			elseif ($module == "teacher") {
				$data['user']['role'] = "Teacher";
				$data['title'] = "Teachers";

				if ( ! (
					$this->role_code == 'admin' ||
					$this->role_code == 'registrar' ||
					$this->role_code == 'dept_coordinator'
				)) {
					show_404(); exit;
				}
			}
			elseif ($module == "dept_coordinator") {
				$data['user']['role'] = "Dept. Coordinator";
				$data['title'] = "Dept. Coordinators";

				if ( ! (
					$this->role_code == 'admin' ||
					$this->role_code == 'registrar'
				) ) {
					show_404(); exit;
				}
			}
			elseif ($module == "admin") {
				$data['user']['role'] = "Admin";
				$data['title'] = "Admins";

				if ( ! (
					$this->role_code == 'admin' ||
					$this->role_code == 'registrar'
				) ) {
					show_404(); exit;
				}
			}
		}
		else {
			if ( ! (
				$this->role_code == 'admin' ||
				$this->role_code == 'registrar'
			) ) {
				show_404(); exit;
			}
		}

		$this->load->view('head', $data);
		$this->load->view('pages/users');
		$this->load->view('footer');
	}

	/**
	 *
	 *
	 */
	public function add($module = "")
	{
		$data = array(
			'title'=>'Add new user',
			'ch_btns'=>array(
				$this->layout->get_back_btn(site_url("users/{$module}")),
				array(
					'name'=>"Save <i class='fa fa-ch fa-save'></i>",
					'class'=>'btn-success',
					'attr'=>array(
						array(
							'name'=>'onclick',
							'value'=>'saveForm()'
						)
					)
				)
			),
			'form_action'=>site_url("users/save/{$module}"),
			'module'=>$module
		);
		$this->load->view('head', $data);
		$this->load->view('pages/users/form');
		$this->load->view('footer');
	}

	/**
	 *
	 *
	 */
	public function roles($mode = NULL, $id = NULL)
	{
		if ( ! (
			$this->role_code == 'admin' || 
			$this->role_code == 'registrar'
		)) {
			show_404(); exit;
		}
		if ($mode == 'create') {
			$this->create_role();
			return;
		}
		if ($mode == 'save') {
			$this->save_role();
			return;
		}
		if ($mode == 'edit' && $id) {
			$this->edit_role($id);
			return;
		}
		if ($mode == 'list') {
			$this->list_role();
			return;
		}
		if ($mode == 'delete' && $id) {
			$this->delete_role($id);
			return;
		}
		if ($mode) {
			show_404();
			return;
		}

		$data = array(
			'title'=>'Roles',
			'ch_btns'=>array(
				$this->layout->getPrintBtn(array(
					array(
						'name'=>'onclick',
						'value'=>'print()'
					)
				)),
				array(
					'name'=>'New <i class="fa fa-ch fa-plus"></i>',
					'class'=>'btn-success',
					'attr'=>array(
						array(
							'name'=>'onclick',
							'value'=>'createRole()'
						)
					)
				)
			)
		);

		$this->load->view('head', $data);
		$this->load->view('pages/roles');
		$this->load->view('footer');
	}

	/**
	 *
	 *
	 */
	public function create_role()
	{
		if ($this->role_code != 'admin') {
			show_404(); exit;
		}
		$data = array(
			'title'=>"Create new role",
			'ch_btns'=>array(
				$this->layout->getBackBtn(site_url('users/roles')),
				array(
					'name'=>'Save <i class="fa fa-ch fa-save"></i>',
					'class'=>'btn-success',
					'attr'=>array(
						array(
							'name'=>'onclick',
							'value'=>'saveForm()'
						)
					)
				)
			),
			'form_action'=>site_url('users/roles/save')
		);

		$this->load->view('head', $data);
		$this->load->view('pages/roles/form');
		$this->load->view('footer');
	}

	/**
	 *
	 *
	 */
	public function delete($id, $module = "")
	{
		$dbo = new Database_Object('users', $id);

		if ( ! $dbo->getData('id')) {
			$this->layout->addAlert('danger', "Unable to find user.");
			redirect("users/{$module}");
			return;
		}
		else {
			$dbo->delete();
			$this->layout->addAlert('success', "Successfully deleted user.");
			redirect("users/{$module}");
			return;
		}
	}

	/**
	 *
	 *
	 */
	public function delete_role($id)
	{
		if ($this->role_code != 'admin') {
			show_404(); exit;
		}
		$dbo = new Database_Object('user_roles', $id);

		if ( ! $dbo->getData('id')) {
			$this->layout->addAlert('danger', "Unable to find role.");
			redirect("users/roles");
			return;
		}
		else {
			$dbo->delete();
			$this->layout->addAlert('success', "Successfully deleted role.");
			redirect("users/roles");
			return;
		}
	}

	/**
	 *
	 *
	 */
	public function edit($id, $module = "")
	{
		$data = array(
			'title'=>"Update user",
			'ch_btns'=>array(
				$this->layout->get_back_btn(site_url("users/{$module}")),
				array(
					'name'=>'Delete <i class="fa fa-ch fa-trash"></i>',
					'class'=>'btn-danger',
					'attr'=>array(
						array(
							'name'=>'onclick',
							'value'=>'deleteData()'
						)
					)
				),
				array(
					'name'=>'Save <i class="fa fa-ch fa-save"></i>',
					'class'=>'btn-success',
					'attr'=>array(
						array(
							'name'=>'onclick',
							'value'=>'saveForm()'
						)
					)
				)
			),
			'form_action'=>site_url("users/save/{$module}"),
			'module'=>$module
		);

		$dbo = new Database_Object('users', $id);

		if ( ! $dbo->getData('id')) show_404();

		$data['form_data'] = $dbo->getData();

		$this->load->view('head', $data);
		$this->load->view('pages/users/form');
		$this->load->view('footer');
	}

	/**
	 *
	 *
	 */
	public function edit_role($id)
	{
		if ($this->role_code != 'admin') {
			show_404(); exit;
		}
		$data = array(
			'title'=>"Update role",
			'ch_btns'=>array(
				$this->layout->getBackBtn(site_url('users/roles')),
				array(
					'name'=>'Delete <i class="fa fa-ch fa-trash"></i>',
					'class'=>'btn-danger',
					'attr'=>array(
						array(
							'name'=>'onclick',
							'value'=>'deleteData()'
						)
					)
				),
				array(
					'name'=>'Save <i class="fa fa-ch fa-save"></i>',
					'class'=>'btn-success',
					'attr'=>array(
						array(
							'name'=>'onclick',
							'value'=>'saveForm()'
						)
					)
				)
			),
			'form_action'=>site_url('users/roles/save')
		);

		$dbo = new Database_Object('user_roles', $id);

		if ( ! $dbo->getData('id')) show_404();

		$data['form_data'] = $dbo->getData();

		$this->load->view('head', $data);
		$this->load->view('pages/roles/form');
		$this->load->view('footer');
	}

	/**
	 *
	 *
	 */
	public function save($module = "")
	{
		$post = $this->input->post();
		$except = array('password_confirm');

		$id = isset($post['id']) ? $post['id']: 0;

		$dbo = new Database_Object('users');

		if ($dbo->load($id)->getData('id')) {
			$dbo = $dbo->load($id);
		}
		else {
			$dbo = new Database_Object('users');
		}

		if ($post) {
			foreach ($post as $key => $value) {
				if ( ! in_array($key, $except) && $value) $dbo->setData($key, $value);
			}
		}

		if ($dbo->getData()) {
			$dbo->save();
		}

		if (isset($post['ajax']) && $post['ajax']) {
			$this->output->set_content_type('json')->set_output(json_encode(array('data'=>array(), 'status'=>TRUE)));
		}
		else {
			$this->layout->addAlert('success', 'Successfully saved user data.');
			redirect("users/{$module}");
			return;
		}

	}

	/**
	 *
	 *
	 */
	public function save_role()
	{
		if ($this->role_code != 'admin') {
			show_404(); exit;
		}
		$post = $this->input->post();

		$id = isset($post['id']) ? $post['id']: 0;

		$dbo = new Database_Object('user_roles');

		if ($dbo->load($id)->getData('id')) {
			$dbo = $dbo->load($id);
		}
		else {
			$dbo = new Database_Object('user_roles');
		}

		if ($post) {
			foreach ($post as $key => $value) {
				$dbo->setData($key, $value);
			}
		}

		if ($dbo->getData()) {
			$dbo->save();
		}

		if (isset($post['ajax']) && $post['ajax']) {
			$this->output->set_content_type('json')->set_output(json_encode(array('data'=>array(), 'status'=>TRUE)));
		}
		else {
			$this->layout->addAlert('success', 'Successfully saved role.');
			redirect('users/roles');
			return;
		}

	}

	/**
	 *
	 *
	 */
	public function listing($module = NULL)
	{
		$users = $this->user->listing($module);
		$this->output->set_content_type('json')->set_output(json_encode(array('data'=>$users)));
	}

	/**
	 *
	 *
	 */
	public function list_role()
	{
		if ( ! (
			$this->role_code == 'admin' ||
			$this->role_code == 'registrar'
		)) {
			show_404(); exit;
		}
		// $dbo = new Database_Object('user_roles');
		// $this->output->set_content_type('json')->set_output(json_encode(array('data'=>$dbo->getAll())));
		$roles = $this->user->list_role();
		$this->output->set_content_type('json')->set_output(json_encode(array('data'=>$roles)));
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

	/**
	 *
	 *
	 */
	public function admin()
	{
		$this->index('admin');
	}
}