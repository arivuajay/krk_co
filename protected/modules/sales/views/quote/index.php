<?php
echo CHtml::script('$(document).ready(function() {  
			$("#list-table").dataTable({
			    "aoColumnDefs": [{ \'bSortable\': false, \'aTargets\': [ 5 ] }],
			    "sDom": "<\'row-fluid\'<\'span6\'l><\'span6\'f>r>t<\'row-fluid\'<\'span6\'i><\'span6\'p>>",
   			    "sPaginationType": "bootstrap",			    
			    "oLanguage": {"sLengthMenu": "_MENU_ records per page","sInfo": "Showing _START_ to _END_ of _TOTAL_ records",}
			});            
		    });');
?>

<h3><?php echo Yii::t('sales', 'CREATE_QUOTES'); ?></h3>


<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
	'id' => 'quote-form',
	'enableAjaxValidation' => false,
	    ));

    echo $form->errorSummary($model);
    ?>


    <div class="row-fluid">
<?php echo $form->dropDownList($model, 'company_id', CHtml::listData(Myclass::GetCompanies(), 'company_id', 'name'), array('empty' => 'Choose Customer')); ?>
    </div>

    <div class="row-fluid">
<?php echo $form->dropDownList($model, 'company_id', CHtml::listData(Myclass::GetCompanies(), 'company_id', 'name'), array('empty' => 'Choose Customer')); ?>
    </div>


    <h2><?php echo Myclass::t('View Customers');?></h2>
    <table  border="0" cellspacing="0" class="table table-bordered table-striped" id="list-table" cellpadding="0">
	<thead>
	    <tr class="tablehead">				 
		<th><?php echo Myclass::t('Cus ID');?></th>
		<th><?php echo Myclass::t('Customer Name');?></th>
		<th><?php echo Myclass::t('Primary Contact');?></th>
		<th><?php echo Myclass::t('Email');?></th>
		<th><?php echo Myclass::t('Phone');?></th>
		<th><?php echo Myclass::t('Action');?></th>
	    </tr>
	</thead>
	<tbody>
	    <?php
	    $i = 1;
	    foreach ($companies as $company):
		$primary_contact = Myclass::GetCompanyPrimarycontact($company->company_id);
		?>
    	    <tr>				 
    		<td><?php echo $company->company_id; ?></td>
    		<td><?php echo ucwords($company->name); ?></td>
    		<td><?php echo $primary_contact->contact_name; ?></td>
    		<td><?php echo $company->email; ?></td>
    		<td><?php echo (!empty($primary_contact->office_phone)) ? $primary_contact->office_phone : $primary_contact->mobile; ?></td>
    		<td>	
    		    <!-- Update / edit -->
			<?php
			echo CHtml::link('<i class="icon-pencil"></i>', array('/sales/default/updatecompany', 'id' => $company->company_id), array('title' => Myclass::t('Edit'), 'rel' => 'tooltip'));
			?>
    		    <!-- Delete -->
			<?php
			echo CHtml::link('<i class="icon-trash"></i>', array('/sales/default/delcompany', 'id' => $company->company_id), array('onclick' => "return confirm('".Myclass::t('Are you sure you want to delete')."?')", 'title' => 'Delete', 'rel' => 'tooltip'));
			?>	
    		</td>
    	    </tr>
    <?php $i++;
endforeach; ?>
	</tbody>
    </table>



    <div class="row-fluid">
	<?php echo $form->labelEx($model, 'company_id'); ?>
<?php echo $form->textField($model, 'company_id'); ?>
<?php echo $form->error($model, 'company_id'); ?>
    </div>

    <div class="row-fluid">
	<?php echo $form->labelEx($model, 'delivery_date'); ?>
<?php echo $form->textField($model, 'delivery_date'); ?>
<?php echo $form->error($model, 'delivery_date'); ?>
    </div>

    <div class="row-fluid">
	<?php echo $form->labelEx($model, 'created_by'); ?>
<?php echo $form->textField($model, 'created_by'); ?>
<?php echo $form->error($model, 'created_by'); ?>
    </div>

    <div class="row-fluid">
	<?php echo $form->labelEx($model, 'status'); ?>
<?php echo $form->textField($model, 'status'); ?>
<?php echo $form->error($model, 'status'); ?>
    </div>

    <div class="row-fluid">
	<?php echo $form->labelEx($model, 'approved_by'); ?>
<?php echo $form->textField($model, 'approved_by'); ?>
<?php echo $form->error($model, 'approved_by'); ?>
    </div>

    <div class="row-fluid">
	<?php echo $form->labelEx($model, 'created_date'); ?>
<?php echo $form->textField($model, 'created_date'); ?>
<?php echo $form->error($model, 'created_date'); ?>
    </div>

    <div class="row-fluid">
	<?php echo $form->labelEx($model, 'modified_date'); ?>
<?php echo $form->textField($model, 'modified_date'); ?>
<?php echo $form->error($model, 'modified_date'); ?>
    </div>

    <div class="row-fluid">
	<?php echo $form->labelEx($model, 'ip_address'); ?>
<?php echo $form->textField($model, 'ip_address', array('size' => 20, 'maxlength' => 20)); ?>
<?php echo $form->error($model, 'ip_address'); ?>
    </div>

    <div class="row-fluid">
	<?php echo $form->labelEx($model, 'is_active'); ?>
<?php echo $form->textField($model, 'is_active'); ?>
<?php echo $form->error($model, 'is_active'); ?>
    </div>

    <div class="row-fluid">
	<?php echo $form->labelEx($model, 'is_deleted'); ?>
<?php echo $form->textField($model, 'is_deleted'); ?>
<?php echo $form->error($model, 'is_deleted'); ?>
    </div>

    <div class="row buttons">
    <?php echo CHtml::submitButton($model->isNewRecord ? Myclass::t('Create') : Myclass::t('Save')); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->
