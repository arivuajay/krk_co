<fieldset>
    <legend style="margin-bottom: 0;"><?php echo Myclass::t('Pack Details');?> : </legend>
<table width="50%" cellspacing="0" cellpadding="0" border="0" class="table table-striped">
        <tr>
	    <td><?php echo Myclass::t('Pick ID');?> #</td>
	    <td><?php echo $packdet[0]->pack_id; ?></td>
	</tr>
        <tr>
	    <td><?php echo Myclass::t('SalesOrder ID');?> #</td>
	    <td><?php echo $packdet[0]->salesord_id; ?></td>
	</tr>
</table>
<table  border="0" cellspacing="0" class="table table-bordered" cellpadding="0">
    <thead>
	<tr class="tablehead">				 
		<th><?php echo Myclass::t('S.No');?>#</th>
		<th><?php echo Myclass::t('Product Name');?></th>
		<th><?php echo Myclass::t('Product Class');?></th>
		<th><?php echo Myclass::t('Pick Qty');?></th>
		<th><?php echo Myclass::t('Pack Qty');?></th>
		<th><?php echo Myclass::t('Pallete / Box Identifier');?></th>
		<th><?php echo Myclass::t('Remarks');?></th>
	</tr>
    </thead>
    <tbody>
	<?php foreach($packdet as $key => $pack): ?>
	<tr>			 
		<td><?php echo $key+1;?></td>
		<td><?php echo ucwords($pack->product->name); ?></td>
		<td><?php echo ucwords($pack->product->productClass->name); ?></td>
		<td><?php echo $pack->actual_qty; ?></td>
		<td><?php echo $pack->pack_qty; ?></td>
		<td><?php echo (empty($pack->box_id)) ? 'Null' : $pack->box_id; ?></td>
		<td><?php echo (empty($pack->remarks)) ? 'Null' : $pack->remarks; ?></td>
	</tr>
	<?php endforeach; ?>
    </tbody>
</table>
</fieldset>