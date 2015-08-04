
<table  border="0" cellspacing="0" width="50%"  class="table table-bordered table-striped" id="list-table" cellpadding="0">

    <tbody>
	<tr>
	    <td><?php echo CHtml::activeLabel($soCdetail,'so_id'); ?></td>
	    <td><?php echo $soCdetail->so_id;?></td>
	</tr>
	<tr>
	    <td><?php echo CHtml::activeLabel($soCdetail,'customer_id'); ?></td>
	    <td><?php echo $soCdetail->customer_id;?></td>
	</tr>
	<tr>
	    <td><?php echo CHtml::activeLabel($soCdetail,'customer'); ?></td>
	    <td><?php echo $soCdetail->customer;?></td>
	</tr>
	<tr>
	    <td><?php echo CHtml::activeLabel($soCdetail,'primary_contact'); ?></td>
	    <td><?php echo $soCdetail->primary_contact;?></td>
	</tr>
	<?php if($soCdetail->quote_id) : ?>
	<tr>
	    <td><?php echo CHtml::activeLabel($soCdetail,'quote_id'); ?></td>
	    <td><?php echo $soCdetail->quote_id;?></td>
	</tr>
	<?php endif; ?>
	<tr>
	    <td><?php echo CHtml::activeLabel($soCdetail,'phone'); ?></td>
	    <td><?php echo $soCdetail->phone;?></td>
	</tr>
	<tr>
	    <td><?php echo CHtml::activeLabel($soCdetail,'ship_address'); ?></td>
	    <td><?php echo $soCdetail->ship_address;?><br /><?php echo $soCdetail->ship_city;?><br /><?php echo $soCdetail->ship_state;?></td>
	</tr>
	
	<tr>
	    <td><?php echo CHtml::activeLabel($soCdetail,'bill_address'); ?></td>
	    <?php if($soCdetail->same_as_shipping == 1): ?>
	    <td>Same As Shipping Address</td>
	    <?php else : ?>
	    <td><?php echo $soCdetail->bill_address;?><br/><?php echo $soCdetail->bill_city;?><br/><?php echo $soCdetail->bill_state;?></td>
	    <?php endif; ?>
	</tr>
    </tbody>
</table>