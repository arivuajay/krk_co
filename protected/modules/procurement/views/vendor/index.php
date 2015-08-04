<?php
echo CHtml::script('$(document).ready(function() {  
			$("#list-table").dataTable({
			    "aoColumnDefs": [{ \'bSortable\': false, \'aTargets\': [ 5 ] }],
			    "sDom": "<\'row-fluid\'<\'span6\'l><\'span6\'f>r>t<\'row-fluid\'<\'span6\'i><\'span6\'p>>",
   			    "sPaginationType": "bootstrap",			    
			    "oLanguage": {"sLengthMenu": "_MENU_ records per page","sInfo": "Showing _START_ to _END_ of _TOTAL_ records"}
			});            
		    });');
?>

<h1><?php echo Myclass::t('View Vendors');?></h1>
<table  border="0" cellspacing="0" class="table table-bordered table-striped" id="list-table" cellpadding="0">
    <thead>
	<tr class="tablehead">				 
		<th><?php echo Myclass::t('Vendor ID');?></th>
		<th><?php echo Myclass::t('Vendor Name');?></th>
		<th><?php echo Myclass::t('Primary Contact');?></th>
		<th><?php echo Myclass::t('Email');?></th>
		<th><?php echo Myclass::t('Phone');?></th>
		<th><?php echo Myclass::t('Action');?></th>
	</tr>
    </thead>
    <tbody>
	<?php $i =1; foreach($lists as $key => $list): ?>
	<tr>				 
		<td><?php echo CHtml::link(VENDOR_PREFIX.$list->ven_id,array('/procurement/vendor/create','venid'=>$list->ven_id)) ;?></td>
		<td><?php echo ucwords($list->ven_name); ?></td>
		<td><?php echo $list->primaryContact->con_name; ?></td>
		<td><?php echo $list->primaryContact->ven_email;?></td>
		<td><?php echo $list->off_phone; ?></td>
		<td>	
		<!-- Update / edit -->
		<?php echo CHtml::link('<i class="cus-icon-pencil"></i>',array('/procurement/vendor/create','venid'=>$list->ven_id),
			array('title'=>Myclass::t('Edit'),'rel'=>'tooltip'));
		?>
		<!-- Delete -->
		<?php echo CHtml::link('<i class="cus-icon-trash"></i>',array('/procurement/vendor/delete','id'=>$list->ven_id),
			array('onclick'=>"return confirm('Are you sure you want to delete?')",'title'=>Myclass::t('Delete'),'rel'=>'tooltip')); 
		?>	
		</td>
	</tr>
	<?php $i++;	endforeach; ?>
    </tbody>
</table>


