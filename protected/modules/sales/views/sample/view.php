<?php
echo CHtml::script('$(document).ready(function() {  
			$("#list-table").dataTable({
			    "aoColumns": [{ "asSorting": [ "desc", "asc" ] },null,null,null,null,null],
			    "aoColumnDefs": [{ \'bSortable\': false, \'aTargets\': [ 6 ] }],
			    "sDom": "<\'row-fluid\'<\'span6\'l><\'span6\'f>r>t<\'row-fluid\'<\'span6\'i><\'span6\'p>>",
   			    "sPaginationType": "bootstrap",			    
			    "oLanguage": {"sLengthMenu": "_MENU_ records per page","sInfo": "Showing _START_ to _END_ of _TOTAL_ records"}
			});            
		    });');
$this->widget('bootstrap.widgets.BootAlert'); 
?>

<h1>My samples</h1>
<table  border="0" cellspacing="0" class="table table-bordered table-striped" id="list-table" cellpadding="0">
    <thead>
	<tr class="tablehead">
		<th class="hide">S.No</th>
		<th>Request ID</th>
		<th>Client Name</th>
		<th>Despatch No</th>
		<th>Created Date</th>
		<th>Status</th>
		<th>Action</th>
	</tr>
    </thead>
    <tbody>
	<?php 
	$i =1;	
	foreach($model as $key => $order): 
	    switch($order->sample_status):
		case '0': $status = "Pending Approval";break;
		case '1': $status = "In Transit";break;
		case '2': $status = "In Transit";break;
		case '3': $status = "Returned";break;
	    endswitch;
	?>
	<tr>	
		<td class="hide"><?php echo $key+1;?></td>
		<td><?php echo CHtml::link(SAMPLE_PREFIX.$order->sample_id,array('/sales/sample/viewdetail','id'=>$order->sample_id));?></td>
		<td><?php echo ucwords($order->client_name); ?></td>
		<td><?php echo (!empty($order->despatch_no)) ? $order->despatch_no :  "--"; ?></td>
		<td><?php echo date(FORMAT_DATE,strtotime($order->req_date)); ?></td>
		<td><?php echo $status;?></td>
		<td>
		<?php 
		echo CHtml::link('<i class="cus-icon-zoom"></i>',array('/sales/sample/viewdetail','id'=>$order->sample_id),
			array('title'=>'view','rel'=>'tooltip')); 
		echo "&nbsp;&nbsp;&nbsp;&nbsp;";
		if($order->sample_status == '1' || $order->sample_status == '2')
		    echo CHtml::link('Return Request',array('/sales/sample/notifyreturn','id'=>$order->sample_id),array('onclick'=>"return confirm('Are you sure you want to return the sample?')",'title'=>'Return','rel'=>'tooltip')); 
		?>	
		</td>
	</tr>
	<?php $i++;	endforeach; ?>
    </tbody>
</table>


