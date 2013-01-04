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

<header id="top_nav">
	<nav>
		<ul>
			<li>
				<a href="/"><img src="/static/yibei_page/icons/home.svg" width="40" height="40" /></a>
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
				</a>
			</li>
			<li><a href="/frukost">Frukost</a>
				<ul>

				</ul>
			</li>
			<li><a href="/lunch">Lunch</a>
				<ul>

				</ul>
			</li>
			<li><a href="/mellanmal">Mellanmål</a>
				<ul>

				</ul>
			</li>
			<li><a href="/middag">Middag</a>
				<ul>

				</ul>
			</li>
			<li><a href="/dessert">Dessert</a>
				<ul>

				</ul>
			</li>
			<li>
				<input type="search" placeholder="Sök" />
			</li>
			<li>
				<a href="/recept/skapa">Nytt recept</a>
			</li>
			<?php if(User::current() instanceof User && User::current()->get('class') != 'anonymous') : ?>
			<li>
				<?php echo User::current()->render_avatar('x-small'); ?>
				<?php echo User::current()->get('displayname'); ?>
				<span class="logout_control">
					<a href="/logga-ut">Logga ut</a>
				</span>
			</li>
			<?php else : ?>
				<li>
					<a href="" class="fb_login_control">Logga in med Facebook</a>
				</li>
			<?php endif; ?>
		</ul>
	</nav>
	<br style="clear: both;" />
</header>
<div class="main">
	<?php echo $main_content; ?>
</div>
<div id="background"></div>
