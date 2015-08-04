<?php
echo CHtml::script("
$(document).ready(function(){
	$('#pay_date').datepicker({
	    'autoSize':true,
	    'minDate':0,
	    'dateFormat':'yy-mm-dd',
	    'mode':'date',
	    'showOn':'focus',
	    'changeMonth':true,
	    'changeYear':true,
	    'htmlOptions':{'readonly':'readonly'}
	});
//	var default_date = '".date(FORMAT_DATE,strtotime($past_invoice->pay_date))."';
//	$('#pay_date').val(default_date);
    });");

$form=$this->beginWidget('CActiveForm', array(
	    'id'=>'update-man-po-payment',
	    'action'=>Yii::app()->createUrl('/finance/invoice/modal_update_man_po_payments', array('id'=>$past_invoice->pay_id)),
	    'enableAjaxValidation'=>true,
	    'enableClientValidation'=>true,
	    'clientOptions' => array('validateOnSubmit' => true,'validateOnChange' => true),
	    'htmlOptions'=>array('class'=>'form-horizontal','enctype'=>'multipart/form-data'),
    ));
?>

<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <?php echo CHtml::image(SML_SITE_LOGO); ?>
    <h3><?php echo Myclass::t('Update Payments'); ?></h3>
</div>
<?php echo $form->errorSummary(array($past_invoice),''); ?>
 <div class="hide">
    <?php echo $form->error($past_invoice,'paid_amt'); ?>
    <?php echo $form->error($past_invoice,'pay_date'); ?>
    <?php echo $form->error($past_invoice,'past_pay_ref'); ?>
</div>  
<div class="modal-body">
    <div class="control-group">
	<?php echo $form->labelEx($past_invoice,'pay_amt',array('class'=>'control-label')); ?>
	<div class="controls">
	    <?php echo Myclass::GetSiteSetting("AMOUNT_FORMAT")." ".$past_invoice->pay_amt; ?>
	</div>
    </div>
    <div class="control-group">
	<?php echo $form->labelEx($past_invoice,'paid_amt',array('class'=>'control-label')); ?>
	<div class="controls">
	    <?php echo Myclass::GetSiteSetting("AMOUNT_FORMAT")." ".$form->textField($past_invoice,'paid_amt'); ?>
	</div>
    </div>
    <div class="control-group">
	<?php echo $form->labelEx($past_invoice,'pay_date',array('class'=>'control-label')); ?>
	<div class="controls">
	    <?php echo $form->textField($past_invoice,'pay_date',array('id'=>'pay_date','autocomplete'=>'off')); ?>
	</div>
    </div>
    <div class="control-group">
	<label for="Invoice_past_pay_ref" class="control-label required">Payment Document</label>
	<div class="controls">
	    <?php echo $form->fileField($past_invoice,'past_pay_ref'); ?>
	</div>
    </div>
    <div class="control-group">
	<?php echo $form->labelEx($past_invoice,'past_pay_remarks',array('class'=>'control-label')); ?>
	<div class="controls">
	    <?php echo $form->textArea($past_invoice,'past_pay_remarks'); ?>
	</div>
    </div>
</div>

<div class="modal-footer">
    <?php $this->widget('bootstrap.widgets.BootButton', array(
	'buttonType'=>'submit', 
	'type'=>'primary', 
	'icon'=>'ok white', 
	'label'=>Myclass::t('Save')
    )); ?>
    <?php $this->widget('bootstrap.widgets.BootButton', array(
        'label'=>Myclass::t('Close'),
        'url'=>'#',
        'htmlOptions'=>array('data-dismiss'=>'modal'),
    )); ?>
</div>

 <?php $this->endWidget(); ?>