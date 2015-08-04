<div class="create_user">
	<div class="form">

	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'salesorder-form',
		'enableAjaxValidation'=>false,
	)); 
	echo $form->errorSummary(array($pomodel),'');
	?>

		<div class="row-fluid">
			<?php echo $form->labelEx($pomodel,'vendor_id'); ?>
			<?php 
			
			//echo CHtml::activeLabel($pomodel,'customer_id'); 
			
			if(isset($po_req_records)):
			    echo $form->textField($pomodel,'vendor_id',array('readonly'=>'readonly','value'=>$po_req_records->po_ven_id));
			else:
			    $company = Myclass::GetCompanies();
			    if(!$pomodel->po_id): //Not from Quote,If Direct SO
			    echo $form->dropDownList($pomodel,'customer_id',CHtml::listData($company, 'company_id', 'name'),array('empty'=>'Select Customer','id'=>'mylist',
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
									 $("#Salesorder_ship_address").val(data.ship_addr);
									 $("#Salesorder_ship_city").val(data.ship_city);
									 $("#Salesorder_ship_state").val(data.ship_state);
									 $("#Salesorder_bill_address").val(data.bill_addr);
									 $("#Salesorder_bill_city").val(data.bill_city);
									 $("#Salesorder_bill_state").val(data.bill_state);
								}',
							))
			));
			    else: //from Quote,If UPDATE SO
				echo $form->textField($pomodel,'vendor_id',array('readonly'=>'readonly'));
			    endif;
			endif;
			?>
		</div>
	    			    
		<div class="row-fluid">
		    <?php echo $form->labelEx($pomodel,'vendor_name'); ?>
		    <?php echo $form->textField($pomodel,'vendor_name',array('value'=>$po_req_records->poVen->ven_name)); ?>
		</div>
		<div class="row-fluid">
			<?php echo $form->labelEx($pomodel,'ref_so'); ?>
			<?php 
			$so_array = CHtml::listData(Salesorder::model()->processing()->findAll(),'so_id','concatwith_prefix');
			echo $form->dropdownList($pomodel,'ref_so',$so_array,array('empty'=>'N/A')); 
			?>
		</div>
		<?php if(isset($po_req_records)): ?>
		<div class="row-fluid">
			<?php echo $form->labelEx($pomodel,'po_id'); ?>
			<?php echo $form->textField($pomodel,'po_id',array('size'=>60,'maxlength'=>255,'readonly'=>'readonly','value'=>$po_req_records->po_id)); ?>
		</div>
		<div class="row-fluid">
		<?php 
		    echo $form->labelEx($pomodel,'po_approver'); 
		    echo $po_req_records->poApprovedBy->fullname;
		    echo $form->hiddenField($pomodel,'po_approver',array('value'=>$po_req_records->po_approved_by)); 
		?>
		</div>
		<div class="row-fluid">
		<?php 
		    echo $form->labelEx($pomodel,'address').$po_req_records->poVen->ship_addr.",".$po_req_records->poVen->ship_city.",".$po_req_records->poVen->ship_state;
		?>
		</div>
		<?php endif; ?>
		
		<div class="row-fluid">
			<?php echo $form->labelEx($pomodel,'ship_title'); ?>
		</div>
		<div class="row-fluid">
			<?php echo $form->labelEx($pomodel,'ship_address'); ?>
			<?php echo $form->textField($pomodel,'ship_address',array('size'=>60,'value'=>Myclass::GetSiteSetting("COMAPANY_ADDRESS"))); ?>
			
		</div>
		<div class="row-fluid">
			<?php echo $form->labelEx($pomodel,'ship_city'); ?>
			<?php echo $form->textField($pomodel,'ship_city',array('size'=>60,'value'=>Myclass::GetSiteSetting("COMPANY_CITY"))); ?>
			
		</div>
		<div class="row-fluid">
			<?php echo $form->labelEx($pomodel,'ship_state'); ?>
			<?php echo $form->textField($pomodel,'ship_state',array('size'=>60,'value'=>Myclass::GetSiteSetting("COMPANY_STATE"))); ?>
		</div>

		<div class="row-fluid">
			<?php echo $form->labelEx($pomodel,'bill_to_location'); ?>
			<?php echo $form->checkBox($pomodel,'same_as_shipping'); ?>
			<?php echo 'Same as shipping'; ?>
		</div>
		
		<div id="same_shipping" class="row-fluid">
			<div class="row-fluid">
				<?php echo $form->labelEx($pomodel,'bill_address'); ?>
				<?php echo $form->textField($pomodel,'bill_address',array('size'=>60,'maxlength'=>255)); ?>
			</div>
			<div class="row-fluid">
				<?php echo $form->labelEx($pomodel,'bill_city'); ?>
				<?php echo $form->textField($pomodel,'bill_city',array('size'=>60,'maxlength'=>255)); ?>
			</div>
			<div class="row-fluid">
				<?php echo $form->labelEx($pomodel,'bill_state'); ?>
				<?php echo $form->textField($pomodel,'bill_state',array('size'=>60,'maxlength'=>255)); ?>
			</div>
		</div>

		<div class="row-fluid buttons">
			<label>&nbsp;</label>
			<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'type'=>'primary','icon'=>'ok white', 'label'=>$pomodel->isNewRecord ? 'Proceed To Order Details' : 'Save','htmlOptions'=>array('name'=>'PO_CUST_INFO'))); ?>
			<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'reset', 'icon'=>'remove', 'label'=>'Cancel')); ?>
		</div>
		<?php $this->endWidget(); ?>
	</div><!-- form -->
</div><!-- Create user div -->	

<?php
echo CHtml::script('$(document).ready(function(){
	$("#PoOrder_same_as_shipping").click(function(){
	    if($(this).is(":checked"))
	    {
		$("#same_shipping").slideUp();
	    }
	    else
	    {
		$("#same_shipping").slideDown();
	    }
	    
	});
	if($("#PoOrder_same_as_shipping").is(":checked"))  $("#same_shipping").slideUp();
    })');
?>