<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'sample-form',
	'enableAjaxValidation'=>false,
)); 

echo $form->errorSummary(array($error_model,$sample),'');
$client_lists = array_values(CHtml::listData(Myclass::GetCompanies(),'company_id','name'));

Yii::app()->bootstrap->registerTypeahead('.typeahead', array(
    'source'=> $client_lists,
    'items'=>4,
    'matcher'=>"js:function(item) {
        return ~item.toLowerCase().indexOf(this.query.toLowerCase());
    }",
));
?>
    <h1>Create Sample Request</h1>
    <div class="row-fluid">
    <div class="span6">
	<?php echo CHtml::activeLabel($sample,'client_name',array('class'=>'inline-label')); ?>
	<?php echo $form->textField($sample,'client_name',array('class'=>'typeahead','autocomplete'=>'off')); ?>
    </div>
    </div>
    <div class="row-fluid">
	<table  border="0" cellspacing="0" class="table table-bordered" cellpadding="0" id="SO_PROD_TBL">
	    <thead>
		<tr class="tablehead">				 
			<th>S.#</th>
			<th>Product Name</th>
			<th>Qty</th>
		</tr>
	    </thead>
	    <tbody>
		<?php 
		$i = "0";
		foreach($prodmodel as $key => $product): 
		$set_prod = $_POST['SamplerProduct'];
		if(isset($set_prod)):
		    $product_ids = $set_prod['prod_id'];
		    $qtys	 = $set_prod['qty'];	

		    if(isset($product_ids[$key])) $product->prod_id = $product_ids[$key];
		    if(isset($qtys[$key]))  $product->qty = $qtys[$key];
		endif;
		?>
		<tr>				 
			<td><?php echo $key+1;?></td>
			<td><?php echo CHtml::dropDownList("SamplerProduct[prod_id][]",$product->prod_id,Myclass::getProduct_Items(), array('empty'=>'Select Product'));?></td>
			<td>
			    <?php 
			    echo $form->textField($product,"qty[]",array('class'=>'input-mini',"onkeypress"=>"return isNumberKey(event)",'value'=>$product->qty)); 
			    if($i > 0):
				echo CHtml::link("&nbsp;","javascript:void(0);",array("class"=>"table_row_remove pull-right","style"=>"height:30px;display:block;width:16px;"));
			    endif;
				
			    ?>
			</td>
		</tr>
		<?php $i++; endforeach;?>
		<tfoot>
		<td colspan="5" style="text-align: right;">
		    <?php echo CHtml::link('Add Product', 'javascript:void(0);', array('id'=>'add_product')); ?>
		</td>
		</tfoot>
	    </tbody>
	</table>
    </div>
    <textarea id="add_row_tmpl" class="hide">
	<td><?php echo CHtml::dropDownList("SamplerProduct[prod_id][]",'',Myclass::getProduct_Items(), array('empty'=>'Select Product'));?></td>
	<td><?php 
	echo $form->textField($product,"qty[]",array('class'=>'input-mini',"onkeypress"=>"return isNumberKey(event)")); 
	echo CHtml::link("&nbsp;","javascript:void(0);",array("class"=>"table_row_remove pull-right","style"=>"height:30px;display:block;width:16px;")); 
	?></td>
    </textarea>

    <div class="row-fluid buttons inline-center">
	    <?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit','type'=>'primary','icon'=>'folder-close white', 'label'=>'Save')); ?>
	    <?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'reset', 'icon'=>'remove',  'label'=>'Cancel')); ?>
    </div>
    <?php 
    $this->endWidget(); 
    ?>
</div><!-- form -->
<?php
echo CHtml::script("$(document).ready(function(){

	$('select[name^=\'SamplerProduct[prod_id]\']').live('change',function(){
	    var prod_id = $(this).val();
	    var sel_row = $(this).attr('name');
	    var rowIndex = $(this).closest('tr').prevAll().length; 

	    var postData = new Array();
	    postData.push({ 'prod_id': prod_id });
	    postData = JSON.stringify(postData);
	    $.ajax({
		url: '".Yii::app()->createUrl('/sales/salesorder/searchproduct')."',
		dataType: 'json',
		data: { 'prod_id': prod_id },
		success: function(data) {
		    $('select[name=\"'+sel_row+'\"]').closest('#SO_PROD_TBL tbody tr:eq('+rowIndex+')').find('input[name^=\'SamplerProduct[quote_price]\']').val(data.product_amt);
		},
	    });
	});
	
	$('#add_product').live('click',function(){
	    var row = $('#add_row_tmpl').val();

	    var row_count = $('#SO_PROD_TBL tbody tr').length + 1;
	    $('#SO_PROD_TBL tbody').append('<tr><td>'+row_count+'</td>'+row+'</tr>');
	});
});
");
?>
