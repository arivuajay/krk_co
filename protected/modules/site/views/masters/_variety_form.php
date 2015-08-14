<?php
if ($variety_model->isNewRecord) {
    $act_url = Yii::app()->createUrl('/site/masters/variety_save');
    $btn_name = 'ADD';
} else {
    $act_url = Yii::app()->createUrl('/site/masters/variety_save', array('id' => $variety_model->variety_id));
    $btn_name = 'UPDATE';
}
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'product-variety-form',
    'htmlOptions' => array('role' => 'form', 'class' => 'form-inline'),
    'action' => $act_url,
    'clientOptions' => array('validateOnSubmit' => true),
    'enableAjaxValidation' => true,
        ));

$family = CHtml::listData(ProductFamily::model()->active()->findAll(),'pro_family_id','pro_family_name');

$variety_family = '';
?>
<div class="form-group">
    <?php echo CHtml::dropDownList('variety_family_id',$variety_family, $family, array('class' => 'form-control','empty'=>'Select Family',
        'ajax' => array(
            'type'=>'GET',
            'url'=>Yii::app()->createUrl('/site/default/getProductbyFamily'), //or $this->createUrl('loadcities') if '$this' extends CController
            'update'=>'#ProductVariety_product_id',
            'data'=>array('id'=>'js:this.value'))));
    ?>
</div>
<div class="form-group">
    <?php echo $form->dropDownList($variety_model, 'product_id', array(), array('class' => 'form-control','empty'=>'Select Products')); ?>
    <?php echo $form->error($variety_model, 'product_id'); ?>
</div>
<div class="form-group">
    <?php echo $form->textField($variety_model, 'variety_code', array('class' => 'form-control', 'readonly' => 'readonly')); ?>
    <?php if ($variety_model->isNewRecord) { ?>
        <?php echo CHtml::ajaxButton('Get Variety Code', array('/site/default/getvarietycode'), array('success' => 'js:function(data){ $("form#product-variety-form input#ProductVariety_variety_code").val(data); }'), array('class' => 'btn btn-warning')); ?>
    <?php } ?>
    <?php echo $form->error($variety_model, 'variety_code'); ?>
</div>
<div class="form-group">
    <?php echo $form->textField($variety_model, 'variety_name', array('class' => 'form-control')); ?>
    <?php echo $form->error($variety_model, 'variety_name'); ?>
</div>
<button type="submit" class="btn btn-success"><?php echo $btn_name; ?></button>
<?php if (!$variety_model->isNewRecord) { ?>
    <button type="reset" class="btn btn-default" id="cancel_company_form">CANCEL</button>
<?php } ?>
<?php $this->endWidget(); ?>