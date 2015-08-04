<?php
$this->hiddenpath = "/settings/productprice/index";
echo CHtml::script('$(document).ready(function() {  
			$("#list-table").dataTable({
			    "aoColumnDefs": [{ \'bSortable\': false, \'aTargets\': [ 3 ] }],
			    "sDom": "<\'row-fluid\'<\'span6\'l><\'span6\'f>r>t<\'row-fluid\'<\'span6\'i><\'span6\'p>>",
   			    "sPaginationType": "bootstrap",			    
			    "oLanguage": {"sLengthMenu": "_MENU_ records per page","sInfo": "Showing _START_ to _END_ of _TOTAL_ records"}
			});            
		    });');

?>

<h1>Product Price<?php echo CHtml::link('+ Create Product Price range',array('/settings/productprice/create'),array('class'=>'pull-right','style'=>'font-size:20px;')); ?></h1>
<?php $this->widget('bootstrap.widgets.BootAlert'); ?>
<table  border="0" cellspacing="0" class="table table-bordered table-striped" id="list-table" cellpadding="0">
    <thead>
	<tr class="tablehead">				 
		<th>S.No #</th>		
		<th>Start Range</th>
		<th>End Range</th>
		<th>Action</th>
	</tr>
    </thead>
    <tbody>
	<?php 
	foreach($prdtrange as $key =>$range): 
	?>
	<tr>				 
		<td><?php echo $range->prid;?></td>
		<td><?php echo $range->range_from; ?></td>		
		<td><?php echo $range->range_to; ?></td>		
		<td>	
		<!-- Update / edit -->
		<?php echo CHtml::link('<i class="cus-icon-pencil"></i>',array('/settings/productprice/update','id'=>$range->prid),
			array('title'=>'Edit','rel'=>'tooltip'));
		?>
		<!-- Delete -->
		<?php echo CHtml::link('<i class="cus-icon-trash"></i>',array('/settings/productprice/delete','id'=>$range->prid),
			array('onclick'=>"return confirm('Are you sure you want to delete?')",'title'=>'Delete','rel'=>'tooltip')); 
		?>
		</td>
	</tr>
	<?php $i++;	endforeach; ?>
    </tbody>
</table>


