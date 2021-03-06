<!--a id="feedback" href="http://<?php echo e($site->domain()) ?>/landing-page" target="_blank" class="feedback"><?php echo s("Check your Meumobi's App landing page: %s", 'http://' . $site->domain() ) ?>/landing-page</a-->
<?php $this->pageTitle = s('dashboard') ?>

<div class="slide-header">
	<div class="grid-4 first">&nbsp;</div>
	<div class="grid-8">
		<h1><?php echo $this->pageTitle ?></h1>
	</div>
	<div class="clear"></div>
</div>
<div class="dashboard">
	<div class="wrapp">
		<div class="tip-big">
			<h2><?php echo s('welcome to your mobile App') ?></h2>
			<p><?php echo s('keep improving your mobile App') ?></p>
			<p id="qr-code"><img src="http://api.qrserver.com/v1/create-qr-code/?size=100x100&data=<?php echo e(MeuMobi::currentSegment()->downloadAppUrl ? MeuMobi::currentSegment()->downloadAppUrl : "http://".$site->domain()) ?>" /></p>
		</div>
		<ul class="featured-list">
			<?php if ($category): ?>
			<li id="categories">
				<a class="link" href="<?php echo MeuMobi::url('/categories') ?>">
					<i class="icons fa fa-4x fa-pencil-square-o"></i>
					<h3><?php echo s('Edit content') ?></h3>
					<small><?php echo s('you can edit your news, polls or events') ?></small>
					<i class="arrow fa fa-4x fa-angle-right"></i>
				</a>
			</li>
			<?php endif ?>
			<?php $i = 0; $fieldsets = MeuMobi::currentSegment()->enableFieldSet ? MeuMobi::currentSegment()->enableFieldSet : array() ?>
			<?php foreach ($fieldsets as $item ): ?>
			<?php 
				echo $this->element('dashboard/'.$item, compact('site'));
				$i++;
				if($i>4)
					break;
			?>
			<?php endforeach; ?>
			<li id="add-content" class="open" style="display:none;">
				<div class="link">
					<span class="icons fa fa-4x fa-file-o"></span>
					<h3><?php echo s('create new content') ?></h3>
					<small><?php echo s('you can add a restaurant menu, products, services, etc') ?></small>
					<i class="arrow fa fa-4x fa-angle-down"></i>
				</div>
				<p class="placeholder-links">
					<a href="<?php echo MeuMobi::url('/placeholder_creator/menu') ?>">
						<?php echo $this->html->image('/images/shared/dashboard/icon-menu.png', array(
							'alt' => s('menu')
						)) ?>
						<?php echo s('menu') ?>
					</a>

					<a href="<?php echo MeuMobi::url('/placeholder_creator/stores') ?>">
						<?php echo $this->html->image('/images/shared/dashboard/icon-stores.png', array(
							'alt' => s('stores')
						)) ?>
						<?php echo s('stores') ?>
					</a>

					<a id="products" href="<?php echo MeuMobi::url('/placeholder_creator/products') ?>">
						<?php echo $this->html->image('/images/shared/dashboard/icon-products.png', array(
							'alt' => s('products')
						)) ?>
						<?php echo s('products') ?>
					</a>

					<a href="<?php echo MeuMobi::url('/placeholder_creator/news') ?>">
						<?php echo $this->html->image('/images/shared/dashboard/icon-news.png', array(
							'alt' => s('news')
						)) ?>
						<?php echo s('news') ?>
					</a>
				</p>
			</li>
		</ul>
		<?php if (!MeuMobi::currentSegment()->downloadAppUrl): ?>
		<div class="domain">
			<p><?php echo s('you can access anytime from your mobile phone') ?></p>
			<?php echo $this->html->link('http://' . e($site->domain()),
				'http://' . e($site->domain()), array('target' => 'blank')) ?>
		</div>
		<?php endif ?>
	</div>
	<?php echo $this->element('sites/theme_preview', array(
		'site' => $site,
		'autoload' => true
	)) ?>
	<p class="clear"></p>
</div>
