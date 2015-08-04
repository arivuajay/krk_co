<?php
echo CHtml::script('$(document).ready(function() {  
			var oTable = $("#list-table").dataTable({
			    "aoColumns": [{ "asSorting": [ "desc", "asc" ] },null,null,null,null,null],
			    "aoColumnDefs": [{ \'bSortable\': false, \'aTargets\': [ 1 ] }],
			    "sDom": "<\'row-fluid\'<\'span6 date-range\'l><\'span6\'f>r>t<\'row-fluid\'<\'span6\'i><\'span6\'p>>",
   			    "sPaginationType": "bootstrap",			    
			    "oLanguage": {"sLengthMenu": "_MENU_ records per page","sInfo": "Showing _START_ to _END_ of _TOTAL_ records"},
			    "fnDrawCallback": function ( oSettings ){
					if ( oSettings.bSorted || oSettings.bFiltered )
					{
					    for ( var i=0, iLen=oSettings.aiDisplay.length ; i<iLen ; i++ )
					    {
						$("td:eq(1)", oSettings.aoData[ oSettings.aiDisplay[i] ].nTr ).html( i+1 );
					    }
					}
				    },
			    "fnFooterCallback": function (nRow, aaData, iStart, iEnd, aiDisplay ) {
				if(iEnd > 0) {
				    var total_credit = 0;
				    var total_debit = 0;
				    var credit = 0;
				    var debit = 0;

				    /*Calculate the total for all rows, even outside this page*/
				    for (var i = iStart; i < iEnd; i++) {
					/*Have to strip out extra characters so parsefloat and parseInt work right*/
					credit = parseFloat(aaData[aiDisplay[i]][4].replace("$", "").replace(",",""));
					debit = parseFloat(aaData[aiDisplay[i]][5].replace("$", "").replace(",",""));
					if(isNaN(credit) == false)
					{
					total_credit += credit;
					}
					if(isNaN(debit) == false)
					{
					total_debit += debit;
					}
				    }
				    
				    $("#total-credit").html("'.Myclass::GetSiteSetting('AMOUNT_FORMAT').' "+total_credit.toFixed(2));
				    $("#total-debit").html("'.Myclass::GetSiteSetting('AMOUNT_FORMAT').' "+total_debit.toFixed(2));
				} 
			     }	
			});

			$.datepicker.regional[""].dateFormat = "'.JS_FORMAT_DATE.'";
			$.datepicker.setDefaults($.datepicker.regional[""]);
			oTable.columnFilter({
			    sPlaceHolder: "head:before",
			    aoColumns: [ 
				null,
				null,
				{ sSelector: ".date-range", type:"date-range" },
				null,
				null,
				null
			    ]

			});
			$(".date_range_filter").addClass("input-medium");
		    });');

$this->widget('bootstrap.widgets.BootAlert');
?>
<?php // echo (empty($cr_total_amt)) ? "--" :Myclass::GetSiteSetting('AMOUNT_FORMAT')." ".number_format($cr_total_amt,2);?>
<h2>Account Summary</h2>
<table  border="0" cellspacing="0" class="table table-bordered table-striped" id="list-table" cellpadding="0">
    <thead>
	<tr class="tablehead">
		<th class="hide">Row NO</th>
		<th><?php echo Myclass::t("S.No"); ?></th>
		<th><?php echo Myclass::t("Date"); ?></th>
		<th><?php echo Myclass::t("Description"); ?></th>
		<th><?php echo Myclass::t("Dr"); ?></th>
		<th><?php echo Myclass::t("Cr"); ?></th>
	</tr>
    </thead>
    <tbody>
	<?php 
	$cr_total_amt =0;$dr_total_amt =0;
	foreach($invoices as $key => $invoice):
	    $dr = "--"; $cr = "--";
	    if(isset($invoice->memo_id)): //From Memo
		$cust_name = $invoice->cli_name;
		$ord_link  = CHtml::link(MEMO_PREFIX.$invoice->memo_id,array('/finance/memo/view','id'=>$invoice->memo_id),array('target'=>'_blank'));
		if($invoice->memo_scenario == "sales_order"):
		    $description = Myclass::t("Debit Payment to ")."<b>".$cust_name."</b>".Myclass::t(" towards ").$ord_link;
		    $dr = Myclass::GetSiteSetting('AMOUNT_FORMAT')." ".number_format($invoice->amount,2);
		    $dr_total_amt +=  $invoice->amount;
		else:
		    $description = Myclass::t("Credit Payment From ")."<b>".$cust_name."</b>".Myclass::t(" towards ").$ord_link;
		    $cr = Myclass::GetSiteSetting('AMOUNT_FORMAT')." ".number_format($invoice->amount,2);
		    $cr_total_amt +=  $invoice->amount;
		endif;
	    elseif(isset($invoice->pay_id)): //Manual PO
		$cust_name = $invoice->pay_vendor;
		$ord_link  = CHtml::link(MANUAL_PREFIX.$invoice->pay_id,array('/finance/invoice/manualpoview','id'=>$invoice->pay_id),array('target'=>'_blank'));
		$description = Myclass::t("Manual Payment to ")."<b>".$cust_name."</b>".Myclass::t(" towards ").$ord_link;
		$dr = Myclass::GetSiteSetting('AMOUNT_FORMAT')." ".number_format($invoice->pay_amt,2);
		$dr_total_amt +=  $invoice->pay_amt;
	    else:
		if($invoice->inv_scenario == "salesorder"):
		    $cust_name = $invoice->invSo->company->name;
		    $inv_state = Myclass::getRaiseInvoice($invoice->invMilestone->raise_invoice);
		    $ord_link  = CHtml::link(SO_PREFIX.$invoice->invSo->so_id,array('/sales/salesorder/viewsodetail','id'=>$invoice->invSo->so_id),array('target'=>'_blank'));
		    $description = Myclass::t("Received From ")."<b>".$cust_name."</b>".Myclass::t(" towards ").$ord_link;
		    $cr = Myclass::GetSiteSetting('AMOUNT_FORMAT')." ".number_format($invoice->inv_payment,2);
		    $cr_total_amt +=  $invoice->inv_payment;
		elseif($invoice->inv_scenario == "poorder"):
		    $cust_name = $invoice->invPO->vendor->ven_name;
		    $inv_state = Myclass::getRaiseInvoice($invoice->invPOMilestone->raise_invoice,true);
		    $ord_link  = CHtml::link(PO_PREFIX.$invoice->invPO->po_ord_id,array('/procurement/po/viewpodetail','id'=>$invoice->invPO->po_ord_id),array('target'=>'_blank'));
		    $description = Myclass::t("Paid to ")."<b>".$cust_name."</b>".Myclass::t(" towards ").$ord_link;
		    $dr = Myclass::GetSiteSetting('AMOUNT_FORMAT')." ".number_format($invoice->inv_payment,2);
		    $dr_total_amt +=  $invoice->inv_payment;
		endif;
	    endif;
	?>
	<tr>	
		<td class="hide"><?php echo $key+1;?></td>	
		<td></td>
		<td><?php echo date(FORMAT_DATE,strtotime($invoice->pay_date)); ?></td>
		<td><?php echo $description; ?></td>
		<td><?php echo $dr;?></td>
		<td><?php echo $cr; ?></td>
	</tr>
	<?php endforeach; ?>
    </tbody>
</table>
<table class="table-bordered pull-right account_final">
    	<tr>
	    
	    <td><?php echo "<h4>".Myclass::t("Total Creditors")." :</h4>"; ?></td>
	    <td><h4 id='total-credit'>--</h4></td>
	</tr>
	<tr>
	    <td><?php echo "<h4>".Myclass::t("Total Debtors")." :</h4>"?></td>
	    <td><h4 id='total-debit'>--</h4></td>
	</tr>
</table>
<?php
Yii::app()->clientScript->registerCoreScript('jquery.ui');
Yii::app()->clientScript->registerCssFile(Yii::app()->clientScript->getCoreScriptUrl().'/jui/css/base/jquery-ui.css');

$this->beginWidget('bootstrap.widgets.BootModal', array('id'=>'modal_send_invoice'));  
$this->endWidget(); 
?>