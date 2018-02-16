<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="box">
	<div class="box-body">
		<table id="notifications_table" class="table table-bordered table-striped">
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
var createNotifications = null, dtNotificationsTable = null, deleteNotifications = null;
	
window.addEventListener('load', function() {

(function($) {

dtNotificationsTable = $('#notifications_table').DataTable({
	ajax: {
		url: "<?php echo site_url('notifications/listing', SITE_SCHEME) ?>"
	},
	columns: [
		{
			title: "ID",
			visible: false,
			data: 'id'
		},
		{
			title: "Message",
			data: 'message', 
			render: function(data, method, row) {
				var $msg = data;

				if (row.unread == 1) {
					$msg = "<span style='font-weight: 600'>" + $msg + "</span>";
				}

				return $msg;

			}
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
				var edtBtnEl = $('<button type="button" class="btn btn-primary btn-sm"><i class="fa fa-external-link"></i></button>');
				edtBtnEl.attr({
					onclick: "PageOverlay.show(); location.href='<?php echo site_url('notifications/view') ?>/" + data + "';"
				}).appendTo(btnCnt);
				var delBtnEl = $('<button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>');
				delBtnEl.attr({
					onclick: "if (confirm('Delete Notifications?')) location.href='<?php echo site_url('notifications/delete') ?>/" + data + "';"
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
	order: [
		[0, 'desc']
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
	location.href = "<?php echo site_url('notifications/add') ?>";
}

})(jQuery);

});

</script>