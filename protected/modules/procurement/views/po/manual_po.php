<h1><?php echo Myclass::t('Create Manual PO"s');?></h1>
<div class="create_user">
    <div class="form">


	<?php
	$form = $this->beginWidget('CActiveForm', array(
	    'id' => 'manualpo-form',
//	    'enableAjaxValidation' => true,
		));
	?>

	<?php
	echo $form->errorSummary(array($model), '');

	$array1 = array();
	$array2 = CHtml::listData(Vendor::model()->active()->findAll(), 'ven_id', 'ven_name');

	$result = array_merge($array1, $array2);
	?>
        <div class="row-fluid">
	    <?php echo $form->labelEx($model, 'pay_vendor'); ?>
	    <?php
	    $this->widget('bootstrap.widgets.BootTypeahead', array(
		'options' => array(
		    'name' => 'typeahead',
		    'source' => $result,
		    'items' => 4,
		    'matcher' => "js:function(item) {
			    return ~item.toLowerCase().indexOf(this.query.toLowerCase());
			}",
		),
		'htmlOptions' => array('name' => 'ManualPo[pay_vendor]'),
	    ));
	    ?>
        </div>

        <div class="row-fluid">
	    <?php echo $form->labelEx($model, 'pay_date'); ?>
	    <?php echo $this->getDatePicker('pay_date', $model, ''); ?>
        </div>

	<div id="prod_list">
	    <?php foreach ($mpomodel as $key => $mproduct): ?>
                <div class="row-fluid">
		    <?php
		    echo $form->labelEx($mproduct, 'product_info');
		    echo $form->textField($mproduct, "product_name[]", array('class'=>'input-medium','placeholder'=>$mproduct->getAttributeLabel('product_name')));
		    echo '&nbsp;';
		    echo $form->textField($mproduct, "quantity[]", array('class'=>'input-small','placeholder'=>$mproduct->getAttributeLabel('quantity'),'onkeypress'=>'return isNumberKey(event);'));
		    echo '&nbsp;';
		    echo $form->textField($mproduct, "price[]", array('class'=>'input-small','placeholder'=>$mproduct->getAttributeLabel('price'),'onkeypress'=>'return isNumberKey(event)'));
		    if ($key > 0):
			echo CHtml::link("&nbsp;", "javascript:void(0);", array("class" => "remove pull-right", "style" => "height:30px;display:block;width:16px;"));
		    endif;
		    ?>
                </div>
	    <?php endforeach; ?>
	</div>
	<div class="row-fluid">
	    <?php echo CHtml::link(Myclass::t('Add Product'), "javascript:void(0);", array('id' => 'add_product' ,'class'=>'pull-right')); ?>
	</div>

	<?php $poprdmdl = new ManualPoProducts();?>
	<textarea id="add_row_tmpl" class="hide">
	<div class="row-fluid">
	    <label for="ManualPoProducts_product_info"><?php echo Myclass::t('Product Info');?></label>
	    <input type="text" maxlength="150" id="ManualPoProducts_product_name" name="ManualPoProducts[product_name][]" class="input-medium" placeholder="<?php echo $poprdmdl->getAttributeLabel('product_name')?>"/>
	    <input type="text" id="ManualPoProducts_quantity" name="ManualPoProducts[quantity][]" class="input-small" onkeypress="return isNumberKey(event);" placeholder="<?php echo $poprdmdl->getAttributeLabel('quantity')?>"/>
	    <input type="text" id="ManualPoProducts_price" name="ManualPoProducts[price][]" class="input-small" onkeypress="return isNumberKey(event);" placeholder="<?php echo $poprdmdl->getAttributeLabel('price')?>"/>
	    <a href="javascript:void(0);" style="height:30px;display:block;width:16px;" class="remove pull-right">&nbsp;</a>
	</div>
	</textarea>
	
	<div class="row-fluid">
	    <?php echo $form->labelEx($model, 'pay_amt'); ?>
	    <?php echo $form->textField($model, 'pay_amt', array('class' => 'input-mini','readonly'=>'readonly')); ?>
        </div>
	
        <div class="row-fluid">
	    <?php echo $form->labelEx($model, 'pay_description'); ?>
	    <?php echo $form->textArea($model, 'pay_description'); ?>
        </div>

        <div class="row-fluid">
            <label>&nbsp;</label>
	    <?php $this->widget('bootstrap.widgets.BootButton', array('buttonType' => 'submit', 'type' => 'primary', 'icon' => 'ok white', 'label' => 'Submit')); ?>
	    <?php $this->widget('bootstrap.widgets.BootButton', array('buttonType' => 'reset', 'icon' => 'remove', 'label' => 'Cancel')); ?>
        </div>

	<?php $this->endWidget(); ?>
    </div><!-- form -->
</div><!-- Create user -->
<script type="text/javascript">
    $(document).ready(function(){
	$(".remove").live('click',function(){
	    $(this).closest('.row-fluid').remove(); 
	});
 
	$('#add_product').live('click',function(){
	    var row = $('#add_row_tmpl').val();
	    $('#prod_list').append(row);
	});

	$('input[name^="ManualPoProducts[price]"]').live('keyup',function(){
	    var pay_amt = 0;
	    $('input[name^="ManualPoProducts[price]"]').each(function(){
		if($(this).val() > 0)
		{
		    pay_amt = parseInt($(this).val()) + pay_amt;
		}
	    });
	    $('#ManualPo_pay_amt').val(pay_amt);
	});
    });
</script>	