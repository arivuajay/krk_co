<div class="create_user">
	<div class="form">

	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'salesorder-form',
		'enableAjaxValidation'=>false,
	)); 
	echo $form->errorSummary(array($somodel),'');
	?>

		<div class="row-fluid">
			<label class="required"><?php echo Myclass::t('Customer Name');?></label>
			<?php 
			
			//echo CHtml::activeLabel($somodel,'customer_id'); 
			
			if(isset($quote_records)):
			    echo $form->textField($somodel,'customer_id',array('readonly'=>'readonly','value'=>$quote_records->company_id));
			else:
			    $company = Myclass::GetCompanies();
			    if(!$somodel->quote_id): //Not from Quote,If Direct SO
			    echo $form->dropDownList($somodel,'customer_id',CHtml::listData($company, 'company_id', 'name'),array('empty'=>'Select Customer','id'=>'mylist',
							'onchange' => CHtml::ajax(
							array(
								'type' => 'POST',
								'dataType'=> 'json',
								'url' => CController::createUrl('salesorder/getcompanydetails'),
								//'relpace' => '#Salesorder_customer',
								'success'=>'function(data){
									 $("#Salesorder_customer").val(data.name);
									 $("#Salesorder_primary_contact").val(data.email);
									 $("#Salesorder_phone").val(data.office_phone);
									 $("#Salesorder_ship_address").val(data.shipping_address);
									 $("#Salesorder_ship_city").val(data.shipping_city);
									 $("#Salesorder_ship_state").val(data.shipping_state);
									 $("#Salesorder_bill_address").val(data.billing_address);
									 $("#Salesorder_bill_city").val(data.billing_city);
									 $("#Salesorder_bill_state").val(data.billing_state);
								}',
							))
			));
			    else: //from Quote,If UPDATE SO
				echo $form->textField($somodel,'customer_id',array('readonly'=>'readonly'));
			    endif;
			endif;
			?>
		</div>

		<div class="row-fluid">
			<?php echo $form->labelEx($somodel,'customer'); ?>
			<?php echo $form->textField($somodel,'customer',array('size'=>60,'maxlength'=>255,'readonly'=>'readonly','value'=>$quote_records->company->name)); ?>			
		</div>

		<div class="row-fluid">
			<?php echo $form->labelEx($somodel,'primary_contact'); ?>
			<?php 
			    if(isset($quote_records)) $contact_record = Myclass::GetCompanyPrimarycontact($quote_records->company_id);
			    echo $form->textField($somodel,'primary_contact',array('size'=>60,'maxlength'=>255,'readonly'=>'readonly','value'=>$contact_record->email)); 
			?>
			
		</div>
	    
		<?php if(isset($quote_records)): ?>
		<div class="row-fluid">
			<?php echo $form->labelEx($somodel,'quote_id'); ?>
			<?php echo $form->textField($somodel,'quote_id',array('size'=>60,'maxlength'=>255,'readonly'=>'readonly','value'=>$quote_records->quote_id)); ?>
		</div>
		<div class="row-fluid">
			<?php  
				echo $form->labelEx($somodel,'quote_date'); 
				echo CHtml::textField('quote_date',date("d-m-Y",strtotime($quote_records->created_date)),array('size'=>60,'maxlength'=>255,'readonly'=>'readonly')); 
			?>
		</div>
		<div class="row-fluid">
			<?php 
				$approved_user = Myclass::GetUserProfile($quote_records->approved_by);
				echo $form->labelEx($somodel,'quote_approved'); 
				echo CHtml::textField('quote_approved',$approved_user->first_name." ".$approved_user->last_name,array('size'=>60,'maxlength'=>255,'readonly'=>'readonly')); 
			?>
		</div>	    
		<?php endif; ?>
		  
		<div class="row-fluid">
			<?php echo $form->labelEx($somodel,'phone'); ?>
			<?php echo $form->textField($somodel,'phone',array('size'=>20,'value'=>$quote_records->company->office_phone)); ?>
			
		</div>
		<div class="row-fluid">
			<?php echo $form->labelEx($somodel,'ship_title'); ?>
		</div>
		<div class="row-fluid">
			<?php echo $form->labelEx($somodel,'ship_address'); ?>
			<?php echo $form->textField($somodel,'ship_address',array('size'=>60,'value'=>$quote_records->company->shipping_address)); ?>
			
		</div>
		<div class="row-fluid">
			<?php echo $form->labelEx($somodel,'ship_city'); ?>
			<?php echo $form->textField($somodel,'ship_city',array('size'=>60,'value'=>$quote_records->company->shipping_city)); ?>
			
		</div>
		<div class="row-fluid">
			<?php echo $form->labelEx($somodel,'ship_state'); ?>
			<?php echo $form->textField($somodel,'ship_state',array('size'=>60,'value'=>$quote_records->company->shipping_state)); ?>
		</div>

		<div class="row-fluid">
			<?php echo $form->labelEx($somodel,'same_as_shipping'); ?>
			<?php echo $form->radioButton($somodel,'same_as_shipping',array('value'=>1,'uncheckValue'=>null)).'Yes'; ?>
			<?php echo $form->radioButton($somodel,'same_as_shipping',array('value'=>0,'uncheckValue'=>null)).'No'; ?>
		</div>
		
		<div id="same_shipping" class="row-fluid">
			<div class="row-fluid">
				<?php echo $form->labelEx($somodel,'bill_address'); ?>
				<?php echo $form->textField($somodel,'bill_address',array('size'=>60,'maxlength'=>255,'value'=>$quote_records->company->billing_address)); ?>
			</div>
			<div class="row-fluid">
				<?php echo $form->labelEx($somodel,'bill_city'); ?>
				<?php echo $form->textField($somodel,'bill_city',array('size'=>60,'maxlength'=>255,'value'=>$quote_records->company->billing_city)); ?>
			</div>
			<div class="row-fluid">
				<?php echo $form->labelEx($somodel,'bill_state'); ?>
				<?php echo $form->textField($somodel,'bill_state',array('size'=>60,'maxlength'=>255,'value'=>$quote_records->company->billing_city)); ?>
			</div>
		</div>

		<div class="row-fluid buttons">
			<label>&nbsp;</label>
			<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'type'=>'primary','icon'=>'ok white', 'label'=>$somodel->isNewRecord ? Myclass::t('Proceed To Order Details') : Myclass::t('Save'),'htmlOptions'=>array('name'=>'SO_CUST_INFO'))); ?>
			<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'reset', 'icon'=>'remove', 'label'=>Myclass::t('Cancel'))); ?>
		</div>
		<?php $this->endWidget(); ?>
	</div><!-- form -->
</div><!-- Create user div -->	
<?php
echo CHtml::script('$(document).ready(function(){
	if($("#Salesorder_same_as_shipping:checked").val() > 0) $("#same_shipping").slideUp();
	else $("#same_shipping").slideDown();

	$("#Salesorder_same_as_shipping").live("click",function(){
	    if($(this).val() > 0) $("#same_shipping").slideUp();
	    else $("#same_shipping").slideDown();
	});
    })');
?>