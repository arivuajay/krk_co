<?php
 $this->hiddenpath = ($invoice->pay_status == '0') ? "/finance/invoice/induepayments" : "/finance/invoice/pastpayments";
?>
<fieldset> 
    <legend><?php echo Myclass::t("Manual payment detail # ").$invoice->pay_id; ?></legend>
<table  border="0" cellspacing="0" width="50%"  class="table table-bordered table-striped" id="list-table" cellpadding="0">
    <tbody>
	<tr>
	    <td><?php echo CHtml::activeLabel($invoice,'pay_id'); ?></td>
	    <td><?php echo CHtml::link(MANUAL_PREFIX.$invoice->pay_id,array('/finance/invoice/manualpoview','id'=>$invoice->pay_id));?></td>
	</tr>
	<tr>
	    <td><?php echo CHtml::activeLabel($invoice,'pay_vendor'); ?></td>
	    <td><?php echo ucwords($invoice->pay_vendor);?></td>
	</tr>
	<tr>
	    <td><?php echo CHtml::activeLabel($invoice,'pay_date'); ?></td>
	    <td><?php if(!empty($invoice->pay_date)) { echo date(FORMAT_DATE,strtotime($invoice->pay_date)); } ?></td>
	</tr>
	<tr>
	    <td><?php echo CHtml::activeLabel($invoice,'pay_amt'); ?></td>
	    <td><?php echo Myclass::GetSiteSetting('AMOUNT_FORMAT')." ".$invoice->pay_amt; ?></td>
	</tr>
	<?php if($invoice->manualPoProducts): ?>
	<tr class="even"><th><?php echo $invoice->getAttributeLabel('po_product');?></th><td>
	    <table class="product_view_table custom-detail-view">
		<?php 
		echo '<thead><tr><th style="border:none;">Product name</th><th style="border:none;">Quantity</th><th style="border:none;">Price</th></tr></thead><tbody>';
		foreach($invoice->manualPoProducts as $product): 
		    echo '<tr>';
		    echo '<td align="center" style="border:none;">'.$product->product_name."</td>";
		    echo '<td align="center" style="border:none;">'.$product->quantity."</td>";
		    echo '<td align="center" style="border:none;">'.Myclass::GetSiteSetting("AMOUNT_FORMAT")." ".$product->price."</td>";
		    echo '</tr>';
		endforeach; 
		echo '</tbody>';
		?>
	    </table>
	</td></tr>
	<?php endif; ?>
	<tr>
	    <td><?php echo CHtml::activeLabel($invoice,'pay_description'); ?></td>
	    <td><?php echo $invoice->pay_description;?></td>
	</tr>	
	<tr>
	    <td><?php echo CHtml::activeLabel($invoice,'pay_status'); ?></td>
	    <td><?php echo ($invoice->pay_status == '0') ? "New" : "Past";?></td>
	</tr>	
	<?php if(!empty($invoice->paid_inv_date)): ?>
	<tr>
	    <td><?php echo CHtml::activeLabel($invoice,'paid_inv_date'); ?></td>
	    <td><?php echo date(FORMAT_DATE,strtotime($invoice->paid_inv_date));  ?></td>
	</tr>
	<?php endif; ?>
	<?php if(!empty($invoice->past_pay_ref)): ?>
	<tr>
	    <td><?php echo CHtml::activeLabel($invoice,'past_pay_ref'); ?></td>
	    <td><?php echo CHtml::link(Myclass::t("Download"), array("/site/download",'doc'=>$invoice->pay_id.'_'.$invoice->past_pay_ref)); ?></td>
	</tr>
	<?php endif; ?>
    </tbody>
</table>
</fieldset>