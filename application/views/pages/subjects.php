<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="box">
	<div class="box-body">
		<table id="subjects_table" class="table table-bordered table-striped">
			<colgroup>
				<col />
				<col width="" />
				<col width="1" />
				<col width="1" />
				<col width="1" />
			</colgroup>
		</table>
	</div>
</div>


<script type="text/javascript">

/* Fn init */
var createSubjects = null, dtSubjectsTable = null, deleteSubjects = null;
	
window.addEventListener('load', function() {

(function($) {

dtSubjectsTable = $('#subjects_table').DataTable({
	ajax: {
		url: "<?php echo site_url('subjects/listing', SITE_SCHEME) ?>"
	},
	columns: [
		{
			title: "Name",
			data: 'name'
		},
		{
			title: "Code",
			data: 'code',
			render: function(data) {
				return data.toUpperCase();
			} 
		},
		{
			title: "Dept.",
			data: 'department',
			render: function(data) {
				return data.toUpperCase();
			} 
		},
		{
			title: "Units",
			data: 'units'
		},
		{
			title: "Date Created",
			data: 'created_at',
			className: "text-nowrap",
			render: function(data) {
				return moment(data).format("MMMM D, YYYY | hh:mma");
			}
			<?php if (isset($teacher_view) && $teacher_view) : ?>
			,visible: false
			<?php endif; ?>
		},
		{
			title: "Actions",
			data: 'id',
			className: "text-nowrap action_col",
			render: function(data) {
				var btnCnt = $("<div class='btn-group'></div>");
				var edtBtnEl = $('<button type="button" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>');
				edtBtnEl.attr({
					onclick: "PageOverlay.show(); location.href='<?php echo site_url('subjects/edit') ?>/" + data + "';"
				}).appendTo(btnCnt);
				var delBtnEl = $('<button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>');
				delBtnEl.attr({
					onclick: "if (confirm('Delete Subjects?')) location.href='<?php echo site_url('subjects/delete') ?>/" + data + "';"
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
	location.href = "<?php echo site_url('subjects/add') ?>";
}

<?php if (isset($teacher_view) && $teacher_view) : ?>
$('.add_subject').hide();
<?php endif; ?>

})(jQuery);

});

</script>