<?php
echo CHtml::script('$(document).ready(function() {  
			$("#list-table").dataTable({
			    "aoColumns": [{ "asSorting": [ "desc", "asc" ] },null,null,null,null,null,null,null,null],
			    "aoColumnDefs": [{ \'bSortable\': false, \'aTargets\': [ 1,6,7 ] }],
			    "sDom": "<\'row-fluid\'<\'span6\'l><\'span6\'f>r>t<\'row-fluid\'<\'span6\'i><\'span6\'p>>",
   			    "sPaginationType": "bootstrap",			    
			    "oLanguage": {"sLengthMenu": "_MENU_ records per page","sInfo": "Showing _START_ to _END_ of _TOTAL_ records"}
			});            
		    });');
$this->widget('bootstrap.widgets.BootAlert'); 
?>

<h1>My Quotes</h1>
<table  border="0" cellspacing="0" class="table table-bordered table-striped" id="list-table" cellpadding="0">
    <thead>
	<tr class="tablehead">
		<th class="hide">S.No</th>
		<th><?php echo Myclass::t('Quote ID');?></th>
		<th style="line-height:36px;"><?php echo Myclass::t('Customer Name');?></th>
		<th><?php echo Myclass::t('Created Date');?></th>
		<th style="line-height:36px;"><?php echo Myclass::t('Exp DD');?></th>
		<th style="line-height:36px;width:60px;"><?php echo Myclass::t('Status');?></th>
		<th><?php echo Myclass::t('Quote Total');?></th>
		<th style="line-height:36px;"><?php echo Myclass::t('Action');?></th>
		<th>&nbsp;</th>
	</tr>
    </thead>
    <tbody>
	<?php 
	$i =1;	
	foreach($myquotes as $key => $quote): 
	?>
	<tr>	
		<td class="hide"><?php echo $key+1;?></td>
		<td><?php echo CHtml::link(QUOTE_PREFIX.$quote->quote_id,array('/sales/quote/view','id'=>$quote->quote_id));?></td>
		<td><?php echo ucwords($quote->company->name); ?></td>
		<td><?php echo date(FORMAT_DATE,strtotime($quote->created_date)); ?></td>
		<td><?php echo date(FORMAT_DATE,strtotime($quote->delivery_date)); ?></td>
		<td><?php echo Myclass::getQuoteStatus($quote->status);?></td>
		<td><?php echo Myclass::GetSiteSetting('AMOUNT_FORMAT')."  ".number_format($quote->gettotalamt, '2')  ; ?></td>
		<td>
		<!-- Delete -->
		<?php echo CHtml::link('<i class="cus-icon-trash"></i>',array('/sales/quote/delete','id'=>$quote->quote_id),
			array('onclick'=>"return confirm('".Myclass::t('Are you sure you want to delete')."?')",'title'=>Myclass::t('Delete'),'rel'=>'tooltip')); 
		?>	
		</td>
		<td>
		<?php
                $data = Salesorder::model()->find('quote_id=:param_qid',array('param_qid'=>$quote->quote_id));
                $so = SalesOrder::model()->find('quote_id=:param_qid',array('param_qid'=>$quote->quote_id));
		
		if($so):
		    echo Myclass::t("SO Created");
		elseif($quote->status == '1'):
		    echo CHtml::link(Myclass::t('Create SO'),array('/sales/salesorder/create','quoteid'=>$quote->quote_id));
		elseif($quote->status == '2'):
		    echo Myclass::t('Declined');
                elseif($quote->status == '0'):
		    echo Myclass::t('Waiting For Approval');
		endif;
		if($quote->status > '0'):
		    echo CHtml::link(Myclass::t('Print'),array('/finance/invoice/printquote','id'=>$quote->quote_id),array('target'=>'_blank'));
		endif;
                ?>
		</td>
	</tr>
	<?php $i++;	endforeach; ?>
    </tbody>
</table>


