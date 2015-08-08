<?php
if ($grade_model->isNewRecord) {
    $act_url = Yii::app()->createUrl('/site/masters/grade_save');
    $btn_name = 'ADD';
} else {
    $act_url = Yii::app()->createUrl('/site/masters/grade_save', array('id' => $grade_model->grade_id));
    $btn_name = 'UPDATE';
}
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'product-grade-form',
    'htmlOptions' => array('role' => 'form', 'class' => 'form-inline'),
    'action' => $act_url,
    'clientOptions' => array('validateOnSubmit' => true),
    'enableAjaxValidation' => true,
        ));

$family = CHtml::listData(ProductFamily::model()->active()->findAll(),'pro_family_id','pro_family_name');

$grade_family = '';
?>
<div class="form-group">
    <?php echo CHtml::dropDownList('grade_family_id',$grade_family, $family, array('class' => 'form-control','empty'=>'Select Family',
        'ajax' => array(
            'type'=>'GET',
            'url'=>Yii::app()->createUrl('/site/masters/getProductbyFamily'), //or $this->createUrl('loadcities') if '$this' extends CController
            'update'=>'#ProductGrade_product_id',
            'data'=>array('id'=>'js:this.value'))));
    ?>
</div>
<div class="form-group">
    <?php echo $form->dropDownList($grade_model, 'product_id', array(), array('class' => 'form-control','empty'=>'Select Products')); ?>
    <?php echo $form->error($grade_model, 'product_id'); ?>
</div>
<div class="form-group">
    <?php echo $form->textField($grade_model, 'grade_code', array('class' => 'form-control', 'readonly' => 'readonly')); ?>
    <?php if ($grade_model->isNewRecord) { ?>
        <?php echo CHtml::ajaxButton('Get Grade Code', array('/site/masters/getgradecode'), array('success' => 'js:function(data){ $("form#product-grade-form input#ProductGrade_grade_code").val(data); }'), array('class' => 'btn btn-warning')); ?>
    <?php } ?>
    <?php echo $form->error($grade_model, 'grade_code'); ?>
</div>
<div class="form-group">
    <?php echo $form->textField($grade_model, 'grade_short_name', array('class' => 'form-control')); ?>
    <?php echo $form->error($grade_model, 'grade_short_name'); ?>
</div>
<div class="form-group">
    <?php echo $form->textField($grade_model, 'grade_long_name', array('class' => 'form-control')); ?>
    <?php echo $form->error($grade_model, 'grade_long_name'); ?>
</div>
<button type="submit" class="btn btn-success"><?php echo $btn_name; ?></button>
<?php if (!$grade_model->isNewRecord) { ?>
    <button type="reset" class="btn btn-default" id="cancel_company_form">CANCEL</button>
<?php } ?>
<?php $this->endWidget(); ?>