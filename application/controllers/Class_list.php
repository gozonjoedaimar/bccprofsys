<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Class_list extends CI_Controller {

	/**
	 *
	 *
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('class_list_model', 'class_list');
	}

	/**
	 * Index Page for this controller.
	 *
	 */
	public function index($module = NULL)
	{
		$data = array(
			'title'=>'Class list',
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
							'value'=>'location.href=\'' . site_url('class_list/add') . '\';'
						)
					)
				)
			)
		);
		$this->load->view('head', $data);
		$this->load->view('pages/class_list');
		$this->load->view('footer');
	}

	/**
	 *
	 *
	 */
	public function add()
	{
		$data = array(
			'title'=>'Add new class list',
			'ch_btns'=>array(
				$this->layout->getBackBtn(site_url('class_list')),
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
			'form_action'=>site_url('class_list/save')
		);
		$this->load->view('head', $data);
		$this->load->view('pages/class_list/form');
		$this->load->view('footer');
	}

	/**
	 *
	 *
	 */
	public function delete($id)
	{
		$dbo = new Database_Object('class_list', $id);

		if ( ! $dbo->getData('id')) {
			$this->layout->addAlert('danger', "Unable to find class_list.");
			redirect("class_list");
			return;
		}
		else {
			$dbo->delete();
			$this->layout->addAlert('success', "Successfully deleted class_list.");
			redirect("class_list");
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
			'title'=>"Update class list",
			'ch_btns'=>array(
				$this->layout->getBackBtn(site_url('class_list')),
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
			'form_action'=>site_url('class_list/save')
		);

		$dbo = new Database_Object('class_list', $id);

		if ( ! $dbo->getData('id')) show_404();

		$data['form_data'] = $dbo->getData();

		$this->load->view('head', $data);
		$this->load->view('pages/class_list/form');
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

		$dbo = new Database_Object('class_list');

		if ($dbo->load($id)->getData('id')) {
			$dbo = $dbo->load($id);
		}
		else {
			$dbo = new Database_Object('class_list');
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
			$this->layout->addAlert('success', 'Successfully saved class_list.');
			redirect('class_list');
			return;
		}

	}

	/**
	 *
	 *
	 */
	public function listing()
	{
		$depts = $this->class_list->listing();
		$this->output->set_content_type('json')->set_output(json_encode(array('data'=>$depts)));
	}
}