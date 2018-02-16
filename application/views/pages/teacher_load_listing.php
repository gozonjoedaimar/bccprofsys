<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$teacher_id = isset($teacher_id) ? $teacher_id: '';

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
		url: "<?php echo site_url('teacher_load/listing/' . $teacher_id, SITE_SCHEME) ?>"
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
			data: 'time_start'
		},
		{
			title: "Time End",
			data: 'time_end'
		},
		{
			title: "Class",
			data: 'classroom_disp'
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
			render: function(data) {
				var btnCnt = $("<div class='btn-group'></div>");
				var edtBtnEl = $('<button type="button" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>');
				edtBtnEl.attr({
					onclick: "PageOverlay.show(); location.href='<?php echo site_url('teacher_load/edit') ?>/" + data + "/<?php echo $teacher_id ?>';"
				}).appendTo(btnCnt);
				var delBtnEl = $('<button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>');
				delBtnEl.attr({
					onclick: "if (confirm('Delete Teacher_load?')) location.href='<?php echo site_url('teacher_load/delete') ?>/" + data + "';"
				}).appendTo(btnCnt);
				return btnCnt.get(0).outerHTML;
			}
			<?php if (isset($teacher_view) && $teacher_view) : ?>
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