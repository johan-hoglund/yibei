<h1>Editing <?php echo $user->get('first_name') . ' ' . $user->get('last_name'); ?></h1>

<form method="post" class="standard_form">
	<input type="hidden" name="action" value="update" />
	
	<label>Email address</label>
	<input type="text" name="email" value="<?php echo $user->get('email'); ?>" />

	<label>New password</label>
	<input type="password" name="desired_password" />

	<label>Verify new password</label>
	<input type="password" name="password_verification" />

	<label>First name</label>
	<input type="text" name="first_name" value="<?php echo $user->get('first_name'); ?>" />
	
	<label>Last name</label>
	<input type="text" name="last_name" value="<?php echo $user->get('first_name'); ?>" />

	<input type="submit" value="Create user" />
</form>



