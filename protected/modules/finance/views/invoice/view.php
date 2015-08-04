<?php
if($invoice->inv_scenario == "salesorder"):
$this->hiddenpath = "/finance/invoice/paid";    
    $cust_name = $invoice->invSo->company->name;
    $inv_state = Myclass::getRaiseInvoice($invoice->invMilestone->raise_invoice);
    $ord_link  = CHtml::link(SO_PREFIX.$invoice->invSo->so_id,array('/sales/salesorder/viewsodetail','id'=>$invoice->invSo->so_id),array('target'=>'_blank'));
    $payref = $invoice->past_pay_ref;
    $pre = INVOICE_PREFIX;   
    $title = Yii::t('default',"Invoice detail # ");
    $inv_id = CHtml::activeLabel($invoice,'inv_id');
    $ref_id = CHtml::activeLabel($invoice,'inv_so_id');
    $inv_amt = CHtml::activeLabel($invoice,'inv_payment');
elseif($invoice->inv_scenario == "poorder"):
$this->hiddenpath = "/finance/invoice/pastpayments";    
    $cust_name = $invoice->invPO->vendor->ven_name;
    $inv_state = Myclass::getRaiseInvoice($invoice->invPOMilestone->raise_invoice,true);
    $ord_link  = CHtml::link(PO_PREFIX.$invoice->invPO->po_ord_id,array('/procurement/po/viewpodetail','id'=>$invoice->invPO->po_ord_id),array('target'=>'_blank'));
    $payref = CHtml::link(Yii::t('default', "Download"), array("/site/download",'doc'=>$invoice->inv_id.'_'.$invoice->past_pay_ref));
    $pre = PAYMENT_PREFIX;
    $title = Yii::t('default',"Payment detail # ");
    $inv_id = CHtml::activeLabel($invoice,'invoicepo_id');
    $ref_id = CHtml::activeLabel($invoice,'inv_po_id');
    $inv_amt = CHtml::activeLabel($invoice,'invoicepo_payment');
endif;
?>
<fieldset> 
    <legend><?php echo $title.$invoice->inv_id; ?></legend>
<table  border="0" cellspacing="0" width="50%"  class="table table-bordered table-striped" id="list-table" cellpadding="0">
    <tbody>
	<tr>
	    <td><?php echo $inv_id; ?></td>
	    <td><?php echo CHtml::link($pre.$invoice->inv_id,array('/finance/invoice/view','id'=>$invoice->inv_id));?></td>
	</tr>
	<tr>
	    <td>Customer Name</td>
	    <td><?php echo ucwords($cust_name);?></td>
	</tr>
	<tr>
	    <td><?php echo CHtml::activeLabel($invoice,'inv_milestone_id'); ?></td>
	    <td><?php echo $inv_state;?></td>
	</tr>	
	<tr>
	    <td><?php echo $ref_id; ?></td>
	    <td><?php echo $ord_link;?></td>
	</tr>	
	<tr>
	    <td><?php echo $inv_amt; ?></td>
	    <td><?php echo Myclass::GetSiteSetting('AMOUNT_FORMAT')." ".$invoice->inv_payment; ?></td>
	</tr>	
	<tr>
	    <td><?php echo CHtml::activeLabel($invoice,'pay_amt'); ?></td>
	    <td><?php if(!empty($invoice->pay_amt)) { echo Myclass::GetSiteSetting('AMOUNT_FORMAT')." ".$invoice->pay_amt; } ?></td>
	</tr>	
	<tr>
	    <td><?php echo CHtml::activeLabel($invoice,'send_inv_due_date'); ?></td>
	    <td><?php if(!empty($invoice->send_inv_due_date)) { echo date(FORMAT_DATE,strtotime($invoice->send_inv_due_date)); } ?></td>
	</tr>	
	<tr>
	    <td><?php echo CHtml::activeLabel($invoice,'pay_date'); ?></td>
	    <td><?php if(!empty($invoice->pay_date)) { echo date(FORMAT_DATE,strtotime($invoice->pay_date)); } ?></td>
	</tr>
        <?php if(!empty($invoice->past_pay_ref)): ?>
	<tr>
	    <td><?php echo CHtml::activeLabel($invoice,'past_pay_ref'); ?></td>
	    <td><?php echo $payref; ?></td>
	</tr>
        <?php endif; ?>
	<tr>
	    <td><?php echo CHtml::activeLabel($invoice,'past_pay_remarks'); ?></td>
	    <td><?php echo $invoice->past_pay_remarks; ?></td>
	</tr>	
	<tr>
	    <td><?php echo CHtml::activeLabel($invoice,'past_inv_date'); ?></td>
	    <td><?php if(!empty($invoice->past_inv_date)) { echo date(FORMAT_DATE,strtotime($invoice->past_inv_date)); } ?></td>
	</tr>	
	<tr>
	    <td><?php echo CHtml::activeLabel($invoice,'paid_inv_date'); ?></td>
	    <td><?php if(!empty($invoice->paid_inv_date)) { echo date(FORMAT_DATE,strtotime($invoice->paid_inv_date)); } ?></td>
	</tr>		
    </tbody>
</table>
</fieldset>