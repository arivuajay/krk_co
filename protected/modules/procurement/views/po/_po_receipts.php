<?php 
$this->hiddenpath = '/procurement/po/past';
?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'quote-form',
	'enableAjaxValidation'=>false,
)); 
if(isset($receipt) && $receipt->getErrors()):
    echo '<div class="alert-error fade in" style="border-radius: 4px;margin-bottom: 18px;  padding: 8px 35px 8px 14px;text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);"><ul>';
    foreach($receipt->getErrors() as $value):
	$error = $value[0];
	echo "<li>".$error."</li>";
    endforeach;
    echo '</ul></div>';
endif;
//if($receipt->getErrors() && isset($receipt)):
//    echo '<div class="alert-error fade in" style="border-radius: 4px;margin-bottom: 18px;  padding: 8px 35px 8px 14px;text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);"><ul>';
//    foreach($receipt->getErrors() as $value):
//	$error = $value[0];
//	echo "<li>".$error."</li>";
//    endforeach;
//    echo '</ul></div>';
//endif;
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
//	var_dump($poreceiptmodel);
	foreach($poreceiptmodel as $key => $poreceipt): 
	    if($poreceipt->prod_scenario == 'product'):
		$prod_name = $poreceipt->product->name; 
	    else:
		$prod_name = $poreceipt->item->name; 
	    endif;
	?>
	<tr>				 
		<td><?php echo $i+1;?></td>
		<td><?php echo ucwords($prod_name).$form->hiddenField($poreceipt,"[{$key}]product_id",array('value'=>$poreceipt->prod_scenario.'_'.$poreceipt->product_id)); ?></td>
		<td><?php echo $poreceipt->quantity.$form->hiddenField($poreceipt,"[{$key}]quantity"); ?></td>
		<td><?php echo $form->dropDownList($poreceipt,"[{$key}]ship_mode",Myclass::getShipmentMode(),array('class'=>'input-mini')) ; ?></td>
		<td><?php echo $form->textField($poreceipt,"[{$key}]carrier_name",array('class'=>'input-medium','placeholder'=>$poreceipt->getAttributeLabel('carrier_name'),'value'=>$poreceipt->carrier_name)); ?></td>
		<td class="small_input"><?php $this->getDatePicker("[{$key}]crd_date", $poreceipt,'','focus'); ?></td>
		<td class="small_input"><?php $this->getDatePicker("[{$key}]srd_date", $poreceipt,'','focus'); ?></td>
		<td class="small_input"><?php $this->getDatePicker("[{$key}]ctmd_date", $poreceipt,'','focus'); ?></td>
		<td><?php echo $form->dropDownList($poreceipt,"[{$key}]po_receipt_status",Myclass::getShipmentStatus(),array('class'=>'input-mini')) ; ?></td>
	</tr>
	<tr>				 
		<td colspan="2"><?php echo Myclass::t('Additional Details'); ?></td>
		<td>&nbsp;</td>
		<td colspan="2"><?php echo $form->textField($poreceipt,"[{$key}]tracking_ref",array('class'=>'input-medium','placeholder'=>$poreceipt->getAttributeLabel('tracking_ref'))) ; ?></td>
		<td><?php echo $form->textField($poreceipt,"[{$key}]port_discharge",array('class'=>'input-mini','placeholder'=>$poreceipt->getAttributeLabel('port_discharge'))); ?></td>
		<td><?php echo $form->textField($poreceipt,"[{$key}]port_receive",array('class'=>'input-mini','placeholder'=>$poreceipt->getAttributeLabel('port_receive'))); ?></td>
		<td colspan="2"><?php echo $form->textField($poreceipt,"[{$key}]bl_no",array('class'=>'input-mini','placeholder'=>$poreceipt->getAttributeLabel('bl_no'))); ?></td>
	</tr>
	<?php
	if($save_ship->crd_date)
	    echo CHtml::script("$(function(){ $('input[name=\"Ship[crd_date][{$key}]\"]').val('{$save_ship->crd_date}'); })");

	if($save_ship->srd_date)
	    echo CHtml::script("$(function(){ $('input[name=\"Ship[srd_date][{$key}]\"]').val('{$save_ship->srd_date}'); })");

	if($save_ship->clrd_date)
	    echo CHtml::script("$(function(){ $('input[name=\"Ship[clrd_date][{$key}]\"]').val('{$save_ship->clrd_date}'); })");

	$i++;	endforeach; ?>
    </tbody>
    <?php
     echo CHtml::submitButton(Myclass::t('Mark as full shipment received'),array('class'=>'quote_sub','name'=>'PO_RELEASE'));
     echo CHtml::submitButton(Myclass::t('Save'),array('class'=>'quote_sub','name'=>'SAVE_RELEASE'));
     echo CHtml::linkButton(Myclass::t('Cancel'),array('class'=>'quote_sub','href'=>'/production/ship/index'));
    ?>
</table>
<?php 
$this->endWidget(); 
?>

