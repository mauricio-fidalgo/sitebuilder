<div class="hero outer wrapp">
	<div class="container">
		<div class="hero-unit clearfix">
			<div class="block pull-left">
				<h1><?php echo s('Create a mobile website for your business.')?></h1>
				<h2><?php echo s('Works with over 6000 cellphones and smartphones.')?></h2>
				<?php echo $this->language->link(s('start your free trial ›'), '/signup/user', array(
					'class' => 'btn big'
				)) ?>
				<p class="trial"><small><b><?php echo s('NO')?></b> <?php echo s('Credit card required.')?><br> <?php echo s('30-day, fully functional trial.')?></small></p>
			</div>
			<div class="pull-right">
				<div class="slider ">
					<p><img alt="" src="/images/home/slides/slide-01.png"></p>
					<p><img alt="" src="/images/home/slides/slide-02.png"></p>
					<p><img alt="" src="/images/home/slides/slide-03.png"></p>
				</div>
				<div class="pagination"></div>
			</div>
			</div>
		</div>
	</div>
</div>
<div class="presentation outer wrapp">
	<div class="container">
		<h2 class="title"><?php echo s('Everything you need to create a <br>professional <b>mobile site</b>.')?></h2>
		<ul class="thumbnails">
			<li class="span3">
			<div class="thumbnail">
				<p class="img"><img src="/images/shared/home/en/icon-middle-01.png" alt=""></p>
				<h3><?php echo s('Choose themes designed by experts')?></h3>
				<p><?php echo s('Get your the right look with professional themes that fit your business segment. Whether it\'s a restaurant or an hospital.')?></p>
			</div>
			</li>
			<li class="span3">
			<div class="thumbnail">
				<p class="img"><img src="/images/shared/home/en/icon-middle-02.png" alt=""></p>
				<h3><?php echo s('Fill in the information of your business')?></h3>
				<p><?php echo s('Business description, location, contacts, social links, pictures, logo, and more!')?></p>
			</div>
			</li>
			<li class="span3">
			<div class="thumbnail">
				<p class="img"><img src="/images/shared/home/en/icon-middle-03.png" alt=""></p>
				<h3><?php echo s('Add products, services or menus')?></h3>
				<p><?php echo s('Your mobile website has space for your restaurant menu, your products, services, all with descriptions and photos.')?></p>
			</div>
			</li>
			<li class="span3">
			<div class="thumbnail">
				<p class="img"><img src="/images/shared/home/en/icon-middle-04.png" alt=""></p>
				<h3><?php echo s('Provide your site for over 6000 devices')?></h3>
				<p><?php echo s('From the cutting-edge smartphones to the oldest and cheapest cell phones. Your mobile website is for everyone!')?></p>
			</div>
			</li>
		</ul>
	</div>
