<?php
$themeUrl = $this->themeUrl;
$cs = Yii::app()->getClientScript();
$cs_pos_end = CClientScript::POS_END;

$cs->registerCssFile($themeUrl . '/css/datepicker/bootstrap-datepicker.css');
$cs->registerScriptFile($themeUrl . '/js/datepicker/bootstrap-datepicker.js', $cs_pos_end);

if ($perm_model->isNewRecord) {
    $act_url = Yii::app()->createUrl('/site/masters/permit_save');
    $btn_name = 'ADD';
} else {
    $act_url = Yii::app()->createUrl('/site/masters/permit_save', array('id' => $perm_model->permit_id));
    $btn_name = 'UPDATE';
}
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'permit-form',
    'htmlOptions' => array('role' => 'form', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data'),
    'action' => $act_url,
    'clientOptions' => array('validateOnSubmit' => true,'validateOnChange' => false),
    'enableAjaxValidation' => true,
        ));

$companies = Company::CompanyList();
$vendors = Vendor::VendorList();
?>
<div class="form-group">
    <?php echo $form->labelEx($perm_model, 'company_id', array('class' => 'col-sm-4 control-label')); ?>
    <div class="col-sm-8">
        <?php echo $form->dropDownList($perm_model, 'company_id', $companies, array('class' => 'form-control', 'prompt' => 'Select company')); ?>
        <?php echo $form->error($perm_model, 'company_id'); ?>
    </div>
</div>
<div class="form-group">
    <?php echo $form->labelEx($perm_model, 'vendor_id', array('class' => 'col-sm-4 control-label')); ?>
    <div class="col-sm-8">
        <?php echo $form->dropDownList($perm_model, 'vendor_id', $vendors, array('class' => 'form-control', 'prompt' => 'Select Vendor')); ?>
        <?php echo $form->error($perm_model, 'vendor_id'); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->labelEx($perm_model, 'permit_no', array('class' => 'col-sm-4 control-label')); ?>
    <div class="col-sm-8">
        <?php echo $form->textField($perm_model, 'permit_no', array('class' => 'form-control', 'size' => 60, 'maxlength' => 100)); ?>
        <?php echo $form->error($perm_model, 'permit_no'); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->labelEx($perm_model, 'doissue', array('class' => 'col-sm-4 control-label')); ?>
    <div class="col-sm-8">
        <?php echo $form->textField($perm_model, 'doissue', array('class' => 'form-control datepicker')); ?>
        <?php echo $form->error($perm_model, 'doissue'); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->labelEx($perm_model, 'valupto', array('class' => 'col-sm-4 control-label')); ?>
    <div class="col-sm-8">
        <?php echo $form->textField($perm_model, 'valupto', array('class' => 'form-control datepicker')); ?>
        <?php echo $form->error($perm_model, 'valupto'); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->labelEx($perm_model, 'permit_regno', array('class' => 'col-sm-4 control-label')); ?>
    <div class="col-sm-8">
        <?php echo $form->textField($perm_model, 'permit_regno', array('class' => 'form-control', 'size' => 60, 'maxlength' => 100)); ?>
        <?php echo $form->error($perm_model, 'permit_regno'); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->labelEx($perm_model, 'permit_poissue', array('class' => 'col-sm-4 control-label')); ?>
    <div class="col-sm-8">
        <?php echo $form->textField($perm_model, 'permit_poissue', array('class' => 'form-control', 'size' => 60, 'maxlength' => 100)); ?>
        <?php echo $form->error($perm_model, 'permit_poissue'); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->labelEx($perm_model, 'permit_file', array('class' => 'col-sm-4 control-label')); ?>
    <div class="col-sm-8">
        <?php echo $form->fileField($perm_model, 'permit_file'); ?>
        <?php echo $form->error($perm_model, 'permit_file'); ?>
    </div>
</div>


<button type="submit" class="btn btn-success"><?php echo $btn_name; ?></button>
<?php if (!$perm_model->isNewRecord) { ?>
    <button type="reset" class="btn btn-default" id="cancel_permit_form">CANCEL</button>
<?php } ?>
<?php
$this->endWidget();
$user_js_format = JS_USER_DATE_FORMAT;
$js = <<< EOD
    $(function(){
        $('.datepicker').datepicker({ format: '$user_js_format' });
    });
EOD;
$cs->registerScript('_form', $js);
?>