<h2>Lägg till flera råvaror</h2>

<form method="post">
	<input type="submit" value="Lägg till" />
	<table>
		<thead>
			<tr>
				<th>Singular</th>
				<th>Plural</th>
				<th>Butiksgrupp</th>
			</tr>
		</thead>
		<tbody>
			<?php for($i = 0; $i < 50; $i++) : ?>
				<tr>
					<td><input type="text" name="singular[]" /></td>
					<td><input type="text" name="plural[]" /></td>
					<td><?php echo $group_dropdown->render(); ?></td>
				</tr>
			<?php endfor; ?>
		</tbody>
	</table>

	<input type="submit" value="Lägg till" />
</form>
