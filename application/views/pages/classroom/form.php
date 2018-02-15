<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<form action="<?php if (isset($form_action)) echo $form_action; ?>" id="classroom_edit" method="post">
	<div class="box">
		<div class="box-body">
			<div class="row">
				<div class="col-xs-12 col-sm-6 -col-sm-offset-3 hide">
					<div class="form-group">
						<label for="classroom_name">Name</label>
						<input type="hidden" name="id" value="<?php if (isset($form_data['id'])) echo $form_data['id']; ?>">
						<input type="text" name="name" id="classroom_name" class="form-control" value="<?php if (isset($form_data['name'])) echo $form_data['name']; ?>">
					</div>		
				</div>
				<div class="col-xs-12 col-sm-6 ">
					<div class="form-group">
						<label for="class_level">Year Level</label>
						<?php
							$selected = isset($form_data['level']) ? $form_data['level']: ""; 
							$this->layout->get_select('level', 'class_level', $this->classroom->level_selection(), $selected, TRUE);
						?>
					</div>	
				</div>
				<div class="col-xs-12 col-sm-6 -col-sm-offset-3">
					<div class="form-group">
						<label for="classroom_section">Section</label>
						<input type="text" name="section" id="classroom_section" class="form-control" value="<?php if (isset($form_data['section'])) echo $form_data['section']; ?>">
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
				<div class="col-xs-12 col-sm-6 ">
					<div class="form-group">
						<label for="classroom_batch">Batch</label>
						<?php
							$selected = isset($form_data['batch']) ? $form_data['batch']: date('Y'); 
							$this->layout->get_select('batch', 'classroom_batch', $this->layout->year_selection(), $selected, TRUE);
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
		$('#classroom_edit').trigger('submit');
	}

	deleteData = function() {
		if (confirm("Delete classroom?")) {
			<?php if (isset($form_data['id'])) { ?>
			location.href = "<?php echo site_url('classroom/delete/' . $form_data['id']) ?>";
			<?php } ?>
		}
	}

	// $('select#department').find('option[value=admin]').detach();

	})(jQuery);
});


</script>