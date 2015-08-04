<h1>Debit Memo</h1>
<div class="create_user">
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'salesorder-form',
	'enableAjaxValidation'=>false,
)); 
$client_lists = array_values(CHtml::listData(Myclass::GetVendors(),'ven_id','ven_name'));
Yii::app()->bootstrap->registerTypeahead('.typeahead', array(
    'source'=> $client_lists,
    'items'=>4,
    'matcher'=>"js:function(item) {
        return ~item.toLowerCase().indexOf(this.query.toLowerCase());
    }",
));
echo $form->errorSummary(array($model),'');
?>
	<div class="row-fluid">
		<?php echo $form->labelEx($model,'cli_name'); ?>
		<?php echo $form->textField($model,'cli_name',array('class'=>'typeahead')); ?>			
	</div>

	<div class="row-fluid">
	    <label class="required" for="Memo_rel_id">PO ID # <span class="required">*</span></label>
	    <?php echo $form->textField($model,'rel_id'); ?>
	</div>

	<div class="row-fluid">
	    <?php echo $form->labelEx($model,'description'); ?>
	    <?php echo $form->textArea($model,'description'); ?>
	</div>
	
	<div class="row-fluid">
	    <?php echo $form->labelEx($model,'amount'); ?>
	    <?php echo $form->textField($model,'amount'); ?>
	</div>

	<div class="row-fluid">
	    <?php echo $form->labelEx($model,'pay_mode'); ?>
	    <?php echo $form->textField($model,'pay_mode'); ?>
	</div>

	<div class="row-fluid">
	    <?php echo $form->labelEx($model,'pay_date'); ?>
	    <?php echo $this->getDatePicker('pay_date',$model,''); ?>
	</div>

	<div class="row-fluid">
	    <?php echo $form->labelEx($model,'remarks'); ?>
	    <?php echo $form->textArea($model,'remarks'); ?>
	</div>

    
	<div class="row-fluid buttons">
		<label>&nbsp;</label>
		<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'type'=>'primary','icon'=>'ok white', 'label'=>'Create Debit Memo')); ?>
		<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'reset', 'icon'=>'remove', 'label'=>'Cancel')); ?>
	</div>
	<?php $this->endWidget(); ?>
</div><!-- form -->
</div>