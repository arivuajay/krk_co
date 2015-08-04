<?php
echo CHtml::script('$(document).ready(function() {  
			$("#list-table").dataTable({
			    "aoColumns": [{ "asSorting": [ "desc", "asc" ] },null,null,null,null,null,null,null,null],
			    "aoColumnDefs": [{ \'bSortable\': false, \'aTargets\': [ 7,8 ] }],
			    "sDom": "<\'row-fluid\'<\'span6\'l><\'span6\'f>r>t<\'row-fluid\'<\'span6\'i><\'span6\'p>>",
   			    "sPaginationType": "bootstrap",			    
			    "oLanguage": {"sLengthMenu": "_MENU_ records per page","sInfo": "Showing _START_ to _END_ of _TOTAL_ records"}
			});            
		    });');
$this->widget('bootstrap.widgets.BootAlert'); 
?>

<h1><?php echo Myclass::t('My PO Requests');?></h1>
<table  border="0" cellspacing="0" class="table table-bordered table-striped" id="list-table" cellpadding="0">
    <thead>
	<tr class="tablehead">
		<th class="hide">S.No</th>	    
		<th><?php echo Myclass::t('PR ID');?></th>
		<th><?php echo Myclass::t('Vendor Name');?></th>
		<th><?php echo Myclass::t('Created Date');?></th>
		<th><?php echo Myclass::t('Exp DD');?></th>
		<th><?php echo Myclass::t('Status');?></th>
		<th><?php echo Myclass::t('PO Total');?></th>
		<th><?php echo Myclass::t('Action');?></th>
		<th>&nbsp;</th>
	</tr>
    </thead>
    <tbody>
	<?php foreach($model as $key => $po): ?>
	<tr>
		<td class="hide"><?php echo $key+1; ?></td>
		<td><?php echo CHtml::link(PO_REQ_PREFIX.$po->po_id,array('/procurement/po/view','id'=>$po->po_id));?></td>
		<td><?php echo ucwords($po->poVen->ven_name); ?></td>
		<td><?php echo date(FORMAT_DATE,strtotime($po->po_created_on)); ?></td>
		<td><?php echo date(FORMAT_DATE,strtotime($po->po_delivery_date)); ?></td>
		<td><?php echo ($po->po_status == 0) ? Myclass::t('Pending') : Myclass::t('Approved');?></td>
		<td><?php echo Myclass::GetSiteSetting('AMOUNT_FORMAT')."  ".number_format($po->poTotalAmt, '2'); ?></td>
		<td>
		<!-- Delete -->
		<?php echo CHtml::link('<i class="cus-icon-trash"></i>',array('/procurement/po/delete','id'=>$po->po_id),
			array('onclick'=>"return confirm('Are you sure you want to delete?')",'title'=>Myclass::t('Delete'),'rel'=>'tooltip')); 
		?>	
		</td>
		<td>
		<?php
		$view_link =  CHtml::link(Myclass::t('View'),array('/procurement/po/view','id'=>$po->po_id));

		if($po->po_created_by == Yii::app()->user->id)
		    $create_po_link =  CHtml::link(Myclass::t('Create PO'),array('/procurement/po/createpo','id'=>$po->po_id));
		if(isset($po->poOrders))
		    $create_po_link = CHtml::link(Myclass::t('View PO'),array('/procurement/po/viewpodetail','id'=>$po->poOrders->po_ord_id));
		
		switch($po->po_status):
		    case '0':  echo $view_link; break;
		    case '1':  echo $create_po_link; break;
		endswitch;
                ?>
		</td>
	</tr>
	<?php endforeach; ?>
    </tbody>
</table>


