<?php defined('BASEPATH') OR exit('No direct script access allowed');
$student_id = isset($student_id) ? $student_id: "";

?>

<div class="box">
	<div class="box-body">
		<table id="grades_table" class="table table-bordered table-striped">
			<colgroup>
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

/* Fn init */
var createGrades = null, dtGradesTable = null, deleteGrades = null;
	
window.addEventListener('load', function() {

(function($) {

dtGradesTable = $('#grades_table').DataTable({
	ajax: {
		url: "<?php echo site_url("grades/listing/{$student_id}", SITE_SCHEME) ?>"
	},
	columns: [
		{
			title: "Subject Code",
			data: 'subject_code'
		},
		{
			title: "Subject Title",
			data: 'subject_title'
		},
		{
			title: "1st Semister",
			data: 'first_sem'
		},
		{
			title: "2nd Semister",
			data: 'second_sem'
		},
		{
			title: "Final Grades",
			data: 'final_grade'
		},
		{
			title: "Teacher",
			data: 'teacher'
		},
		{
			title: "Remarks",
			data: 'remark'
		},
		{
			title: "Date Created",
			data: 'created_at',
			className: "text-nowrap",
			render: function(data) {
				return moment(data).format("MMMM D, YYYY | hh:mma");
			}
		},
		{
			title: "Actions",
			data: 'id',
			visible: false,
			className: "text-nowrap action_col",
			render: function(data) {
				var btnCnt = $("<div class='btn-group'></div>");
				var edtBtnEl = $('<button type="button" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>');
				edtBtnEl.attr({
					onclick: "PageOverlay.show(); location.href='<?php echo site_url('grades/edit') ?>/" + data + "';"
				}).appendTo(btnCnt);
				var delBtnEl = $('<button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>');
				delBtnEl.attr({
					onclick: "if (confirm('Delete Grades?')) location.href='<?php echo site_url('grades/delete') ?>/" + data + "';"
				}).appendTo(btnCnt);
				return btnCnt.get(0).outerHTML;
			}
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
	location.href = "<?php echo site_url('grades/add') ?>";
}

<?php if ($this->core->get_session('role_code') == "student") : ?>
$('.content-header-buttons').hide();
<?php endif; ?>

})(jQuery);

});

</script>