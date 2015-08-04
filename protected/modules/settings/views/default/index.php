<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->module->id,
);
?>
<h1><?php echo $this->uniqueId . '/' . $this->action->id; ?></h1>

<?php 
$this->widget('zii.widgets.CMenu',array(
	    'items'=>array(
		    array('label'=>'Messages', 'url'=>array('/settings/sourcemessage/index'),'visible'=>(ENV == 'development') ),			    
		    array('label'=>'Access', 'url'=>array('/settings/access/index'),'visible'=>(ENV == 'development') ),			    
	    ),
    )); 
?>