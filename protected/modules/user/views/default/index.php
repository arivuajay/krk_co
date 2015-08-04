<?php
$this->breadcrumbs=array(
	'Users',
);
 
echo CHtml::script('$(document).ready(function() {  
			$("#list-table").dataTable({
			    "aoColumnDefs": [{ \'bSortable\': false, \'aTargets\': [ 5 ] }],
			    "sDom": "<\'row-fluid\'<\'span6\'l><\'span6\'f>r>t<\'row-fluid\'<\'span6\'i><\'span6\'p>>",
   			    "sPaginationType": "bootstrap",			    
			    "oLanguage": {"sLengthMenu": "_MENU_ records per page","sInfo": "Showing _START_ to _END_ of _TOTAL_ records"}
			});            
		    });');

?>

<h1>User Manager</h1>
<?php $this->widget('bootstrap.widgets.BootAlert'); ?>
<table  border="0" cellspacing="0" class="table table-bordered table-striped" id="list-table" cellpadding="0">
    <thead>
	<tr class="tablehead">				 
		<th>S.No</th>
		<th>Name</th>
		<th>Username</th>
		<th>Role</th>
		<th>E-Mail</th>
		<th>Action</th>
	</tr>
    </thead>
    <tbody>
	<?php 
	$i =1;	
	foreach($users as $user): 
	    	$status_icon = ($user->is_active==1)?'ok':'minus';
	?>
	<tr>				 
		<td><?php echo $i;?></td>
		<td><?php echo ucwords($user->userProfiles->first_name." ".$user->userProfiles->last_name); ?></td>
		<td><?php echo $user->user_name; ?></td>
		<td><?php echo implode('<br />',CHtml::listData($user->userRoles,'role_id','role.name'));?></td>
		<td><?php echo $user->userProfiles->email_address; ?></td>
		<td>	
		<!-- Status Change -->
		<?php echo CHtml::link('<i class="icon-'.$status_icon.'-sign"></i>',array('/user/default/changestatus','id'=>$user->user_id),
			array('title'=>'Status','rel'=>'tooltip','class'=>'eye-open')); 
		?>
		<!-- Update / edit -->
		<?php echo CHtml::link('<i class="icon-pencil"></i>',array('/user/default/update','id'=>$user->user_id),
			array('title'=>'Edit','rel'=>'tooltip'));
		?>
		<!-- Delete -->
		<?php echo CHtml::link('<i class="icon-trash"></i>',array('/user/default/delete','id'=>$user->user_id),
			array('onclick'=>"return confirm('Are you sure you want to delete?')",'title'=>'Delete','rel'=>'tooltip')); 
		?>	
		</td>
	</tr>
	<?php $i++;	endforeach; ?>
    </tbody>
</table>


