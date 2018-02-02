<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
	<div class="col-sm-6 col-xs-12">
		<div class="box dashup-box ">
			<div class="box-header with-border">
				<h1 class="box-title">Updates</h1>
			</div>
			<div class="box-body">
				<div class="hidden box-list"><?php $this->load->view('notifications') ?></div>
			</div>
			<div class="box-footer">
				<ul class="nav nav-stacked">
					<li class="text-center">
						<a href="#"><small>View All</small></a>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="col-sm-6 col-xs-12">
		<div class="box dashup-box ">
			<div class="box-header with-border">
				<h1 class="box-title">Schedule</h1>
			</div>
			<div class="box-body">
				<div class="hidden box-list"><?php $this->load->view('notifications') ?></div>
			</div>
			<div class="box-footer">
				<ul class="nav nav-stacked">
					<li class="text-center">
						<a href="#"><small>View All</small></a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	
window.addEventListener('load', function() {

(function($) {

var boxList = $('.box-list');
boxList.removeClass('hidden');
boxList.find('.menu').addClass('nav nav-stacked');


})(jQuery)

});

</script>