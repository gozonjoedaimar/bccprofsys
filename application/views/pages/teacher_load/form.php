<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<form action="<?php if (isset($form_action)) echo $form_action; ?>" id="teacher_load_edit" method="post">
	<div class="box">
		<div class="box-body">
			<div class="row">
				<div class="col-xs-12 col-sm-6 -col-sm-offset-3 hide">
					<div class="form-group">
						<label for="teacher_load_name">Name</label>
						<input type="hidden" name="id" value="<?php if (isset($form_data['id'])) echo $form_data['id']; ?>">
						<input type="hidden" name="teacher_id" value="<?php if (isset($form_data['teacher_id'])) echo $form_data['teacher_id']; ?>">
						<input type="text" name="name" id="teacher_load_name" class="form-control" value="<?php if (isset($form_data['name'])) echo $form_data['name']; ?>">
					</div>		
				</div>
				<div class="col-xs-12 col-sm-6 ">
					<div class="form-group">
						<label for="time_start">Time Start</label>
						<?php
							$selected = isset($form_data['time_start']) ? $form_data['time_start']: date('Y'); 
							$this->layout->get_select('time_start', 'time_start', $this->layout->time_selection(), $selected, TRUE);
						?>
					</div>	
				</div>
				<div class="col-xs-12 col-sm-6 ">
					<div class="form-group">
						<label for="time_end">Time End</label>
						<?php
							$selected = isset($form_data['time_end']) ? $form_data['time_end']: date('Y'); 
							$this->layout->get_select('time_end', 'time_end', $this->layout->time_selection(), $selected, TRUE);
						?>
					</div>	
				</div>
				<div class="col-xs-12 col-sm-6 ">
					<div class="form-group">
						<label for="week_day">Week day</label>
						<?php
							$selected = isset($form_data['day']) ? $form_data['day']: date('Y'); 
							$this->layout->get_select('day', 'week_day', $this->layout->day_selection('full'), $selected, TRUE);
						?>
					</div>	
				</div>
				<div class="col-xs-12 col-sm-6 ">
					<div class="form-group">
						<label for="subjects">Subject</label>
						<?php
							$selected = isset($form_data['subject']) ? $form_data['subject']: date('Y'); 
							$this->layout->get_select('subject', 'subjects', $this->subjects->selection(), $selected, TRUE);
						?>
					</div>	
				</div>
				<div class="col-xs-12 col-sm-6 ">
					<div class="form-group">
						<label for="classroom">Class</label>
						<?php
							$selected = isset($form_data['classroom']) ? $form_data['classroom']: date('Y'); 
							$this->layout->get_select('classroom', 'classroom', $this->classroom->selection(), $selected, TRUE);
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
		$('#teacher_load_edit').trigger('submit');
	}

	deleteData = function() {
		if (confirm("Delete teacher_load?")) {
			<?php if (isset($form_data['id'])) { ?>
			location.href = "<?php echo site_url('teacher_load/delete/' . $form_data['id']) ?>";
			<?php } ?>
		}
	}

	})(jQuery);
});


</script>