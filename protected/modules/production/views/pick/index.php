<?php
echo CHtml::script('$(document).ready(function() {  
			$("#list-table").dataTable({
			    "aoColumns": [{ "asSorting": [ "asc", "desc" ] },null,null,null,null,null,null,null,null],
			    "aoColumnDefs": [{ \'bSortable\': false, \'aTargets\': [ 1,7 ] }],
			    "sDom": "<\'row-fluid\'<\'span6\'l><\'span6\'f>r>t<\'row-fluid\'<\'span6\'i><\'span6\'p>>",
   			    "sPaginationType": "bootstrap",			    
			    "oLanguage": {"sLengthMenu": "_MENU_ records per page","sInfo": "Showing _START_ to _END_ of _TOTAL_ records"}
			});            
		    });');
$this->widget('bootstrap.widgets.BootAlert'); 
?>


<table  border="0" cellspacing="0" class="table table-bordered table-striped table_order" id="list-table" cellpadding="0">
    <thead>
	<tr class="tablehead">				 
		<th class="hide">S.No</th>
		<th><?php echo Myclass::t('SO ID');?></th>
		<th><?php echo Myclass::t('Customer Name');?></th>
		<th><?php echo Myclass::t('SO Date');?></th>
		<th><?php echo Myclass::t('Ref Quote');?></th>
		<th><?php echo Myclass::t('Status');?></th>
		<th><?php echo Myclass::t('Order Value');?></th>
		<th><?php echo Myclass::t('Invoiced Value');?></th>
		<th><?php echo Myclass::t('Actions');?></th>
	</tr>
    </thead>
    <tbody>
	<?php foreach($sales as $key => $sale): ?>
	<tr>				 
		<td class="hide"><?php echo $key+1; ?></td>
		<td><?php echo CHtml::link(SO_PREFIX.$sale->so_id,array('/sales/salesorder/viewsodetail','id'=>$sale->so_id),array('title'=>Myclass::t('View'),'rel'=>'tooltip'));?></td>
		<td><?php echo ucwords($sale->company->name); ?></td>
		<td><?php echo date(FORMAT_DATE,strtotime($sale->so_created_date)); ?></td>
		<td><?php echo ($sale->quote_id > 0) ? CHtml::link(QUOTE_PREFIX.$sale->quote_id,array('/sales/quote/view','id'=>$sale->quote_id)) : Myclass::t('Null'); ?></td>
		<td><?php echo Myclass::findSalesorderStatus($sale->so_status); ?></td>
		<td><?php echo Myclass::GetSiteSetting("AMOUNT_FORMAT")." ".$sale->orderdetail->total_order_value; ?></td>
		<td><?php echo (!empty($sale->invoicedAmt)) ? Myclass::GetSiteSetting("AMOUNT_FORMAT")." ".$sale->invoicedAmt : "--"; ?></td>
		<td><?php
		    echo CHtml::link('<i class="icon-pencil"></i>',array('/production/pick/view','id'=>$sale->so_id),array('title'=>Myclass::t('Edit'),'rel'=>'tooltip'));
		    echo CHtml::link('<i class="icon-trash"></i>',array('/production/pick/delete','id'=>$sale->so_id),array('onclick'=>"return confirm('Are you sure you want to delete?')",'title'=>Myclass::t('Delete'),'rel'=>'tooltip')); 
		?>	
		</td>
	</tr>
	<?php endforeach; ?>
    </tbody>
</table>


