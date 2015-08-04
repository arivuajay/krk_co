<?php
echo CHtml::script('$(document).ready(function() {  
			var oTable = $("#list-table").dataTable({
			    "aoColumns": [{ "asSorting": [ "desc", "asc" ] },null,null,null,null,null,null,null],
			    "aoColumnDefs": [{ \'bSortable\': false, \'aTargets\': [ 1,6 ] }],
			    "sDom": "<\'row-fluid\'<\'span6\'l><\'span6\'f>r>t<\'row-fluid\'<\'span6\'i><\'span6\'p>>",
   			    "sPaginationType": "bootstrap",			    
			    "oLanguage": {"sLengthMenu": "_MENU_ records per page","sInfo": "Showing _START_ to _END_ of _TOTAL_ records",}
			});            
		    });');
?>
<h2>Past Memo</h2>
<div class="controls">
    <label class="checkbox inline"><input type="radio" name="TestForm" value="credit" checked="true"><label for="TestForm_inlineCheckboxes_0">Credit Memo</label></label>
    <label class="checkbox inline"><input type="radio" name="TestForm" value="debit"><label for="TestForm_inlineCheckboxes_1">Debit Memo</label></label>
</div>
<table  border="0" cellspacing="0" class="table table-bordered table-striped" id="list-table" cellpadding="0">
    <thead>
	<tr class="tablehead">				 
		<th class="hide">S.No</th>		
		<th>Memo ID</th>
		<th>Client Name</th>
		<th>Related ID</th>
		<th>Amount</th>
		<th>Payment Mode</th>
		<th>Payment Date</th>
		<th>Action</th>
	</tr>
    </thead>
    <tbody>
	<?php 
	foreach($model as $key => $invoice): 
		$pre = MEMO_PREFIX;
		$primary_id = $invoice->memo_id;
		$view_url = "/finance/memo/view";
		$cust_name  = $invoice->cli_name;
		$rel_id	    = $invoice->rel_id;
		$amount	    = $invoice->amount;	
		$pay_mode   = $invoice->pay_mode;		
		$pay_date   = $invoice->pay_date;
	    ?>
	<tr>	
		<td class="hide"><?php echo $key+1; ?></td>	    	    
		<td><?php echo CHtml::link($pre.$primary_id,array($view_url,'id'=>$primary_id));?></td>
		<td><?php echo ucwords($cust_name); ?></td>
		<td><?php echo $rel_id; ?></td>
		<td><?php echo Myclass::GetSiteSetting('AMOUNT_FORMAT')." ".$amount;?></td>
		<td><?php echo $pay_mode;?></td>
		<td><?php echo date(FORMAT_DATE,strtotime($pay_date)); ?></td>
		<td>	
		<?php echo CHtml::link('<i class="cus-icon-zoom"></i>',array('/finance/memo/view','id'=>$invoice->memo_id),array('title'=>'View','rel'=>'tooltip')); ?>
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
<script type="text/javascript">
$(document).ready(function(){
    $('input[name="TestForm"]').live('click',function(){
	var val = $(this).val();
	var urlData = '/finance/memo/past?mode='+val;
	//Retrieve the new data with $.getJSON. You could use it ajax too
	$.getJSON(urlData, null, function(json){
	    table = $('#list-table').dataTable();
	    oSettings = table.fnSettings();

	    table.fnClearTable(this);

	    for (var i=0; i<json.aaData.length; i++)
	    {
		table.oApi._fnAddData(oSettings, json.aaData[i]);
	    }

	    oSettings.aiDisplay = oSettings.aiDisplayMaster.slice();
	    table.fnDraw();
	    
	    $('#list-table tbody tr').each(function(){
		$(this).find("td:eq(0)").addClass('hide');
	    });
	});
    });
});
</script>