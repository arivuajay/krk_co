<table  border="0" cellspacing="0" width="50%"  class="table table-bordered table-striped" id="list-table" cellpadding="0">

    <tbody>
	<tr>
	    <td><?php echo CHtml::activeLabel($summary,'po_ord_id'); ?></td>
	    <td><?php echo $summary->po_ord_id;?></td>
	</tr>
	<tr>
	    <td><?php echo CHtml::activeLabel($summary,'vendor_id'); ?></td>
	    <td><?php echo $summary->vendor_id;?></td>
	</tr>
	<tr>
	    <td><?php echo CHtml::activeLabel($summary,'vendor_name'); ?></td>
	    <td><?php echo $summary->vendor_name;?></td>
	</tr>
	<tr>
	    <td><?php echo CHtml::activeLabel($summary,'ship_address'); ?></td>
	    <td><?php echo $summary->ship_address;?><br /><?php echo $summary->ship_city;?><br /><?php echo $summary->ship_state;?></td>
	</tr>
	
	<tr>
	    <td><?php echo CHtml::activeLabel($summary,'bill_address'); ?></td>
	    <td><?php echo $summary->bill_address;?><br/><?php echo $summary->bill_city;?><br/><?php echo $summary->bill_state;?></td>
	</tr>
    </tbody>
</table>