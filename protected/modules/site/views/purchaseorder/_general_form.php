<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'purchase-order-form',
    'htmlOptions' => array('role' => 'form', 'class' => 'form-horizontal'),
    'clientOptions' => array(
        'validateOnSubmit' => true,
        'validateOnChange' => false,
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
        <?php echo $form->labelEx($model, 'purchase_order_code', array('class' => 'col-sm-2 control-label')); ?>
        <div class="col-sm-5">
            <?php echo $form->textField($model, 'purchase_order_code', array('class' => 'form-control', 'size' => 50, 'maxlength' => 50, 'readonly' => true)); ?>
            <?php echo $form->error($model, 'purchase_order_code'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'po_date', array('class' => 'col-sm-2 control-label')); ?>
        <div class="col-sm-5">
            <?php echo $form->textField($model, 'po_date', array('class' => 'form-control datepicker')); ?>
            <?php echo $form->error($model, 'po_date'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'po_company_id', array('class' => 'col-sm-2 control-label')); ?>
        <div class="col-sm-5">
            <?php echo $form->dropDownList($model, 'po_company_id', $companies, array('class' => 'form-control', 'prompt' => 'Select Company')); ?>
            <?php echo $form->error($model, 'po_company_id'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'po_vendor_id', array('class' => 'col-sm-2 control-label')); ?>
        <div class="col-sm-5">
            <?php
            echo $form->dropDownList($model, 'po_vendor_id', $vendors, array('class' => 'form-control', 'prompt' => 'Select Vendor',
                'onchange' => '$.get("' . Yii::app()->createUrl("site/masters/terms") . '", {
                            id: this.value}
                            ).done(function( data ){
                                $("#terms").html(data);
                           });'
            ));
            if (!empty($model->po_liner_id))
                Yii::app()->clientScript->registerScript('trigger_vendor_info', "$('#PurchaseOrder_po_vendor_id').trigger('change');");
            ?>
            <?php echo $form->error($model, 'po_vendor_id'); ?>
        </div>
    </div>
    <?php echo $form->hiddenField($model, 'po_liner_id'); ?>
    <?php echo CHtml::hiddenField('action'); ?>
    <?php echo $form->error($model, 'po_liner_id'); ?>
    <div id="additioanl_data" class="hidden"></div>
</div>
<?php $this->endWidget(); ?>