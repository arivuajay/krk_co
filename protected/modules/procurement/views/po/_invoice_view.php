<div class="create_user">
    <h3><?php echo Myclass::t('Payment Trail');?></h3>
    <table  border="0" cellspacing="0" class="table table-bordered table-striped" id="list-table" cellpadding="0">
    <thead>
	<tr class="tablehead">				 
		<th><?php echo Myclass::t('Payment ID');?> #</th>
		<th><?php echo Myclass::t('Invoice Amount');?></th>
		<th><?php echo Myclass::t('Paid Amount');?></th>
		<th><?php echo Myclass::t('Date');?></th>
		<th><?php echo Myclass::t('Payment Ref');?> #</th>
	</tr>
    </thead>
    <tbody>
	<?php 
	$inv_amt = 0;$pay_amt = 0;
	
	foreach($invoices as $invoice): 
	    $inv_amt += $invoice->inv_payment;
	    $pay_amt += $invoice->pay_amt;
	    ?>
	<tr>				 
		<td><?php echo CHtml::link(PAYMENT_PREFIX.$invoice->inv_id,array('/finance/invoice/view','id'=>$invoice->inv_id));?></td>
		<td><?php echo Myclass::GetSiteSetting('AMOUNT_FORMAT')." ".$invoice->inv_payment; ?></td>
		<td><?php echo Myclass::GetSiteSetting('AMOUNT_FORMAT')." ".$invoice->pay_amt; ?></td>
		<td><?php echo date(FORMAT_DATE,strtotime($invoice->paid_inv_date)); ?></td>
		<td><?php echo $invoice->past_pay_ref; ?></td>
	</tr>
	<?php endforeach; ?>
    </tbody>
</table>

<table  border="0" cellspacing="0" class="table table_order"  cellpadding="0" style="float: right;width: 455px;">
    <tr>				 
	    <th><?php echo Myclass::t('Total Order Value');?> :</th>
	    <th><?php echo Myclass::GetSiteSetting('AMOUNT_FORMAT')." ".$summary->po_ord_total_order;?></th>
    </tr>
    <tr>				 
	    <th><?php echo Myclass::t('Total Invoices Amount');?> :</th>
	    <th><?php echo Myclass::GetSiteSetting('AMOUNT_FORMAT')." ".$inv_amt;?></th>
    </tr>
    <tr>				 
	    <th><?php echo Myclass::t('Paid Invoices Amount');?> :</th>
	    <th><?php echo Myclass::GetSiteSetting('AMOUNT_FORMAT')." ".$pay_amt;?></th>
    </tr>    
</table>
    
</div>