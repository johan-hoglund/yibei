<div class="commodity_view page">
	<form method="post">
		<input type="hidden" name="action" value="update" />
		<header>
			<div class="fullwidth">
				<div class="view_field">
					<h1>
						<?php echo $commodity->get('singular'); ?>
						<span class="store_group">
							<?php if($group = $commodity->get_store_group()) : ?>
								<?php debug::log($group); ?>
								<?php echo $group->get('title'); ?>
							<?php endif; ?>
						</span>
					</h1>
				</div>
				<div class="edit_field">
					<select name="grammar_article">
						<option value=""></option>
						<option value="en">En</option>
						<option value="ett">Ett</option>
					</select>
					
					<input name="singular" type="text" value="<?php echo htmlspecialchars($commodity->get('singular')); ?>" />
					
					<label>flera</label>
					<input name="plural" type="text" value="<?php echo htmlspecialchars($commodity->get('plural')); ?>" />
				</div>
				<div class="edit_controls">
					<div class="view_field">
						<span class="edit_control link">Redigera</span>
					</div>
					<div class="edit_field">
						<input type="submit" value="save" />
					</div>
				</div>
			</div>
		</header>

		<section class="Top Fullwidth">
			<div class="Description Columns4 ColumnText">
				<div class="view_field">
					<p>
						Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus id pulvinar libero. Sed accumsan metus id turpis molestie sed porttitor sem feugiat. Integer lacus erat, eleifend non suscipit nec, mollis ut est. Fusce leo leo, cursus vitae fermentum vel, volutpat ut leo.
					</p>

					<p>
						Nullam eros metus, sodales eu tincidunt et, pellentesque aliquam augue. Quisque quis tortor ut tellus tempus consequat. Proin ultrices odio ut orci tempus aliquet. Phasellus placerat luctus ipsum, ut venenatis ipsum fermentum ac.
					</p>
				</div>
				<div class="edit_field">
					<textarea></textarea>
					<input type="submit" value="Spara" />
				</div>
			</div>
			<figure class="Picture Columns4">
				<div class="view_field">
					<img src="<?php echo $commodity->get('main_imagecrop')->image_url(array('w' => 400)); ?>" />
				</div>
				
				<div class="edit_field">
					<?php echo $commodity->get('main_imagecrop')->selector(array('name' => 'main_image')); ?>	
				</div>
			</figure>
			<figure class="Columns4 Nutritional">
				<svg style="overflow: hidden; "><defs id="defs"><clipPath id="_ABSTRACT_RENDERER_ID_0"><rect x="115" y="77" width="371" height="247"></rect></clipPath></defs><rect x="0" y="0" width="600" height="400" stroke="none" stroke-width="0" fill="#ffffff"></rect><g><text text-anchor="start" x="115" y="54.05" font-family="Arial" font-size="13" font-weight="bold" stroke="none" stroke-width="0" fill="#000000">Yearly Coffee Consumption by Country</text></g><g><rect x="499" y="77" width="88" height="76" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect><g><rect x="499" y="77" width="88" height="13" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect><g><text text-anchor="start" x="517" y="88.05" font-family="Arial" font-size="13" stroke="none" stroke-width="0" fill="#222222">Austria</text></g><rect x="499" y="77" width="13" height="13" stroke="none" stroke-width="0" fill="#3366cc"></rect></g><g><rect x="499" y="98" width="88" height="13" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect><g><text text-anchor="start" x="517" y="109.05" font-family="Arial" font-size="13" stroke="none" stroke-width="0" fill="#222222">Bulgaria</text></g><rect x="499" y="98" width="13" height="13" stroke="none" stroke-width="0" fill="#dc3912"></rect></g><g><rect x="499" y="119" width="88" height="13" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect><g><text text-anchor="start" x="517" y="130.05" font-family="Arial" font-size="13" stroke="none" stroke-width="0" fill="#222222">Denmark</text></g><rect x="499" y="119" width="13" height="13" stroke="none" stroke-width="0" fill="#ff9900"></rect></g><g><rect x="499" y="140" width="88" height="13" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect><g><text text-anchor="start" x="517" y="151.05" font-family="Arial" font-size="13" stroke="none" stroke-width="0" fill="#222222">Greece</text></g><rect x="499" y="140" width="13" height="13" stroke="none" stroke-width="0" fill="#109618"></rect></g></g><g><rect x="115" y="77" width="371" height="247" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect><g clip-path="url(#_ABSTRACT_RENDERER_ID_0)"><g><rect x="115" y="77" width="1" height="247" stroke="none" stroke-width="0" fill="#cccccc"></rect><rect x="208" y="77" width="1" height="247" stroke="none" stroke-width="0" fill="#cccccc"></rect><rect x="300" y="77" width="1" height="247" stroke="none" stroke-width="0" fill="#cccccc"></rect><rect x="393" y="77" width="1" height="247" stroke="none" stroke-width="0" fill="#cccccc"></rect><rect x="485" y="77" width="1" height="247" stroke="none" stroke-width="0" fill="#cccccc"></rect></g><g><rect x="116" y="86" width="246" height="5" stroke="none" stroke-width="0" fill="#3366cc"></rect><rect x="116" y="127" width="284" height="5" stroke="none" stroke-width="0" fill="#3366cc"></rect><rect x="116" y="168" width="291" height="5" stroke="none" stroke-width="0" fill="#3366cc"></rect><rect x="116" y="209" width="295" height="5" stroke="none" stroke-width="0" fill="#3366cc"></rect><rect x="116" y="250" width="363" height="5" stroke="none" stroke-width="0" fill="#3366cc"></rect><rect x="116" y="291" width="351" height="5" stroke="none" stroke-width="0" fill="#3366cc"></rect><rect x="116" y="92" width="73" height="5" stroke="none" stroke-width="0" fill="#dc3912"></rect><rect x="116" y="133" width="67" height="5" stroke="none" stroke-width="0" fill="#dc3912"></rect><rect x="116" y="174" width="80" height="5" stroke="none" stroke-width="0" fill="#dc3912"></rect><rect x="116" y="215" width="79" height="5" stroke="none" stroke-width="0" fill="#dc3912"></rect><rect x="116" y="256" width="72" height="5" stroke="none" stroke-width="0" fill="#dc3912"></rect><rect x="116" y="297" width="95" height="5" stroke="none" stroke-width="0" fill="#dc3912"></rect><rect x="116" y="98" width="184" height="5" stroke="none" stroke-width="0" fill="#ff9900"></rect><rect x="116" y="139" width="206" height="5" stroke="none" stroke-width="0" fill="#ff9900"></rect><rect x="116" y="180" width="183" height="5" stroke="none" stroke-width="0" fill="#ff9900"></rect><rect x="116" y="221" width="185" height="5" stroke="none" stroke-width="0" fill="#ff9900"></rect><rect x="116" y="262" width="180" height="5" stroke="none" stroke-width="0" fill="#ff9900"></rect><rect x="116" y="303" width="169" height="5" stroke="none" stroke-width="0" fill="#ff9900"></rect><rect x="116" y="104" width="184" height="5" stroke="none" stroke-width="0" fill="#109618"></rect><rect x="116" y="145" width="173" height="5" stroke="none" stroke-width="0" fill="#109618"></rect><rect x="116" y="186" width="171" height="5" stroke="none" stroke-width="0" fill="#109618"></rect><rect x="116" y="227" width="165" height="5" stroke="none" stroke-width="0" fill="#109618"></rect><rect x="116" y="268" width="199" height="5" stroke="none" stroke-width="0" fill="#109618"></rect><rect x="116" y="309" width="194" height="5" stroke="none" stroke-width="0" fill="#109618"></rect></g><g><rect x="115" y="77" width="1" height="247" stroke="none" stroke-width="0" fill="#333333"></rect></g></g><g></g><g><g><text text-anchor="middle" x="115.5" y="343.05" font-family="Arial" font-size="13" stroke="none" stroke-width="0" fill="#444444">0</text></g><g><text text-anchor="middle" x="208" y="343.05" font-family="Arial" font-size="13" stroke="none" stroke-width="0" fill="#444444">500,000</text></g><g><text text-anchor="middle" x="300.5" y="343.05" font-family="Arial" font-size="13" stroke="none" stroke-width="0" fill="#444444">1,000,000</text></g><g><text text-anchor="middle" x="393" y="343.05" font-family="Arial" font-size="13" stroke="none" stroke-width="0" fill="#444444">1,500,000</text></g><g><text text-anchor="middle" x="485.5" y="343.05" font-family="Arial" font-size="13" stroke="none" stroke-width="0" fill="#444444">2,000,000</text></g><g><text text-anchor="end" x="102" y="102.55" font-family="Arial" font-size="13" stroke="none" stroke-width="0" fill="#222222">2003</text></g><g><text text-anchor="end" x="102" y="143.55" font-family="Arial" font-size="13" stroke="none" stroke-width="0" fill="#222222">2004</text></g><g><text text-anchor="end" x="102" y="184.55" font-family="Arial" font-size="13" stroke="none" stroke-width="0" fill="#222222">2005</text></g><g><text text-anchor="end" x="102" y="225.55" font-family="Arial" font-size="13" stroke="none" stroke-width="0" fill="#222222">2006</text></g><g><text text-anchor="end" x="102" y="266.55" font-family="Arial" font-size="13" stroke="none" stroke-width="0" fill="#222222">2007</text></g><g><text text-anchor="end" x="102" y="307.55" font-family="Arial" font-size="13" stroke="none" stroke-width="0" fill="#222222">2008</text></g></g></g><g><g><text text-anchor="middle" x="300.5" y="377.05" font-family="Arial" font-size="13" font-style="italic" stroke="none" stroke-width="0" fill="#222222">Cups</text></g><g><text text-anchor="middle" x="41.55" y="200.5" font-family="Arial" font-size="13" font-style="italic" transform="rotate(-90 41.55 200.5)" stroke="none" stroke-width="0" fill="#222222">Year</text></g></g><g></g></svg>
			</figure>
		</section>


		<br style="clear: both;" />


		<h3>Recept med <?php echo $commodity->get('singular'); ?></h3>
		<?php if(count($recipes = $commodity->get_associated_recipes(array('limit' => 5))) > 0) : ?>
			<?php echo yibei_recipe::render_list($recipes); ?>
		<?php endif; ?>
		<br style="clear: both;" />
	</form>

	<?php foreach($commodity->get_children() AS $child): ?>
		<form method="post">
			<h2><?php echo $child->get('singular'); ?></h2>
		</form>
	<?php endforeach; ?>

	<br style="clear: both;" />
</div>
