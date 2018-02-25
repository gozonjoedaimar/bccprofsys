<?php defined('BASEPATH') OR exit('No direct script access allowed');
$load_listing = $this->teacher_load->listing($teacher_id);

if ( ! $load_listing) {
	$msj = "This teacher is not assigned to any subject.";
	echo "<p>{$msj}</p>";
	return;
} 

?>

<h4>Student List</h4>

<?php foreach ($load_listing as $load_info) {
	$this->load->view('pages/teacher_load/subject_students.php', ['teacher_load'=>$load_info['id'], 'load_info'=>$load_info]);
} ?>