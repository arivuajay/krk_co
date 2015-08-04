<?php $this->hiddenpath = "/sales/default/viewcompanies"; 
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
    <h3><?php echo Myclass::t('Quote Summary');?>, <?php echo $model->name; ?></h3>
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
	<?php foreach($cmpyquotes as $key => $quote): ?>
	<tr>	
		<td class="hide"><?php echo $key+1;?></td>			 
		<td><?php echo CHtml::link(QUOTE_PREFIX.$quote->quote_id,array('/sales/quote/view','id'=>$quote->quote_id,'ret'=>'cmpy'),
			array('title'=>Myclass::t('View'),'rel'=>'tooltip'));
		?></td>
		<td><?php echo date(FORMAT_DATE,strtotime($quote->created_date)); ?></td>
                <td><?php echo Myclass::getQuoteStatus($quote->status);?></td>
		<td><?php echo Myclass::GetSiteSetting('AMOUNT_FORMAT')."  ".$quote->gettotalamt; ?></td>
		<td>
		<!-- Delete -->
		<?php echo CHtml::link('<i class="cus-icon-trash"></i>',array('/sales/quote/delete','id'=>$quote->quote_id),
			array('onclick'=>"return confirm('".Myclass::t('Are you sure you want to delete')."?')",'title'=>'Delete','rel'=>'tooltip')); 
		?>
		</td>
		<td>
		<?php
                $data = Salesorder::model()->find('quote_id=:param_qid',array('param_qid'=>$quote->quote_id));
                $so = SalesOrder::model()->find('quote_id=:param_qid',array('param_qid'=>$quote->quote_id));
		
		if($so):
		    echo Myclass::t("So Created");
		elseif($quote->status == '1'):
		    echo CHtml::link(Myclass::t('Create So'),array('/sales/salesorder/create','quoteid'=>$quote->quote_id));
                elseif($quote->status == '2'):
		    echo Myclass::t('Declined');
		elseif($quote->status == '0'):
		    echo Myclass::t('Waiting For Admin Approval');
		endif;
                ?>
		</td>
	</tr>
	<?php endforeach; ?>
    </tbody>
</table>