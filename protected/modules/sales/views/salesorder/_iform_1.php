<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'salesorder-form',
	'enableAjaxValidation'=>false,
)); 
if(isset($errormilemodel))
    echo $form->errorSummary(array($errormilemodel),'');
?>
    <h4><?php echo Myclass::t('Total Order Value');?> :<?php echo Myclass::GetSiteSetting('AMOUNT_FORMAT')." ".$soordmodel->total_order_value;?></h4>

    <div class="row-fluid">
	<table  border="0" cellspacing="0" class="table table-bordered" cellpadding="0" id="so_milestone_table">
	    <thead>
		<tr class="hide">				 
			<th><?php echo Myclass::t('S.No');?>#</th>
			<th><?php echo Myclass::t('Milestone Amount');?></th>
			<th><?php echo Myclass::t('DOM');?></th>
			<th><?php echo Myclass::t('Raise Invoice');?></th>
		</tr>
	    </thead>
	    <tbody>
		<?php 
		foreach($somilemodel as $key => $somile): ?>
		<tr>				 
			<td><?php echo Myclass::t("Payment Milestone")." ".($key+1);?></td>
			<td><?php echo Myclass::GetSiteSetting('AMOUNT_FORMAT').' '.$form->textField($somile,"milestone_amt[]",array('class'=>'input-mini','value'=>$somile->milestone_amt,'placeholder'=>$somile->getAttributeLabel('milestone_amt'))) ;?></td>
			<td><?php echo $form->textField($somile,"milestone_date[]",array('value'=>$somile->milestone_date,'id'=>'milestone_date'.$key,'placeholder'=>$somile->getAttributeLabel('milestone_date'))); ?></td>
			<td><?php echo $form->dropDownList($somile,"raise_invoice[]",Myclass::getRaiseInvoice(),array('empty'=>'Select Invoice','options' => array($somile->raise_invoice=>array('selected'=>true)))); ?></td>
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
		<?php $this->widget('bootstrap.widgets.BootButton', array('type'=>'primary','icon'=>'arrow-left white', 'label'=>'Back ','htmlOptions'=>array('id'=>'back_order_det'))); ?>
		<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit','type'=>'primary','icon'=>'folder-close white', 'label'=>'Save','htmlOptions'=>array('name'=>'SO_MILE_INFO_SAVE'))); ?>
		<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit','type'=>'primary','icon'=>'ok white', 'label'=>'Book Order','htmlOptions'=>array('name'=>'SO_MILE_INFO_BOOK'))); ?>
	</div>
	<?php $this->endWidget(); ?>
</div><!-- form -->
<?php
echo CHtml::script("$(document).ready(function(){
	$('#back_order_det').live('click',function(){
	    $('a[href=\'#yw0_tab_2\']').trigger('click');
	});
	$('input[name^=\'SalesOrderMilestone[milestone_date]\']').datepicker({'autoSize':true,'minDate':0,'dateFormat':'".JS_FORMAT_DATE."','mode':'date','showOn':'focus','changeMonth':true,'changeYear':true,'htmlOptions':{'readonly':'readonly','value':''}});
	
	$('#add_milestone').live('click',function(){
	    var row = '';
	    $('#so_milestone_table tbody tr:first').find('td').each(function(cellIndex) {
		if (cellIndex != 0)
		    row += '<td>'+$(this).html()+'</td>';
		
	    });	    
	    var row_count = $('#so_milestone_table tbody tr').length + 1;
	    
	    $(row).find('input').each(function(){ 
	    // if the current input has the hasDatpicker class
	    if($(this).hasClass('hasDatepicker')){
		var new_id = 'SalesOrderMilestone_milestone_date_'+row_count; // a new id
		var new_name = 'SalesOrderMilestone[milestone_date]['+row_count+']'; // a new id
		$(this).attr('id', new_id); // change to new id
		$(this).attr('name', new_name); // change to new name
		
		$(this).removeClass('hasDatepicker'); // remove hasDatepicker class
		$(this).datepicker({'autoSize':true,'minDate':0,'dateFormat':'".JS_FORMAT_DATE."','mode':'date','showOn':'focus','changeMonth':true,'changeYear':true,'htmlOptions':{'readonly':'readonly','value':''}}); // re-init datepicker
		    
	    }

	    });
	    $('#so_milestone_table tbody').append('<tr><td>Payment Milestone '+row_count+'</td>'+row+'</tr>');
	});
	
	
    });");
?>
<script type="text/javascript">
$('select[name^="SalesOrderMilestone[raise_invoice]"]').change(function(){
	    var sel_array = [];  
	    $('select[name^="SalesOrderMilestone[raise_invoice]"]').find('option:selected').each(function(){
		if($(this).val() > '0' )
		{
		    if($.inArray($(this).val(), sel_array) > -1)
		    {
		    alert('Already Selected this Milestone');
		    $(this).parent('select').find('option[value=""]').attr('selected','selected');
		    }
		    else
		    {
		    sel_array.push($(this).val());
		    }
		}
	    });
	});
</script>