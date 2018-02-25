<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<form action="<?php if (isset($form_action)) echo $form_action; ?>" id="student_information_edit" method="post">
	<div class="box">
		<div class="box-body">
			<div class="row">
				<div class="col-xs-12">
					<h4>Basic Information</h4>
				</div>
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
				<div class="col-xs-12 col-sm-6 -col-sm-offset-3">
					<div class="form-group">
						<label for="si_birth_place">Place of birth</label>
						<input type="text" name="birth_place" id="si_birth_place" class="form-control" value="<?php if (isset($form_data['birth_place'])) echo $form_data['birth_place']; ?>">
					</div>		
				</div>
				<div class="col-xs-12 col-sm-6 -col-sm-offset-3">
					<div class="form-group">
						<label for="si_religion">Religion</label>
						<input type="text" name="religion" id="si_religion" class="form-control" value="<?php if (isset($form_data['religion'])) echo $form_data['religion']; ?>">
					</div>		
				</div>
				<div class="col-xs-12 col-sm-6 ">
					<div class="form-group">
						<label for="si_gender">Gender</label>
						<?php
							$selected = isset($form_data['gender']) ? $form_data['gender']: ""; 
							$this->layout->get_select('gender', 'si_gender', [
								['code'=>'male', 'name'=>'Male'],
								['code'=>'female', 'name'=>'Female']
							], $selected, TRUE)
						?>
					</div>	
				</div>
				<div class="col-xs-12 col-sm-6 ">
					<div class="form-group">
						<label for="si_civil_status">Civil Status</label>
						<?php
							$selected = isset($form_data['civil_status']) ? $form_data['civil_status']: ""; 
							$this->layout->get_select('civil_status', 'si_civil_status', [
								['code'=>'single', 'name'=>'Single'],
								['code'=>'married', 'name'=>'Married'],
								['code'=>'other', 'name'=>'Other']
							], $selected, TRUE)
						?>
					</div>	
				</div>
				<div class="col-xs-12 col-sm-6">
					<div class="form-group">
						<label for="si_present_address">Present Address</label>
						<small>(House No./Street Village, Barangay, Municipality/City, Province)</small>
						<textarea class="form-control" rows="3" name="present_address" id="si_present_address" placeholder="(House No./Street Village, Barangay, Municipality/City, Province)"><?php if (isset($form_data['present_address'])) echo $form_data['present_address']; ?></textarea>
					</div>		
				</div>
				<div class="clearfix"></div>
				<div class="col-xs-12 col-sm-6">
					<div class="form-group">
						<label for="si_height">Height</label>
						<input type="text" name="height" id="si_height" class="form-control" value="<?php if (isset($form_data['height'])) echo $form_data['height']; ?>">
					</div>		
				</div>
				<div class="col-xs-12 col-sm-6">
					<div class="form-group">
						<label for="si_email">Email Address</label>
						<input type="text" name="email" id="si_email" class="form-control" value="<?php if (isset($form_data['email'])) echo $form_data['email']; ?>">
					</div>		
				</div>
				<div class="col-xs-12 col-sm-6">
					<div class="form-group">
						<label for="si_landline">Land line</label>
						<input type="text" name="landline" id="si_landline" class="form-control" value="<?php if (isset($form_data['landline'])) echo $form_data['landline']; ?>">
					</div>		
				</div>
				<div class="col-xs-12 col-sm-6">
					<div class="form-group">
						<label for="si_cellphone">Cellphone</label>
						<input type="text" name="cellphone" id="si_cellphone" class="form-control" value="<?php if (isset($form_data['cellphone'])) echo $form_data['cellphone']; ?>">
					</div>		
				</div>
			</div>
		</div>
	</div>
	<div class="box">
		<div class="box-body">
			<div class="row">
				<div class="col-xs-12">
					<h4>Parent/Guardian</h4>
				</div>
				<div class="col-xs-12 col-sm-6 -col-sm-offset-3">
					<div class="form-group">
						<label for="si_p_first_name">First Name</label>
						<input type="text" name="p_first_name" id="si_p_first_name" class="form-control" value="<?php if (isset($form_data['p_first_name'])) echo $form_data['p_first_name']; ?>">
					</div>		
				</div>
				<div class="col-xs-12 col-sm-6 -col-sm-offset-3">
					<div class="form-group">
						<label for="si_p_last_name">Last Name</label>
						<input type="text" name="p_last_name" id="si_p_last_name" class="form-control" value="<?php if (isset($form_data['p_last_name'])) echo $form_data['p_last_name']; ?>">
					</div>		
				</div>
				<div class="col-xs-12 col-sm-6 -col-sm-offset-3">
					<div class="form-group">
						<label for="si_p_middle_name">Middle Name</label>
						<input type="text" name="p_middle_name" id="si_p_middle_name" class="form-control" value="<?php if (isset($form_data['p_middle_name'])) echo $form_data['p_middle_name']; ?>">
					</div>		
				</div>
				<div class="col-xs-12 col-sm-6">
					<div class="form-group">
						<label for="si_p_cellphone">Cellphone</label>
						<input type="text" name="p_cellphone" id="si_p_cellphone" class="form-control" value="<?php if (isset($form_data['p_cellphone'])) echo $form_data['p_cellphone']; ?>">
					</div>		
				</div>
				<div class="col-xs-12 col-sm-6">
					<div class="form-group">
						<label for="si_p_present_address">Present Address</label>
						<small>(House No./Street Village, Barangay, Municipality/City, Province)</small>
						<textarea class="form-control" rows="3" name="p_present_address" id="si_p_present_address" placeholder="(House No./Street Village, Barangay, Municipality/City, Province)"><?php if (isset($form_data['p_present_address'])) echo $form_data['p_present_address']; ?></textarea>
					</div>		
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>

	<div class="box">
		<div class="box-body">
			<div class="row">
				<div class="col-xs-12">
					<h4>Educational Background</h4>
				</div>
				<div class="col-xs-8">
					<div class="form-group">
						<label for="si_elementary">Elementary</label>
						<input type="text" name="elementary" id="si_elementary" class="form-control" value="<?php if (isset($form_data['elementary'])) echo $form_data['elementary']; ?>">
					</div>		
				</div>
				<div class="col-xs-4">
					<div class="form-group">
						<label for="si_grad_elementary">Graduated</label>
						<input type="text" name="grad_elementary" id="si_grad_elementary" class="form-control" value="<?php if (isset($form_data['grad_elementary'])) echo $form_data['grad_elementary']; ?>">
					</div>		
				</div>
				<div class="col-xs-8">
					<div class="form-group">
						<label for="si_secondary">Secondary</label>
						<input type="text" name="secondary" id="si_secondary" class="form-control" value="<?php if (isset($form_data['secondary'])) echo $form_data['secondary']; ?>">
					</div>		
				</div>
				<div class="col-xs-4">
					<div class="form-group">
						<label for="si_grad_secondary">Graduated</label>
						<input type="text" name="grad_secondary" id="si_grad_secondary" class="form-control" value="<?php if (isset($form_data['grad_secondary'])) echo $form_data['grad_secondary']; ?>">
					</div>		
				</div>
				<div class="col-xs-8">
					<div class="form-group">
						<label for="si_tertiary">Tertiary</label>
						<input type="text" name="tertiary" id="si_tertiary" class="form-control" value="<?php if (isset($form_data['tertiary'])) echo $form_data['tertiary']; ?>">
					</div>		
				</div>
				<div class="col-xs-4">
					<div class="form-group">
						<label for="si_grad_tertiary">Graduated</label>
						<input type="text" name="grad_tertiary" id="si_grad_tertiary" class="form-control" value="<?php if (isset($form_data['grad_tertiary'])) echo $form_data['grad_tertiary']; ?>">
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