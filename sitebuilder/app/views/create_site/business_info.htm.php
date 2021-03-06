<?php $this->pageTitle = s('Create a new Site') ?>
<?php $this->selectedTab = 2 ?>

<?php echo $this->form->create(null, array(
	'id' => 'form-register-site-info',
	'class' => 'form-register default-form',
	'object' => $site,
	'method' => 'file'
)) ?>

	<?php echo $this->element('sites/edit_form', array(
		'action' => 'register',
		'site' => $site
	)) ?>

	<fieldset class="actions">
		<?php echo $this->html->link(s('‹ back'), '/create_site/theme', array(
			'class' => 'ui-button large',
			'style' => ''
		)) ?>
		<?php echo $this->form->submit(s('finish ›'), array(
			'class' => 'ui-button red greater',
			'style' => 'margin-left: 280px'
		)) ?>
	</fieldset>

<?php echo $this->form->close() ?>
