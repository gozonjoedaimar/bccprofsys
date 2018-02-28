<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$teacher_id = isset($teacher_id) ? $teacher_id: '';
$module = isset($student) ? 'student': '';

?>

<div class="box">
	<div class="box-body">
		<table id="teacher_load_table" class="table table-bordered table-striped">
			<colgroup>
				<col />
				<col />
				<col />
				<col />
				<col />
				<col width="1" />
			</colgroup>
		</table>
	</div>
</div>


<script type="text/javascript">

/* Fn init */
var createTeacher_load = null, dtTeacher_loadTable = null, deleteTeacher_load = null;
	
window.addEventListener('load', function() {

(function($) {

dtTeacher_loadTable = $('#teacher_load_table').DataTable({
	ajax: {
		url: "<?php echo site_url('teacher_load/listing/' . $teacher_id. '/' . $module, SITE_SCHEME) ?>"
	},
	columns: [
		{
			title: "Subject",
			data: 'subject_code'
		},
		{
			title: "Day",
			data: 'day',
			render: function(data) {
				return data.toUpperCase();
			}
		},
		{
			title: "Time Start",
			data: 'time_start',
			visible: false
		},
		{
			title: "Time End",
			data: 'time_end',
			visible: false
		},
		{
			title: "Time",
			data: 'id',
			render: function(data, type, row) {

				var $start = moment(row.time_start, 'hh:mm:ss').format("hh:mma");
				var $end = moment(row.time_end, 'hh:mm:ss').format("hh:mma");

				return $start + " - " + $end;

			}
		},
		{
			title: "Class",
			data: 'classroom_disp'
		},		{
			title: "Teacher",
			data: 'teacher_disp',
			<?php if ( ! isset($student)): ?>
			visible: false
			<?php endif; ?>
		},
		{
			title: "Date Created",
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
			render: function(data, type, row) {
				var btnCnt = $("<div class='btn-group'></div>");
				var edtBtnEl = $('<button type="button" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>');
				edtBtnEl.attr({
					onclick: "PageOverlay.show(); location.href='<?php echo site_url('teacher_load/edit') ?>/" + data + "/<?php echo $teacher_id ?>';"
				});
				var delBtnEl = $('<button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>');
				delBtnEl.attr({
					onclick: "if (confirm('Delete Teacher_load?')) location.href='<?php echo site_url('teacher_load/delete') ?>/" + data + "';"
				});


				var classroom = row.classroom;
				var grdeditBtnEl = $('<button type="button" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>');
				grdeditBtnEl.attr({
					onclick: "PageOverlay.show(); location.href='<?php echo site_url('classroom/edit') ?>/" + classroom + "/grades/" + data + "';"
				});


				<?php if ( ! (isset($grades) && $grades)) : ?>
				edtBtnEl.appendTo(btnCnt);
				delBtnEl.appendTo(btnCnt);
				<?php else: ?>
				grdeditBtnEl.appendTo(btnCnt);
				<?php endif; ?>


				return btnCnt.get(0).outerHTML;
			}
			<?php if (isset($teacher_view) && $teacher_view && ! isset($grades)) : ?>
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

createDept = function() {
	location.href = "<?php echo site_url('teacher_load/add') ?>";
}

<?php if (isset($teacher_view) && $teacher_view) : ?>
$('.add_teacher_load').hide();
<?php endif; ?>

})(jQuery);

});

</script>