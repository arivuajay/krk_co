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

<h1><?php echo Myclass::t('Application Settings');?> <?php echo CHtml::link('+ '.Myclass::t('Create Setting'),array('/settings/sitesettings/create'),array('class'=>'pull-right','style'=>'font-size:20px;')); ?></h1>
<?php $this->widget('bootstrap.widgets.BootAlert'); ?>
<table  border="0" cellspacing="0" class="table table-bordered table-striped" id="list-table" cellpadding="0">
    <thead>
	<tr class="tablehead">				 
		<th><?php echo Myclass::t('S.No');?> #</th>
		<th><?php echo Myclass::t('Label');?></th>
		<th><?php echo Myclass::t('Value');?></th>
		<th><?php echo Myclass::t('Action');?></th>
	</tr>
    </thead>
    <tbody>
	<?php 
	foreach($settings as $key =>$setting): 
	    $status = ($setting->setting_status == '0')?"minus":"ok";
	?>
	<tr>				 
		<td><?php echo $key+1;?></td>
		<td><?php echo $setting->param_key; ?></td>
		<td><?php echo $setting->param_value; ?></td>
		<td>	
		<?php 
		 echo CHtml::link('<i class="icon-pencil"></i>',array('/settings/sitesettings/update','id'=>$setting->settings_id),
			array('title'=>Myclass::t('Edit'),'rel'=>'tooltip'));
		 echo "&nbsp;&nbsp;&nbsp;";
		 echo CHtml::link('<i class="icon-'.$status.'-sign"></i>',array('/settings/sitesettings/updatestatus','id'=>$setting->settings_id),
			array('title'=>Myclass::t('Update Status'),'rel'=>'tooltip'));
		?>
		</td>
	</tr>
	<?php $i++;	endforeach; ?>
    </tbody>
</table>