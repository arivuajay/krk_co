<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="row-fluid">
    <section class="span12 well">
	    <?php if(Yii::app()->user->getFlashes()): $this->widget('bootstrap.widgets.BootAlert'); endif; ?>
	    <div id="content">
		    <?php echo $content; ?>
	    </div>
    </section><!-- content -->

</div>    
<?php $this->endContent(); ?>