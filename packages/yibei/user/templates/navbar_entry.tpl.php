<div class="avatar col_1">
	<div class="passepartout">
		<img src="<?php echo User::current()->get('avatar_small_url'); ?>" />
	</div>
</div>

<div class="userinfo">
	<span class="user_displayname"><?php echo User::current()->get('displayname'); ?></span>

	<?php if(!$user->facebook_connected()) : ?>
		<span class="fb_login_control">Anslut med Facebook</span>
	<?php else : ?>
		
	<?php endif; ?>
	<a href="/user/settings">Inställningar</a>
</div>

