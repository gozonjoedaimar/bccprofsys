<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Classroom extends CI_Controller {

	/**
	 *
	 *
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('classroom_model', 'classroom');
		$this->load->model('department_model', 'department');
	}

	/**
	 * Index Page for this controller.
	 *
	 */
	public function index($module = NULL)
	{
		$data = array(
			'title'=>'Classroom',
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
					'class'=>'btn-success new_class',
					'attr'=>array(
						array(
							'name'=>'onclick',
							'value'=>'location.href=\'' . site_url('classroom/add') . '\';'
						)
					)
				)
			)
		);

		if ($module == "grades") {
			$data['title'] = "Grades";
			$data['head_notes'] = "Select class to view/edit grades";
			$data['module'] = $module;
		}

		if ($module == 'teacher')
		{
			$data['module'] = $module;
		}
		
		$this->load->view('head', $data);
		$this->load->view('pages/classroom');
		$this->load->view('footer');
	}

	public function teacher()
	{
		$this->index('teacher');
	}

	public function grades()
	{
		$this->index('grades');
	}

	/**
	 *
	 *
	 */
	public function add()
	{
		$data = array(
			'title'=>'Add new classroom',
			'ch_btns'=>array(
				$this->layout->getBackBtn(site_url('classroom')),
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
			'form_action'=>site_url('classroom/save')
		);
		$this->load->view('head', $data);
		$this->load->view('pages/classroom/form');
		$this->load->view('footer');
	}

	/**
	 *
	 *
	 */
	public function delete($id)
	{
		$dbo = new Database_Object('classroom', $id);

		if ( ! $dbo->getData('id')) {
			$this->layout->addAlert('danger', "Unable to find classroom.");
			redirect("classroom");
			return;
		}
		else {
			$dbo->delete();
			$this->layout->addAlert('success', "Successfully deleted classroom.");
			redirect("classroom");
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
			'title'=>"Update classroom",
			'ch_btns'=>array(
				$this->layout->getBackBtn(site_url("classroom/{$module}")),
				array(
					'name'=>'Delete <i class="fa fa-ch fa-trash"></i>',
					'class'=>'btn-danger save_update',
					'attr'=>array(
						array(
							'name'=>'onclick',
							'value'=>'deleteData()'
						)
					)
				),
				array(
					'name'=>'Save <i class="fa fa-ch fa-save"></i>',
					'class'=>'btn-success save_update',
					'attr'=>array(
						array(
							'name'=>'onclick',
							'value'=>'saveForm()'
						)
					)
				)
			),
			'form_action'=>site_url('classroom/save'),
			'classroom'=>$id
		);

		$dbo = new Database_Object('classroom', $id);

		if ( ! $dbo->getData('id')) show_404();

		$data['form_data'] = $dbo->getData();
		$data['module'] = $module;

		if ($module == 'teacher') {
			$data['title'] = "Classroom Student List";
		}

		if ($module == 'grades') {
			$data['title'] = "Student Selection";
		}

		$this->load->view('head', $data);
		$this->load->view('pages/classroom/form');
		$this->load->view('pages/classroom/manager');
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

		$dbo = new Database_Object('classroom');

		if ($dbo->load($id)->getData('id')) {
			$dbo = $dbo->load($id);
		}
		else {
			$dbo = new Database_Object('classroom');
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
			$this->layout->addAlert('success', 'Successfully saved classroom.');
			$this->notifications->save(array(
				"message"=> $id ? "A classroom has been updated" : "New classroom has been added",
				"icon"=>"fa-cube",
				"color"=>"yellow",
				'link'=>'/classroom',
				"roles"=>serialize(array("_all"))
			));
			redirect('classroom');
			return;
		}

	}

	/**
	 *
	 *
	 */
	public function listing()
	{
		$depts = $this->classroom->listing();
		$this->output->set_content_type('json')->set_output(json_encode(array('data'=>$depts)));
	}
}