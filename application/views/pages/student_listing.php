<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$module = isset($module) ? $module: NULL;
?>

<div class="box">
	<div class="box-body">
		<table id="<?php echo isset($table_id) ? $table_id: 'student_table' ?>" class="table table-striped table-bordered">
			<colgroup>
				<col />
				<col width="1" />
				<col width="1" />
			</colgroup>
		</table>
	</div>
</div>

<script type="text/javascript">

var dtUsersTable<?php if (isset($table_id)) echo "_{$table_id}" ?> = null, edtBtnEv = null;

window.addEventListener('load', function() {

(function($) {

edtBtnEv = function($el, $url) {
	PageOverlay.show();
	location.href = $url;
}

dtUsersTable<?php if (isset($table_id)) echo "_{$table_id}" ?> = $('#<?php echo isset($table_id) ? $table_id: 'student_table' ?>').DataTable({
	ajax: {
		url: "<?php echo site_url("student/listing/{$module}/{$classroom}", SITE_SCHEME) ?>"
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
			data: 'department',
			visible: false
		},
		{
			title: "Role",
			data: 'role',
			visible: false
			/*visible: <?php echo isset($by_role) && $by_role ? 'false': 'true'; ?>*/
		},
		{
			title: "Username",
			data: 'username',
			visible: false
		},
		{
			title: "Passcode",
			data: 'passcode',
			visible: false
		},
		{
			title: "Record ID",
			data: 'record_id'
		},
		{
			title: "Date Joined",
			data: 'created_at',
			className: "text-nowrap",
			render: function(data) {
				return moment(data).format("MMMM D, YYYY | hh:mma");
			},
			visible: false
		},
		{
			title: "Actions",
			data: 'id',
			className: "text-nowrap action_col",
			render: function(data) {
				var btnCnt = $("<div class='btn-group'></div>");
				var edtBtnEl = $('<button type="button" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></button>');
				edtBtnEl.attr({
					// onclick: "edtBtnEv(this, '<?php echo site_url("student/add_list/{$classroom}") ?>/" + data + "/');"
					onclick: "if (window.addToClassroom) addToClassroom(" + data + ");"
				});
				<?php if ($module != 'classroom') : ?>
				edtBtnEl.appendTo(btnCnt);
				<?php endif; ?>
				var delBtnEl = $('<button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>');
				delBtnEl.attr({
					// onclick: "if (confirm('Delete user?')) location.href='<?php echo site_url('users/delete') ?>/" + data + "/<?php echo $module ?>';"
					onclick: "if (window.delToClassroom) if (confirm('Remove from classroom?')) delToClassroom(" + data + ")"
				});
				<?php if ($module == 'classroom' && ! (isset($view) && ($view == 'teacher' || $view == 'grades'))) : ?>
				delBtnEl.appendTo(btnCnt);
				<?php endif; ?>


				var grdBtnEl = $('<button type="button" class="btn btn-primary btn-sm"><i class="fa fa-bar-chart"></i></button>');
				grdBtnEl.attr({
					onclick: "edtBtnEv(this, '<?php echo site_url("grades/add") ?>/" + data + "/<?php echo $teacher_load ?>');"
					// onclick: "if (window.addToClassroom) addToClassroom(" + data + ");"
				});

				<?php if (isset($view) && $view == 'grades') : ?>
				grdBtnEl.appendTo(btnCnt);
				<?php endif; ?>


				return btnCnt.get(0).outerHTML;
			}
			<?php if (isset($view) && $view == 'teacher'): ?>
			,visible: false
			<?php endif; ?>
		}
	],
	columnDefs: [
		{
			targets: ["_all"],
			defaultContent: ""
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

})(jQuery);

});

</script>