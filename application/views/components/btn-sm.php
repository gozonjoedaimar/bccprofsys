<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php foreach ($btns as $btn) { ?>
	<button type="button" class="btn btn-sm <?php if (isset($btn['class'])) echo $btn['class'] ?>"
		<?php if (isset($btn['attr']) && $btn['attr']) : ?>
		<?php foreach ($btn['attr'] as $attr) {
			echo "{$attr['name']}=\"{$attr['value']}\"\n";
		} ?>
		<?php endif; ?>
		><?php echo $btn['name'] ?></button>
<?php } ?>