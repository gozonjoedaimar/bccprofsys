<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grades extends CI_Controller {

	/**
	 *
	 *
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('grades_model', 'grades');
	}

	/**
	 * Index Page for this controller.
	 *
	 */
	public function index($module = NULL, $user_id = NULL)
	{
		$data = array(
			'title'=>'Grades',
			'ch_btns'=>array(
				$this->layout->getPrintBtn(array(
						array(
							'name'=>'onclick',
							'value'=>'print()'
						)
					)
				)/*,
				array(
					'name'=>'New <i class="fa fa-ch fa-plus"></i>',
					'class'=>'btn-success',
					'attr'=>array(
						array(
							'name'=>'onclick',
							'value'=>'location.href=\'' . site_url('grades/add') . '\';'
						)
					)
				)*/
			),
			'student_id'=>$user_id
		);

		if ($user_id)
		{
			$student = $this->user->get_user($user_id);
			$first_name = $student->first_name;
			$last_name = $student->last_name;

			$data['head_notes'] = "Grades of <b style='text-decoration: underline;'>{$first_name} {$last_name}</b>";
		}

		$this->load->view('head', $data);
		$this->load->view('pages/grades');
		$this->load->view('footer');
	}

	/**
	 *
	 *
	 */
	public function add($student, $teacher_load = NULL, $semister = NULL)
	{
		$grade_info = $this->grades->get_grades($student, $teacher_load);
		$teacher_load_info = $this->core->get_teacher_load($teacher_load);

		if ($grade_info) {
			redirect("grades/edit/{$student}/{$teacher_load}/$semister");
			return;
		}

		if ( ! $teacher_load || ! $teacher_load_info) {
			redirect("grades/index/student/{$student}");
			return;
		}

		$data = array(
			'title'=>'Add new grades',
			'ch_btns'=>array(
				$this->layout->getBackBtn(site_url('teacher_load/grades')),
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
			'form_action'=>site_url('grades/save'),
			'student_id'=>$student,
			'teacher_load'=>$teacher_load,
		);


		$subject_info = $this->core->get_subject($teacher_load_info->subject);

		$student_info = $this->user->get_user($student);

		$first_name = $student_info->first_name;
		$last_name = $student_info->last_name;

		$data['subject_name'] =  $subject_info ? $subject_info->code: "";
		$data['student_name'] = "{$first_name} {$last_name}";
		$data['class'] = "";

		$this->load->view('head', $data);
		$this->load->view('pages/grades/form');
		$this->load->view('footer');
	}

	/**
	 *
	 *
	 */
	public function delete($id)
	{
		$dbo = new Database_Object('grades', $id);

		if ( ! $dbo->getData('id')) {
			$this->layout->addAlert('danger', "Unable to find grades.");
			redirect("grades");
			return;
		}
		else {
			$dbo->delete();
			$this->layout->addAlert('success', "Successfully deleted grades.");
			redirect("grades");
			return;
		}
	}

	/**
	 *
	 *
	 */
	public function edit($student, $teacher_load, $semister = "")
	{

		$grade_info = $this->grades->get_grades($student, $teacher_load);

		$data = array(
			'title'=>"Update grades",
			'ch_btns'=>array(
				// $this->layout->getBackBtn(site_url('grades')),
				$this->layout->getBackBtn(site_url('teacher_load/grades')),
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
			'form_action'=>site_url('grades/save'),
			'student_id'=>$student,
			'teacher_load'=>$teacher_load
		);

		// $dbo = new Database_Object('grades', $id);

		// if ( ! $dbo->getData('id')) show_404();

		// $data['form_data'] = $dbo->getData();
		
		// $data['form_data'] = $grade_info;

		if ($semister) $data['form_data']['semister'] = $semister;

		$teacher_load_info = $this->core->get_teacher_load($teacher_load);

		$subject_info = $this->core->get_subject($teacher_load_info->subject);

		$student_info = $this->user->get_user($student);

		$first_name = $student_info->first_name;
		$last_name = $student_info->last_name;

		$data['subject_name'] =  $subject_info ? $subject_info->code: "";
		$data['student_name'] = "{$first_name} {$last_name}";
		$data['class'] = $this->core->get_classroom_name($teacher_load_info->classroom);

		$this->load->view('head', $data);
		$this->load->view('pages/grades/form');
		$this->load->view('footer');
	}

	public function pull_grade($student_id, $teacher_load, $semister)
	{
		$data = $this->grades->pull_grade($student_id, $teacher_load, $semister);
		$this->output->set_content_type('json')->set_output(json_encode(['data'=>$data]));
	}

	/**
	 *
	 *
	 */
	public function save()
	{
		$post = $this->input->post();

		$id = isset($post['id']) ? $post['id']: 0;

		$dbo = new Database_Object('grades');

		if ($dbo->load($id)->getData('id')) {
			$dbo = $dbo->load($id);
		}
		else {
			$dbo = new Database_Object('grades');
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
			$this->layout->addAlert('success', 'Successfully saved grades.');
			redirect('teacher_load/grades');
			return;
		}

	}

	/**
	 *
	 *
	 */
	public function listing($student = NULL, $semister = "")
	{
		$depts = $this->grades->listing($student, $semister);
		$this->output->set_content_type('json')->set_output(json_encode(array('data'=>$depts)));
	}
}