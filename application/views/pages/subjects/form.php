<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<form action="<?php if (isset($form_action)) echo $form_action; ?>" id="subjects_edit" method="post">
	<div class="box">
		<div class="box-body">
			<div class="row">
				<div class="col-xs-12 col-sm-6 -col-sm-offset-3">
					<div class="form-group">
						<label for="subjects_name">Name</label>
						<input type="hidden" name="id" value="<?php if (isset($form_data['id'])) echo $form_data['id']; ?>">
						<input type="text" name="name" id="subjects_name" class="form-control" value="<?php if (isset($form_data['name'])) echo $form_data['name']; ?>">
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 -col-sm-offset-3">
					<div class="form-group">
						<label for="subjects_code">Code</label>
						<input type="text" name="code" id="subjects_code" class="form-control" value="<?php if (isset($form_data['code'])) echo $form_data['code']; ?>">
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 ">
					<div class="form-group">
						<label for="department">Department</label>
						<?php
							$selected = isset($form_data['department']) ? $form_data['department']: ""; 
							$this->layout->get_select('department', 'department', $this->department->listing('non_mngt'), $selected, TRUE);
						?>
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
		$('#subjects_edit').trigger('submit');
	}

	deleteData = function() {
		if (confirm("Delete subjects?")) {
			<?php if (isset($form_data['id'])) { ?>
			location.href = "<?php echo site_url('subjects/delete/' . $form_data['id']) ?>";
			<?php } ?>
		}
	}

	// $('select#department').find('option[value=admin]').detach();

	})(jQuery);
});


</script>