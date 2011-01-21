<!DOCTYPE html>
<html>
    <head>
        <?php echo $this->html->charset() ?>
        <title><?php echo $this->pageTitle ?></title>
        <link rel="shortcut icon" href="<?php echo Mapper::url("/images/layout/favicon.png"); ?>" type="image/png" />
		<?php echo $this->html->stylesheet('register', 'uikit'); ?>
    </head>
    <body>
	
		<div id="header">
			<?php echo $this->html->link($this->html->image('layout/logo.png', array('class'=>'MeuMobi')), '/', array('class'=>'logo')); ?>
	    </div>
	    
	    <?php if($success = Session::flash('success')): ?>
	    <a href="#" id="success-feedback"><?php echo $success ?></a>
	    <?php endif ?>
	    
	    <?php if($error = Session::flash('error')): ?>
	    <a href="#" id="error-feedback"><?php echo $error ?></a>
	    <?php endif ?>
	    
	    <div id="content">
            <?php echo $this->contentForLayout ?>
        </div>
        
        <?php echo $this->element("layouts/footer") ?>
        
        <?php echo $this->html->script('jquery', 'main') ?>
    </body>
</html>