<?php
echo CHtml::script("
$(document).ready(function(){
	$('#send_inv_due_date').datepicker({
	    'autoSize':true,
	    'minDate':0,
	    'dateFormat':'yy-mm-dd',
	    'mode':'date',
	    'showOn':'focus',
	    'changeMonth':true,
	    'changeYear':true,
	    'htmlOptions':{'readonly':'readonly'}
	});
	$('#send_inv_due_date').hide();
	var default_date = '".date(FORMAT_DATE,strtotime($send_invoice->inv_due_date))."';
	$('#send_inv_due_date').val(default_date);
	$('input[name=\'send_inv_due_date_option\']').live('click',function(){
	    if($(this).val() == '1')
	    {
		$('#send_inv_due_date').show();
//		$('#send_inv_due_date').val('');
	    }
	    else
	    {
		$('#send_inv_due_date').hide();
//		$('#send_inv_due_date').val(default_date);
	    }
	});
    });");

$form=$this->beginWidget('CActiveForm', array(
	    'id'=>'invoice-form',
	    'action'=>Yii::app()->createUrl('/finance/invoice/modal_send_invoice', array('id'=>$send_invoice->inv_id)),
	    'enableAjaxValidation'=>true,
	    'enableClientValidation'=>true,
	    'clientOptions' => array('validateOnSubmit' => true,'validateOnChange' => true),
	    'htmlOptions'=>array('class'=>'form-horizontal'),
    ));
?>

<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <?php echo CHtml::image(SML_SITE_LOGO); ?>
    <h3><?php echo Myclass::t('Send Invoice');?></h3>
</div>
<?php echo $form->errorSummary(array($recipient),''); ?>
<div class="hide">
    <?php echo $form->error($recipient,'recipient_id'); ?>
    <?php echo $form->error($recipient,'despatch_no'); ?>
</div>    
<div class="modal-body">
<?php $data = array('0'=>'Default upon receipt','1'=>'By date'); ?>

    <div class="control-group">
	<?php echo $form->labelEx($send_invoice,'inv_due_date',array('class'=>'control-label')); ?>
	<div class="controls">
	    <?php echo CHtml::RadioButtonList('send_inv_due_date_option',0,$data,array('template'=>'<label class="checkbox inline">{input} {label}</label>','seperator'=>'')); ?>
	    <?php echo $form->textField($send_invoice,'send_inv_due_date',array('id'=>'send_inv_due_date','style'=>'margin-left: 20px; margin-top: 10px;')); ?>
	</div>
    </div>
    
    <div class="control-group ">
	<?php echo $form->labelEx($send_invoice,'inv_recipients',array('class'=>'control-label')); ?>
	<div class="controls">
	<?php
	if($send_invoice->inv_scenario == "salesorder"):
	    $receipient_data = CHtml::listData(CompanyContact::model()->findAll("company_id = {$send_invoice->invSo->customer_id}"), 'contact_id', 'namedept');
	elseif($send_invoice->inv_scenario == "poorder"):
	    $receipient_data = CHtml::listData(VendorContact::model()->findAll("ven_id = {$send_invoice->invPO->vendor_id}"), 'ven_con_id', 'namedept');
	endif;
	echo $form->checkboxList($recipient, 'recipient_id',$receipient_data,array('template'=>'<label class="checkbox">{input} {label}</label>'));
	?>
	</div>
    </div>
    
    <div class="control-group">
	<?php echo $form->labelEx($send_invoice,'despatch_no',array('class'=>'control-label')); ?>
	<div class="controls">
	    <?php echo $form->textField($send_invoice,'despatch_no'); ?>
	</div>
    </div>
</div>

<div class="modal-footer">
    <?php $this->widget('bootstrap.widgets.BootButton', array(
	'buttonType'=>'submit', 
	'type'=>'primary', 
	'icon'=>'ok white', 
	'label'=>Myclass::t('Send Invoice')
    )); ?>
    <?php $this->widget('bootstrap.widgets.BootButton', array(
        'label'=>Myclass::t('Close'),
        'url'=>'#',
        'htmlOptions'=>array('data-dismiss'=>'modal'),
    )); ?>
</div>

 <?php $this->endWidget(); ?>