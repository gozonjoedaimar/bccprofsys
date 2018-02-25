<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$module = isset($module) ? $module: "";

?>


<form action="<?php if (isset($form_action)) echo $form_action; ?>" id="user_edit" method="post">
	<div class="box">
		<div class="box-body">
			<div class="row hide sys-form-container">
				<div class="col-xs-12 col-sm-6 ">
					<div class="form-group">
						<label for="first_name">First Name</label>
						<input type="hidden" name="id" value="<?php if (isset($form_data['id'])) echo $form_data['id']; ?>" />
						<input type="text" class="form-control" required name="first_name" id="first_name" value="<?php if (isset($form_data['first_name'])) echo $form_data['first_name']; ?>" />
					</div>	
				</div>
				<div class="col-xs-12 col-sm-6 ">
					<div class="form-group">
						<label for="last_name">Last Name</label>
						<input type="text" class="form-control" name="last_name" required id="last_name" value="<?php if (isset($form_data['last_name'])) echo $form_data['last_name']; ?>" />
					</div>	
				</div>
				<div class="clearfix"></div>
				<div class="col-xs-12 col-sm-6 ">
					<div class="form-group">
						<label for="middle_name">Middle Name</label>
						<input type="text" class="form-control" name="middle_name" id="middle_name" value="<?php if (isset($form_data['middle_name'])) echo $form_data['middle_name']; ?>" />
					</div>	
				</div>
				<div class="col-xs-12 col-sm-6 ">
					<div class="form-group">
						<label for="role">Role</label>
						<!-- <select id="role" class="form-control">
							<option value="student">Student</option>
							<option value="teacher">Teacher</option>
							<option value="admin">Admin</option>
							<option value="dept_coordinator">Dept. Coordinator</option>
						</select> -->
						<?php
							$selected = isset($form_data['role']) ? $form_data['role']: ""; 
							$this->layout->get_select('role', 'role', $this->user->list_role(), $selected, TRUE)
						?>
					</div>	
				</div>
				<div class="clearfix"></div>
				<div class="col-xs-12 col-sm-6 ">
					<div class="form-group">
						<label for="department">Department</label>
						<!-- <select id="department" class="form-control">
							<option value="bsis">BSIS</option>
							<option value="ted">TED</option>
							<option value="bsit">BSIT</option>
							<option value="bsoa">BSOA</option>
						</select> -->
						<?php
							$selected = isset($form_data['department']) ? $form_data['department']: ""; 
							$this->layout->get_select('department', 'department', $this->department->listing($module ? TRUE: FALSE), $selected, TRUE);
						?>
					</div>	
				</div>
				<div class="col-xs-12 col-sm-6 ">
					<div class="form-group">
						<label for="username">Username</label>
						<input type="text" class="form-control" name="username" id="username" value="<?php if (isset($form_data['username'])) echo $form_data['username']; ?>" />
					</div>	
				</div>
				<div class="clearfix"></div>
				<div class="col-xs-12 col-sm-6 ">
					<div class="form-group">
						<label for="passcode">Passcode</label>
						<div class="input-group">
							<input type="text" class="form-control" name="passcode" readonly id="passcode" value="<?php if (isset($form_data['passcode'])) echo $form_data['passcode']; ?>" />
							<div class="input-group-addon passcode_refresher"><i class="fa fa-refresh"></i></div>
						</div>
					</div>	
				</div>
				<div class="col-xs-12 col-sm-6 ">
					<div class="form-group">
						<label for="record_id">Record ID <small>(ID provided by registrar)</small></label>
						<input type="text" class="form-control" disabled name="record_id" id="record_id" value="<?php if (isset($form_data['record_id'])) echo $form_data['record_id']; ?>" />
					</div>	
				</div>
				<div class="hidden-xs col-sm-12">&nbsp;</div>
				<div class="col-xs-12 col-sm-6 hide">
					<div class="form-group">
						<label for="password">New Password</label>
						<input type="text" class="form-control" disabled name="password" id="password" value="" />
					</div>	
				</div>
				<div class="col-xs-12 col-sm-6 hide">
					<div class="form-group">
						<label for="password_confirm">Confirm Password</label>
						<input type="text" class="form-control" disabled name="password_confirm" id="password_confirm" value="" />
					</div>	
				</div>
			</div>
		</div>
	</div>
