<?php
if ($liner_model->isNewRecord) {
    $act_url = Yii::app()->createUrl('/site/masters/liner_save');
    $btn_name = 'ADD';
} else {
    $act_url = Yii::app()->createUrl('/site/masters/liner_save', array('id' => $liner_model->liner_id));
    $btn_name = 'UPDATE';
}
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'liner-form',
    'htmlOptions' => array('role' => 'form', 'class' => 'form-inline'),
    'action' => $act_url,
    'clientOptions' => array('validateOnSubmit' => true),
    'enableAjaxValidation' => true,
        ));
$countries = CHtml::listData(Country::model()->active()->findAll(),'country_id', 'country_name');
?>
<div class="form-group">
    <?php echo $form->textField($liner_model, 'liner_code', array('class' => 'form-control', 'readonly' => 'readonly')); ?>
    <?php if ($liner_model->isNewRecord) { ?>
        <?php echo CHtml::ajaxButton('Get Liner Code', array('/site/masters/getlinercode'), array('success' => 'js:function(data){ $("form#liner-form input#Liner_liner_code").val(data); }'), array('class' => 'btn btn-warning')); ?>
    <?php } ?>
    <?php echo $form->error($liner_model, 'liner_code'); ?>
</div>
<div class="form-group">
    <?php echo $form->textField($liner_model, 'liner_name', array('class' => 'form-control')); ?>
    <?php echo $form->error($liner_model, 'liner_name'); ?>
</div>
<div class="form-group">
    <?php echo $form->dropDownList($liner_model, 'country_id', $countries,array('class' => 'form-control')); ?>
    <?php echo $form->error($liner_model, 'country_id'); ?>
</div>
<div class="form-group">
    <?php echo $form->textField($liner_model, 'no_of_free_days', array('class' => 'form-control')); ?>
    <?php echo $form->error($liner_model, 'no_of_free_days'); ?>
</div>
<button type="submit" class="btn btn-success"><?php echo $btn_name; ?></button>
<?php if (!$liner_model->isNewRecord) { ?>
    <button type="reset" class="btn btn-default" id="cancel_company_form">CANCEL</button>
<?php } ?>
<?php $this->endWidget(); ?>