<table  border="0" cellspacing="0" width="50%"  class="table table-bordered table-striped" id="list-table" cellpadding="0">

    <tbody>
	<tr>
	    <td><?php echo CHtml::activeLabel($soOdetail,'order_date'); ?></td>
	    <td><?php echo $soOdetail->order_date;?></td>
	</tr>
	<tr>
	    <td><?php echo CHtml::activeLabel($soOdetail,'shipment_date'); ?></td>
	    <td><?php echo $soOdetail->shipment_date;?></td>
	</tr>
	<tr>
	    <td><?php echo Myclass::t('Order Details');?></td>
	    <td>
		    <table  border="0" cellspacing="0" class="table table-bordered" cellpadding="0">
			<thead>
			    <tr class="tablehead">				 
				    <th><?php echo Myclass::t('S.No');?>#</th>
				    <th><?php echo Myclass::t('Product Name');?></th>
				    <th><?php echo Myclass::t('Product Class');?></th>
				    <th><?php echo Myclass::t('Quantity');?></th>
				    <th><?php echo Myclass::t('Approved Unit Price');?></th>
				    <th><?php echo Myclass::t('Order Value');?></th>
			    </tr>
			</thead>
			<tbody>
			    <?php foreach($soPdetail as $key => $product): ?>
			    <tr>				 
				    <td><?php echo $key+1;?></td>
				    <td><?php echo ucwords($product->product->name); ?></td>
				    <td><?php echo ucwords($product->product->productClass->name); ?></td>
				    <td><?php echo $product->quantity; ?></td>
				    <td><?php echo $product->quote_price; ?></td>
				    <td><?php echo $product->order_value; ?></td>
			    </tr>
			    <?php endforeach; ?>
			</tbody>
		    </table>
	    </td>
	</tr>		
	<tr>
	    <td><?php echo CHtml::activeLabel($soOdetail,'line_total'); ?></td>
	    <td><?php echo $soOdetail->line_total;?></td>
	</tr>
	<tr>
	    <td><?php echo CHtml::activeLabel($soOdetail,'tax'); ?></td>
	    <td><?php echo $soOdetail->tax;?></td>
	</tr>
	<tr>
	    <td><?php echo CHtml::activeLabel($soOdetail,'total_order_value'); ?></td>
	    <td><?php echo $soOdetail->total_order_value;?></td>
	</tr>
    </tbody>
</table>
