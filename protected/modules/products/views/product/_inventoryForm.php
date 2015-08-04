<div class="create_user">
<div class="form">
<?php


?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'inventory-form',
	'enableAjaxValidation'=>false,
)); ?>


	<?php echo $form->errorSummary(array($smodel),''); ?>


	 
    <fieldset>
    	<legend><?php echo Myclass::t('Inventory Setting');?></legend>
    	<table width="100%" cellpadding="10" cellspacing="10">
    		<tr>
    			<td><?php echo Myclass::t('Available Stock');?>&nbsp;:&nbsp;&nbsp;&nbsp;<?php echo $model->available_quantity;  ?></td>    			 
    			<td><?php echo Myclass::t('Reorder Limit');?>&nbsp;: &nbsp;&nbsp;&nbsp;<?php  echo $model->re_order_limit; ?></td>    		 
    			<td>
    				<?php echo Myclass::t('Present inventory level');?>&nbsp;:&nbsp;&nbsp;&nbsp;
    				<?php 
				 if(Myclass::getInventoryLevel($model->available_quantity,$model->re_order_limit)):
				     echo CHtml::image(Yii::app()->getBaseUrl(true)."/images/green.png");
				 else:    
				     echo CHtml::image(Yii::app()->getBaseUrl(true)."/images/red.png");
				 endif;
				 ?>
    			</td>
    		</tr>
    	</table>
    </fieldset> 
    <br ><br >
    <div style="width:100%;">    
    	<div style="width:60%;text-align:left;float:left;">
    	<fieldset>
			<legend><?php echo Myclass::t('Place Procurement Request');?></legend>
		 
		<div class="row row-fluid row row-fluid-fluid">
			<?php echo $form->labelEx($smodel,'quantity'); ?>
			<?php echo $form->textField($smodel,'quantity',array('size'=>60,'maxlength'=>200)); ?>			
		</div>
		<div class="row row-fluid row row-fluid-fluid">
			<?php echo $form->labelEx($smodel,'edd'); ?>
			<?php
	                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'name'=>'ProductProcurement[edd]',
				'language'=>Yii::app()->language=='et' ? 'et' : null,
				'value'=>$smodel->edd,
				'options'=>array(
				    'showAnim'=>'fadeIn', // 'show' (the default), 'slideDown', 'fadeIn', 'fold'
				    'showOn'=>'both', // 'focus', 'button', 'both'
				    'buttonText'=>Yii::t('ui',''),
				    'minDate'=>'0',
				    'buttonImage'=>Yii::app()->request->baseUrl.'/images/calendar.png',
				    'buttonImageOnly'=>true,
				    'dateFormat'=>'yy-mm-dd',
				),
				'htmlOptions'=>array(
				    'style'=>'width:80px;vertical-align:top'
				),
			    ));
	                ?>
			
		</div>
	
	<div class="row row-fluid buttons">		
                        <?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'type'=>'primary','icon'=>'ok white', 'label'=>Myclass::t('Request Procurement'),'htmlOptions'=>array('name'=>'PRODUCT_PROCUREMENT'))); ?>
			<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'reset', 'icon'=>'remove', 'label'=>Myclass::t('Cancel'))); ?>
	</div>
	</fieldset>
</div>
<div style="width:40%;text-align:left;float:left;">
<fieldset>
<legend><?php echo Myclass::t('Past 10 procurements');?></legend>
<span style="float:right;"><?php echo Myclass::t('Average procurement price');?>: $<span id="priceval"></span></span>
<br >
<table cellpadding="10" cellspacing="10" width="100%" id="list-table" class="table table-bordered table-striped">
	<thead>
		<tr class="tablehead" valign="top">
			<th><?php echo Myclass::t('Pro.Id');?></th>
			<th><?php echo Myclass::t('Vendor');?></th>
			<th><?php echo Myclass::t('Qty');?></th>
			<th><?php echo Myclass::t('Unit Wholesale');?> $</th>
		</tr>
	</thead>	
	<tbody>
		<?php $price = 0; 
		if(!empty($productinfo)):
		foreach ($productinfo as $product) { $price = $price + $product->vendor_unit_price?>
			<tr>			
				<td>P_<?php echo $product->po_ord_prod_id; ?></td>
				<td><?php echo $product->poOrd->vendor_name; ?></td>
				<td><?php echo $product->quantity; ?></td>
				<td><?php echo $product->vendor_unit_price; ?></td>
			</tr>
		<?php } endif; ?>
	</tbody>
</table>
<script type="text/javascript">	 
	document.getElementById("priceval").innerHTML = <?php echo $price; ?>	
</script>
</fieldset>
</div> 
</div> 

<?php $this->endWidget(); ?>

</div><!-- form -->
</div><!-- crate user -->