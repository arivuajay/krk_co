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

<h1><?php echo Myclass::t('View Customers');?></h1>
<table  border="0" cellspacing="0" class="table table-bordered table-striped" id="list-table" cellpadding="0">
    <thead>
	<tr class="tablehead">				 
		<th><?php echo Myclass::t('Cus ID');?></th>
		<th><?php echo Myclass::t('Customer Name');?></th>
		<th><?php echo Myclass::t('Primary Contact');?></th>
		<th><?php echo Myclass::t('Email');?></th>
		<th><?php echo Myclass::t('Phone');?></th>
                <th><?php echo Myclass::t('ETA');?></th>
		<th><?php echo Myclass::t('Action');?></th>
	</tr>
    </thead>
    <tbody>
	<?php 
	$i =1;	
	foreach($companies as $company): 
	    $primary_contact = Myclass::GetCompanyPrimarycontact($company->company_id);
	?>
	<tr>				 
		<td><?php echo $company->company_id;?></td>
		<td><?php echo ucwords($company->name); ?></td>
		<td><?php echo $primary_contact->contact_name; ?></td>
		<td><?php echo $primary_contact->email;?></td>
		<td><?php echo (!empty($primary_contact->office_phone)) ? $primary_contact->office_phone : $primary_contact->mobile ; ?></td>
                <td>
                    <?php
                        $eta = Myclass::getClientETA($company->company_id);
                        echo Myclass::GetSiteSetting("AMOUNT_FORMAT").number_format($eta['value'],2);
                    ?>
                </td>
		<td>	
		<!-- Update / edit -->
		<?php echo CHtml::link('<i class="cus-icon-pencil"></i>',array('/sales/default/updatecompany','id'=>$company->company_id),
			array('title'=>Myclass::t('Edit'),'rel'=>'tooltip'));
		?>
		<!-- Delete -->
		<?php echo CHtml::link('<i class="cus-icon-trash"></i>',array('/sales/default/delcompany','id'=>$company->company_id),
			array('onclick'=>"return confirm('".Myclass::t('Are you sure you want to delete')."?')",'title'=>Myclass::t('Delete'),'rel'=>'tooltip')); 
		?>	
		</td>                
	</tr>
	<?php $i++;	endforeach; ?>
    </tbody>
</table>


