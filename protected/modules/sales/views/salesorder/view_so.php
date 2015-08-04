<?php
echo CHtml::script('$(document).ready(function() {
	    var oTable = $("#list-table").dataTable({
			    "aoColumns": [{ "asSorting": [ "desc", "asc" ] },null,null,null,null,null,null,null,null],
			    "aoColumnDefs": [{ \'bSortable\': false, \'aTargets\': [ 1,9 ] }],
			    "sDom": "<\'row-fluid\'<\'span6 date-range\'l><\'span6\'f>r>t<\'row-fluid\'<\'span6\'i><\'span6\'p>>",
   			    "sPaginationType": "bootstrap",
			    "oLanguage": {"sLengthMenu": "_MENU_ records per page","sInfo": "Showing _START_ to _END_ of _TOTAL_ records"}
			});
			$.datepicker.regional[""].dateFormat = "'.JS_FORMAT_DATE.'";
			$.datepicker.setDefaults($.datepicker.regional[""]);
			oTable.columnFilter({
			    sPlaceHolder: "head:before",
			    aoColumns: [ 
				null,
				null,
				null,
				{ sSelector: ".date-range", type:"date-range" },
				null,
				null,
				null,
				null,
				null,
				null
			    ]

			});
			$(".date_range_filter").addClass("input-medium");
		    });');
?>

<h1><?php echo Myclass::t('View SO');?></h1>
<div id="invdate"></div>
<table  border="0" cellspacing="0"  class="table table-bordered table-striped" id="list-table" cellpadding="0">
    <thead>
	<tr class="tablehead">
		<th class="hide">S.NO</th>
		<th><?php echo Myclass::t('SO ID');?></th>
		<th style="width:90px;"><?php echo Myclass::t('Customer Name');?></th>
		<th style="line-height:36px;"><?php echo Myclass::t('SO Date');?></th>
		<th><?php echo Myclass::t('Ref Quote');?></th>
		<th style="line-height:36px;"><?php echo Myclass::t('Status');?></th>
		<th><?php echo Myclass::t('Order Value');?></th>
		<th><?php echo Myclass::t('Invoiced Value');?></th>
		<th style="line-height:36px;width:85px;"><?php echo Myclass::t('Assigned');?></th>
		<th style="line-height:36px;"><?php echo Myclass::t('Actions');?></th>
	</tr>
    </thead>
    <tbody>
	<?php
	foreach($so as $key=>$salesorder):
	?>
        <tr>
		<td class="hide"><?php echo $key+1; ?></td>
		<td><?php echo CHtml::link(SO_PREFIX.$salesorder->so_id,array('/sales/salesorder/viewsodetail','id'=>$salesorder->so_id)); ?></td>
		<td><?php echo ucwords($salesorder->company->name);?></td>
		<td><?php echo date(FORMAT_DATE, strtotime($salesorder->so_created_date)); ?></td>
		<td><?php echo ($salesorder->quote_id > 0) ? CHtml::link(QUOTE_PREFIX.$salesorder->quote_id,array('/sales/quote/view','id'=>$salesorder->quote_id)) : 'Null'; ?></td>
		<td><?php echo Myclass::findSalesorderStatus($salesorder->so_status); ?></td>
		<td><?php echo Myclass::GetSiteSetting("AMOUNT_FORMAT")." ".$salesorder->orderdetail->total_order_value; ?></td>
		<td><?php echo (!empty($salesorder->invoicedAmt)) ? Myclass::GetSiteSetting("AMOUNT_FORMAT")." ".$salesorder->invoicedAmt : "--"; ?></td>
                <td>
		<?php
		  $assigned_status = (Yii::app()->user->getState('role') != 'admin');

		  if( $assigned_status ):
		      $assign_name = $salesorder->assigned_to->userProfiles->first_name;
		      echo (!empty($assign_name)) ? $assign_name : 'Admin';
		  else: //If Admin
		  $form=$this->beginWidget('CActiveForm', array(
			'enableClientValidation'=>true,
			'clientOptions'=>array(
				'validateOnSubmit'=>true,
			)));
		switch($salesorder->so_status):
		    case '1':
			    $va =  CHtml::listData(Myclass::GetFirstNameByRoles('2'), 'user_role_id', 'fullname');
			    echo $form->dropDownList($salesorder,"assigned[{$salesorder->so_id}]", $va, array('empty'=>'Select Production Manager','class'=>'input-small'));
			    break;
		    case '2':
			    $va =  CHtml::listData(Myclass::GetFirstNameByRoles(), 'user_role_id', 'fullname');
			    echo $form->dropDownList($salesorder,"pack_assigned[{$salesorder->so_id}]", $va, array('empty'=>'Select Manager','class'=>'input-small'));
			    break;
		    case '3':
			$va =  CHtml::listData(Myclass::GetFirstNameByRoles(), 'user_role_id', 'fullname');
			echo $form->dropDownList($salesorder,"ship_assigned[{$salesorder->so_id}]", $va, array('empty'=>'Select Manager','class'=>'input-small'));
			break;
		endswitch;

		echo CHtml::ajaxSubmitButton(Myclass::t('Assign'),$this->createAbsoluteUrl('salesorder/assignsomod'),array('success'=>'function(data )
                  {
                    if(data){
                        var splitarray = data.split("||");
                        $("#status_"+splitarray[1]).html(splitarray[0]);
                    }else{
                    	alert("unexpected error.. please try again");
                    }
                   $("#Salesorder_assigned'.$salesorder->so_id.'").attr("value","save");

                  }'),array('onclick'=>'$(this).attr("value","'.Myclass::t('Assign again').'");','id'=>'saverss'.$value->id));
		echo "<div id='status_{$salesorder->so_id}'></div>";
		?>
                    <input type="hidden" id="hid_<?php echo $salesorder->so_id;?>" name="sid" value="<?php echo $salesorder->so_id;?>" />
		<?php
                $this->endWidget();
                endif;
                ?>
		</td>
		<td style="text-align:center;">
		<!-- Update / edit -->
		<?php echo CHtml::link('<i class="cus-icon-view"></i>',array('/sales/salesorder/viewsodetail','id'=>$salesorder->so_id),
			array('title'=>Myclass::t('View'),'rel'=>'tooltip'));

                if($salesorder->so_status == 0):
		    echo CHtml::link('<i class="cus-icon-pencil"></i>',array('/sales/salesorder/create','soid'=>$salesorder->so_id),
			array('title'=>Myclass::t('Edit'),'rel'=>'tooltip'));
		else:
		    echo "&nbsp;".CHtml::link(Myclass::t('Print'),array('/finance/invoice/printso','id'=>$salesorder->so_id),array('target'=>'_blank'));
		endif;

		?>
		<!-- Delete -->
		<?php //echo CHtml::link('<i class="cus-icon-trash"></i>',array('/sales/salesorder/deleteso','id'=>$salesorder->so_id),
			//array('onclick'=>"return confirm('Are you sure you want to delete?')",'title'=>'Delete','rel'=>'tooltip'));
		?>
                <?php //echo CHtml::link('<i class="cus-icon-plus"></i>',array('/sales/salesorder/assignSo','id'=>$salesorder->so_id),
			//array('title'=>'Assign','rel'=>'tooltip'));
		?>
		</td>
	</tr>
	<?php $i++; endforeach; ?>
    </tbody>
</table>
<?php 
Yii::app()->clientScript->registerCoreScript('jquery.ui');
Yii::app()->clientScript->registerCssFile(Yii::app()->clientScript->getCoreScriptUrl().'/jui/css/base/jquery-ui.css');
?>

