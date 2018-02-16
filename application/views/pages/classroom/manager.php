<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
	<?php if (isset($module) && ($module == 'teacher' || $module == 'grades')) : ?>
	<div class="col-xs-12">
		<h4>Classroom Students</h4>
		<?php $this->load->view('pages/student_listing', ['module'=>'classroom', 'classroom'=>$classroom, 'view'=>$module, 'table_id'=>'class_list']) ?>
	</div>
	<?php else: ?>
	<div class="col-xs-12 col-sm-6">
		<h4>Classroom Students</h4>
		<?php $this->load->view('pages/student_listing', ['module'=>'classroom', 'classroom'=>$classroom, 'table_id'=>'class_list']) ?>
	</div>
	<div class="col-xs-12 col-sm-6">
		<h4>Unassigned Students</h4>
		<?php $this->load->view('pages/student_listing', ['module'=>'no_class', 'classroom'=>$classroom, 'table_id'=>'no_class']) ?>
	</div>
	<?php endif; ?>
</div>


<script type="text/javascript">
	
var addToClassroom = null, delToClassroom = null;

(function($) {

addToClassroom = function addToClassroom (data) {
	jQuery.ajax({
		url: "<?php echo site_url("student/add_list/{$classroom}") ?>/" + data,
		error: function(xhr) {
			console.log(xhr);
		},
		success: function() {
			dtUsersTable_no_class.ajax.reload();
			dtUsersTable_class_list.ajax.reload();
		}
	});
};

delToClassroom = function delToClassroom (data) {
	jQuery.ajax({
		url: "<?php echo site_url("student/delete_from_list/{$classroom}") ?>/" + data,
		error: function(xhr) {
			console.log(xhr);
		},
		success: function() {
			dtUsersTable_no_class.ajax.reload();
			dtUsersTable_class_list.ajax.reload();
		}
	});
};

})(window.jQuery);


</script>