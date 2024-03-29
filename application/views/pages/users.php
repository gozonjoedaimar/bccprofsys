<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$module = isset($module) ? $module: NULL;
$teacher_load = isset($teacher_load) ? $teacher_load: NULL;
?>

<div class="box">
	<div class="box-body">
		<table id="users_table" class="table table-striped table-bordered">
			<colgroup>
				<col />
				<col />
				<col />
				<col />
				<col />
				<col width="1" />
				<col width="1" />
			</colgroup>
		</table>
	</div>
</div>

<script type="text/javascript">

var dtUsersTable = null, edtBtnEv = null;

window.addEventListener('load', function() {

(function($) {

edtBtnEv = function($el, $url) {
	PageOverlay.show();
	location.href = $url;
}

dtUsersTable = $('#users_table').DataTable({
	ajax: {
		url: "<?php echo site_url("users/listing/{$module}", SITE_SCHEME) ?>"
	},
	columns: [
		{
			title: "Name",
			data: 'id',
			render: function(data, type, row) {
				var name = row.first_name + " " + row.last_name;
				return name;
			}
		},
		{
			title: "Department",
			data: 'department'
		},
		{
			title: "Role",
			data: 'role',
			/*visible: <?php echo isset($by_role) && $by_role ? 'false': 'true'; ?>*/
		},
		{
			title: "Username",
			data: 'username'
		},
		{
			title: "Passcode",
			data: 'passcode'
		},
		{
			title: "Record ID",
			data: 'record_id'
		},
		<?php if ($module == "student") : ?>
		{
			title: "Year & Section",
			data: 'year_section'
		},
		{
			title: "Batch",
			data: 'batch'
		},
		<?php endif; ?>
		{
			title: "Date Joined",
			data: 'created_at',
			className: "text-nowrap",
			render: function(data) {
				return moment(data).format("MMMM D, YYYY | hh:mma");
			}
		},
		{
			title: "Actions",
			data: 'id',
			className: "text-nowrap action_col",
			render: function(data) {
				var btnCnt = $("<div class='btn-group'></div>");
				var edtBtnEl = $('<button type="button" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>');
				edtBtnEl.attr({
					onclick: "edtBtnEv(this, '<?php echo site_url("users/edit") ?>/" + data + "/<?php echo $module ?>');"
				});
				var delBtnEl = $('<button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>');
				delBtnEl.attr({
					onclick: "if (confirm('Delete user?')) location.href='<?php echo site_url('users/delete') ?>/" + data + "/<?php echo $module ?>';"
				});

				<?php if ($this->core->get_session('role_code') == "registrar" && $module == "student") : ?>
				
				var grdBtnEl = $('<button type="button" class="btn btn-primary btn-sm"><i class="fa fa-bar-chart"></i></button>');
				grdBtnEl.attr({
					onclick: "edtBtnEv(this, '<?php echo site_url("grades/add") ?>/" + data + "/<?php echo $teacher_load ?>');"
					// onclick: "if (window.addToClassroom) addToClassroom(" + data + ");"
				});

				grdBtnEl.appendTo(btnCnt);

				<?php else: ?>
				edtBtnEl.appendTo(btnCnt);
				delBtnEl.appendTo(btnCnt);
				<?php endif; ?>
				return btnCnt.get(0).outerHTML;
			}

			<?php if ( $this->core->get_session('role_code') == 'registrar' && $module != 'student') : ?>
			, visible: false
			<?php endif; ?>

		}
	],
	columnDefs: [
		{
			targets: ["_all"],
			defaultContent: "--"
		}
	],
	autoWidth: false,
	responsive: {
		details: {
			display: $.fn.dataTable.Responsive.display.childRowImmediate,
			type: ''
		}
	}
});

<?php if ($this->core->get_session('role_code') == "registrar") : ?>
$('.btn-success').hide();
<?php endif; ?>


console.log("<?php echo $this->core->get_session('role_code') ?>");

})(jQuery);

});

</script>