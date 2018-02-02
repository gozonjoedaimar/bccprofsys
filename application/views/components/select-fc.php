<select id="<?php echo $id ?>" name="<?php echo $name ?>" class="form-control">
	<?php if ($collection) : ?>
		<?php foreach($collection as $option) : ?>
			<option value="<?php echo $option['code'] ?>" <?php if ($selected == $option['code']) echo "selected" ?>><?php echo $option['name'] ?></option>
		<?php endforeach; ?>
	<?php else : ?>
	<option disabled="">No data</option>
	<?php endif; ?>
</select>