<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<form action="<?php if (isset($form_action)) echo $form_action; ?>" id="notifications_edit" method="post">
	<div class="box">
		<div class="box-body">
			<div class="row">
				<div class="col-xs-12 col-sm-6 -col-sm-offset-3">
					<div class="form-group">
						<label for="notifications_name">Message</label>
						<input type="hidden" name="id" value="<?php if (isset($form_data['id'])) echo $form_data['id']; ?>">
						<input type="text" name="message" id="notifications_name" class="form-control" value="<?php if (isset($form_data['message'])) echo $form_data['message']; ?>">
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
		$('#notifications_edit').trigger('submit');
	}

	deleteData = function() {
		if (confirm("Delete notifications?")) {
			<?php if (isset($form_data['id'])) { ?>
			location.href = "<?php echo site_url('notifications/delete/' . $form_data['id']) ?>";
			<?php } ?>
		}
	}

	})(jQuery);
});


</script>