<div class="footer">
	<div class="container">
		<div class="links" >
			<a class="logo" href="#"><?php echo s('MeuMobi') ?></a>
			<a href="http://blog.meumobi.com/about" target="_blank"><?php echo s('About Us') ?></a>
			<a href="http://blog.meumobi.com" target="_blank"><?php echo s('Our Blog') ?></a>
			<p class="copy">
				<span class="border" ></span>
				<?php echo s('&copy;%s MeuMobi. All rights reserved',date("Y")) ?>
			</p>
		</div>
		<div class="contact">
			<div>
			<p class="upper"><?php echo s('Contact Us') ?></p>
			<p>
				<span><?php echo s('contact@meumobi.com') ?></span>
			</p>
			<p>
				<span><?php echo s('+55 21 2499.3744') ?></span>
			</p>
			</div>
		</div>
		<div class="social">
			<span class="upper"><?php echo s('Find us on') ?></span>
			<a class="face" href="http://www.facebook.com/meumobi"><?php echo s('facebook') ?></a>
			<a class="twitter" href="http://twitter.com/MeuMobi"><?php echo s('twitter') ?></a>
		</div>
	</div>
</div>
<?php if (Config::read('App.environment') == 'production' && MeuMobi::currentSegment()->analytics): ?>
<script type="text/javascript">
	var _gaq = _gaq || [];
	_gaq.push(['_setAccount', '<?php echo MeuMobi::currentSegment()->analytics ?>']);
	_gaq.push(['_setDomainName', '.meumobi.com']);
	_gaq.push(['_trackPageview']);

	(function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	})();
</script>
<?php endif ?>
