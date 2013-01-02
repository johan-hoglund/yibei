<fieldset>
	<legend><?php echo isset($options['heading']) ? $options['heading'] : $crop->get('field_name'); ?></legend>
	<?php
		foreach(array('handle', 'x1', 'x2', 'y1', 'y2', 'w', 'h') AS $fld)
		{
			echo '<input type="hidden" name="' . $crop->get('field_name') . '[' . $fld . ']" class="' . $fld . '" value="' . $crop->get($fld) . '" data-name="' . $fld . '" />';
		}

	?>
	<?php if(strlen($crop->get('handle')) > 0) : ?>
		<img class="preview" src="/imagecrop/<?php echo $crop->get('handle') . '/' . $crop->get('x1') . '+' . $crop->get('x2') . '_' . $crop->get('y1') . '+' . $crop->get('y2') . '/200x100.png'; ?>" style="width: 200px;" />
	<?php else : ?>
		<img class="preview" style="width: 200px;" />
	<?php endif; ?>
	<button class="imagecrop_control">Choose and cut image</button>
</fieldset>
