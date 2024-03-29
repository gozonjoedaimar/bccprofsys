<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teacher_load extends CI_Controller {

	/**
	 *
	 *
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('teacher_load_model', 'teacher_load');
		$this->load->model('subjects_model', 'subjects');
		$this->load->model('classroom_model', 'classroom');
	}

	/**
	 * Index Page for this controller.
	 *
	 */
	public function index($module = NULL)
	{
		$data = array(
			'title'=>'Teacher load',
			'head_notes'=>"Select a teacher to start.",
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
							'value'=>'location.href=\'' . site_url('teacher_load/add') . '\';'
						)
					)
				)
			)
		);
		$this->load->view('head', $data);
		$this->load->view('pages/teacher_load');
		$this->load->view('footer');
	}

	public function teacher_view()
	{
		$teacher_id = $this->core->get_session('user_id');
		$this->view($teacher_id, 'teacher_view');
	}

	public function grades()
	{
		$teacher_id = $this->core->get_session('user_id');
		$this->view($teacher_id, 'grades');
	}

	public function student()
	{
		$student_id = $this->core->get_session('user_id');
		$this->view($student_id, 'student');
	}

	/**
	 * Index Page for this controller.
	 *
	 */
	public function view($teacher_id, $module = NULL)
	{
		$teacher = $this->user->get_user($teacher_id);

		$data = array(
			'title'=>'Teacher load',
			'head_notes'=>"- {$teacher->first_name} {$teacher->last_name}",
			'ch_btns'=>array(
				$this->layout->getBackBtn(site_url('teacher_load')),
				$this->layout->getPrintBtn(array(
						array(
							'name'=>'onclick',
							'value'=>'print()'
						)
					)
				),
				array(
					'name'=>'New <i class="fa fa-ch fa-plus"></i>',
					'class'=>'btn-success add_teacher_load',
					'attr'=>array(
						array(
							'name'=>'onclick',
							'value'=>'location.href=\'' . site_url('teacher_load/add/' . $teacher_id) . '\';'
						)
					)
				)
			),
			'teacher_id'=>$teacher_id
		);

		if ($module == 'teacher_view') {
			$data['title'] = "Schedule";
			$data['teacher_view'] = TRUE;
		}

		if ($module == 'grades') {
			$data['title'] = "Subject Selection";
			$data['teacher_view'] = TRUE;
			$data['grades'] = TRUE;
		}

		if ($module == 'student') {
			$data['title'] = "Schedule";
			$data['teacher_view'] = TRUE;
			$data['student'] = TRUE;
		}

		$this->load->view('head', $data);
		$this->load->view('pages/teacher_load_listing');
		$this->load->view('footer');
	}

	/**
	 *
	 *
	 */
	public function add($teacher_id)
	{
		$teacher = $this->user->get_user($teacher_id);

		$data = array(
			'title'=>'Add new teacher load',
			'head_notes'=>"- {$teacher->first_name} {$teacher->last_name}",
			'ch_btns'=>array(
				$this->layout->getBackBtn(site_url('teacher_load/view/' . $teacher_id)),
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
			'form_action'=>site_url('teacher_load/save'),
			'form_data'=>['teacher_id'=>$teacher_id]
		);

		$this->load->view('head', $data);
		$this->load->view('pages/teacher_load/form');
		$this->load->view('footer');
	}

	/**
	 *
	 *
	 */
	public function delete($id)
	{
		$dbo = new Database_Object('teacher_load', $id);

		if ( ! $dbo->getData('id')) {
			$this->layout->addAlert('danger', "Unable to find teacher_load.");
			redirect("teacher_load");
			return;
		}
		else {
			$dbo->delete();
			$this->layout->addAlert('success', "Successfully deleted teacher_load.");
			redirect("teacher_load");
			return;
		}
	}

	/**
	 *
	 *
	 */
	public function edit($id, $teacher_id)
	{
		$data = array(
			'title'=>"Update teacher_load",
			'ch_btns'=>array(
				$this->layout->getBackBtn(site_url('teacher_load/view/' . $teacher_id)),
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
			'form_action'=>site_url('teacher_load/save')
		);

		$dbo = new Database_Object('teacher_load', $id);

		if ( ! $dbo->getData('id')) show_404();

		$data['form_data'] = $dbo->getData();

		$data['form_data']['teacher_id'] = $teacher_id;

		$this->load->view('head', $data);
		$this->load->view('pages/teacher_load/form');
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

		$dbo = new Database_Object('teacher_load');

		if ($dbo->load($id)->getData('id')) {
			$dbo = $dbo->load($id);
		}
		else {
			$dbo = new Database_Object('teacher_load');
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
			$this->output->set_content_type('json')->set_output(json_encode(array('data'=>array(), 'status'=>true)));
		}
		else {
			$this->layout->addAlert('success', 'Successfully saved teacher_load.');
			redirect('teacher_load/view/' . $post['teacher_id']);
			return;
		}

	}

	/**
	 *
	 *
	 */
	public function listing($teacher_id = NULL, $module = NULL)
	{
		$depts = $this->teacher_load->listing($teacher_id, $module);
		$this->output->set_content_type('json')->set_output(json_encode(array('data'=>$depts)));
	}
}