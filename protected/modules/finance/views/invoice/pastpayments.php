<?php
echo CHtml::script('$(document).ready(function() {  
			$("#list-table").dataTable({
			    "aoColumns": [{ "asSorting": [ "desc", "asc" ] },null,null,null,null,null,null,null],
			    "aoColumnDefs": [{ \'bSortable\': false, \'aTargets\': [ 1,6 ] }],
			    "sDom": "<\'row-fluid\'<\'span6\'l><\'span6\'f>r>t<\'row-fluid\'<\'span6\'i><\'span6\'p>>",
   			    "sPaginationType": "bootstrap",			    
			    "oLanguage": {"sLengthMenu": "_MENU_ records per page","sInfo": "Showing _START_ to _END_ of _TOTAL_ records",}
			});            
		    });');
?>
<h2><?php echo ($mode=='manual') ? Myclass::t("Manual- Paid PO's") : Myclass::t("Paid PO's"); ?></h2>

<div class="controls">
    <?php 
	echo CHtml::link(Myclass::t("Paid PO's"),array("/finance/invoice/pastpayments")); 
	echo "&nbsp;&nbsp;||&nbsp;&nbsp;";
	echo CHtml::link(Myclass::t("Manual- Paid PO's"),array("/finance/invoice/pastpayments","mode"=>"manual")); 
    ?>
</div>

<table  border="0" cellspacing="0" class="table table-bordered table-striped" id="list-table" cellpadding="0">
    <thead>
	<tr class="tablehead">
		<th class="hide"><?php echo Myclass::t("S.No"); ?></th>		
		<th><?php echo Myclass::t("PO ID"); ?></th>
		<th><?php echo Myclass::t("Vendor Name"); ?></th>
		<th><?php echo Myclass::t("PO Date"); ?></th>
		<th><?php echo Myclass::t("PO Milestone"); ?></th>
		<th><?php echo Myclass::t("PO Order ID"); ?></th>
		<th><?php echo Myclass::t("PO Value"); ?></th>
		<th><?php echo Myclass::t("Action"); ?></th>
	</tr>
    </thead>
    <tbody>
	<?php 
	foreach($new_invoice as $key=>$invoice):
	    if(isset($mode) && ($mode == "manual")):
		$pre = MANUAL_PREFIX;
		$primary_id = $invoice->pay_id;
		$view_url = "/finance/invoice/manualpoview";
		$cust_name  = $invoice->pay_vendor;
		$pay_date   = $invoice->pay_date;
		$inv_state  = Myclass::t('Null');
		$ord_link   = $invoice->pay_description;
		$amount	    = $invoice->pay_amt;
		$popup_url = "/finance/invoice/modal_update_man_po_payments";
	    else:
		$pre = PAYMENT_PREFIX;
		$primary_id = $invoice->inv_id;
		$view_url = "/finance/invoice/view";
		$cust_name = $invoice->invPO->vendor->ven_name;
		$pay_date  = $invoice->inv_due_date;
		$inv_state = Myclass::getRaiseInvoice($invoice->invPOMilestone->raise_invoice,true);
		$ord_link  = CHtml::link(PO_PREFIX.$invoice->invPO->po_ord_id,array('/procurement/po/viewpodetail','id'=>$invoice->invPO->po_ord_id),array('target'=>'_blank'));
		$amount	    = $invoice->inv_payment;
		$popup_url = "/finance/invoice/modal_update_po_payments";
	    endif; 
	?>
	<tr>		
		<td class="hide"><?php echo $key+1; ?></td>
		<td><?php echo CHtml::link($pre.$primary_id,array($view_url,'id'=>$primary_id));?></td>
		<td><?php echo ucwords($cust_name); ?></td>
		<td><?php echo date(FORMAT_DATE,strtotime($pay_date)); ?></td>
		<td><?php echo $inv_state;?></td>
		<td><?php echo $ord_link;?></td>
		<td><?php echo Myclass::GetSiteSetting('AMOUNT_FORMAT')." ".$amount; ?></td>
		<td>	
		<?php
		echo CHtml::link('<i class="cus-icon-zoom"></i>',array($view_url,'id'=>$primary_id),array('title'=>Myclass::t('View'),'rel'=>'tooltip')); 
		?>
		</td>
	</tr>
	<?php endforeach; ?>
    </tbody>
</table>