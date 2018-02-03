<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Layout_model extends Core_model {

	/**
	 * 
	 *
	 */
	public function btn_sm($btns)
	{
		$this->load->view('components/btn-sm', array('btns'=>$btns));
	}

	/**
	 * 
	 *
	 */
	public function get_select($name, $id, $collection = array(), $selected = "", $required = FALSE)
	{
		$this->load->view('components/select-fc', array('collection'=>$collection, 'name'=>$name, 'id'=>$id, 'selected'=>$selected, 'required'=>$required));
	}

	/**
	 *
	 *
	 */
	public function getPrintBtn($attr) {
		return array(
			'name'=>'Print <i class="fa fa-ch fa-print"></i>',
			'class'=>'btn-primary',
			'attr'=>$attr
		);
	}

	/**
	 * CI compat. method for getPrintBtn
	 *
	 */
	public function get_print_btn($attr)
	{
		return $this->getPrintBtn($attr);
	}

	/**
	 *
	 *
	 */
	public function getBackBtn($return_url) {
		return array(
			'name'=>'Back <i class="fa fa-ch fa-arrow-left"></i>',
			'class'=>'btn-default',
			'attr'=>array(
				array(
					"name"=>"onclick",
					'value'=>"location.href = '{$return_url}'"
				)
			)
		);
	}

	/**
	 * CI compat. method for getBackBtn
	 *
	 */
	public function get_back_btn($return_url)
	{
		return $this->getBackBtn($return_url);
	}
}
