<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student_information extends CI_Controller {

	/**
	 *
	 *
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('student_information_model', 'student_information');
		$this->load->model('user_model', 'user');
	}

	/**
	 * Index Page for this controller.
	 *
	 */
	public function index($module = NULL)
	{
		$role_code = $this->core->get_session('role_code');
		$user_id = $this->core->get_session('user_id');

		if ($role_code == "student") {
			$this->db->from('student_information');
			$this->db->where('user_id', $user_id);
			$detl = $this->db->get()->row();

			$info_id = $detl->id;

			if ( ! $detl) {
				$user = $this->user->get_user($user_id);

				$this->db->from('student_information');
				$this->db->set('user_id', $user_id);
				$this->db->set('name', $user->first_name);
				$this->db->set('first_name', $user->first_name);
				$this->db->set('last_name', $user->last_name);
				$this->db->set('middle_name', $user->middle_name);
				$this->db->insert();

				$info_id = $this->db->insert_id();
			}

			redirect("student_information/edit/{$info_id}/{$user_id}");
			return;
		}


		$data = array(
			'title'=>'Student_information',
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
							'value'=>'location.href=\'' . site_url('student_information/add') . '\';'
						)
					)
				)
			)
		);
		$this->load->view('head', $data);
		$this->load->view('pages/student_information');
		$this->load->view('footer');
	}

	/**
	 *
	 *
	 */
	public function add()
	{
		$data = array(
			'title'=>'Add new student_information',
			'ch_btns'=>array(
				$this->layout->getBackBtn(site_url('student_information')),
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
			'form_action'=>site_url('student_information/save')
		);
		$this->load->view('head', $data);
		$this->load->view('pages/student_information/form');
		$this->load->view('footer');
	}

	/**
	 *
	 *
	 */
	public function delete($id)
	{
		$dbo = new Database_Object('student_information', $id);

		if ( ! $dbo->getData('id')) {
			$this->layout->addAlert('danger', "Unable to find student_information.");
			redirect("student_information");
			return;
		}
		else {
			$dbo->delete();
			$this->layout->addAlert('success', "Successfully deleted student_information.");
			redirect("student_information");
			return;
		}
	}

	/**
	 *
	 *
	 */
	public function edit($id)
	{
		$data = array(
			'title'=>"Student Information",
			'ch_btns'=>array(
				// $this->layout->getBackBtn(site_url('student_information')),
				/*array(
					'name'=>'Delete <i class="fa fa-ch fa-trash"></i>',
					'class'=>'btn-danger',
					'attr'=>array(
						array(
							'name'=>'onclick',
							'value'=>'deleteData()'
						)
					)
				),*/
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
			'form_action'=>site_url('student_information/save')
		);

		$dbo = new Database_Object('student_information', $id);

		if ( ! $dbo->getData('id')) show_404();

		$data['form_data'] = $dbo->getData();

		$this->load->view('head', $data);
		$this->load->view('pages/student_information/form');
		$this->load->view('footer');
	}

	/**
	 *
	 *
	 */
	public function save()
	{
		$post = $this->input->post();

		$id = isset($post['id']) ? $post['id']: 0;

		$dbo = new Database_Object('student_information');

		if ($dbo->load($id)->getData('id')) {
			$dbo = $dbo->load($id);
		}
		else {
			$dbo = new Database_Object('student_information');
		}

		if ($post) {
			foreach ($post as $key => $value) {
				$dbo->setData($key, $value);
			}
		}

		if ($dbo->getData()) {
			$dbo->save();
		}

		$this->db->from('users');
		$this->db->where('id', $post['user_id']);
		$this->db->set('first_name', $post['first_name']);
		$this->db->set('last_name', $post['last_name']);
		$this->db->set('middle_name', $post['middle_name']);
		$this->db->update();

		$user = $this->user->get_user($post['user_id']);
		$this->core->set_session('name', $user->first_name . " " . $user->last_name);

		if (isset($post['ajax']) && $post['ajax']) {
			$this->output->set_content_type('json')->set_output(json_encode(array('data'=>array(), 'status'=>true)));
		}
		else {
			$this->layout->addAlert('success', 'Successfully saved student_information.');
			redirect('student_information');
			return;
		}

	}

	/**
	 *
	 *
	 */
	public function listing()
	{
		$depts = $this->student_information->listing();
		$this->output->set_content_type('json')->set_output(json_encode(array('data'=>$depts)));
	}
}