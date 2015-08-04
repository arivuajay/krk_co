<?php
/* @var $this SitesetttingsController */
/* @var $model Sitesettings */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('settings_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->settings_id), array('view', 'id'=>$data->settings_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('key')); ?>:</b>
	<?php echo CHtml::encode($data->key); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('value')); ?>:</b>
	<?php echo CHtml::encode($data->value); ?>
	<br />


</div>