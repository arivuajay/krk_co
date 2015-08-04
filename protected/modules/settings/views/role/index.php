<?php
echo CHtml::script('$(document).ready(function() {  
			$("#list-table").dataTable({
			    "aoColumnDefs": [{ \'bSortable\': false, \'aTargets\': [ 3 ] }],
			    "sDom": "<\'row-fluid\'<\'span6\'l><\'span6\'f>r>t<\'row-fluid\'<\'span6\'i><\'span6\'p>>",
   			    "sPaginationType": "bootstrap",			    
			    "oLanguage": {"sLengthMenu": "_MENU_ records per page","sInfo": "Showing _START_ to _END_ of _TOTAL_ records"}
			});            
		    });');

?>

<h1><?php echo Myclass::t('Role Manager');?> <?php echo CHtml::link('+ '.Myclass::t('Create Role'),array('/settings/role/create'),array('class'=>'pull-right','style'=>'font-size:20px;')); ?></h1>
<?php $this->widget('bootstrap.widgets.BootAlert'); ?>
<table  border="0" cellspacing="0" class="table table-bordered table-striped" id="list-table" cellpadding="0">
    <thead>
	<tr class="tablehead">				 
		<th><?php echo Myclass::t('Role');?> #</th>
		<th><?php echo Myclass::t('Name');?></th>
		<th><?php echo Myclass::t('Status');?></th>
		<th><?php echo Myclass::t('Action');?></th>
	</tr>
    </thead>
    <tbody>
	<?php 
	$i =1;	
	foreach($roles as $role): 
	    	$status_icon = ($role->is_active==1)?'ok':'minus';
	?>
	<tr>				 
		<td><?php echo $role->role_id;?></td>
		<td><?php echo ucwords($role->name); ?></td>
		<td><?php echo CHtml::link('<i class="icon-'.$status_icon.'-sign"></i>',array('/settings/role/changestatus','id'=>$role->role_id),
			array('title'=>Myclass::t('Status'),'rel'=>'tooltip','class'=>'eye-open')); 
		?></td>
		<td>	
		<!-- Update / edit -->
		<?php echo CHtml::link('<i class="cus-icon-pencil"></i>',array('/settings/role/update','id'=>$role->role_id),
			array('title'=>Myclass::t('Edit'),'rel'=>'tooltip'));
		?>
		<!-- Delete -->
		<?php echo CHtml::link('<i class="cus-icon-trash"></i>',array('/settings/role/delete','id'=>$role->role_id),
			array('onclick'=>"return confirm('".Myclass::t('Are you sure you want to delete')."?')",'title'=>Myclass::t('Delete'),'rel'=>'tooltip')); 
		?>	
		</td>
	</tr>
	<?php $i++;	endforeach; ?>
    </tbody>
</table>