</div>
<div class="features outer wrapp">
	<div class="container">
		<h2 class="title"><?php echo s('Allow your <b>customers to connect your business</b> easily. <br>Add <b>extensions</b> for businesses with multiple locations <br>and online publishers.')?></h2>
		<div class="row">
			<div class="span4">
				<div class="call block">
					<span class="icon"><img alt="" src="/images/shared/home/fone.png"></span>
					<h3><?php echo s('Click-to-call')?></h3>
					<p>
						<?php echo s('Add a phone number on mobile site to make it easy for your customers to contact your business, whenever they need it.')?>
					</p>
				</div>
				<div class="map block">
					<span class="icon"><img alt="" src="/images/shared/home/marker.png"></span>
					<h3><?php echo s('Map & direction')?></h3>
					<p>
						<?php echo s('Add a map integrated with Google Maps to your mobile site, with the location and direction of your business.')?>
					</p>
				</div>
			</div>
			<div class="span8">
				<div class="row">
					<div class="span4">
						<div class="store-locator block">
							<span class="icon"><img alt="" src="/images/shared/home/lupa.png"></span>
							<h3><?php echo s('Store locator')?></h3>
							<p>
								<?php echo s('A mobile map interface with geolocated address <b>(ex.: stores, atms, gas stations, tourist spots).</b>')?>
							</p>
						</div>
					</div>
					<div class="span4">
						<div class="rss block">
							<span class="icon"><img alt="" src="/images/shared/home/rss.png"></span>
							<h3><?php echo s('RSS feed')?></h3>
							<p>
								<?php echo s('Import any content automatically from a RSS feed. Great for online publishers <b>(ex.: blogs, news site, online journals).</b>')?>
							</p>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="span4">
						<div class="phone">
							<img alt="" src="/images/shared/home/icon-phone-mini.png">
						</div>
					</div>
					<div class="span4">
						<div class="phone">
							<img alt="" src="/images/shared/home/icon-phone-rss.png">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="prices outer wrapp">
	<div class="container">
		<h3><?php echo s('Our plans and prices.')?></h3>
		<div class="row">
			<div class="span6">
				<h2><span><?php echo s('Basic')?> </span><?php echo s('USD <b>9/mo</b>')?></h2>
				<p><?php echo s('create a mobile presence')?></p>

				<ul>
					<li><span class="icon"></span><?php echo s('<b>Basic information:</b><br>contacts, address, photos, social links, news via RSS')?></li>
					<li><span class="icon"></span><?php echo s('additional content such as <b>menus, products, services</b>, etc.')?></li>
					<li class="uncheck"><span class="icon"></span><?php echo s('add more location? get a Store Locator')?> ›</li>
				</ul>
			</div>
			<div class="span6">
				<h2><span><?php echo s('Locator')?> </span><?php echo s('USD <b>34/mo</b>')?></h2>
				<p><?php echo s('for businesses with multiple locations')?></p>

				<ul>
					<li><span class="icon"></span><?php echo s('<b>Basic information:</b><br>contacts, address, photos, social links, news via RSS')?></li>
					<li><span class="icon"></span><?php echo s('additional content such as <b>menus, products, services</b>, etc.')?></li>
					<li><span class="icon"></span><?php echo s('create a <b>store locator</b>, showing the locations nearest to your customer - <small>up to 25 stores</small>')?></li>
				</ul>
			</div>
		</div>

		<p class="action">
			<?php echo $this->language->link(s('start your free trial now!'), '/signup/user', array(
				'class' => 'btn big'
			)) ?>
			<br>
			<span class="trial">
				<small>
				<?php echo s('NO')?> <b><?php echo s('credit card required!')?></b>
				<br>
				<?php echo s('you´ll be able to choose a plan after the trial.')?>
				</small>
			</span>
		</p>
	</div>
</div>
<div class="quotes outer wrapp">
	<div class="container">
		<div class="row">
			<div class=" span4 ">
				<div class="insights">
					<h3><?php echo s('<b>get mobile.</b><br> a few insights on the mobile market.')?></h3>

					<div class="slider">
						<div>
							<p>
								<?php echo s('<b>Users expect their mobile experience to be as good as their desktop experience.</b> 66%% of users says: "I\'m disappointed if the mobile site is a bad experience."') ?>
							</p>
							<p class="author"><?php echo s('— Google Research, 2012') ?></p>
						</div>

						<div>
							<p>
								<?php echo s('<b>A bad mobile experience can cost you customers.</b> 61%% of users who don\'t see what they\'re looking for on a mobile site, they\'ll quikly move to another site.'); ?>
							</p>
							<p class="author"><?php echo s('— Google Research, 2012') ?></p>
						</div>

						<div>
							<p>
								<?php echo s('Having a mobile optimized site is critical to <b>engage consumers across the multiple paths to purchase.</b>')?>
							</p>
							<p class="author"><?php echo s('— Google Research, 2012') ?></p>
						</div>
					</div>
					<div class="pagination"></div>
				</div>
			</div>
			<div class="about span8">
				<h3><?php echo s('what our clients, partners and press say about us')?></h3>
				<div class="row">
					<div class="span4">
						<div class="quote">

							<p>
								<span class="icon left"></span>
								<span class="icon right"></span>
								<?php echo s('The platform is very versatile and can be customized according to the needs of each segment. It\'s a complete solution!')?>
							</p>
							<p class="author"><?php echo s('— IMAginal Architecture')?></p>
						</div>
					</div>

					<div class="span4">
						<div class="quote">
							<p>
								<span class="icon left"></span>
								<span class="icon right"></span>
								<?php echo s('MeuMobi provides a very innovative mobile marketing solution to businesses and media companies. They\'re very professional.')?>
							</p>
							<p class="author"><?php echo s('— DMM Digital Agency')?></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container ">
	<div class="custom-solution">
		<h3><?php echo s('need custom solutions?')?></h3>
		<p>
		<?php echo s('Creating custom layout, open API, white label solution for agencies, mobile site resale for digital partners. Any custom solution!')?>
		<b class="mail" >enterprise@meumobi.com</b>
		</p>
	</div>
</div>
