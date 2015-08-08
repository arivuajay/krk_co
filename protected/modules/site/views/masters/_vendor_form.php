<?php
if ($vendor_model->isNewRecord) {
    $act_url = Yii::app()->createUrl('/site/masters/permit_save');
    $btn_name = 'ADD';
} else {
    $act_url = Yii::app()->createUrl('/site/masters/permit_save', array('id' => $vendor_model->vendor_id));
    $btn_name = 'UPDATE';
}
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'permit-form',
    'htmlOptions' => array('role' => 'form', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data'),
    'action' => $act_url,
    'clientOptions' => array('validateOnSubmit' => true),
    'enableAjaxValidation' => true,
        ));

$vendor_types = VendorType::VendorTypeList();
?>
<div class="form-group">
    <?php echo $form->labelEx($vendor_model, 'vendor_type_id', array('class' => 'col-sm-5 control-label')); ?>
    <div class="col-sm-7">
        <?php echo $form->dropDownList($vendor_model, 'vendor_type_id',$vendor_types, array('class' => 'form-control')); ?>
        <?php echo $form->error($vendor_model, 'vendor_type_id'); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->labelEx($vendor_model, 'vendor_code', array('class' => 'col-sm-5 control-label')); ?>
    <div class="col-sm-7">
        <?php echo $form->textField($vendor_model, 'vendor_code', array('class' => 'form-control', 'size' => 10, 'maxlength' => 10)); ?>
        <?php echo $form->error($vendor_model, 'vendor_code'); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->labelEx($vendor_model, 'vendor_name', array('class' => 'col-sm-5 control-label')); ?>
    <div class="col-sm-7">
        <?php echo $form->textField($vendor_model, 'vendor_name', array('class' => 'form-control', 'size' => 50, 'maxlength' => 50)); ?>
        <?php echo $form->error($vendor_model, 'vendor_name'); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->labelEx($vendor_model, 'vendor_address', array('class' => 'col-sm-5 control-label')); ?>
    <div class="col-sm-7">
        <?php echo $form->textArea($vendor_model, 'vendor_address', array('class' => 'form-control', 'rows' => 6, 'cols' => 50)); ?>
        <?php echo $form->error($vendor_model, 'vendor_address'); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->labelEx($vendor_model, 'vendor_city', array('class' => 'col-sm-5 control-label')); ?>
    <div class="col-sm-7">
        <?php echo $form->textField($vendor_model, 'vendor_city', array('class' => 'form-control', 'size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($vendor_model, 'vendor_city'); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->labelEx($vendor_model, 'vendor_country', array('class' => 'col-sm-5 control-label')); ?>
    <div class="col-sm-7">
        <?php echo $form->textField($vendor_model, 'vendor_country', array('class' => 'form-control', 'size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($vendor_model, 'vendor_country'); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->labelEx($vendor_model, 'vendor_contact_person', array('class' => 'col-sm-5 control-label')); ?>
    <div class="col-sm-7">
        <?php echo $form->textField($vendor_model, 'vendor_contact_person', array('class' => 'form-control', 'size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($vendor_model, 'vendor_contact_person'); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->labelEx($vendor_model, 'vendor_mobile_no', array('class' => 'col-sm-5 control-label')); ?>
    <div class="col-sm-7">
        <?php echo $form->textField($vendor_model, 'vendor_mobile_no', array('class' => 'form-control', 'size' => 60, 'maxlength' => 100)); ?>
        <?php echo $form->error($vendor_model, 'vendor_mobile_no'); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->labelEx($vendor_model, 'vendor_office_no', array('class' => 'col-sm-5 control-label')); ?>
    <div class="col-sm-7">
        <?php echo $form->textField($vendor_model, 'vendor_office_no', array('class' => 'form-control', 'size' => 60, 'maxlength' => 100)); ?>
        <?php echo $form->error($vendor_model, 'vendor_office_no'); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->labelEx($vendor_model, 'vendor_email', array('class' => 'col-sm-5 control-label')); ?>
    <div class="col-sm-7">
        <?php echo $form->textField($vendor_model, 'vendor_email', array('class' => 'form-control', 'size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($vendor_model, 'vendor_email'); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->labelEx($vendor_model, 'vendor_website', array('class' => 'col-sm-5 control-label')); ?>
    <div class="col-sm-7">
        <?php echo $form->textField($vendor_model, 'vendor_website', array('class' => 'form-control', 'size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($vendor_model, 'vendor_website'); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->labelEx($vendor_model, 'vendor_trade_mark', array('class' => 'col-sm-5 control-label')); ?>
    <div class="col-sm-7">
        <?php echo $form->textField($vendor_model, 'vendor_trade_mark', array('class' => 'form-control', 'size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($vendor_model, 'vendor_trade_mark'); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->labelEx($vendor_model, 'vendor_remarks', array('class' => 'col-sm-5 control-label')); ?>
    <div class="col-sm-7">
        <?php echo $form->textArea($vendor_model, 'vendor_remarks', array('class' => 'form-control', 'rows' => 6, 'cols' => 50)); ?>
        <?php echo $form->error($vendor_model, 'vendor_remarks'); ?>
    </div>
</div>

<button type="submit" class="btn btn-success"><?php echo $btn_name; ?></button>
<?php if (!$vendor_model->isNewRecord) { ?>
    <button type="reset" class="btn btn-default" id="cancel_permit_form">CANCEL</button>
<?php } ?>
<?php $this->endWidget(); ?>