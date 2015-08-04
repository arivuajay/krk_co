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
<h2><?php echo Myclass::t("Indue Invoices"); ?></h2>
<table  border="0" cellspacing="0" class="table table-bordered table-striped" id="list-table" cellpadding="0">
    <thead>
	<tr class="tablehead">				 
		<th class="hide"><?php echo Myclass::t("S.No"); ?></th>		
		<th><?php echo Myclass::t("Inv Id"); ?></th>
		<th><?php echo Myclass::t("Customer Name"); ?></th>
		<th><?php echo Myclass::t("Invoice Date"); ?></th>
		<th><?php echo Myclass::t("Invoice Milestone"); ?></th>
		<th><?php echo Myclass::t("Order ID"); ?></th>
		<th><?php echo Myclass::t("Invoice Value"); ?></th>
		<th><?php echo Myclass::t("Action"); ?></th>
	</tr>
    </thead>
    <tbody>
	<?php 
	foreach($new_invoice as $key => $invoice): 
	    if($invoice->inv_scenario == "salesorder"):
		$cust_name = $invoice->invSo->company->name;
		$inv_state = Myclass::getRaiseInvoice($invoice->invMilestone->raise_invoice);
		$ord_link  = CHtml::link(SO_PREFIX.$invoice->invSo->so_id,array('/sales/salesorder/viewsodetail','id'=>$invoice->invSo->so_id),array('target'=>'_blank'));
	    elseif($invoice->inv_scenario == "poorder"):
		$cust_name = $invoice->invPO->vendor->ven_name;
		$inv_state = Myclass::getRaiseInvoice($invoice->invPOMilestone->raise_invoice,true);
		$ord_link  = CHtml::link(PO_PREFIX.$invoice->invPO->po_ord_id,array('/procurement/po/viewpodetail','id'=>$invoice->invPO->po_ord_id),array('target'=>'_blank'));
	    endif;    
	    ?>
	<tr>	
		<td class="hide"><?php echo $key+1; ?></td>	    	    
		<td><?php echo CHtml::link(INVOICE_PREFIX.$invoice->inv_id,array('/finance/invoice/view','id'=>$invoice->inv_id));?></td>
		<td><?php echo ucwords($cust_name); ?></td>
		<td><?php echo date(FORMAT_DATE,strtotime($invoice->inv_due_date)); ?></td>
		<td><?php echo $inv_state;?></td>
		<td><?php echo $ord_link;?></td>
		<td><?php echo Myclass::GetSiteSetting('AMOUNT_FORMAT')." ".$invoice->inv_payment; ?></td>
		<td>	
		<?php
		echo CHtml::ajaxLink(Myclass::t("Update Payment"), $this->createUrl('/finance/invoice/modal_update_payments',array('id'=>$invoice->inv_id)), 
				array('success'=>'function(r){$("#modal_update_payments").html(r).modal("toggle"); return false;}'), 
				array('title'=>Myclass::t('Read More'),'rel'=>'tooltip'));
		echo "&nbsp;&nbsp;";
		echo CHtml::link(Myclass::t('Print'),array('/finance/invoice/printinvoice','id'=>$invoice->inv_id),array('target'=>'_blank'));
		?>
		</td>
	</tr>
	<?php endforeach; ?>
    </tbody>
</table>
<?php
Yii::app()->clientScript->registerCoreScript('jquery.ui');
Yii::app()->clientScript->registerCssFile(Yii::app()->clientScript->getCoreScriptUrl().'/jui/css/base/jquery-ui.css');

?>
<?php $this->beginWidget('bootstrap.widgets.BootModal', array('id'=>'modal_update_payments'));  $this->endWidget(); ?>