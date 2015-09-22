<?php
if ($exp_subtype_model->isNewRecord) {
    $act_url = Yii::app()->createUrl('/site/masters/exp_subtype_save');
    $btn_name = 'ADD';
} else {
    $act_url = Yii::app()->createUrl('/site/masters/exp_subtype_save', array('id' => $exp_subtype_model->exp_subtype_id));
    $btn_name = 'UPDATE';
}
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'expense-sub-type-form',
    'htmlOptions' => array('role' => 'form', 'class' => 'form-inline'),
    'action' => $act_url,
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
    'enableAjaxValidation' => true,
        ));
?>
<div class="form-group">
    <?php echo $form->dropDownList($exp_subtype_model, 'exp_type_id', ExpenseType::ExpenseTypeList(), array('class' => 'form-control', 'prompt' => '')); ?>
    <?php echo $form->error($exp_subtype_model, 'exp_type_id'); ?>
</div>
<div class="form-group">
    <?php echo $form->textField($exp_subtype_model, 'exp_subtype_name', array('class' => 'form-control', 'size' => 60, 'maxlength' => 255)); ?>
    <?php echo $form->error($exp_subtype_model, 'exp_subtype_name'); ?>
</div>
    <button type="submit" class="btn btn-success"><?php echo $btn_name; ?></button>
<?php if (!$exp_subtype_model->isNewRecord) { ?>
    <button type="reset" class="btn btn-default" id="cancel_company_form">CANCEL</button>
<?php } ?>

<?php $this->endWidget(); ?>
