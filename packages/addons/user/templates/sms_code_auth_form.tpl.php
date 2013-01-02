<h1>Ange sms-kod</h1>
<form method="post">
	<input type="hidden" value="auth" name="action" />
	<input type="hidden" name="phone_number" value="<?php echo $phone_number; ?>" />

	<input type="text" name="sms_code" />
	<input type="submit" value="Logga in" />
</form>

