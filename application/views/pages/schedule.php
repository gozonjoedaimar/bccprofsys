<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="box">
	<div class="box-body">
		<table id="schedule_table" class="table table-bordered table-striped">
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

/* Fn init */
var createSchedule = null, dtScheduleTable = null, deleteSchedule = null;
	
window.addEventListener('load', function() {

(function($) {

dtScheduleTable = $('#schedule_table').DataTable({
	ajax: {
		url: "<?php echo site_url('schedule/listing', SITE_SCHEME) ?>"
	},
	columns: [
		{
			title: "Subject",
			data: 'dbg'
		},
		{
			title: "Week day",
			data: 'dbg'
		},
		{
			title: "Start",
			data: 'dbg'
		},
		{
			title: "End",
			data: 'dbg'
		},
		{
			title: "Teacher",
			data: 'dbg'
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
					onclick: "PageOverlay.show(); location.href='<?php echo site_url('schedule/edit') ?>/" + data + "';"
				}).appendTo(btnCnt);
				var delBtnEl = $('<button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>');
				delBtnEl.attr({
					onclick: "if (confirm('Delete Schedule?')) location.href='<?php echo site_url('schedule/delete') ?>/" + data + "';"
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
	location.href = "<?php echo site_url('schedule/add') ?>";
}

})(jQuery);

});

</script>