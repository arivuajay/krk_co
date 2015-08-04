<h1><?php echo Myclass::t("Create Manual PO's"); ?></h1>
<div class="create_user">
<div class="form">

    
<?php 
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
)); 
?>

	<?php 
	echo $form->errorSummary(array($model),''); 
	
	$array1 = array();	
	$array2 = CHtml::listData(Vendor::model()->active()->findAll(),'ven_id','ven_name');

	$result = array_merge($array1, $array2);
	?>
	<div class="row-fluid">
		<?php echo $form->labelEx($model,'pay_vendor'); ?>
		<?php
		$this->widget('bootstrap.widgets.BootTypeahead', array(
		    'options'=>array(
			'name'=>'typeahead',
			'source'=> $result,
			'items'=>4,
			'matcher'=>"js:function(item) {
			    return ~item.toLowerCase().indexOf(this.query.toLowerCase());
			}",
		    ),
		    'htmlOptions'=>array('name'=>'ManualPo[pay_vendor]'),
		)); 
		?>
	</div>
	
	<div class="row-fluid">
		<?php echo $form->labelEx($model,'pay_date'); ?>
		<?php echo $this->getDatePicker('pay_date',$model,''); ?>
	</div>
    
	<div class="row-fluid">
		<?php echo $form->labelEx($model,'pay_amt'); ?>
		<?php echo $form->textField($model,'pay_amt',array('class'=>'input-mini')); ?>
	</div>
	
	<div class="row-fluid">
		<?php echo $form->labelEx($model,'pay_description'); ?>
		<?php echo $form->textArea($model,'pay_description'); ?>
	</div>

	<div class="row-fluid">
		<label>&nbsp;</label>
	    <?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>Myclass::t("Submit"))); ?>
	    <?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'reset', 'icon'=>'remove', 'label'=>Myclass::t('Cancel'))); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
</div><!-- Create user -->