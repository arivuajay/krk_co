<?php
if ($comp_model->isNewRecord) {
    $act_url = Yii::app()->createUrl('/site/masters/company_save');
    $btn_name = 'ADD';
} else {
    $act_url = Yii::app()->createUrl('/site/masters/company_save', array('id' => $comp_model->company_id));
    $btn_name = 'UPDATE';
}
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'company-form',
    'htmlOptions' => array('role' => 'form', 'class' => 'form-inline'),
    'action' => $act_url,
    'clientOptions' => array('validateOnSubmit' => true),
    'enableAjaxValidation' => true,
        ));
?>
<div class="form-group">
    <?php echo $form->textField($comp_model, 'company_name', array('class' => 'form-control', 'size' => 60, 'maxlength' => 255)); ?>
    <?php echo $form->error($comp_model, 'company_name'); ?>
</div>
<div class="form-group">
    <?php echo $form->textField($comp_model, 'company_address', array('class' => 'form-control', 'size' => 60, 'maxlength' => 255)); ?>
    <?php echo $form->error($comp_model, 'company_address'); ?>
</div>
<button type="submit" class="btn btn-success"><?php echo $btn_name; ?></button>
<?php if (!$comp_model->isNewRecord) { ?>
<button type="reset" class="btn btn-default" id="cancel_company_form">CANCEL</button>
<?php } ?>
<?php $this->endWidget(); ?>