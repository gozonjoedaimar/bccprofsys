<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="box">
	<div class="box-body">
		<table id="teacher_load_table" class="table table-bordered table-striped">
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
var createTeacher_load = null, dtTeacher_loadTable = null, deleteTeacher_load = null;
	
window.addEventListener('load', function() {

(function($) {

dtTeacher_loadTable = $('#teacher_load_table').DataTable({
	ajax: {
		url: "<?php echo site_url('users/listing/teacher', SITE_SCHEME) ?>"
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
				var edtBtnEl = $('<button type="button" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></button>');
				edtBtnEl.attr({
					onclick: "PageOverlay.show(); location.href='<?php echo site_url('teacher_load/view') ?>/" + data + "';"
				}).appendTo(btnCnt);
				var delBtnEl = $('<button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>');
				delBtnEl.attr({
					onclick: "if (confirm('Delete Teacher_load?')) location.href='<?php echo site_url('teacher_load/delete') ?>/" + data + "';"
				});
				// delBtnEl.appendTo(btnCnt);
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
	location.href = "<?php echo site_url('teacher_load/add') ?>";
}

$('.content-header-buttons').hide();

})(jQuery);

});

</script>