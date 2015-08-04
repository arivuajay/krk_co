<?php
$this->hiddenpath = "/finance/memo/past";
//if($model->memo_scenario == "salesorder"):
//    $cust_name = $model->cli_name;
//    $inv_state = Myclass::getRaiseInvoice($model->invMilestone->raise_invoice);
//    $ord_link  = CHtml::link(SO_PREFIX.$model->invSo->so_id,array('/sales/salesorder/viewsodetail','id'=>$model->invSo->so_id),array('target'=>'_blank'));
//    $payref = $model->past_pay_ref;
//    $pre = INVOICE_PREFIX;   
//    $title = "Invoice detail # ";
//elseif($model->memo_scenario == "poorder"):
//    $cust_name = $model->cli_name;
//    $inv_state = Myclass::getRaiseInvoice($model->invPOMilestone->raise_invoice,true);
//    $ord_link  = CHtml::link(PO_PREFIX.$model->invPO->po_ord_id,array('/procurement/po/viewpodetail','id'=>$model->invPO->po_ord_id),array('target'=>'_blank'));
//    $payref = CHtml::link("Download", array("/site/download",'doc'=>$model->inv_id.'_'.$model->past_pay_ref));
//    $pre = PAYMENT_PREFIX;
//    $title = "Payment detail # ";
//endif;
$pre		= MEMO_PREFIX;
$cust_name	= $model->cli_name;
$rel_id		= $model->rel_id;
$inv_id		= $model->inv_id;
$amount		= $model->amount;	
$pay_mode	= $model->pay_mode;		
$pay_date	= $model->pay_date;
$remarks	= $model->remarks;
$memo_date	= $model->memo_date;
$description	= $model->description;
$title = "Memo Description # ".$model->memo_id;
?>
<fieldset> 
    <legend><?php echo $title; ?></legend>
<table  border="0" cellspacing="0" width="50%"  class="table table-bordered table-striped" id="list-table" cellpadding="0">
    <tbody>
	<tr>
	    <td><?php echo CHtml::activeLabel($model,'memo_id'); ?></td>
	    <td><?php echo CHtml::link($pre.$model->memo_id,array('/finance/invoice/view','id'=>$model->memo_id));?></td>
	</tr>
	<tr>
	    <td>Customer Name</td>
	    <td><?php echo ucwords($cust_name);?></td>
	</tr>
	<tr>
	    <td>Related ID</td>
	    <td><?php echo $rel_id;?></td>
	</tr>	
	<?php if(!empty($inv_id)): ?>
	<tr>
	    <td>INV ID</td>
	    <td><?php echo $inv_id;?></td>
	</tr>
	<?php endif; ?>
	<tr>
	    <td>Amount</td>
	    <td><?php echo Myclass::GetSiteSetting('AMOUNT_FORMAT')." ".$amount; ?></td>
	</tr>	
	<tr>
	    <td>Payment Mode</td>
	    <td><?php echo $pay_mode;?></td>
	</tr>	
	<tr>
	    <td>Payment Date</td>
	    <td><?php echo date(FORMAT_DATE,strtotime($pay_date)); ?></td>
	</tr>	
	<tr>
	    <td>Description</td>
	    <td><?php echo $description;?></td>
	</tr>		
	<tr>
	    <td>Remarks</td>
	    <td><?php echo $remarks;?></td>
	</tr>	
	<tr>
	    <td>Created Date</td>
	    <td><?php echo date(FORMAT_DATE,strtotime($memo_date)); ?></td>
	</tr>	
    </tbody>
</table>
</fieldset>