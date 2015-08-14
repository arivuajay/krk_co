<?php
$size_family = '';

if ($size_model->isNewRecord) {
    $act_url = Yii::app()->createUrl('/site/masters/size_save');
    $btn_name = 'ADD';
} else {
    $act_url = Yii::app()->createUrl('/site/masters/size_save', array('id' => $size_model->size_id));
    $btn_name = 'UPDATE';
    $size_family = $size_model->product->proFamily->pro_family_id;
}
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'product-size-form',
    'htmlOptions' => array('role' => 'form', 'class' => 'form-inline'),
    'action' => $act_url,
    'clientOptions' => array('validateOnSubmit' => true),
    'enableAjaxValidation' => true,
        ));

$family = CHtml::listData(ProductFamily::model()->active()->findAll(), 'pro_family_id', 'pro_family_name');
?>
<div class="form-group">
    <?php
    echo CHtml::dropDownList('size_family_id', $size_family, $family, array('class' => 'form-control', 'empty' => 'Select Family',
        'ajax' => array(
            'type' => 'GET',
            'url' => Yii::app()->createUrl('/site/default/getProductbyFamily'), //or $this->createUrl('loadcities') if '$this' extends CController
            'update' => '#ProductSize_product_id',
            'data' => array('id' => 'js:this.value', 'pro_id' => $size_model->product_id))));
    ?>
</div>
<div class="form-group">
    <?php echo $form->dropDownList($size_model, 'product_id', array(), array('class' => 'form-control', 'empty' => 'Select Products')); ?>
    <?php echo $form->error($size_model, 'product_id'); ?>
</div>
<div class="form-group">
    <?php echo $form->textField($size_model, 'size_code', array('class' => 'form-control', 'readonly' => 'readonly')); ?>
    <?php if ($size_model->isNewRecord) { ?>
        <?php echo CHtml::ajaxButton('Get Size Code', array('/site/default/getsizecode'), array('success' => 'js:function(data){ $("form#product-size-form input#ProductSize_size_code").val(data); }'), array('class' => 'btn btn-warning')); ?>
    <?php } ?>
    <?php echo $form->error($size_model, 'size_code'); ?>
</div>
<div class="form-group">
    <?php echo $form->textField($size_model, 'size_name', array('class' => 'form-control')); ?>
    <?php echo $form->error($size_model, 'size_name'); ?>
</div>
<button type="submit" class="btn btn-success"><?php echo $btn_name; ?></button>
<?php if (!$size_model->isNewRecord) { ?>
    <button type="reset" class="btn btn-default" id="cancel_company_form">CANCEL</button>
<?php } ?>
<?php
$this->endWidget();
if ($size_family != '') {
    $script = <<< JS
$(function(){
    $('#size_family_id').trigger('change');
});
JS;

Yii::app()->clientScript->registerScript('_size_js', $script);
}
?>