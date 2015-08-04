
<script type = "text/javascript">
function load() {
var x = document.getElementById("mylist").value;
if(null!= x){



}
}

</script>
<div class="create_user">
	<div class="form">

		<?php if(Yii::app()->user->hasFlash('customer_info')){ ?>

		<div class="flash-success">
		<?php //echo Yii::app()->user->getFlash('contact'); ?>
		<p><?php echo Yii::app()->user->getFlash('customer_info'); ?></p>
		</div>

		<?php } //else: ?>

	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'salesorder-form',
		'enableAjaxValidation'=>false,
	)); ?>

		<p class="note">Fields with <span class="required">*</span> are required.</p>

		<?php echo $form->errorSummary($smodel); ?>
		   <?php
		   $company_id = array();
		   foreach($company as $c){
			   $company_id[$c->company_id] = $c->name;
		   }
		   ?>
		
		<div class="row row-fluid row row-fluid-fluid">
			<?php echo $form->labelEx($smodel,'customer_id'); ?>
			<?php if(isset($_REQUEST[id])){echo $form->textField($smodel,'customer_id',array('readonly'=>'readonly'));}else{ ?>
					<?php //echo CHtml::dropDownList('customer_id','',CHtml::listData(Myclass::GetCompanies(), 'company_id', 'company_id'), array('empty'=>'Select Type','value'=>1)); ?>
					<?php echo $form->dropDownList($smodel,'customer_id', $company_id, array('empty'=>'Select Customer Id','id'=>'mylist','onchange' => CHtml::ajax(
							array(
								'type' => 'POST',
								'dataType'=> 'json',
								'url' => CController::createUrl('salesorder/loadform'),
								//'relpace' => '#Salesorder_customer',
								'success'=>'function(data){
									 $("#Salesorder_customer").val(data.name);
									 $("#Salesorder_primary_contact").val(data.email);
									 $("#Salesorder_phone").val(data.office_phone);
									 $("#Salesorder_ship_address").val(data.shipping_address);
									 $("#Salesorder_ship_city").val(data.shipping_city);
									 $("#Salesorder_ship_state").val(data.shipping_state);
								}',


							))
	));}?>
		</div>

		<div class="row row-fluid row row-fluid-fluid">
			<?php echo $form->labelEx($smodel,'customer'); ?>
			<?php echo $form->textField($smodel,'customer',array('size'=>60,'maxlength'=>255,'readonly'=>'readonly')); ?>
			
		</div>

		<div class="row row-fluid row row-fluid-fluid">
			<?php echo $form->labelEx($smodel,'primary_contact'); ?>
			<?php echo $form->textField($smodel,'primary_contact',array('size'=>60,'maxlength'=>255,'readonly'=>'readonly')); ?>
			
		</div>
			<?php if(isset($_REQUEST[id])){ ?>
		<div class="row row-fluid">
			<?php echo $form->labelEx($smodel,'quote_id'); ?>
			<?php echo $form->textField($smodel,'quote_id',array('size'=>60,'maxlength'=>255,'readonly'=>'readonly')); ?>
		</div>
		<div class="row row-fluid">
			<?php echo $form->labelEx($smodel,'so_created_date'); ?>
			<?php echo $form->textField($smodel,'so_created_date',array('readonly'=>'readonly')); ?>
		</div>
		  
		<div class="row row-fluid">
			<?php echo $form->labelEx($smodel,'quote_approved'); ?>
			<?php echo $form->textField($smodel,'quote_approved',array('size'=>60,'maxlength'=>255,'readonly'=>'readonly')); ?>
			
		</div>
		<div class="row row-fluid">
			<?php echo $form->labelEx($smodel,'reference_quote_id'); ?>
			<?php echo $form->textField($smodel,'reference_quote_id',array('size'=>60,'maxlength'=>255,'readonly'=>'readonly')); ?>

		</div>
		<?php } ?>
		<div class="row row-fluid">
			<?php echo $form->labelEx($smodel,'phone'); ?>
			<?php echo $form->textField($smodel,'phone',array('size'=>20,'maxlength'=>20)); ?>
			
		</div>

		<div class="row row-fluid">
			<?php echo $form->labelEx($smodel,'ship_address'); ?>
			<?php echo $form->textField($smodel,'ship_address',array('size'=>60,'maxlength'=>255)); ?>
			
		</div>

		<div class="row row-fluid">
			<?php echo $form->labelEx($smodel,'ship_city'); ?>
			<?php echo $form->textField($smodel,'ship_city',array('size'=>60,'maxlength'=>255)); ?>
			
		</div>

		<div class="row row-fluid">
			<?php echo $form->labelEx($smodel,'ship_state'); ?>
			<?php echo $form->textField($smodel,'ship_state',array('size'=>60,'maxlength'=>255)); ?>
			
		</div>
		<div class="cpanel row-fluid">
			<input type="checkbox" ><?php echo $form->labelEx($smodel,'same_as_shipping'); ?>
			<div class="cpanelContent">
				<div class="row row-fluid">
					<?php echo $form->labelEx($smodel,'bill_address'); ?>
					<?php echo $form->textField($smodel,'bill_address',array('size'=>60,'maxlength'=>255)); ?>				
				</div>
				<div class="row row-fluid">
					<?php echo $form->labelEx($smodel,'bill_city'); ?>
					<?php echo $form->textField($smodel,'bill_city',array('size'=>60,'maxlength'=>255)); ?>			
				</div>
				<div class="row row-fluid">
					<?php echo $form->labelEx($smodel,'bill_state'); ?>
					<?php echo $form->textField($smodel,'bill_state',array('size'=>60,'maxlength'=>255)); ?>			
				</div>
			</div>
		</div>
		<div class="row row-fluid buttons">
			<label>&nbsp;</label>
			<?php echo CHtml::submitButton($smodel->isNewRecord ? 'Proceed To Order Details' : 'Save',array('class'=>'btn-primary')); ?>
			<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'reset', 'icon'=>'remove', 'label'=>'Cancel')); ?>
		</div>
		

                
	
		<?php $this->endWidget(); ?>
	</div><!-- form -->
</div><!-- Create user div -->