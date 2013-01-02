<div class="user_status_bar">
	<h3>Signed in as <?php echo $user->get('name') . ' ' . $user->get('last_name'); ?></h3>
	<a href="/user/sign-out/">
		<button>Sign out</button>
	</a>

	<ul class="main_menu">
		<li><a href="/devices/list">Device list</a></li>
		<li><a href="/vendor/list">Vendor list</a></li>
		<li><a href="/model/list">Model list</a></li>
	</ul>

</div>
