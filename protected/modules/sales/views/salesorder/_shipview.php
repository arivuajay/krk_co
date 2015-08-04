<fieldset>
    <legend style="margin-bottom: 0;"><?php echo Myclass::t('ShipMent Details');?> : </legend>
<table width="50%" cellspacing="0" cellpadding="0" border="0" class="table table-striped">
        <tr>
	    <td><?php echo Myclass::t('Ship ID');?> #</td>
	    <td><?php echo $shipdet[0]->ship_id; ?></td>
	</tr>
        <tr>
	    <td><?php echo Myclass::t('SalesOrder ID');?> #</td>
	    <td><?php echo $shipdet[0]->salesord_id; ?></td>
	</tr>
</table>
<table  border="0" cellspacing="0" class="table table-bordered" cellpadding="0">
    <thead>
	<tr class="tablehead">				 
		<th><?php echo Myclass::t('S.No');?>#</th>
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
	<?php foreach($shipdet as $key => $ship): ?>
	<tr>				 
		<td><?php echo $key+1;?></td>
		<td><?php echo ucwords($ship->product->name); ?></td>
		<td><?php echo $ship->pack_qty; ?></td>
		<td><?php echo ($ship->ship_mode > 0) ? Myclass::getShipmentMode($ship->ship_mode) : 'Null'; ?></td>
		<td><?php echo (!empty($ship->carrier_name)) ? $ship->carrier_name : 'Null'; ?></td>
		<td><?php echo (!empty($ship->crd_date)) ? date(FORMAT_DATE,strtotime($ship->crd_date)) : 'Null'; ?></td>
		<td><?php echo (!empty($ship->srd_date)) ? date(FORMAT_DATE,strtotime($ship->srd_date)) : 'Null'; ?></td>
		<td><?php echo (!empty($ship->clrd_date)) ? date(FORMAT_DATE,strtotime($ship->clrd_date)) : 'Null'; ?></td>
		<td><?php echo ($ship->ship_status > 0) ? Myclass::getShipmentStatus($ship->ship_status) : 'Null'; ?></td>	
	</tr>
	<tr>
		<td colspan="2"><?php echo Myclass::t('Additional Details'); ?></td>
		<td>&nbsp;</td>
		<td colspan="2"><?php echo (!empty($ship->tracking_ref)) ? $ship->getAttributeLabel('tracking_ref')." : ".$ship->tracking_ref : 'Null'; ?></td>
		<td><?php echo (!empty($ship->port_discharge)) ? $ship->getAttributeLabel('port_discharge')." : ".$ship->port_discharge : 'Null'; ?></td>
		<td><?php echo (!empty($ship->port_receive)) ? $ship->getAttributeLabel('port_receive')." : ".$ship->port_receive : 'Null'; ?></td>
		<td colspan="2"><?php echo (!empty($ship->bl_no)) ? $ship->getAttributeLabel('bl_no')." : ".$ship->bl_no : 'Null'; ?></td>
	</tr>
	<?php endforeach; ?>
    </tbody>
</table>
</fieldset>