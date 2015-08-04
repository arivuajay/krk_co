    <div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
	    'id'=>'salesorder-form',
	    'enableAjaxValidation'=>false,
    )); 
    if($pomodel->getErrors()):
	echo '<div class="alert-error fade in" style="border-radius: 4px;margin-bottom: 18px;  padding: 8px 35px 8px 14px;text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);"><ul>';
	foreach($pomodel->getErrors() as $value):
	    $error = $value[0];
	    echo "<li>".$error."</li>";
	endforeach;
	echo '</ul></div>';
    endif;
    ?>
	<h4><?php echo Myclass::t('PlaceOrder Detail');?></h4>
	    <div class="row-fluid">
		<div class="span6">
		    <?php echo CHtml::activeLabel($pomodel,'po_ord_date',array('class'=>'inline-label')); ?>
		    <?php echo $this->getDatePicker('po_ord_date',$pomodel,''); ?>
		</div>
		<div class="last span6">
		    <?php echo CHtml::activeLabel($pomodel,'po_ship_date',array('class'=>'inline-label')); ?>
		    <?php echo $this->getDatePicker('po_ship_date',$pomodel,''); ?>
		</div>	
	    </div>

	<div class="row-fluid">
	    <table  border="0" cellspacing="0" class="table table-bordered" cellpadding="0" id="SO_PROD_TBL">
		<thead>
		    <tr class="tablehead">				 
			    <th><?php echo Myclass::t('S.#');?></th>
			    <th><?php echo Myclass::t('Product Name');?></th>
			    <th><?php echo Myclass::t('Qty');?></th>
			    <th><?php echo Myclass::t('Vendor Unit Price');?></th>
			    <th><?php echo Myclass::t('Order Value');?></th>
			    <th><?php echo Myclass::t('Discounts');?></th>
			    <th><?php echo Myclass::t('Net Cost');?></th>
		    </tr>
		</thead>
		<tbody>
		    <?php 
//		    if($somodel->quote_id > 0):
		    foreach($poprodmodel as $key => $product): 
//			var_dump($product); exit; 
			if($product->prod_scenario == 'product'):
			   $prod_name = $product->product->name; 
			else:
			   $prod_name = $product->item->name; 
			endif;
		    ?>
		    <tr>				 
			    <td><?php echo $key+1;?></td>
			    <td><?php echo $prod_name; ?></td>
			    <td><?php echo $product->quantity; ?></td>
			    <td><?php echo $product->vendor_unit_price; ?></td>				
			    <td><?php echo $ord_val = $product->item_value; ?></td>
			    <td><?php echo $ord_val = $product->discounts; ?></td>
			    <td><?php echo $ord_val = $product->netcost; ?></td>
		    </tr>
		    <?php 
		    endforeach;  
//		    endif; 
		    ?>
		</tbody>
	    </table>
	</div>

	<div class="row-fluid">
		<div class="span3"></div>
		<div class="span3">
		    <?php echo CHtml::activeLabel($pomodel,'po_ord_line_total',array('class'=>'inline-label')); ?>
		    <?php echo $form->textField($pomodel,'po_ord_line_total',array('readonly'=>'readonly','class'=>'input-mini')) ; ?>
		</div>
		<?php if(Myclass::GetSiteSetting('TAX_VALUE','setting_status')): ?>
		<div class="span3">
		    <?php echo CHtml::activeLabel($pomodel,'po_ord_tax',array('class'=>'inline-label')); ?>
		    <?php echo $form->textField($pomodel,'po_ord_tax',array('readonly'=>'readonly','class'=>'input-mini')); ?>
		</div>
		<?php endif; ?>
		<div class="span3"> 
		    <?php echo CHtml::activeLabel($pomodel,'po_ord_total_order',array('class'=>'inline-label')); ?>
		    <?php echo $form->textField($pomodel,'po_ord_total_order',array('readonly'=>'readonly','class'=>'input-mini')); ?>
		</div>	
	    </div>

	    <div class="row-fluid buttons inline-center">
		    <?php $this->widget('bootstrap.widgets.BootButton', array('type'=>'primary','icon'=>'arrow-left white', 'label'=>'Back to vendor info','htmlOptions'=>array('id'=>'back_customer'))); ?>
		    <?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit','type'=>'primary','icon'=>'folder-close white', 'label'=>'Save','htmlOptions'=>array('name'=>'PO_ORD_INFO'))); ?>
		    <?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'type'=>'primary','icon'=>'ok white',  'label'=>'Save & Next','htmlOptions'=>array('name'=>'PO_ORD_INFO_NEXT'))); ?>
	    </div>
	    <?php $this->endWidget(); ?>
    </div><!-- form -->
<?php
echo CHtml::css("
input[name='Orderdetail[order_date]'],input[name='Orderdetail[shipment_date]'] { width:110px;}
");
?>
<script type="text/javascript">
$(document).ready(function(){
    $('#back_customer').live('click',function(){
	$('a[href="#yw0_tab_1"]').trigger('click');
    });

    $('select[name^="SoProducts[product_id]"]').live('change',function(){
	var prod_id = $(this).val();
	var sel_row = $(this).attr('name');
	var rowIndex = $(this).closest('tr').prevAll().length; 

	var postData = new Array();
	postData.push({ 'prod_id': prod_id });
	postData = JSON.stringify(postData);
	$.ajax({
	    url: '<?php echo Yii::app()->createUrl('/sales/salesorder/searchproduct');?>',
	    dataType: 'json',
	    data: { 'prod_id': prod_id },
	    success: function(data) {
		$('select[name="'+sel_row+'"]').closest('#SO_PROD_TBL tbody tr:eq('+rowIndex+')').find('input[name^="SoProducts[quote_price]"]').val(data.product_amt);
	    }
	});
    });

    $('input[name^="SoProducts[quantity]"]').live('keyup',function(){
	var quant_closest = $(this).closest('tr');
	var total_val = quant_closest.find('input[name^="SoProducts[quantity]"]').val() * quant_closest.find('input[name^="SoProducts[quote_price]"]').val();
	quant_closest.find('input[name^="SoProducts[order_value]"]').val(total_val);

	var po_ord_line_total = 0;
	$('input[name^="SoProducts[order_value]"]').each(function(){
	    if($(this).val() > 0)
	    {
		po_ord_line_total = parseInt($(this).val()) + po_ord_line_total;
	    }
	});

    <?php if(Myclass::GetSiteSetting('TAX_VALUE','setting_status')): ?>
	var po_ord_tax = <?php echo Myclass::GetSiteSetting('po_ord_tax_VALUE');?>
	var po_ord_tax_amt = po_ord_line_total * po_ord_tax / 100;
    <?php else: ?>
	    var po_ord_tax_amt = 0;
    <?php endif;?>
    var po_ord_total_order = po_ord_line_total + po_ord_tax_amt;
	$('#Orderdetail_po_ord_line_total').val(po_ord_line_total);	    
	$('#Orderdetail_po_ord_tax').val(po_ord_tax_amt);
	$('#Orderdetail_po_ord_total_order').val(po_ord_total_order);
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
$(window).bind('load',function(){
    $('.hasDatepicker').addClass('input-medium');
});
</script>
