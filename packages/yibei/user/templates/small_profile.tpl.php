<div class="user_profile_small">
	<?php debug::log($user); ?>
	<h3><?php echo $user->get('displayname'); ?></h3>
	<?php if(isset($extra_html)) : ?>
		<?php echo $extra_html; ?>
	<?php endif; ?>
	<br style="clear: both;" />
</div>
