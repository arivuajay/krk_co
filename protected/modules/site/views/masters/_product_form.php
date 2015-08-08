<?php
if ($product_model->isNewRecord) {
    $act_url = Yii::app()->createUrl('/site/masters/product_save');
    $btn_name = 'ADD';
} else {
    $act_url = Yii::app()->createUrl('/site/masters/product_save', array('id' => $product_model->pro_family_id));
    $btn_name = 'UPDATE';
}
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'family-form',
    'htmlOptions' => array('role' => 'form', 'class' => 'form-inline'),
    'action' => $act_url,
    'clientOptions' => array('validateOnSubmit' => true),
    'enableAjaxValidation' => true,
        ));

$family = CHtml::listData(ProductFamily::model()->active()->findAll(),'pro_family_id','pro_family_name');
?>
<div class="form-group">
    <?php echo $form->dropDownList($product_model, 'pro_family_id', $family, array('class' => 'form-control','empty'=>'Select Fruits')); ?>
    <?php echo $form->error($product_model, 'pro_family_id'); ?>
</div>
<div class="form-group">
    <?php echo $form->textField($product_model, 'product_code', array('class' => 'form-control', 'readonly' => 'readonly')); ?>
    <?php if ($product_model->isNewRecord) { ?>
        <?php echo CHtml::ajaxButton('Get Product Family Code', array('/site/masters/getproductcode'), array('success' => 'js:function(data){ $("form#family-form input#Product_product_code").val(data); }'), array('class' => 'btn btn-warning')); ?>
    <?php } ?>
    <?php echo $form->error($product_model, 'product_code'); ?>
</div>
<div class="form-group">
    <?php echo $form->textField($product_model, 'pro_name', array('class' => 'form-control', 'size' => 60, 'maxlength' => 255)); ?>
    <?php echo $form->error($product_model, 'pro_name'); ?>
</div>
<button type="submit" class="btn btn-success"><?php echo $btn_name; ?></button>
<?php if (!$product_model->isNewRecord) { ?>
    <button type="reset" class="btn btn-default" id="cancel_company_form">CANCEL</button>
<?php } ?>
<?php $this->endWidget(); ?>