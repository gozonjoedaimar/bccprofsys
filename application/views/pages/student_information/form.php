<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<form action="<?php if (isset($form_action)) echo $form_action; ?>" id="student_information_edit" method="post">
	<div class="box">
		<div class="box-body">
			<div class="row">
				<input type="hidden" name="id" value="<?php if (isset($form_data['id'])) echo $form_data['id']; ?>">
				<input type="hidden" name="user_id" value="<?php if (isset($form_data['user_id'])) echo $form_data['user_id']; ?>">
				
				<div class="col-xs-12 col-sm-6 -col-sm-offset-3">
					<div class="form-group">
						<label for="si_first_name">First Name</label>
						<input type="text" name="first_name" id="si_first_name" class="form-control" value="<?php if (isset($form_data['first_name'])) echo $form_data['first_name']; ?>">
					</div>		
				</div>
				<div class="col-xs-12 col-sm-6 -col-sm-offset-3">
					<div class="form-group">
						<label for="si_last_name">Last Name</label>
						<input type="text" name="last_name" id="si_last_name" class="form-control" value="<?php if (isset($form_data['last_name'])) echo $form_data['last_name']; ?>">
					</div>		
				</div>
				<div class="col-xs-12 col-sm-6 -col-sm-offset-3">
					<div class="form-group">
						<label for="si_middle_name">Middle Name</label>
						<input type="text" name="middle_name" id="si_middle_name" class="form-control" value="<?php if (isset($form_data['middle_name'])) echo $form_data['middle_name']; ?>">
					</div>		
				</div>
				<div class="col-xs-12 col-sm-6 -col-sm-offset-3">
					<div class="form-group">
						<label for="si_age">Age</label>
						<input type="number" name="age" id="si_age" class="form-control" value="<?php if (isset($form_data['age'])) echo $form_data['age']; ?>">
					</div>		
				</div>
				<div class="col-xs-12 col-sm-6 -col-sm-offset-3">
					<div class="form-group">
						<label for="si_birthday">Birthday</label>
						<input type="date" name="birthday" id="si_birthday" class="form-control" value="<?php if (isset($form_data['birthday'])) echo $form_data['birthday']; ?>">
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
		$('#student_information_edit').trigger('submit');
	}

	deleteData = function() {
		if (confirm("Delete student_information?")) {
			<?php if (isset($form_data['id'])) { ?>
			location.href = "<?php echo site_url('student_information/delete/' . $form_data['id']) ?>";
			<?php } ?>
		}
	}

	})(jQuery);
});


</script>