<?php
if ($exp_type_model->isNewRecord) {
    $act_url = Yii::app()->createUrl('/site/masters/exp_type_save');
    $btn_name = 'ADD';
} else {
    $act_url = Yii::app()->createUrl('/site/masters/exp_type_save', array('id' => $exp_type_model->exp_type_id));
    $btn_name = 'UPDATE';
}
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'expense-type-form',
    'htmlOptions' => array('role' => 'form', 'class' => 'form-inline'),
    'action' => $act_url,
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
    'enableAjaxValidation' => true,
        ));
?>
<div class="form-group">
    <?php echo $form->textField($exp_type_model, 'exp_type_name', array('class' => 'form-control', 'size' => 60, 'maxlength' => 255)); ?>
    <?php echo $form->error($exp_type_model, 'exp_type_name'); ?>
</div>
    <button type="submit" class="btn btn-success"><?php echo $btn_name; ?></button>
<?php if (!$exp_type_model->isNewRecord) { ?>
    <button type="reset" class="btn btn-default" id="cancel_company_form">CANCEL</button>
<?php } ?>

<?php $this->endWidget(); ?>
