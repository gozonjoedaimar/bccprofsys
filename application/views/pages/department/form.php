<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<form action="<?php if (isset($form_action)) echo $form_action; ?>" id="dept_edit" method="post">
	<div class="box">
		<div class="box-body">
			<div class="row">
				<div class="col-xs-12 col-sm-6 -col-sm-offset-3">
					<div class="form-group">
						<label for="dept_name">Name</label>
						<input type="hidden" name="id" value="<?php if (isset($form_data['id'])) echo $form_data['id']; ?>">
						<input type="text" name="name" id="dept_name" class="form-control" value="<?php if (isset($form_data['name'])) echo $form_data['name']; ?>">
					</div>
					<div class="form-group">
						<label for="dept_code">Code</label>
						<input type="text" class="form-control" name="code" id="dept_code" value="<?php if (isset($form_data['code'])) echo $form_data['code']; ?>">
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
		$('#dept_edit').trigger('submit');
	}

	deleteData = function() {
		if (confirm("Delete department?")) {
			<?php if (isset($form_data['id'])) { ?>
			location.href = "<?php echo site_url('department/delete/' . $form_data['id']) ?>";
			<?php } ?>
		}
	}

	})(jQuery);
});


</script>