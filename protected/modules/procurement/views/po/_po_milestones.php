<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'salesorder-form',
	'enableAjaxValidation'=>false,
)); 
    echo $form->errorSummary(array($pomilemodel[0]),'');
?>
    <h4><?php echo Myclass::t('Total Order Value');?> :<?php echo Myclass::GetSiteSetting('AMOUNT_FORMAT')." ".$pomodel->po_ord_total_order;?></h4>

    <div class="row-fluid">
	<table  border="0" cellspacing="0" class="table table-bordered" cellpadding="0" id="PO_MILE_TBL">
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
		foreach($pomilemodel as $key => $pomile): 
		    if(!empty($_POST['PoOrderMilestone']['milestone_amt'][$key])) $pomile->milestone_amt = $_POST['PoOrderMilestone']['milestone_amt'][$key];
		    if(!empty($_POST['PoOrderMilestone']['milestone_date'][$key])) $pomile->milestone_date = $_POST['PoOrderMilestone']['milestone_date'][$key];
		    ?>
		<tr>				 
			<td><?php echo "Payment Milestone ".($key+1);?></td>
			<td><?php echo Myclass::GetSiteSetting('AMOUNT_FORMAT').' '.$form->textField($pomile,"milestone_amt[$key]",array('class'=>'input-mini','value'=>$pomile->milestone_amt)) ;?></td>
			<td><?php echo $form->textField($pomile,"milestone_date[$key]",array('value'=>$pomile->milestone_date,'autocomplete'=>'off')); ?></td>
			<td><?php echo $form->dropDownList($pomile,"raise_invoice[$key]",Myclass::getRaiseInvoice(null,true),array('empty'=>'Select Invoice','options' => array($pomile->raise_invoice=>array('selected'=>true)))); ?></td>
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
		<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit','type'=>'primary','icon'=>'folder-close white', 'label'=>Myclass::t('Save'),'htmlOptions'=>array('name'=>'PO_MILE_INFO_SAVE'))); ?>
		<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit','type'=>'primary','icon'=>'ok white', 'label'=>Myclass::t('PO Release'),'htmlOptions'=>array('name'=>'PO_MILE_INFO_BOOK'))); ?>
	</div>
	<?php $this->endWidget(); ?>
</div><!-- form -->
<?php
echo CHtml::script("$(document).ready(function(){
	$('#back_order_det').live('click',function(){
	    $('a[href=\'#yw0_tab_2\']').trigger('click');
	});
	$('input[name^=\'PoOrderMilestone[milestone_date]\']').datepicker({'autoSize':true,'minDate':0,'dateFormat':'yy-mm-dd','mode':'date','showOn':'focus','changeMonth':true,'changeYear':true,'htmlOptions':{'readonly':'readonly','value':''}});
	
	$('#add_milestone').live('click',function(){
	    var row = '';
	    $('#PO_MILE_TBL tbody tr:first').find('td').each(function(cellIndex) {
		if (cellIndex != 0)
		    row += '<td>'+$(this).html()+'</td>';
		
	    });	    
	    var row_count = $('#PO_MILE_TBL tbody tr').length + 1;
	    
	    $(row).find('input').each(function(){ 
	    // if the current input has the hasDatpicker class
	    if($(this).hasClass('hasDatepicker')){
		var new_id = 'PoOrderMilestone_milestone_date_'+row_count; // a new id
		var new_name = 'PoOrderMilestone[milestone_date]['+row_count+']'; // a new id
		$(this).attr('id', new_id); // change to new id
		$(this).attr('name', new_name); // change to new name
		
		$(this).removeClass('hasDatepicker'); // remove hasDatepicker class
		$(this).datepicker({'autoSize':true,'minDate':0,'dateFormat':'yy-mm-dd','mode':'date','showOn':'focus','changeMonth':true,'changeYear':true,'htmlOptions':{'readonly':'readonly','value':''}}); // re-init datepicker
	    }

	    });
	    $('#PO_MILE_TBL tbody').append('<tr><td>Payment Milestone '+row_count+'</td>'+row+'</tr>');
	});
    });");
?>
<script type="text/javascript">
$('select[name^="PoOrderMilestone[raise_invoice]"]').change(function(){
    var sel_array = [];  
    $('select[name^="PoOrderMilestone[raise_invoice]"]').find("option:selected").each(function(){
	if($(this).val() > '0' )
	{
	    if($.inArray($(this).val(), sel_array) > -1)
	    {
	    alert('Already Selected this range');
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