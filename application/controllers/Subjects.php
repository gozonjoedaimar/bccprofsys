<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subjects extends CI_Controller {

	/**
	 *
	 *
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('subjects_model', 'subjects');
		$this->load->model('department_model', 'department');
	}

	/**
	 * Index Page for this controller.
	 *
	 */
	public function index($module = NULL)
	{
		$data = array(
			'title'=>'Subjects',
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
							'value'=>'location.href=\'' . site_url('subjects/add') . '\';'
						)
					)
				)
			)
		);
		$this->load->view('head', $data);
		$this->load->view('pages/subjects');
		$this->load->view('footer');
	}

	/**
	 *
	 *
	 */
	public function add()
	{
		$data = array(
			'title'=>'Add new subjects',
			'ch_btns'=>array(
				$this->layout->getBackBtn(site_url('subjects')),
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
			'form_action'=>site_url('subjects/save')
		);
		$this->load->view('head', $data);
		$this->load->view('pages/subjects/form');
		$this->load->view('footer');
	}

	/**
	 *
	 *
	 */
	public function delete($id)
	{
		$dbo = new Database_Object('subjects', $id);

		if ( ! $dbo->getData('id')) {
			$this->layout->addAlert('danger', "Unable to find subjects.");
			redirect("subjects");
			return;
		}
		else {
			$dbo->delete();
			$this->layout->addAlert('success', "Successfully deleted subjects.");
			redirect("subjects");
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
			'title'=>"Update subjects",
			'ch_btns'=>array(
				$this->layout->getBackBtn(site_url('subjects')),
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
			'form_action'=>site_url('subjects/save')
		);

		$dbo = new Database_Object('subjects', $id);

		if ( ! $dbo->getData('id')) show_404();

		$data['form_data'] = $dbo->getData();

		$this->load->view('head', $data);
		$this->load->view('pages/subjects/form');
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

		$dbo = new Database_Object('subjects');

		if ($dbo->load($id)->getData('id')) {
			$dbo = $dbo->load($id);
		}
		else {
			$dbo = new Database_Object('subjects');
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
			$this->layout->addAlert('success', 'Successfully saved subjects.');
			redirect('subjects');
			return;
		}

	}

	/**
	 *
	 *
	 */
	public function listing()
	{
		$depts = $this->subjects->listing();
		$this->output->set_content_type('json')->set_output(json_encode(array('data'=>$depts)));
	}
}