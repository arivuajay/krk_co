<?php
if ($pro_family_model->isNewRecord) {
    $act_url = Yii::app()->createUrl('/site/masters/family_save');
    $btn_name = 'ADD';
} else {
    $act_url = Yii::app()->createUrl('/site/masters/family_save', array('id' => $pro_family_model->pro_family_id));
    $btn_name = 'UPDATE';
}
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'family-form',
    'htmlOptions' => array('role' => 'form', 'class' => 'form-inline'),
    'action' => $act_url,
    'clientOptions' => array('validateOnSubmit' => true),
    'enableAjaxValidation' => true,
        ));
?>
<div class="form-group">
    <?php echo $form->textField($pro_family_model, 'pro_family_code', array('class' => 'form-control', 'readonly' => 'readonly')); ?>
    <?php if ($pro_family_model->isNewRecord) { ?>
        <?php echo CHtml::ajaxButton('Get Product Family Code', array('/site/default/getfamilycode'), array('success' => 'js:function(data){ $("form#family-form input#ProductFamily_pro_family_code").val(data); }'), array('class' => 'btn btn-warning')); ?>
    <?php } ?>
    <?php echo $form->error($pro_family_model, 'pro_family_code'); ?>
</div>
<div class="form-group">
    <?php echo $form->textField($pro_family_model, 'pro_family_name', array('class' => 'form-control', 'size' => 60, 'maxlength' => 255)); ?>
    <?php echo $form->error($pro_family_model, 'pro_family_name'); ?>
</div>
<button type="submit" class="btn btn-success"><?php echo $btn_name; ?></button>
<?php if (!$pro_family_model->isNewRecord) { ?>
    <button type="reset" class="btn btn-default" id="cancel_company_form">CANCEL</button>
<?php } ?>
<?php $this->endWidget(); ?>