<?php
echo CHtml::script('$(document).ready(function() {  
			$("#list-table").dataTable({
			    "aoColumnDefs": [{ \'bSortable\': false, \'aTargets\': [ 2 ] }],
			    "sDom": "<\'row-fluid\'<\'span6\'l><\'span6\'f>r>t<\'row-fluid\'<\'span6\'i><\'span6\'p>>",
   			    "sPaginationType": "bootstrap",			    
			    "oLanguage": {"sLengthMenu": "_MENU_ records per page","sInfo": "Showing _START_ to _END_ of _TOTAL_ records"}
			});            
		    });');

?>

<h1><?php echo Myclass::t('Product Class');?><?php echo CHtml::link('+ Create Product Class',array('/settings/productclass/create'),array('class'=>'pull-right','style'=>'font-size:20px;')); ?></h1>
<?php $this->widget('bootstrap.widgets.BootAlert'); ?>
<table  border="0" cellspacing="0" class="table table-bordered table-striped" id="list-table" cellpadding="0">
    <thead>
	<tr class="tablehead">				 
		<th><?php echo Myclass::t('S.No');?> #</th>		
		<th><?php echo Myclass::t('Value');?></th>
		<th><?php echo Myclass::t('Action');?></th>
	</tr>
    </thead>
    <tbody>
	<?php 
	foreach($productClass as $key =>$setting): 
	?>
	<tr>				 
		<td><?php echo $setting->product_class_id;?></td>
		<td><?php echo $setting->name; ?></td>		
		<td>	
		<!-- Update / edit -->
		<?php echo CHtml::link('<i class="cus-icon-pencil"></i>',array('/settings/productclass/update','id'=>$setting->product_class_id),
			array('title'=>Myclass::t('Edit'),'rel'=>'tooltip'));
		?>
		<!-- Delete -->
		<?php echo CHtml::link('<i class="cus-icon-trash"></i>',array('/settings/productclass/delete','id'=>$setting->product_class_id),
			array('onclick'=>"return confirm('".Myclass::t('Are you sure you want to delete')."?')",'title'=>Myclass::t('Delete'),'rel'=>'tooltip')); 
		?>
		</td>
	</tr>
	<?php $i++;	endforeach; ?>
    </tbody>
</table>


