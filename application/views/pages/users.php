<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$module = isset($module) ? $module: NULL;
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
				}).appendTo(btnCnt);
				var delBtnEl = $('<button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>');
				delBtnEl.attr({
					onclick: "if (confirm('Delete user?')) location.href='<?php echo site_url('users/delete') ?>/" + data + "/<?php echo $module ?>';"
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

})(jQuery);

});

</script>