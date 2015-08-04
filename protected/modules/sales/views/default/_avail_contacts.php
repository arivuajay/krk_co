<?php if(!empty($avail_contact)): ?>
    <h3><?php echo Myclass::t('Available Contacts');?></h3>
    <table  border="0" cellspacing="0" class="table table-bordered table-striped" id="list-table" cellpadding="0">
    <thead>
	<tr class="tablehead">				 
		<th><?php echo Myclass::t('S.No');?></th>
		<th><?php echo Myclass::t('Contact Name');?></th>
		<th><?php echo Myclass::t('Department');?></th>
		<th><?php echo Myclass::t('Email');?></th>
		<th><?php echo Myclass::t('Phone');?></th>
		<th><?php echo Myclass::t('Mobile');?></th>
		<th><?php echo Myclass::t('Action');?></th>
	</tr>
    </thead>
    <tbody>
	<?php foreach($avail_contact as $key => $avail): ?>
	<tr>				 
		<td><?php echo $key+1;?></td>
		<td><?php echo ucwords($avail->contact_name); ?></td>
		<td><?php echo $avail->department->name; ?></td>
		<td><?php echo $avail->email;?></td>
		<td><?php echo $avail->office_phone." Ext:".$avail->ext; ?></td>
		<td><?php echo $avail->mobile; ?></td>
		<td>	
		<!-- Update / edit -->
		<?php echo CHtml::link('<i class="cus-icon-pencil"></i>',array('/sales/default/updatecontact','id'=>$avail->contact_id),
			array('title'=>Myclass::t('Edit'),'rel'=>'tooltip'));
		?>
		<!-- Delete -->
		<?php echo CHtml::link('<i class="cus-icon-trash"></i>',array('/sales/default/delcontact','id'=>$avail->contact_id,'return'=>$avail->company_id),
			array('onclick'=>"return confirm('".Myclass::t('Are you sure you want to delete')."?')",'title'=>Myclass::t('Delete'),'rel'=>'tooltip')); 
		?>	
		</td>
	</tr>
	<?php endforeach; ?>
    </tbody>
</table>
<?php endif; ?>
