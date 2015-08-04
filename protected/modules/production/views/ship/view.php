<?php 
$this->hiddenpath = '/production/ship/index';
?>
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'quote-form',
	'enableAjaxValidation'=>false,
)); 
echo $form->errorSummary(array($model),''); 
if($form->errorSummary(array($model),'')):
    echo Yii::t('production','FORCEPROCEED');
endif;
?>
<table  border="0" cellspacing="0" class="table table-bordered" cellpadding="0">
    <thead>
	<tr class="tablehead">				 
		<th><?php echo Myclass::t('S.#');?></th>
		<th><?php echo Myclass::t('Product Name');?></th>
		<th><?php echo Myclass::t('Pack Qty');?></th>
		<th><?php echo Myclass::t('Shipment Mode');?></th>
		<th><?php echo Myclass::t('Carrier');?></th>
		<th><?php echo Myclass::t('CRD');?></th>
		<th><?php echo Myclass::t('SRD');?></th>
		<th><?php echo Myclass::t('CLRD');?></th>
		<th><?php echo Myclass::t('Status');?></th>
	</tr>
    </thead>
    <tbody>
	<?php
	foreach($quoteproducts as $key => $product):
	    if(!isset($_POST['Ship'])):
	    $save_ship = Myclass::getSaveShip($_REQUEST['id'], $product->product->product_id);
	    endif;
	?>
	<tr>				 
		<td><?php echo $i+1;?></td>
		<td><?php echo ucwords($product->product->name); ?></td>
		<td><?php echo $save_pack[$product->product->product_id]; ?>
		<?php echo $form->hiddenField($model,"pack_qty[{$product->product->product_id}]",array('value'=>$save_pack[$product->product->product_id])); ?>
		</td>
		<td><?php echo CHtml::dropDownList("ship_mode[{$product->product->product_id}]",$save_ship->ship_mode,Myclass::getShipmentMode(),array('class'=>'input-mini')) ; ?></td>
		<td><?php echo $form->textField($model,"carrier_name[{$product->product->product_id}]",array('class'=>'input-medium','placeholder'=>$model->getAttributeLabel('carrier_name'),'value'=>$save_ship->carrier_name)); ?></td>
		<td class="small_input"><?php $this->getDatePicker("crd_date[{$product->product->product_id}]", $model,'','focus'); ?></td>
		<td class="small_input"><?php $this->getDatePicker("srd_date[{$product->product->product_id}]", $model,'','focus'); ?></td>
		<td class="small_input"><?php $this->getDatePicker("clrd_date[{$product->product->product_id}]", $model,'','focus'); ?></td>
		<td><?php echo CHtml::dropDownList("ship_status[{$product->product->product_id}]",$save_ship->ship_status,Myclass::getShipmentStatus(),array('class'=>'input-mini','value'=>$save_ship->ship_status)) ; ?></td>
	</tr>
	<tr>				 
		<td colspan="2"><?php echo Myclass::t('Additional Details'); ?></td>
		<td>&nbsp;</td>
		<td colspan="2"><?php echo $form->textField($model,"tracking_ref[{$product->product->product_id}]",array('class'=>'input-medium','placeholder'=>$model->getAttributeLabel('tracking_ref'),'value'=>$save_ship->tracking_ref)) ; ?></td>
		<td><?php echo $form->textField($model,"port_discharge[{$product->product->product_id}]",array('class'=>'input-mini','placeholder'=>$model->getAttributeLabel('port_discharge'),'value'=>$save_ship->port_discharge)); ?></td>
		<td><?php echo $form->textField($model,"port_receive[{$product->product->product_id}]",array('class'=>'input-mini','placeholder'=>$model->getAttributeLabel('port_receive'),'value'=>$save_ship->port_receive)); ?></td>
		<td colspan="2"><?php echo $form->textField($model,"bl_no[{$product->product->product_id}]",array('class'=>'input-mini','placeholder'=>$model->getAttributeLabel('bl_no'),'value'=>$save_ship->bl_no)); ?></td>
	</tr>
	<?php echo CHtml::script("$(function(){
	    if({$save_ship->crd_date})$('input[name=\"Ship[crd_date][{$product->product->product_id}]\"]').val('{$save_ship->crd_date}');
	    if({$save_ship->srd_date})$('input[name=\"Ship[srd_date][{$product->product->product_id}]\"]').val('{$save_ship->crd_date}');
	    if({$save_ship->clrd_date})$('input[name=\"Ship[clrd_date][{$product->product->product_id}]\"]').val('{$save_ship->crd_date}');
	});");$i++;	endforeach; ?>
    </tbody>
    <?php
     echo CHtml::submitButton(Myclass::t('Mark as full shipment received'),array('class'=>'quote_sub','name'=>'ship_release'));
     echo CHtml::submitButton(Myclass::t('Save'),array('class'=>'quote_sub','name'=>'save_release'));
     echo CHtml::linkButton(Myclass::t('Cancel'),array('class'=>'quote_sub','href'=>'/production/ship/index'));
    ?>
</table>
<?php 
echo $form->hiddenField($model,'salesord_id',array('value'=>$_REQUEST['id']));
$this->endWidget(); 
?>

