	<div class="form">

	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'salesorder-form',
		'enableAjaxValidation'=>false,
	)); 
	echo $form->errorSummary(array($soordmodel,$soprodmodel[0]),'');
	?>
	    <h4><?php echo Myclass::t('PlaceOrder Detail');?></h4>
		<div class="row-fluid">
		    <div class="span6">
			<?php echo CHtml::activeLabel($soordmodel,'order_date',array('class'=>'inline-label')); ?>
			<?php echo $this->getDatePicker('order_date',$soordmodel,''); ?>
		    </div>
		    <div class="last span6">
			<?php echo CHtml::activeLabel($soordmodel,'shipment_date',array('class'=>'inline-label')); ?>
			<?php echo $this->getDatePicker('shipment_date',$soordmodel,''); ?>
		    </div>	
		</div>

	    <div class="row-fluid">
		<table  border="0" cellspacing="0" class="table table-bordered" cellpadding="0" id="SO_PROD_TBL">
		    <thead>
			<tr class="tablehead">				 
			    <th><?php echo Myclass::t('S.No');?>#</th>
				<th><?php echo Myclass::t('Product Name');?></th>
				<th><?php echo Myclass::t('Qty');?></th>
				<th><?php echo Myclass::t('Approved Unit Price');?></th>
				<th><?php echo Myclass::t('Order Value');?></th>
			</tr>
		    </thead>
		    <tbody>
			<?php 
			if($somodel->quote_id > 0):
			foreach($soprodmodel as $key => $product): ?>
			<tr>				 
				<td><?php echo $key+1;?></td>
				<td><?php echo $product->product->name; ?></td>
				<td><?php echo $product->quantity; ?></td>
				<td><?php echo $product->quote_price; ?></td>				
				<td><?php echo $ord_val = $product->order_value; ?></td>
				<!-- For Stored Value -->
				<?php echo $form->hiddenField($product,"product_id[]",array('value'=>$product->product_id));?>
				<?php echo $form->hiddenField($product,"quantity[]",array('value'=>$product->quantity)) ; ?>
				<?php echo $form->hiddenField($product,"quote_price[]",array('value'=>$product->quote_price)) ; ?>
				<?php echo $form->hiddenField($product,"order_value[]",array('value'=>$product->order_value)) ; ?>
			</tr>
			<?php endforeach; else: 
			    foreach($soprodmodel as $key => $soprod): ?>
			<tr>				 
				<td><?php echo $key+1;?></td>
				<td><?php echo CHtml::dropDownList("SoProducts[product_id][]",$soprod->product_id,CHtml::listData(Myclass::getProducts(), 'product_id', 'name'), array('empty'=>'Select Product'));?></td>
				<td><?php echo $form->textField($soprod,"quantity[]",array('class'=>'input-mini','value'=>$soprod->quantity)) ; ?></td>
				<td><?php echo $form->textField($soprod,"quote_price[]",array('readonly'=>'readonly','class'=>'input-mini','value'=>$soprod->quote_price)); ?></td>
				<td>
				    <?php echo $form->textField($soprod,"order_value[]",array('class'=>'input-mini','value'=>$soprod->order_value)) ; ?>
				    <?php if($key > 0) echo CHtml::link('&nbsp;','javascript:void(0);',array('class'=>'table_row_remove')); ?> 
				</td>
			</tr>
			<?php endforeach;?>
			<tfoot>
			<td colspan="5" style="text-align: right;">
			    <?php echo CHtml::link(Myclass::t('Add Product'), 'javascript:void(0);', array('id'=>'add_product')); ?>
			</td>
			</tfoot>
			<?php endif; ?>
		    </tbody>
		</table>
	    </div>
	    
	    <div class="row-fluid">
		    <div class="span3"></div>
		    <div class="span3">
			<?php echo CHtml::activeLabel($soordmodel,'line_total',array('class'=>'inline-label')); ?>
			<?php echo $form->textField($soordmodel,'line_total',array('readonly'=>'readonly','class'=>'input-mini')) ; ?>
		    </div>
		    <?php if(Myclass::GetSiteSetting('TAX_VALUE','setting_status')): ?>
		    <div class="span3">
			<?php echo CHtml::activeLabel($soordmodel,'tax',array('class'=>'inline-label')); ?>
			<?php echo $form->textField($soordmodel,'tax',array('readonly'=>'readonly','class'=>'input-mini')); ?>
		    </div>
		    <?php endif; ?>
		    <div class="span3"> 
			<?php echo CHtml::activeLabel($soordmodel,'total_order_value',array('class'=>'inline-label')); ?>
			<?php echo $form->textField($soordmodel,'total_order_value',array('readonly'=>'readonly','class'=>'input-mini')); ?>
		    </div>	
		</div>

		<div class="row-fluid buttons inline-center">
			<?php $this->widget('bootstrap.widgets.BootButton', array('type'=>'primary','icon'=>'arrow-left white', 'label'=>'Back to customer info','htmlOptions'=>array('id'=>'back_customer'))); ?>
			<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit','type'=>'primary','icon'=>'folder-close white', 'label'=>'Save','htmlOptions'=>array('name'=>'SO_ORD_INFO'))); ?>
			<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'type'=>'primary','icon'=>'ok white',  'label'=>'Save & Next','htmlOptions'=>array('name'=>'SO_ORD_INFO_NEXT'))); ?>
		</div>
		<?php $this->endWidget(); ?>
	</div><!-- form -->
