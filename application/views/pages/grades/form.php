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
				<div class="col-xs-12">
					Semister:
					<div style="width: 300px;">
						<?php
							$selected = isset($form_data['semister']) ? $form_data['semister']: ""; 
							$this->layout->get_select('semister', 'semister', [['code'=>'first_sem', 'name'=>'First Sem'],['code'=>'second_sem', 'name'=>'Second Sem']], $selected, TRUE);
						?>
					</div>
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
						<label for="mid_term">Mid Term</label>
						<input type="text" name="mid_term" id="mid_term" class="form-control" value="<?php if (isset($form_data['mid_term'])) echo $form_data['mid_term']; ?>">
					</div>		
				</div>
				<div class="col-xs-3 ">
					<div class="form-group">
						<label for="final_term">Final Term</label>
						<input type="text" name="final_term" id="final_term" class="form-control" value="<?php if (isset($form_data['final_term'])) echo $form_data['final_term']; ?>">
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

var saveForm = null, deleteData = null, reload_grade = null;

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

	reload_grade = function() {
		var selctr = $('select#semister');

		if (selctr.get(0)) {
			var sem = selctr.val();
			var jxurl = "<?php echo site_url("grades/pull_grade/{$student_id}/{$teacher_load}") ?>/" + sem;

			$.ajax({
				url: jxurl,
				error: function(xhr) {

				},
				success: function(res) {
					var data = res.data;

					if (data) {
						$('[name=mid_term]').val(data.mid_term);
						$('[name=final_term]').val(data.final_term);
						$('[name=final_grade]').val(data.final_grade);
						$('[name=remark]').val(data.remark);
						$('[name=id]').val(data.id);
					}
					else {
						$('[name=mid_term]').val("");
						$('[name=final_term]').val("");
						$('[name=final_grade]').val("");
						$('[name=remark]').val("");
						$('[name=id]').val("");
					}
				}
			});
		}
	};

	setTimeout(function() {
		reload_grade();
	}, 700);

	var selectInp = $('select#semister');

	if (selectInp.get(0)) 
	{
		selectInp.on('change', function() {
			reload_grade();
		});
	}


	})(jQuery);
});


</script>