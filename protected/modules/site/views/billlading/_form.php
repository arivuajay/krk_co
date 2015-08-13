<?php
/* @var $this BillladingController */
/* @var $model BillLading */
/* @var $form CActiveForm */
?>

<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'bill-lading-form',
    'htmlOptions' => array('role' => 'form', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data'),
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
    'enableAjaxValidation' => true,
        ));
$companies = Company::CompanyList();
$vendors = Vendor::VendorList();
?>
<div class="row">
    <div class="col-lg-12 col-xs-12">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">General Info</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-lg-6 col-xs-6">
                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'bl_company_id', array('class' => 'col-sm-3 control-label')); ?>
                            <div class="col-sm-6">
                                <?php echo $form->dropDownList($model, 'bl_company_id', $companies, array('class' => 'form-control', 'prompt' => '')); ?>
                                <?php echo $form->error($model, 'bl_company_id'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'bl_vendor_id', array('class' => 'col-sm-3 control-label')); ?>
                            <div class="col-sm-6">
                                <?php echo $form->dropDownList($model, 'bl_vendor_id', $vendors, array('class' => 'form-control', 'prompt' => '')); ?>
                                <?php echo $form->error($model, 'bl_vendor_id'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'bl_po_id', array('class' => 'col-sm-3 control-label')); ?>
                            <div class="col-sm-6">
                                <?php echo $form->textField($model, 'bl_po_id', array('class' => 'form-control')); ?>
                                <?php echo $form->error($model, 'bl_po_id'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'bl_invoice_id', array('class' => 'col-sm-3 control-label')); ?>
                            <div class="col-sm-6">
                                <?php echo $form->textField($model, 'bl_invoice_id', array('class' => 'form-control')); ?>
                                <?php echo $form->error($model, 'bl_invoice_id'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'bl_number', array('class' => 'col-sm-3 control-label')); ?>
                            <div class="col-sm-6">
                                <?php echo $form->textField($model, 'bl_number', array('class' => 'form-control', 'size' => 60, 'maxlength' => 100)); ?>
                                <?php echo $form->error($model, 'bl_number'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'bl_issue_date', array('class' => 'col-sm-3 control-label')); ?>
                            <div class="col-sm-6">
                                <?php echo $form->textField($model, 'bl_issue_date', array('class' => 'form-control')); ?>
                                <?php echo $form->error($model, 'bl_issue_date'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xs-6">                
                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'bl_issue_place', array('class' => 'col-sm-3 control-label')); ?>
                            <div class="col-sm-6">
                                <?php echo $form->textField($model, 'bl_issue_place', array('class' => 'form-control', 'size' => 60, 'maxlength' => 100)); ?>
                                <?php echo $form->error($model, 'bl_issue_place'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'bl_load_port', array('class' => 'col-sm-3 control-label')); ?>
                            <div class="col-sm-6">
                                <?php echo $form->textField($model, 'bl_load_port', array('class' => 'form-control', 'size' => 60, 'maxlength' => 100)); ?>
                                <?php echo $form->error($model, 'bl_load_port'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'bl_discharge_port', array('class' => 'col-sm-3 control-label')); ?>
                            <div class="col-sm-6">
                                <?php echo $form->textField($model, 'bl_discharge_port', array('class' => 'form-control', 'size' => 60, 'maxlength' => 100)); ?>
                                <?php echo $form->error($model, 'bl_discharge_port'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'bl_vessal_name', array('class' => 'col-sm-3 control-label')); ?>
                            <div class="col-sm-6">
                                <?php echo $form->textField($model, 'bl_vessal_name', array('class' => 'form-control', 'size' => 60, 'maxlength' => 100)); ?>
                                <?php echo $form->error($model, 'bl_vessal_name'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'bl_shipped_date', array('class' => 'col-sm-3 control-label')); ?>
                            <div class="col-sm-6">
                                <?php echo $form->textField($model, 'bl_shipped_date', array('class' => 'form-control')); ?>
                                <?php echo $form->error($model, 'bl_shipped_date'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'bl_container_number', array('class' => 'col-sm-3 control-label')); ?>
                            <div class="col-sm-6">
                                <?php echo $form->textField($model, 'bl_container_number', array('class' => 'form-control', 'size' => 60, 'maxlength' => 100)); ?>
                                <?php echo $form->error($model, 'bl_container_number'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'bl_liner_id', array('class' => 'col-sm-3 control-label')); ?>
                            <div class="col-sm-6">
                                <?php echo $form->textField($model, 'bl_liner_id', array('class' => 'form-control')); ?>
                                <?php echo $form->error($model, 'bl_liner_id'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 col-xs-12">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">BL Info</h3>
            </div>
            <div class="box-body">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'bl_container_count', array('class' => 'col-sm-3 control-label')); ?>
                    <div class="col-sm-6">
                        <?php echo $form->textField($model, 'bl_container_count', array('class' => 'form-control')); ?>
                        <?php echo $form->error($model, 'bl_container_count'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($model, 'bl_free_days', array('class' => 'col-sm-3 control-label')); ?>
                    <div class="col-sm-6">
                        <?php echo $form->textField($model, 'bl_free_days', array('class' => 'form-control')); ?>
                        <?php echo $form->error($model, 'bl_free_days'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($model, 'bl_frieght_paid', array('class' => 'col-sm-3 control-label')); ?>
                    <div class="col-sm-6">
                        <?php echo $form->radioButtonList($model, 'bl_frieght_paid', array('Y'=>'Yes', 'N'=>'No'), array('class' => 'form-control', 'size' => 1, 'maxlength' => 1)); ?>
                        <?php echo $form->error($model, 'bl_frieght_paid'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 col-xs-12">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Upload Relavent Documents</h3>
            </div>
            <div class="box-body">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'bl_documents', array('class' => 'col-sm-3 control-label')); ?>
                    <div class="col-sm-6">
                        <?php echo $form->fileField($model, 'bl_documents'); ?>
                        <?php echo $form->error($model, 'bl_documents'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 col-xs-12">
        <div class="form-group">
            <div class="col-sm-0 col-sm-offset-2">
                <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary')); ?>
            </div>
        </div>
    </div>
</div>

<?php $this->endWidget(); ?>
