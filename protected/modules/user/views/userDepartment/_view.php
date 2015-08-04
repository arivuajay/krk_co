<?php
/* @var $this UserDepartmentController */
/* @var $model UserDepartment */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_depart_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->user_depart_id), array('view', 'id'=>$data->user_depart_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('department_id')); ?>:</b>
	<?php echo CHtml::encode($data->department_id); ?>
	<br />


</div>