<?php
echo CHtml::css("
    input[name='Orderdetail[order_date]'],input[name='Orderdetail[shipment_date]'] { width:110px;}
    ");
echo CHtml::script("");
?>
<script type="text/javascript">
    $(document).ready(function(){
$('#back_customer').live('click',function(){
    $('a[href="#yw0_tab_1"]').trigger('click');
});


$('input[name^="SoProducts[quantity]"]').live('keyup',function(){
    var quant_closest = $(this).closest('tr');
    var prod_id = quant_closest.find('select[name^="SoProducts[product_id]"]').val();
    var total_qty = quant_closest.find('input[name^="SoProducts[quantity]"]').val();
    $.ajax({
	url: '<?php echo Yii::app()->createUrl('/sales/salesorder/searchproduct');?>',
	dataType: 'json',
	data: { 'prod_id': prod_id , 'quantity': total_qty},
	success: function(returndata) {
	    quant_closest.find('input[name^="SoProducts[quote_price]"]').val(returndata);
	    var total_val =  total_qty * quant_closest.find('input[name^="SoProducts[quote_price]"]').val();

	    quant_closest.find('input[name^="SoProducts[order_value]"]').val(total_val);

	    var line_total = 0;
	    $('input[name^="SoProducts[order_value]"]').each(function(){
		if($(this).val() > 0)
		{
		    line_total = parseInt($(this).val()) + line_total;
		}
	    });
	    <?php if(Myclass::GetSiteSetting('TAX_VALUE','setting_status')): ?>
		var tax = '<?php echo Myclass::GetSiteSetting('TAX_VALUE');?>'; 
		var tax_amt = line_total * tax / 100;
	    <?php else: ?>
		    var tax_amt = 0;
	    <?php endif;?>

	    var total_order_value = line_total + tax_amt;
		$('#Orderdetail_line_total').val(line_total);	    
		$('#Orderdetail_tax').val(tax_amt);
		$('#Orderdetail_total_order_value').val(total_order_value);

		    }
		});
});

$('#add_product').live('click',function(){
    var row = '';
    $('#SO_PROD_TBL tbody tr:first').find('td').each(function(cellIndex) {
	if (cellIndex != 0)
	    row += '<td>'+$(this).html()+'</td>';
    });

    var row_count = $('#SO_PROD_TBL tbody tr').length + 1;
    $('#SO_PROD_TBL tbody').append('<tr><td>'+row_count+'</td>'+row+'</tr>');
});
});
</script>
