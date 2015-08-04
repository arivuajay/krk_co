<h1>Credit Memo</h1>
<div class="create_user">
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'salesorder-form',
	'enableAjaxValidation'=>false,
)); 
$client_lists = array_values(CHtml::listData(Myclass::GetCompanies(),'company_id','name'));
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
	    <?php echo $form->labelEx($model,'rel_id'); ?>
	    <?php echo $form->textField($model,'rel_id'); ?>
	</div>
    
	<div class="row-fluid">
	    <?php echo $form->labelEx($model,'inv_id'); ?>
	    <?php echo $form->textField($model,'inv_id'); ?>
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
		<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'type'=>'primary','icon'=>'ok white', 'label'=>'Create Credit Memo')); ?>
		<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'reset', 'icon'=>'remove', 'label'=>'Cancel')); ?>
	</div>
	<?php $this->endWidget(); ?>
</div><!-- form -->
</div>