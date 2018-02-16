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

	/**
	 *
	 */
	public function year_selection()
	{
		$start = 1970;
		$end = date('Y') + 10;

		$batch = [];

		for ($i=$start; $i <= $end; $i++) { 
			$batch[] = [
				'code'=>$i,
				'name'=>$i
			];
		}

		return $batch;
	}


	/**
	 *
	 */
	public function time_selection()
	{
		$start = "07:00:00";
		$end = "21:00:00";
		$selection = [];

		$time = $start;

		while ($time != $end) {

			$selection[] = [
				'code'=>$time,
				'name'=>date("h:i a", strtotime($time))
			];

			$curr = explode(':', $time);
			$h = $curr[1] == "30" ? str_pad((intval($curr[0]) + 1), "0", 2): $curr[0];
			$m = $curr[1] == "00" ? "30": "00";
			$s = $curr[2];

			$time = implode(':', [$h, $m, $s]);
		}

		return $selection;
	}

	/**
	 *
	 */
	public function day_selection($full = NULL)
	{
		$init = [
			[
				'code'=>'sun',
				'name'=>"Sunday"
			]
		];

		$days = [
			[
				'code'=>'mon',
				'name'=>"Monday"
			],
			[
				'code'=>'tue',
				'name'=>"Tuesday"
			],
			[
				'code'=>'wed',
				'name'=>"Wednesday"
			],
			[
				'code'=>'thu',
				'name'=>"Thursday"
			],
			[
				'code'=>'fri',
				'name'=>"Friday"
			],
			[
				'code'=>'sat',
				'name'=>"Saturday"
			]
		];

		if ($full) {
			$days = array_merge($init, $days);
		}

		return $days;
	}
}
