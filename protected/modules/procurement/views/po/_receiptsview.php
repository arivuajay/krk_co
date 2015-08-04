<fieldset>
    <legend style="margin-bottom: 0;"><?php echo Myclass::t('Receipts Details');?> : </legend>
<table width="50%" cellspacing="0" cellpadding="0" border="0" class="table table-striped">
        <tr><td><?php echo Myclass::t('PO Order ID');?> #</td><td><?php echo $summary->po_ord_id; ?></td></tr>
</table>
<table  border="0" cellspacing="0" class="table table-bordered" cellpadding="0">
    <thead>
	<tr class="tablehead">				 
		<th><?php echo Myclass::t('S.#');?></th>
		<th><?php echo Myclass::t('Product Name');?></th>
		<th><?php echo Myclass::t('Quantity');?></th>
		<th><?php echo Myclass::t('Receipts Mode');?></th>
		<th><?php echo Myclass::t('Carrier');?></th>
		<th><?php echo Myclass::t('CRD');?></th>
		<th><?php echo Myclass::t('SRD');?></th>
		<th><?php echo Myclass::t('CTMD');?></th>
		<th><?php echo Myclass::t('Status');?></th>
	</tr>
    </thead>
    <tbody>
	<?php 
	foreach($receipts as $key => $receipt): 
	     if($receipt->prod_scenario == 'product'):
		$prod_name = $receipt->product->name; 
	    else:
		$prod_name = $receipt->item->name; 
	    endif;
	?>
	<tr>				 
		<td><?php echo $key+1;?></td>
		<td><?php echo ucwords($prod_name); ?></td>
		<td><?php echo $receipt->quantity; ?></td>
		<td><?php echo ($receipt->ship_mode > 0) ? Myclass::getShipmentMode($receipt->ship_mode) : Myclass::t('Null'); ?></td>
		<td><?php echo (!empty($receipt->carrier_name)) ? $receipt->carrier_name : Myclass::t('Null'); ?></td>
		<td><?php echo (!empty($receipt->crd_date)) ? date(FORMAT_DATE,strtotime($receipt->crd_date)) : Myclass::t('Null'); ?></td>
		<td><?php echo (!empty($receipt->srd_date)) ? date(FORMAT_DATE,strtotime($receipt->srd_date)) : Myclass::t('Null'); ?></td>
		<td><?php echo (!empty($receipt->ctmd_date)) ? date(FORMAT_DATE,strtotime($receipt->ctmd_date)) : Myclass::t('Null'); ?></td>
		<td><?php echo ($receipt->po_receipt_status > 0) ? Myclass::getShipmentStatus($receipt->po_receipt_status) : Myclass::t('Null'); ?></td>	
	</tr>
	<tr>				 
		<td colspan="2"><?php echo Myclass::t('Additional Details'); ?></td>
		<td>&nbsp;</td>
		<td colspan="2"><?php echo (!empty($receipt->tracking_ref)) ? $receipt->tracking_ref : Myclass::t('Null'); ?></td>
		<td><?php echo (!empty($receipt->port_discharge)) ? $receipt->port_discharge : Myclass::t('Null'); ?></td>
		<td><?php echo (!empty($receipt->port_receive)) ? $receipt->port_receive : Myclass::t('Null'); ?></td>
		<td colspan="2"><?php echo (!empty($receipt->bl_no)) ? $receipt->bl_no : Myclass::t('Null'); ?></td>
	</tr>
	<?php endforeach; ?>
    </tbody>
</table>
</fieldset>