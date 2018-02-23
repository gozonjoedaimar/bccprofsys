<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="box">
	<div class="box-body">
		<table id="student_information_table" class="table table-bordered table-striped">
			<colgroup>
				<col />
				<col width="1" />
				<col width="1" />
			</colgroup>
		</table>
	</div>
</div>


<script type="text/javascript">

/* Fn init */
var createStudent_information = null, dtStudent_informationTable = null, deleteStudent_information = null;
	
window.addEventListener('load', function() {

(function($) {

dtStudent_informationTable = $('#student_information_table').DataTable({
	ajax: {
		url: "<?php echo site_url('student_information/listing', SITE_SCHEME) ?>"
	},
	columns: [
		{
			title: "Name",
			data: 'name'
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
			className: "text-nowrap action_col",
			render: function(data) {
				var btnCnt = $("<div class='btn-group'></div>");
				var edtBtnEl = $('<button type="button" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>');
				edtBtnEl.attr({
					onclick: "PageOverlay.show(); location.href='<?php echo site_url('student_information/edit') ?>/" + data + "';"
				}).appendTo(btnCnt);
				var delBtnEl = $('<button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>');
				delBtnEl.attr({
					onclick: "if (confirm('Delete Student_information?')) location.href='<?php echo site_url('student_information/delete') ?>/" + data + "';"
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
	location.href = "<?php echo site_url('student_information/add') ?>";
}

})(jQuery);

});

</script>