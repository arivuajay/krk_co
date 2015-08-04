<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'salesorder-form',
	'enableAjaxValidation'=>false,
)); 
    echo $form->errorSummary(array($somilemodel[0]),'');
?>
    <h4><?php echo Myclass::t('Total Order Value');?> :<?php echo Myclass::GetSiteSetting('AMOUNT_FORMAT')." ".$soordmodel->total_order_value;?></h4>

    <div class="row-fluid">
	<table  border="0" cellspacing="0" class="table table-bordered" cellpadding="0" id="SO_MILE_TBL">
	    <thead>
		<tr class="hide">				 
			<th>S.#</th>
			<th>Milestone Amount</th>
			<th>DOM</th>
			<th>Raise Invoice</th>
		</tr>
	    </thead>
	    <tbody>
		<?php 
		foreach($somilemodel as $key => $somile): ?>
		<tr>				 
			<td><?php echo Myclass::t("Payment Milestone ").($key+1);?></td>
			<td><?php echo Myclass::GetSiteSetting('AMOUNT_FORMAT').' '.$form->textField($somile,"milestone_amt[$key]",array('class'=>'input-mini','value'=>$somile->milestone_amt)) ;?></td>
			<td><?php echo $form->textField($somile,"milestone_date[$key]",array('value'=>$somile->milestone_date)); ?></td>
			<td><?php echo $form->dropDownList($somile,"raise_invoice[$key]",Myclass::getRaiseInvoice(),array('empty'=>'Select Invoice','options' => array($somile->raise_invoice=>array('selected'=>true)))); ?></td>
		</tr>
		<?php endforeach;?>
		<tfoot>
		<td colspan="5" style="text-align: right;">
		    <?php echo CHtml::link(Myclass::t('Add Milestone'), 'javascript:void(0);', array('id'=>'add_milestone')); ?>
		</td>
		</tfoot>
	    </tbody>
	</table>
    </div>

	<div class="row-fluid buttons inline-center">
		<?php $this->widget('bootstrap.widgets.BootButton', array('type'=>'primary','icon'=>'arrow-left white', 'label'=>Myclass::t('Back'),'htmlOptions'=>array('id'=>'back_order_det'))); ?>
		<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit','type'=>'primary','icon'=>'folder-close white', 'label'=>Myclass::t('Save'),'htmlOptions'=>array('name'=>'SO_MILE_INFO_SAVE'))); ?>
		<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit','type'=>'primary','icon'=>'ok white', 'label'=>Myclass::t('Book Order'),'htmlOptions'=>array('name'=>'SO_MILE_INFO_BOOK'))); ?>
	</div>
	<?php $this->endWidget(); ?>
</div><!-- form -->
<?php
echo CHtml::script("$(document).ready(function(){
	$('#back_order_det').live('click',function(){
	    $('a[href=\'#yw0_tab_2\']').trigger('click');
	});
	$('input[name^=\'SalesOrderMilestone[milestone_date]\']').datepicker({'autoSize':true,'minDate':0,'dateFormat':'yy-mm-dd','mode':'date','showOn':'focus','changeMonth':true,'changeYear':true,'htmlOptions':{'readonly':'readonly','value':''}});
	
	$('#add_milestone').live('click',function(){
	    var row = '';
	    $('#SO_MILE_TBL tbody tr:first').find('td').each(function(cellIndex) {
		if (cellIndex != 0)
		    row += '<td>'+$(this).html()+'</td>';
		
	    });	    
	    var row_count = $('#SO_MILE_TBL tbody tr').length + 1;
	    
	    $(row).find('input').each(function(){ 
	    // if the current input has the hasDatpicker class
	    if($(this).hasClass('hasDatepicker')){
		var new_id = 'SalesOrderMilestone_milestone_date_'+row_count; // a new id
		var new_name = 'SalesOrderMilestone[milestone_date]['+row_count+']'; // a new id
		$(this).attr('id', new_id); // change to new id
		$(this).attr('name', new_name); // change to new name
		
		$(this).removeClass('hasDatepicker'); // remove hasDatepicker class
		$(this).datepicker({'autoSize':true,'minDate':0,'dateFormat':'yy-mm-dd','mode':'date','showOn':'focus','changeMonth':true,'changeYear':true,'htmlOptions':{'readonly':'readonly','value':''}}); // re-init datepicker
	    }

	    });
	    $('#SO_MILE_TBL tbody').append('<tr><td>Payment Milestone '+row_count+'</td>'+row+'</tr>');
	});
	
	/*$('select[name^=\'SalesOrderMilestone[raise_invoice]\']').live('change',function(){
	    var cur_id = $(this).attr('id');
	    var cur_value = $(this).val();
	    var values = {};
	    $('select[name^=\'SalesOrderMilestone[raise_invoice]\']').each(function(n, el){
	    values[ $(el).attr('id') ] = $(el).val();
	    });

	    $('select[name^=\'SalesOrderMilestone[raise_invoice]\']').each(function(){
		if(cur_id != $(this).attr('id'))
		{
		    $(this).find('option').attr('class','');
		    $(this).find('option[value=\"'+cur_value+'\"]').addClass('hide');
		}
	    });
	});*/
	
    });");
?>
