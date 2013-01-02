<h1>Inställningar</h1>

<form method="post">
	<input type="hidden" name="action" value="update" />
	
	<h2>Om salongen</h2>
<?php /*
	<label>Framförhållning för bokning</label>
	<input type="text" name="queue_time" value="<?php echo $user->get('queue_time'); ?>" />
*/ ?>	

	<label>Telefonnummer för utgående sms</label>
	<input type="text" name="sms_sender" value="<?php echo $user->get_shop()->get('sms_sender'); ?>" />

	<input type="submit" value="Save" />
</form>
