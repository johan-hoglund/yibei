<span class="user_displayname"><?php echo User::current()->get('displayname'); ?></span>

<?php if(!$user->facebook_connected()) : ?>
	<span class="fb_login_control">Anslut med Facebook</span>
<?php else : ?>
	
<?php endif; ?>
<a href="/user/settings">Inställningar</a>


