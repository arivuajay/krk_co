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

<h1><?php echo Myclass::t('SO'); ?></h1>
<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'user-form',
    'enableAjaxValidation' => false,
	));
?>
<table  border="0" cellspacing="0"  class="table table-bordered table-striped" id="list-table" cellpadding="0">
    <thead>
	<tr class="tablehead">
	    <th><?php echo Myclass::t('SO ID'); ?></th>
	    <th><?php echo Myclass::t('Name'); ?></th>
	    <th><?php echo Myclass::t('SO date'); ?></th>
	    <th><?php echo Myclass::t('Quote'); ?></th>
	    <th><?php echo Myclass::t('Status'); ?></th>
	    <th><?php echo Myclass::t('Order Value'); ?></th>
	    <th><?php echo Myclass::t('Invoiced'); ?> </th>
	    <th><?php echo Myclass::t('Assign to'); ?></th>
	    <th><?php echo Myclass::t('Action'); ?></th>
	</tr>
    </thead>
    <tbody>
	<?php
	$i = 1;
	//$product_user = Myclass::GetCompanyPrimarycontact($company->customer_id);
	foreach ($so as $key => $company):
	    $data_role_selected_id = 0;
	    $label_for_assign = Myclass::t("Assign");
	    if ($company->assigned > 0) {

		$data_role_selected_id = Myclass::getUserRoleId($company->assigned);
		$label_for_assign = Myclass::t("Change assign");
	    }
	    $va = CHtml::listData(Myclass::GetFirstNameByRoles('2'), 'user_role_id', 'fullname');
	    ?>

    	<tr>
    	    <td><?php echo CHtml::link("O_" . $company->so_id, array('/sales/salesorder/viewsodetail', 'id' => $company->so_id)); ?>


    	    </td>
    	    <td><?php echo ucwords($company->customer); ?></td>
    	    <td><?php echo date(FORMAT_DATE, strtotime($company->SalesOrderMilestone->created_date));
	?></td>
    	    <td><?php echo "Q_" . $company->quote_id; ?></td>
    	    <td><?php
	if ($company->so_status == 1):
	    echo Myclass::t("Book Order");
	elseif ($company->so_status == 2):
	    echo Myclass::t("Pick Release");
	elseif ($company->so_status == 3):
	    echo Myclass::t("Pack Release");
	elseif ($company->so_status == 4):
	    echo Myclass::t("Ship Release");
	endif;
	    ?></td>
    	    <td> <?php echo $company->orderdetail->total_order_value; ?>
    	    </td>
    	    <td>
		    <?php echo "-" ?>

    	    </td>

    	    <td>
    <?php
    $form = $this->beginWidget('CActiveForm', array(
	'enableClientValidation' => true,
	'clientOptions' => array(
	    'validateOnSubmit' => true,
	),
	'htmlOptions' => array(
	    'class' => 'form-stacked',
	),
	    ));
    ?>

		    <?php //echo $form->textField($value,'hound_rssurlid',array('style'=>'width:80px;'));  ?>
		    <?php echo $form->dropDownList($company, "assigned[{$company->so_id}]", $va, array('options' => array($data_role_selected_id => array('selected' => true)), 'empty' => 'Select User')); ?>
		    <?php echo CHtml::ajaxSubmitButton($label_for_assign, $this->createAbsoluteUrl('salesorder/assignSo'), array('success' => 'function(data )
                  {


                    if(data){

                        var splitarray = data.split("||");

                        $("#status_"+splitarray[1]).html(splitarray[0]);
                    }else{
                    	alert("unexpected error.. please try again");

                    }
                   $("#Salesorder_assigned' . $company->so_id . '").attr("value","save");

                  }'), array('onclick' => '$(this).attr("value","'.Myclass::t('Change Assign').'");', 'id' => 'saverss' . $value->id)); ?>
		    <?php //echo $form->hiddenField($company,'s_id',array('value'=>$company->so_id)); ?>
    		<input type="hidden" id="hid_<?php echo $company->so_id; ?>" name="sid" value="<?php echo $company->so_id; ?>">
		    <?php $this->endWidget(); ?>
    	    </td>
    	    <td>
	    <?php echo CHtml::link('<i class="cus-icon-view"></i>', array('/sales/salesorder/viewsodetail', 'id' => $company->so_id), array('title' =>Myclass::t('View'), 'rel' => 'tooltip'));	    ?>
    	    </td>
    	</tr>
		    <?php $i++;
		endforeach;
		?>
    </tbody>
</table>
<?php $this->endWidget(); ?>

