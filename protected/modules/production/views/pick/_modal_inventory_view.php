<?php
$form=$this->beginWidget('CActiveForm', array(
	    'id'=>'inventory-form',
	    'action'=>Yii::app()->createUrl('/production/pick/modal_inventory_product', array('id'=>$data->product_id,'soid'=>$soid)),
	    'enableAjaxValidation'=>true,
	    'enableClientValidation'=>true,
	    'clientOptions' => array('validateOnSubmit' => true,'validateOnChange' => true),
	    'htmlOptions'=>array('class'=>'form-horizontal'),
    ));
$invetory_status = Myclass::getInventoryLevel($data->available_quantity,$data->re_order_limit);
$inventory_image = ($invetory_status) ? "green" : "red";
?>
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <?php echo CHtml::image(SML_SITE_LOGO); ?>
    <h3><?php echo CHtml::image(Yii::app()->getBaseUrl(true)."/images/$inventory_image.png")." ".$data->name;?> Detail</h3>
    <span></span>
</div>
<?php 
if($invetory_status):
?>
<div class="modal-body modal-product-detail">
    <div class="short_desc">
	    <span><label><?php echo Myclass::t('SKU');?></label><?php echo $data->sku; ?></span>
	    <span><label><?php echo Myclass::t('Category');?></label><?php foreach($data->productCategories as $pro_category) echo $pro_category->category->name; ?></span>
	    <span><label><?php echo Myclass::t('Sub-category');?></label><?php foreach($data->productCategories as $pro_category) echo $pro_category->subcategory->name; ?></span>
	    <span><label><?php echo Myclass::t('Weight');?></label><?php echo $data->weight; ?></span>
	    <span><label><?php echo Myclass::t('Product Class');?></label><?php echo $data->productClass->name; ?></span>
		<div class="long_desc">
		<p><?php echo strip_tags($data->description); ?></p>
		</div>
    </div>
    <div class="image">
	<?php echo CHtml::image($baseUrl.PRO_LARGE_IMAGE_PATH.$data->image_path,$data->name); ?>
    </div>
</div>
<?php 
else: 
echo CHtml::script("
$(document).ready(function(){
	$('#edd').datepicker({
	    'autoSize':true,
	    'minDate':0,
	    'dateFormat':'yy-mm-dd',
	    'mode':'date',
	    'showOn':'focus',
	    'changeMonth':true,
	    'changeYear':true,
	    'htmlOptions':{'readonly':'readonly'}
	});
    });");    
echo $form->errorSummary(array($model),'');
?>
<div class="hide">
    <?php echo $form->error($model,'quantity'); ?>
    <?php echo $form->error($model,'edd'); ?>
</div>  
<div class="modal-body modal-product-detail">
    <div class="short_desc">
	<div class="row row-fluid row row-fluid-fluid">
		<?php echo $form->labelEx($model,'quantity'); ?>
		<?php echo $form->textField($model,'quantity',array('size'=>60,'maxlength'=>200)); ?>			
	</div>
	<div class="row row-fluid row row-fluid-fluid">
		<?php echo $form->labelEx($model,'edd'); ?>
		<?php echo $form->textField($model,'edd',array('id'=>'edd','style'=>'margin-left: 20px; margin-top: 10px;')); ?>
	</div>
    </div>
    <div class="image">
	<?php echo CHtml::image($baseUrl.PRO_LARGE_IMAGE_PATH.$data->image_path,$data->name); ?>
    </div>
</div>
<?php endif; ?>
 
<div class="modal-footer">
    <?php 
    if(!$invetory_status):
    $this->widget('bootstrap.widgets.BootButton', array(
	'buttonType'=>'submit', 
	'type'=>'primary', 
	'icon'=>'ok white', 
	'label'=>Myclass::t('Request Procurement')
    ));
    endif;
    $this->widget('bootstrap.widgets.BootButton', array(
        'label'=>Myclass::t('Close'),
        'url'=>'#',
        'htmlOptions'=>array('data-dismiss'=>'modal'),
    )); 
    ?>
</div>
<?php $this->endWidget(); ?>