</form>

<?php if ($module == "teacher") { $this->load->view('pages/teacher_load/teacher_students.php', ['teacher_id'=>$form_data['id']]); } ?>

<script type="text/javascript">

/* Define global variables */
var saveForm = null, deleteData = null, generatePassCode = null, passcodeEl = null, unameEl = null;

/* Init events after window has loaded */
window.addEventListener('load', function() {
	(function($) {

	if ( ! $) return;

	saveForm = function() {
		var _frm = $('#user_edit');

		if (_frm.valid()) {
			PageOverlay.show();
			_frm.trigger('submit');
		}
	}

	deleteData = function() {
		if (confirm("Delete user?")) {
			<?php if (isset($form_data['id'])) { ?>
			location.href = "<?php echo site_url('users/delete/' . $form_data['id']) ?>";
			<?php } ?>
		}
	}

	generatePassCode = function() {
		var randStr = Math.random().toString(36);
		var randStr = randStr.substr(randStr.length - 8);
		return randStr;
	}

	/* Init passcode/username behavior */
	passcodeEl = $('input#passcode');
	if ( ! passcodeEl.val()) passcodeEl.val(generatePassCode());
	unameEl = $('input#username');
	if ( ! unameEl.val()) unameEl.val("user_" + generatePassCode());

	$('.passcode_refresher').on('click', function() {
		passcodeEl.val(generatePassCode());
	});

	$('.sys-form-container').removeClass('hide');

	<?php if ( ! (
		$this->core->get_session('role_code') == 'admin' 
	)) : ?>
	$('#department > [value=admin]').attr('disabled', true);
	<?php endif; ?>

	})(jQuery);
});

document.addEventListener('DOMContentLoaded', function() {

	var roleEl = document.getElementById('role');
	var recIdEl = document.getElementById('record_id');
	
	<?php if ($module) : ?>

	if (roleEl) {

		roleEl.setAttribute('readonly', true);

		if (roleEl.options) {
			for (var i = 0; i < roleEl.options.length; i++) {
				var opt = roleEl.options[i];
				if (opt.value == '<?php echo $module ?>') {
					opt.setAttribute('selected', true);
				}
				else {
					opt.setAttribute('disabled', true);
					opt.removeAttribute('selected');
				}
			}
		}
		
	}


		<?php if (
			$module == 'student' ||
			(
				$this->core->get_session('role_code') == 'admin' ||
				$this->core->get_session('role_code') == 'registrar'
			)
		) : ?>

		if (recIdEl) recIdEl.removeAttribute('disabled');

		<?php endif; ?>

	<?php else: ?>

	if (roleEl) {
		roleEl.removeAttribute('readonly');

		roleEl.addEventListener('change', function(e) {
			if (recIdEl) {
				if (this.value == 'student') {
					recIdEl.removeAttribute('disabled');
					if (recIdEl.cache) {
						recIdEl.value = recIdEl.cache;
					}
				}
				else {
					recIdEl.setAttribute('disabled', true);
					recIdEl.cache = recIdEl.value;
					recIdEl.value = "";
				}
			}
		});
	}
		
	if (recIdEl && roleEl) {
		if (roleEl.value == 'student') {
			recIdEl.removeAttribute('disabled');
		}
	}
	
	<?php endif; ?>

	<?php
	$dept_code = $this->core->get_session('dept_code');
	if ( ! (
		$dept_code == 'admin' ||
		$dept_code == 'registrar'
	)) : ?>

	var deptCodeEl = document.getElementById('department');

	if (deptCodeEl) {
		deptCodeEl.setAttribute('readonly', true);

		if (deptCodeEl.options) {
			for (var i = 0; i < deptCodeEl.options.length; i++) {
				var opt = deptCodeEl.options[i];
				if (opt.value == '<?php echo $dept_code ?>') {
					opt.setAttribute('selected', true);
				}
				else {
					opt.setAttribute('disabled', true);
					opt.removeAttribute('selected');
				}
			}
		}
	}

	console.log('<?php echo $dept_code ?>');

	<?php endif; ?>

});


</script>