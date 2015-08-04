<?php $this->hiddenpath = "/sales/default/viewcompanies"; ?>

<div class="create_user">
<h1><?php echo $model->name; ?> <?php echo Myclass::t('Company');?></h1>
<?php echo $this->renderPartial('//layouts/_update_company_tabs',array('model'=>$model)); ?>
    <h3><?php echo Myclass::t('Invoice Trail');?>, <?php echo $model->name; ?></h3>
    <table  border="0" cellspacing="0" class="table table-bordered table-striped" id="list-table" cellpadding="0">
    <thead>
	<tr class="tablehead">				 
		<th><?php echo Myclass::t('Invoice ID');?> #</th>
		<th><?php echo Myclass::t('Invoice Date');?></th>
		<th><?php echo Myclass::t('Invoice Value');?></th>
		<th><?php echo Myclass::t('Status');?></th>
		<th><?php echo Myclass::t('Amt Paid');?></th>
		<th><?php echo Myclass::t('Payment Date');?></th>
	</tr>
    </thead>
    <tbody>
	<?php 
	foreach($cmpyinv as $invoice):
	    switch($invoice->inv_status):
		case "0": $status = Myclass::t("Due"); break;
		case "1": $status = Myclass::t("Past"); break;
		case "2": $status = Myclass::t("Paid"); break;
	    endswitch;
	?>
	<tr>				 
		<td><?php echo CHtml::link(INVOICE_PREFIX.$invoice->inv_id,array('/finance/invoice/view','id'=>$invoice->inv_id));?></td>
		<td><?php echo date(FORMAT_DATE,strtotime($invoice->inv_due_date)); ?></td>
		<td><?php echo Myclass::GetSiteSetting('AMOUNT_FORMAT')." ".$invoice->inv_payment; ?></td>
		<td><?php echo ucwords($status); ?></td>
		<td><?php echo Myclass::GetSiteSetting('AMOUNT_FORMAT')." ".$invoice->pay_amt; ?></td>
		<td><?php echo (empty($invoice->paid_inv_date)) ? "--" : date(FORMAT_DATE,strtotime($invoice->paid_inv_date)); ?></td>
	</tr>
	<?php endforeach; ?>
    </tbody>
</table>

</div>