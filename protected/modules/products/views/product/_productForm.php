<div class="create_user">
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'product-form',
	'enableAjaxValidation'=>false,
)); 

echo $form->errorSummary(array($model,$cModel,$ppModel[0]),'');
?>

	<div class="row row-fluid">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>200)); ?>
		
	</div>

	<div class="row row-fluid">
		<?php echo $form->labelEx($model,'sku'); ?>
		<?php echo $form->textField($model,'sku',array('size'=>20,'maxlength'=>20)); ?>
		
	</div>
	<div class="row row-fluid">
		<?php echo $form->labelEx($model,'re_order_limit'); ?>
		<?php echo $form->textField($model,'re_order_limit',array('size'=>20,'maxlength'=>20)); ?>
		
	</div>
	<div class="row row-fluid" id="product_cat">
		<?php echo $form->labelEx($cModel,'category_id'); ?>
		<?php echo $form->dropDownList($cModel,'category_id',CHtml::listData(Myclass::GetProductCategory(), 'category_id', 'name'), array('empty'=>'Select Category','id'=>'mylist','onchange' => CHtml::ajax(
							array(
								'type' => 'POST',
//								'dataType'=> 'json',
								'url' => CController::createUrl('product/loadSubcategory'),
								'update'=>'#subcategorylist',

							))
	));?>
		<?php echo $form->textField($cModel,'category_id',array('disabled'=>'disabled','class'=>'hide'));?>	    
		<?php //echo CHtml::link("Add New Category","javascript:void(0);",array("id"=>"add_category")); ?>
	</div>

    <div class="row row-fluid">
        <?php
        echo $form->labelEx($cModel,'sub_category_id');
	$sub_cat = array();
	if($cModel->category_id > 0):
	    $sub_cat = CHtml::listData(Myclass::GetProductSubCategory($cModel->category_id),'category_id','name');	    
	endif;
//	var_dump($sub_cat);
        echo CHtml::dropDownList ('subcategorylist',$cModel->sub_category_id,$sub_cat, array('empty'=>'Select Sub Category'));
        ?>

   
    </div>

	<div class="row row-fluid">
		<?php echo $form->labelEx($model,'weight'); ?>
		<?php echo $form->textField($model,'weight'); ?>
	</div>

	<div class="row row-fluid">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php
               $this->widget('application.extensions.eckeditor.ECKEditor', array(
                                    'model'=>$model,
                                    'attribute'=>'description',
                                    'config' => array(
                                    'width'=>'500px',
                                    'height'=>'100px',
                                    'toolbar'=>array(
                                    array('Bold','Italic','Underline','Strike','-','NumberedList','BulletedList','-','Outdent','Indent','Blockquote','-','Link','Unlink','-','Table','SpecialChar','-','Cut','Copy','Paste','-','Undo','Redo',),
                                    ),
                                    ),

                                    ));

                ?>
	</div>

	<div class="row row-fluid">
		<?php echo $form->labelEx($model,'product_class_id'); ?>
		<?php echo $form->dropDownList($model, 'product_class_id', CHtml::listData(Myclass::getProductClassType(), 'product_class_id', 'name'), array('empty'=>'Select Product Class')); ?>
	</div>
	<div class="form-horizontal">
	    <div class="control-group">
		    <?php echo $form->labelEx($ppModel[0],'range_price',array('class'=>'control-label'));?>
		    <div id="price_range_list" class="controls">
			<?php
			foreach($ppModel as $key => $price_range): 
			    $selected_range = array($price_range->price_range_id => array("selected"=>"selected"));
			    echo '<p>';
			    echo $form->dropDownList($price_range,"price_range_id[]",CHtml::listData(Myclass::getPriceRange(), 'prid', 'ranges'), array('empty'=>'Select Price Range','options'=>$selected_range));
			    echo '&nbsp;&nbsp;&nbsp;';
			    echo $form->textField($price_range,"range_price[]",array('class'=>'input-mini','value'=>$price_range->range_price));
			    if($key > 0) echo CHtml::link("&nbsp;","javascript:void(0);",array('class'=>'remove table_row_remove'));
			    echo '</p>';
			endforeach; 
			?>
		    </div>
		<label class="control-label">&nbsp;</label>
		<?php echo CHtml::link(Myclass::t('Add Price Range'),'javascript:void(0);',array('id'=>'add_price_range')); ?>
	    </div>
	</div>
	
	<div class="row row-fluid buttons">
	    <label>&nbsp;</label>
	    <?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'type'=>'primary','icon'=>'ok white', 'label'=>Myclass::t('Save'),'htmlOptions'=>array('name'=>'PRODUCT_FORM'))); ?>
	    <?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'reset', 'icon'=>'remove', 'label'=>Myclass::t('Cancel'))); ?>
	</div>

<?php $this->endWidget(); ?>
    <textarea class="hide" id="addpricerange_tmpl"><?php echo '<p>'.$form->dropDownList($price_range,"price_range_id[]",CHtml::listData(Myclass::getPriceRange(), 'prid', 'ranges'), array('empty'=>'Select Price Range')).'&nbsp;&nbsp;&nbsp;'.$form->textField($price_range,"range_price[]",array('class'=>'input-mini','value'=>'')).CHtml::link("&nbsp;","javascript:void(0);",array('class'=>'remove table_row_remove')).'</p>'; ?></textarea>
</div><!-- form -->
</div><!-- Create user div -->

<script type="text/javascript">
    $(document).ready(function(){
	$('#add_category').live('click',function(){
	   if($('input#ProductCategory_category_id').is(':disabled'))
	    {
		 $('select#ProductCategory_category_id').attr('disabled','disabled').addClass('hide');		
		 $('input#ProductCategory_category_id').removeAttr('disabled').removeClass('hide');
		 $(this).text('Choose Category');
	    }
	    else
	    {
		 $('input#ProductCategory_category_id').attr('disabled','disabled').addClass('hide');		
		 $('select#ProductCategory_category_id').removeAttr('disabled').removeClass('hide');
		 $(this).text('Add new Category');
	    }
	});


	
        var prod_range_html = $('#addpricerange_tmpl').val();
	$('#add_price_range').live('click',function(){
	   $('div#price_range_list').append(prod_range_html);
	});
	
	$("a.remove").live('click',function(){
	    $(this).parent('p').remove();
	});
	
	$("input[type='reset'],button[type='reset']").live('click',function(){
	    CKEDITOR.instances.Product_description.setData("");
	});
	
	$('select[name^="ProductPrice[price_range_id]"]').live('change',function(){
	    var sel_array = [];  
	    $('select[name^="ProductPrice[price_range_id]"]').find('option:selected').each(function(){
		if($(this).val() > '0' )
		{
		    if($.inArray($(this).val(), sel_array) > -1)
		    {
		    alert('Already Selected this Price range');
		    $(this).parent('select').find('option[value=""]').attr('selected','selected');
		    }
		    else
		    {
		    sel_array.push($(this).val());
		    }
		}
	    });
	});
    });
</script>