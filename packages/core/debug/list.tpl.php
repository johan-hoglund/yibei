<h1>Debug messages</h1>
<ul>
	<?php foreach($messages AS $msg) : ?>
		<li>
			<pre>
				<?php print_r($msg); ?>
			</pre>
		</li>
	<?php endforeach; ?>
</ul>	
end
