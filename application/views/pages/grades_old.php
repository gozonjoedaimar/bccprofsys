<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

          <div class="box">
            <!-- <div class="box-header">
              <h3 class="box-title">Hover Data Table</h3>
            </div> -->
            <!-- /.box-header -->
            <div class="box-body">
				<table id="grades" class="table table-bordered table-striped"></table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

<script type="text/javascript">

window.addEventListener('load', function() {

(function($) {
	var grdTable = $('#grades');
	var gtbDTOb = grdTable.DataTable({
		columns: [
			{
				title: "Subject"
			},
			{
				title: "1st"
			},
			{
				title: "2nd"
			},
			{
				title: "3rd"
			},
			{
				title: "Final"
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