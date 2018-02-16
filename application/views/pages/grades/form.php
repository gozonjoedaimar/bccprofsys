<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<form action="<?php if (isset($form_action)) echo $form_action; ?>" id="grades_edit" method="post">
	<div class="box">
		<div class="box-body">
			<div class="row">
				<div class="col-xs-12">
					Subject: <?php echo $subject_name; ?>
				</div>
				<div class="col-xs-12">
					Student: <?php echo $student_name; ?>
				</div>
				<div class="col-xs-12">
					Class: <?php echo $class; ?>
				</div>
			</div>
			<br>
			<div class="row">
				<input type="hidden" name="id" value="<?php if (isset($form_data['id'])) echo $form_data['id']; ?>">
				<input type="hidden" name="student" value="<?php if (isset($student_id)) echo $student_id; ?>">
				<input type="hidden" name="teacher_load" value="<?php if (isset($teacher_load)) echo $teacher_load; ?>">
				<input type="hidden" name="id" value="<?php if (isset($form_data['id'])) echo $form_data['id']; ?>">
				<div class="col-xs-12 col-sm-6 -col-sm-offset-3 hide">
					<div class="form-group">
						<label for="grades_name">Name</label>
						<input type="text" name="name" id="grades_name" class="form-control" value="<?php if (isset($form_data['name'])) echo $form_data['name']; ?>">
					</div>		
				</div>
				<div class="col-xs-3 ">
					<div class="form-group">
						<label for="first_sem">First Semister</label>
						<input type="text" name="first_sem" id="first_sem" class="form-control" value="<?php if (isset($form_data['first_sem'])) echo $form_data['first_sem']; ?>">
					</div>		
				</div>
				<div class="col-xs-3 ">
					<div class="form-group">
						<label for="second_sem">Second Semister</label>
						<input type="text" name="second_sem" id="second_sem" class="form-control" value="<?php if (isset($form_data['second_sem'])) echo $form_data['second_sem']; ?>">
					</div>		
				</div>
				<div class="col-xs-3 ">
					<div class="form-group">
						<label for="final_grade">Final Grade</label>
						<input type="text" name="final_grade" id="final_grade" class="form-control" value="<?php if (isset($form_data['final_grade'])) echo $form_data['final_grade']; ?>">
					</div>		
				</div>
				<div class="col-xs-3 ">
					<div class="form-group">
						<label for="remark">Remark</label>
						<input type="text" name="remark" id="remark" class="form-control" value="<?php if (isset($form_data['remark'])) echo $form_data['remark']; ?>">
					</div>		
				</div>
			</div>
		</div>
	</div>
</form>


<script type="text/javascript">

var saveForm = null, deleteData = null;

window.addEventListener('load', function() {
	(function($) {

	saveForm = function() {
		PageOverlay.show();
		$('#grades_edit').trigger('submit');
	}

	deleteData = function() {
		if (confirm("Delete grades?")) {
			<?php if (isset($form_data['id'])) { ?>
			location.href = "<?php echo site_url('grades/delete/' . $form_data['id']) ?>";
			<?php } ?>
		}
	}


	// $('.content-header-buttons').hide();

	})(jQuery);
});


</script>