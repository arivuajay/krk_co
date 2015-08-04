<table  border="0" cellspacing="0" width="50%"  class="table table-bordered table-striped" id="list-table" cellpadding="0">
    <tbody>
	<tr>
	    <td><?php echo Myclass::t("Product Name"); ?></td>
            <td><?php echo Myclass::getProductName($productDetail->product_id);?></td>
	</tr>
	<tr>
	    <td><?php echo Myclass::t("Unit of Manufacture"); ?></td>
	    <td><?php echo $productBom[0]->unit_manufacture;?></td>
	</tr>
	<tr>
	    <td><?php echo Myclass::t('BOM Details');?> </td>
	    <td>
		    <table  border="0" cellspacing="0" class="table table-bordered" cellpadding="0">
			<thead>
			    <tr class="tablehead">
				    <th><?php echo Myclass::t('S.No');?>#</th>
				    <th><?php echo Myclass::t('Item Name');?></th>
				    <th><?php echo Myclass::t('Item Value');?></th>
				    
			    </tr>
			</thead>
			<tbody>
			    <?php foreach($productBom as $key => $product): ?>
			    <tr>
				    <td><?php echo $key+1;?></td>
                                    <td><?php echo ucwords(Myclass::GetItemName($product->item_id)); ?></td>
				    <td><?php echo ucwords($product->item_value); ?></td>
				    
			    </tr>
			    <?php endforeach; ?>
			</tbody>
		    </table>
	    </td>
	</tr>
	
    </tbody>
</table>
