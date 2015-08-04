<?php $this->hiddenpath = "/sales/default/viewcompanies"; ?>
<?php
Yii::app()->clientScript->registerCoreScript('jquery.ui');
Yii::app()->clientScript->registerCssFile(Yii::app()->clientScript->getCoreScriptUrl().'/jui/css/base/jquery-ui.css');


echo CHtml::script('$(document).ready(function() {  
			var oTable = $("#list-table").dataTable({
			    "aoColumns": [{ "asSorting": [ "desc", "asc" ] },null,null,null,null,null,null],
			    "aoColumnDefs": [{ \'bSortable\': false, \'aTargets\': [ 5,6 ] }],
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
				{ sSelector: ".date-range", type:"date-range" },
				null,
				null,
				null,
				null
			    ]

			});
			$(".date_range_filter").addClass("input-medium");
		    });');

?>
<h1><?php echo $model->name; ?> <?php echo Myclass::t('Company');?></h1>
<?php echo $this->renderPartial('//layouts/_update_company_tabs',array('model'=>$model)); ?>
    <h3><?php echo Myclass::t('Order Summary');?>, <?php echo $model->name; ?></h3>
    <div id="invdate"></div>
    <table  border="0" cellspacing="0" class="table table-bordered table-striped" id="list-table" cellpadding="0">
    <thead>
	<tr class="tablehead">	
		<th class="hide">S.No</th>	    
		<th><?php echo Myclass::t('Ord_id');?></th>
		<th><?php echo Myclass::t('Order Date');?></th>
		<th><?php echo Myclass::t('Status');?></th>
		<th><?php echo Myclass::t('Value');?></th>
		<th><?php echo Myclass::t('Actions');?></th>
		<th>&nbsp;</th>
	</tr>
    </thead>
    <tbody>
	<?php foreach($cmpyso as $key => $so): ?>
	<tr>			
		<td class="hide"><?php echo $key+1;?></td>
		<td><?php echo CHtml::link(SO_PREFIX.$so->so_id,array('/sales/salesorder/viewsodetail','id'=>$so->so_id),
			array('title'=>Myclass::t('View'),'rel'=>'tooltip'));
		?></td>
		<td><?php echo date(FORMAT_DATE,strtotime($so->so_created_date)); ?></td>
		<td><?php echo Myclass::findSalesorderStatus($so->so_status); ?></td>
		<td><?php echo Myclass::GetSiteSetting('AMOUNT_FORMAT')."  ".$so->orderdetail->total_order_value; ?></td>
		<td>
		<!-- Delete -->
		<?php echo CHtml::link('<i class="cus-icon-trash"></i>',array('/sales/quote/delete','id'=>$so->so_id),
			array('onclick'=>"return confirm('".Myclass::t('Are you sure you want to delete')."?')",'title'=>Myclass::t('Delete'),'rel'=>'tooltip')); 
		?>
		</td>
		<td>
		<?php
                $data = Salesorder::model()->find('so_id=:param_qid',array('param_qid'=>$so->so_id));
                $so = SalesOrder::model()->find('so_id=:param_qid',array('param_qid'=>$so->so_id));
		
		if($so):
		    echo Myclass::t("So Created");
		elseif($so->status):
		    echo CHtml::link(Myclass::t('Create So'),array('/sales/salesorder/create','quoteid'=>$so->so_id));
		elseif($so->status == 0):
		    echo Myclass::t('Waiting For Admin Approval');
		endif;
                ?>
		</td>
	</tr>
	<?php endforeach; ?>
    </tbody>
</table>