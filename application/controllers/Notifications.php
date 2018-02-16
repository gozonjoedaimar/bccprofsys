<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifications extends CI_Controller {

	/**
	 *
	 *
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('notifications_model', 'notifications');
	}

	/**
	 * Index Page for this controller.
	 *
	 */
	public function index($module = NULL)
	{
		$data = array(
			'title'=>'Notifications',
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
							'value'=>'location.href=\'' . site_url('notifications/add') . '\';'
						)
					)
				)
			)
		);
		$this->load->view('head', $data);
		$this->load->view('pages/notifications');
		$this->load->view('footer');
	}

	/**
	 *
	 *
	 */
	public function add()
	{
		$data = array(
			'title'=>'Add new notifications',
			'ch_btns'=>array(
				$this->layout->getBackBtn(site_url('notifications')),
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
			'form_action'=>site_url('notifications/save')
		);
		$this->load->view('head', $data);
		$this->load->view('pages/notifications/form');
		$this->load->view('footer');
	}

	/**
	 *
	 *
	 */
	public function delete($id)
	{
		$dbo = new Database_Object('notifications', $id);

		if ( ! $dbo->getData('id')) {
			$this->layout->addAlert('danger', "Unable to find notifications.");
			redirect("notifications");
			return;
		}
		else {
			$dbo->delete();
			$this->layout->addAlert('success', "Successfully deleted notifications.");
			redirect("notifications");
			return;
		}
	}

	/**
	 *
	 */
	public function view($id = NULL)
	{
		$this->db->from('notifications');
		$this->db->where('id', $id);
		$this->db->set('unread', 0);
		$this->db->update();

		$url = "/";

		if ($this->input->get('url')) {
			$url = $this->input->get('url');
		}
		else {
			$this->db->from('notifications');
			$this->db->where('id', $id);
			$notif = $this->db->get()->row();
			$url = $notif->link;
		}

		redirect($url);
	}

	/**
	 *
	 *
	 */
	public function edit($id)
	{
		$data = array(
			'title'=>"Update notifications",
			'ch_btns'=>array(
				$this->layout->getBackBtn(site_url('notifications')),
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
			'form_action'=>site_url('notifications/save')
		);

		$dbo = new Database_Object('notifications', $id);

		if ( ! $dbo->getData('id')) show_404();

		$data['form_data'] = $dbo->getData();

		$this->load->view('head', $data);
		$this->load->view('pages/notifications/form');
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

		$dbo = new Database_Object('notifications');

		if ($dbo->load($id)->getData('id')) {
			$dbo = $dbo->load($id);
		}
		else {
			$dbo = new Database_Object('notifications');
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
			$this->layout->addAlert('success', 'Successfully saved notifications.');
			redirect('notifications');
			return;
		}

	}

	/**
	 *
	 *
	 */
	public function listing()
	{
		$depts = $this->notifications->listing();
		$this->output->set_content_type('json')->set_output(json_encode(array('data'=>$depts)));
	}
}