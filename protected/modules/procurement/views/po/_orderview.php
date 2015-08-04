<table  border="0" cellspacing="0" width="50%"  class="table table-bordered table-striped" id="list-table" cellpadding="0">

    <tbody>
	<tr>
	    <td><?php echo CHtml::activeLabel($summary,'po_ord_date'); ?></td>
	    <td><?php echo $summary->po_ord_date;?></td>
	</tr>
	<tr>
	    <td><?php echo CHtml::activeLabel($summary,'po_ship_date'); ?></td>
	    <td><?php echo $summary->po_ship_date;?></td>
	</tr>
	<tr>
	    <td>Order Details </td>
	    <td>
		    <table  border="0" cellspacing="0" class="table table-bordered" cellpadding="0">
			<thead>
			    <tr class="tablehead">				 
				    <th><?php echo Myclass::t('S.#');?></th>
				    <th><?php echo Myclass::t('Product Name');?></th>
				    <th><?php echo Myclass::t('Product Class');?></th>
				    <th><?php echo Myclass::t('Quantity');?></th>
				    <th><?php echo Myclass::t('Vendor Unit Price');?></th>
				    <th><?php echo Myclass::t('Item Value');?></th>
				    <th><?php echo Myclass::t('Discounts');?></th>
				    <th><?php echo Myclass::t('Net Cost');?></th>
			    </tr>
			</thead>
			<tbody>
			    <?php 
			    foreach($product as $key => $product):
				if($product->prod_scenario == 'product'):
				    $prod_name	= $product->product->name; 
				    $prod_cls	= $product->product->productClass->name;
				else:
				    $prod_name	= $product->item->name; 
				    $prod_cls	= 'item';
				endif;	
			    ?>
			    <tr>				 
				    <td><?php echo $key+1;?></td>
				    <td><?php echo ucwords($prod_name); ?></td>
				    <td><?php echo ucwords($prod_cls); ?></td>
				    <td><?php echo $product->quantity; ?></td>
				    <td><?php echo Myclass::GetSiteSetting("AMOUNT_FORMAT")." ".$product->vendor_unit_price; ?></td>
				    <td><?php echo Myclass::GetSiteSetting("AMOUNT_FORMAT")." ".$product->item_value; ?></td>
				    <td><?php echo $product->discounts." ".Myclass::GetSiteSetting("DISCOUNT_FORMAT"); ?></td>
				    <td><?php echo Myclass::GetSiteSetting("AMOUNT_FORMAT")." ".$product->netcost; ?></td>
			    </tr>
			    <?php endforeach; ?>
			</tbody>
		    </table>
	    </td>
	</tr>		
	<tr>
	    <td><?php echo CHtml::activeLabel($summary,'po_ord_line_total'); ?></td>
	    <td><?php echo Myclass::GetSiteSetting("AMOUNT_FORMAT")." ".$summary->po_ord_line_total;?></td>
	</tr>
	<tr>
	    <td><?php echo CHtml::activeLabel($summary,'po_ord_tax'); ?></td>
	    <td><?php echo Myclass::GetSiteSetting("AMOUNT_FORMAT")." ".$summary->po_ord_tax;?></td>
	</tr>
	<tr>
	    <td><?php echo CHtml::activeLabel($summary,'po_ord_total_order'); ?></td>
	    <td><?php echo Myclass::GetSiteSetting("AMOUNT_FORMAT")." ".$summary->po_ord_total_order;?></td>
	</tr>
    </tbody>
</table>
