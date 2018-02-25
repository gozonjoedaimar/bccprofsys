<?php defined('BASEPATH') OR exit('No direct script access allowed');
$table_id = "load_student_" . substr(uniqid('', true), -5);

?>

<div class="box box-default --collapsed-box">
	<div class="box-header with-border">
		<h3 class="box-title"><?php echo $load_info['subject_code'] ?> - <?php echo $load_info['classroom_disp'] ?></h3>

		<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
		</button>
		</div>
	<!-- /.box-tools -->
	</div>
	<!-- /.box-header -->
	<div class="box-body" disabled-style="display: none;">
		<table id="<?php echo $table_id ?>" class="table table-bordered table-striped"></table>
		<script type="text/javascript">

		window.addEventListener('load', function(e) {

		(function($) {

		var <?php echo $table_id ?> = $('#<?php echo $table_id ?>').DataTable({
			ajax: {
				url: "<?php echo site_url("student/listing/classroom/{$load_info['classroom']}", SITE_SCHEME) ?>",
				error: function(xhr) {
					<?php echo $table_id ?>.draw();
				}
			},
			columns: [
				{
					title: "Last Name",
					data: 'last_name'
				},
				{
					title: "First Name",
					data: 'first_name'
				},
				{
					title: "Middle Name",
					data: 'middle_name'
				},
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
					visible: false,
					render: function(data) {
						return moment(data).format("MMMM D, YYYY | hh:mma");
					},
					searchable: false
				},
				{
					title: "Actions",
					data: 'id',
					className: "text-nowrap action_col",
					visible: false,
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

		})(window.jQuery);
			
		});
			

		</script>
	</div>
	<!-- /.box-body -->
</div>

