<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<ul class="<?php echo ($main) ? "sidebar-menu tree": "treeview-menu" ?>">
	<?php foreach ($links as $link) {
			$is_visible = (property_exists($link, 'visible') && $link->visible == 'false') ? "hide": "";
		?>
		<?php if (property_exists($link, "sub")) { ?>
			<li class="treeview <?php echo $is_visible ?>">
				<a href="<?php echo $link->url; ?>">
					<i class="fa <?php echo (property_exists($link, 'icon') && $link->icon) ? $link->icon: "fa-circle-o";  ?>"></i>
					<?php echo $link->name; ?>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<?php $this->load->view('components/sidebar-link', array('links'=>$link->sub->link, 'main'=>FALSE)); ?>
			</li>
		<?php } else { ?>
			<li class="<?php echo $is_visible; ?>">
				<a href="<?php echo $link->url; ?>">
					<i class="fa <?php echo (property_exists($link, 'icon') && $link->icon) ? $link->icon: "fa-circle-o";  ?>"></i>
					<?php echo $link->name; ?>
				</a>
			</li>
		<?php } ?>
	<?php } ?>
</ul>