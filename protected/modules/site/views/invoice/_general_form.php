<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'invoice-form',
    'htmlOptions' => array('role' => 'form', 'class' => 'form-horizontal'),
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
    'enableAjaxValidation' => true,
        ));
$companies = Company::CompanyList();
$vendors = Vendor::VendorList();
?>
<div class="box-header">
    <h3 class="box-title">General Info</h3>
</div>
<div class="box-body">
    <div class="form-group">
        <?php echo $form->labelEx($model, 'vendor_id', array('class' => 'col-sm-2 control-label')); ?>
        <div class="col-sm-5">
            <?php echo $form->dropDownList($model, 'vendor_id', $vendors, array('class' => 'form-control', 'prompt' => 'Select Vendor')); ?>
            <?php echo $form->error($model, 'vendor_id'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'company_id', array('class' => 'col-sm-2 control-label')); ?>
        <div class="col-sm-5">
            <?php echo $form->dropDownList($model, 'company_id', $companies, array('class' => 'form-control', 'prompt' => 'Select Company')); ?>
            <?php echo $form->error($model, 'company_id'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'po_id', array('class' => 'col-sm-2 control-label')); ?>
        <div class="col-sm-5">
            <?php echo $form->textField($model, 'po_id', array('class' => 'form-control')); ?>
            <?php echo $form->error($model, 'po_id'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'permit_no', array('class' => 'col-sm-2 control-label')); ?>
        <div class="col-sm-5">
            <?php echo $form->textField($model, 'permit_no', array('class' => 'form-control', 'size' => 60, 'maxlength' => 100)); ?>
            <?php echo $form->error($model, 'permit_no'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'bol_no', array('class' => 'col-sm-2 control-label')); ?>
        <div class="col-sm-5">
            <?php echo $form->textField($model, 'bol_no', array('class' => 'form-control', 'size' => 60, 'maxlength' => 100)); ?>
            <?php echo $form->error($model, 'bol_no'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'inv_no', array('class' => 'col-sm-2 control-label')); ?>
        <div class="col-sm-5">
            <?php echo $form->textField($model, 'inv_no', array('class' => 'form-control', 'size' => 60, 'maxlength' => 100)); ?>
            <?php echo $form->error($model, 'inv_no'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'vessel_name', array('class' => 'col-sm-2 control-label')); ?>
        <div class="col-sm-5">
            <?php echo $form->textField($model, 'vessel_name', array('class' => 'form-control', 'size' => 60, 'maxlength' => 100)); ?>
            <?php echo $form->error($model, 'vessel_name'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'inv_date', array('class' => 'col-sm-2 control-label')); ?>
        <div class="col-sm-5">
            <?php echo $form->textField($model, 'inv_date', array('class' => 'form-control')); ?>
            <?php echo $form->error($model, 'inv_date'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'inv_file', array('class' => 'col-sm-2 control-label')); ?>
        <div class="col-sm-5">
            <?php echo $form->textField($model, 'inv_file', array('class' => 'form-control', 'size' => 60, 'maxlength' => 255)); ?>
            <?php echo $form->error($model, 'inv_file'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'pkg_list_file', array('class' => 'col-sm-2 control-label')); ?>
        <div class="col-sm-5">
            <?php echo $form->textField($model, 'pkg_list_file', array('class' => 'form-control', 'size' => 60, 'maxlength' => 255)); ?>
            <?php echo $form->error($model, 'pkg_list_file'); ?>
        </div>
    </div>

</div>
<?php $this->endWidget(); ?>