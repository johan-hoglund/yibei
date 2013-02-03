<div id="fb-root"></div>
<script>
  // Additional JS functions here
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '435311603190536', // App ID
      channelUrl : '//yibei.se/facebook_channel.html', // Channel File
      status     : true, // check login status
      cookie     : true, // enable cookies to allow the server to access the session
      xfbml      : true  // parse XFBML
    });

    // Additional init code here

  };

  // Load the SDK Asynchronously
  (function(d){
     var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement('script'); js.id = id; js.async = true;
     js.src = "//connect.facebook.net/en_US/all.js";
     ref.parentNode.insertBefore(js, ref);
   }(document));
</script>


<header id="top_nav" class="interface clearfix">
	<div class="recipe_search_control disabled">
		<div class="filters">
			<span class="minimize_control">&mdash;</span>
			<ul>
				<li>Vegetariskt</li>
				<li>Lunch</li>
				<li>Med avokado</li>
			</ul>
			<span style="display: block; clear: both; height: 0;"></span>
		</div>
		<div class="browser">
			<span class="pan_left"></span>
			<span class="pan_right"></span>
			<div class="wrapper">
				<span class="scroll_up"></span>
				<span class="scroll_down"></span>
				<ul>
					<li>
						<a href="/s/frukost">
							<img src="/imagecrop/upload44472406/0+900_699+1204/75x42.png" />
							Frukost
						</a>
					</li>
					<li>
						<img src="/imagecrop/upload44472406/0+900_699+1204/75x42.png" />
						Lunch
					</li>
					<li>
						<img src="/imagecrop/upload55943633/0+853_68+550/75x42.png" />
						Middag
					</li>
					<li>
						<img src="/imagecrop/upload39808534/0+1260_8+716/75x42.png" />
						Dessert
					</li>
					<li>
						<img src="/imagecrop/upload72785597/0+1600_38+937/75x42.png" />
						Fika
					</li>
					<li class="view_more">
						Fler typer &raquo;
					</li>
				</ul>
			</div>
			<div class="wrapper">
				<span class="scroll_up"></span>
				<span class="scroll_down"></span>
				<ul>
					<li>
						<img src="/imagecrop/upload44472406/0+900_699+1204/75x42.png" />
						LCHF
					</li>
					<li>
						<img src="/imagecrop/upload44472406/0+900_699+1204/75x42.png" />
						GI
					</li>
					<li>
						<img src="/imagecrop/upload55943633/0+853_68+550/75x42.png" />
						Nyckelhålsmärkt
					</li>
					<li>
						<img src="/imagecrop/upload39808534/0+1260_8+716/75x42.png" />
						Onyttigt
					</li>
				</ul>
			</div>
			<div class="wrapper">
				<span class="scroll_up"></span>
				<span class="scroll_down"></span>
				<ul>
					<li>
						<img src="/imagecrop/upload44472406/0+900_699+1204/75x42.png" />
						Nötkött
					</li>
					<li>
						<img src="/imagecrop/upload44472406/0+900_699+1204/75x42.png" />
						Kyckling
					</li>
					<li>
						<img src="/imagecrop/upload55943633/0+853_68+550/75x42.png" />
						Vegetariskt
					</li>
					<li>
						<img src="/imagecrop/upload39808534/0+1260_8+716/75x42.png" />
						Fisk
					</li>
					<li>
						<img src="/imagecrop/upload39808534/0+1260_8+716/75x42.png" />
						Fläsk
					</li>
					<li class="view_more">
						Fler råvaror &raquo;
					</li>
				</ul>
			</div>
		</div>
	</div>
	<nav>
		<ul class="clearfix">
			<li class="col_1">
				<a href="/">
					<span class="label">Start</span>
				</a>
			</li>
			<li class="cook">
				<a href="/">
					<img src="/static/yibei_page/icons/home.svg" width="40" height="40" />
					<span class="label">Laga</span>	
				</a>
			</li>
			<li class="shopping_list">
				<div class="list_preview">
					<ul>
					</ul>
				</div>
				<a href="/inkopslista">
					<?php $list = new ShoppingList(User::current()); ?>
					<?php if($list->count() > 0) : ?>
						<span class="count"><?php echo $list->count(); ?></span>
					<?php else : ?>
						<span class="count empty">0</span>
					<?php endif; ?>
					<img src="/static/yibei_page/icons/list.svg" width="40" height="40" />
					<span class="label">Handla</span>
				</a>
			</li>
			<li>
				<input type="search" placeholder="Sök" />
			</li>
			<li>
				<a href="/recept/skapa">Nytt recept</a>
			</li>
			<li class="user">
				<?php echo User::current()->render_navbar_entry(); ?>
			</li>
		</ul>
	</nav>
</header>
<div class="main">
	<?php echo $main_content; ?>
</div>
<div style="clear: both; height: 400px;" />
<div id="background"></div>
