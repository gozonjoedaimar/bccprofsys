<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifications_model extends CI_Model {

	/**
	 * 
	 *
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 *
	 *
	 */
	public function listing($limit = NULL)
	{
		// $dbo = new Database_Object('notifications');
		// return $dbo->getAll();

		$this->db->from('notifications');

		if ($limit) {
			$this->db->order_by('id', 'desc');
			$this->db->order_by('created_at', 'desc');
			$this->db->limit($limit);
		}

		return $this->db->get()->result_array();
	}

	public function save($post)
	{
		// $post = $this->input->post();

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

		// if (isset($post['ajax']) && $post['ajax']) {
		// 	$this->output->set_content_type('json')->set_output(json_encode(array('data'=>array(), 'status'=>true)));
		// }
		// else {
		// 	$this->layout->addAlert('success', 'Successfully saved notifications.');
		// 	redirect('notifications');
		// 	return;
		// }

	}
}
