<fieldset>
    <legend style="margin-bottom: 0;"><?php echo Myclass::t('Pick Details');?> : </legend>
<table width="50%" cellspacing="0" cellpadding="0" border="0" class="table table-striped">
        <tr>
	    <td><?php echo Myclass::t('Pick ID');?> #</td>
	    <td><?php echo $pickdet[0]->pick_id; ?></td>
	</tr>
        <tr>
	    <td><?php echo Myclass::t('SalesOrder ID');?> #</td>
	    <td><?php echo $pickdet[0]->salesord_id; ?></td>
	</tr>
</table>
<table  border="0" cellspacing="0" class="table table-bordered" cellpadding="0">
    <thead>
	<tr class="tablehead">				 
		<th><?php echo Myclass::t('S.No');?>#</th>
		<th><?php echo Myclass::t('Product Name');?></th>
		<th><?php echo Myclass::t('Product Class');?></th>
		<th><?php echo Myclass::t('Order Qty');?></th>
		<th><?php echo Myclass::t('Pick Qty');?></th>
	</tr>
    </thead>
    <tbody>
	<?php foreach($pickdet as $key => $pick): ?>
	<?php if($pick->product_class == '1'){ ?>
	<tr>				 
		<td><?php echo $key+1;?></td>
		<td><?php echo $pick->product->name; ?></td>
		<td><?php echo ucwords($pick->product->productClass->name); ?></td>
		<td><?php echo $pick->actual_qty; ?></td>
		<td><?php echo $pick->pick_qty; ?></td>
	</tr>
	<?php }else{ ?> 
	<tr>				 
		<td><?php echo $key+1;?></td>
		<td><?php echo $pick->item->name; ?></td>
		<td><?php echo Myclass::t("Assembled Item"); ?></td>
		<td><?php echo $pick->actual_qty; ?></td>
		<td><?php echo $pick->pick_qty; ?></td>
	</tr>
	<?php } endforeach; ?>
    </tbody>
</table>
</fieldset>