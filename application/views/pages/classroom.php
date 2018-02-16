<?php defined('BASEPATH') OR exit('No direct script access allowed');

$module = isset($module) ? $module: "";

?>

<div class="box">
	<div class="box-body">
		<table id="classroom_table" class="table table-bordered table-striped">
			<colgroup>
				<col />
				<col width="" />
				<col width="" />
				<col width="" />
				<col width="" />
				<col width="" />
			</colgroup>
		</table>
	</div>
</div>


<script type="text/javascript">

/* Fn init */
var createClassroom = null, dtClassroomTable = null, deleteClassroom = null;
	
window.addEventListener('load', function() {

(function($) {

dtClassroomTable = $('#classroom_table').DataTable({
	ajax: {
		url: "<?php echo site_url('classroom/listing', SITE_SCHEME) ?>"
	},
	columns: [
		{
			title: "Year Level",
			data: 'level',
			render: function(data) {
				var $txt = "n/a";
				switch(parseInt(data)) {
					case 1: $txt = "1st";
					break;
					case 2: $txt = "2nd";
					break;
					case 3: $txt = "3rd";
					break;
					case 4: $txt = "4th";
					break;
				}
				return $txt;
			}
		},
		{
			title: "Section",
			data: 'section'
		},
		{
			title: "Dept.",
			data: 'department'
		},
		{
			title: "Batch.",
			data: 'batch'
		},
		{
			title: "Date Created",
			data: 'created_at',
			className: "text-nowrap",
			render: function(data) {
				return moment(data).format("MMMM D, YYYY | hh:mma");
			},
			searchable: false
		},
		{
			title: "Actions",
			data: 'id',
			className: "text-nowrap action_col",
			render: function(data) {
				var btnCnt = $("<div class='btn-group'></div>");
				var edtBtnEl = $('<button type="button" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>');
				edtBtnEl.attr({
					onclick: "PageOverlay.show(); location.href='<?php echo site_url('classroom/edit') ?>/" + data + "';"
				});

				var viewBtnEl = $('<button type="button" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></button>');
				viewBtnEl.attr({
					onclick: "PageOverlay.show(); location.href='<?php echo site_url('classroom/edit') ?>/" + data + "/<?php echo $module ?>';"
				});

				var delBtnEl = $('<button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>');
				delBtnEl.attr({
					onclick: "if (confirm('Delete Classroom?')) location.href='<?php echo site_url('classroom/delete') ?>/" + data + "';"
				});

				<?php if (! (isset($module) && ($module == 'teacher' || $module == 'grades'))) : ?>
				edtBtnEl.appendTo(btnCnt);
				delBtnEl.appendTo(btnCnt);
				<?php else: ?>
				viewBtnEl.appendTo(btnCnt);
				<?php endif; ?>
				
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
	location.href = "<?php echo site_url('classroom/add') ?>";
}

<?php if (isset($module) && ($module == 'teacher' || $module == 'grades')) : ?>
	$('.new_class').hide();
	$('.save_update').hide();
<?php endif; ?>

})(jQuery);

});

</script>