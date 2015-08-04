<?php $this->beginContent('//layouts/main'); ?>
<div class="two_column">
<div class="row-fluid">
    <section class="span3">
	<div class="well sidebar-nav" id="sidebar_menu">
	<?php
	    $this->widget('bootstrap.widgets.BootMenu', array(
		'type'=>'list',
		'checkAccess'=>true,
		'htmlOptions'=>array('class'=>$this->menuclass),
		'items'=>$this->menu
	    ));
	    
	    if(isset($this->menu2) && !empty($this->menu2)):
		$this->widget('bootstrap.widgets.BootMenu', array(
		'type'=>'list',
		'checkAccess'=>true,
		'htmlOptions'=>array('class'=>$this->menu2class),
		'items'=>$this->menu2
	    ));
	    endif;
		
	    if(isset($this->menu3) && !empty($this->menu3)):
		$this->widget('bootstrap.widgets.BootMenu', array(
		'type'=>'list',
		'checkAccess'=>true,    
		'htmlOptions'=>array('class'=>$this->menu3class),
		'items'=>$this->menu3
	    ));
	    endif;
	    
	    if(isset($this->menu4) && !empty($this->menu4)):
		$this->widget('bootstrap.widgets.BootMenu', array(
		'type'=>'list',
		'encodeLabel'=>false,    
		'checkAccess'=>true,    
		'htmlOptions'=>array('class'=>$this->menu4class),
		'items'=>$this->menu4
	    ));
	    endif;
	    
	    if(isset($this->menu5) && !empty($this->menu5)):
		$this->widget('bootstrap.widgets.BootMenu', array(
		'type'=>'list',
		'checkAccess'=>true,    
		'htmlOptions'=>array('class'=>$this->menu5class),
		'items'=>$this->menu5
	    ));
	    endif;
	?>
	</div>    
    </section><!-- sidebar -->
    
    <section class="span9 well">
	    <?php $this->widget('bootstrap.widgets.BootAlert'); ?>
	    <div id="content">
		    <?php echo $content; ?>
	    </div>
    </section><!-- content -->

</div>    
</div>    
<?php $this->endContent(); ?>