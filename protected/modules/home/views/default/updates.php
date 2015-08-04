<h1>Transaction Updates</h1>
<?php 
echo CHtml::script('$(document).ready(function() {  
			$("#list-table").dataTable({
			    "aoColumns": [{ "asSorting": [ "desc", "asc" ] },null],
			    "sDom": "<\'row-fluid\'<\'span6\'l><\'span6\'f>r>t<\'row-fluid\'<\'span6\'i><\'span6\'p>>",
   			    "sPaginationType": "bootstrap",			    
			    "oLanguage": {"sLengthMenu": "_MENU_ records per page","sInfo": "Showing _START_ to _END_ of _TOTAL_ records","sInfoEmpty":"","sEmptyTable":"No Updates Found"}
			});            
		    });');
//echo $this->renderPartial('//layouts/_dashboard_tabs');
?>
<table  border="0" cellspacing="0" class="table table-bordered table-striped table_no_border" id="list-table" cellpadding="0">
<thead class="hide">
    <tr class="tablehead">
	<th><?php echo Myclass::t('Notify ID');?></th>
	    <th><?php echo Myclass::t('Records');?></th>
    </tr>
</thead>
<tbody>
<?php 
foreach($records as $record):
  $result = Myclass::getNotification($record->notify_id,$record->notify_type,$record->notify_update_id,$record->notify_status,$record->notify_from_user,$record->notify_on);
?>
<tr class="updates">
	<td class="hide"><?php echo $record->notify_id; ?></td>
	<td><?php echo $result;?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
