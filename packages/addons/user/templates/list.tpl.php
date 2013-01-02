<h1>User list</h1>

<table class="standard_table">
	<thead>
		<tr>
			<th>Email</th>
			<th>Name</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($users AS $user) : ?>
			<tr>
				<td>
					<a href="/user/edit/<?php echo $user->get('id'); ?>">
						<?php echo (strlen($user->get('email')) > 0) ? $user->get('email') : 'No email'; ?></a>
				</td>
				<td>
					<?php echo $user->get('first_name') . ' ' .  $user->get('last_name'); ?>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
