<?php
/* @var $this PurchaseorderController */
/* @var $model PurchaseOrder */
/* @var $form CActiveForm */
$themeUrl = $this->themeUrl;
$cs = Yii::app()->getClientScript();
$cs_pos_end = CClientScript::POS_END;

$cs->registerCssFile($themeUrl . '/css/datepicker/datepicker3.css');
$cs->registerScriptFile($themeUrl . '/js/datepicker/bootstrap-datepicker.js', $cs_pos_end);
?>

<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'purchase-order-form',
    'htmlOptions' => array('role' => 'form', 'class' => 'form-horizontal'),
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
            <div class="box-body">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'po_number', array('class' => 'col-sm-2 control-label')); ?>
                    <div class="col-sm-5">
                        <?php echo $form->textField($model, 'po_number', array('class' => 'form-control', 'size' => 50, 'maxlength' => 50, 'readonly' => true)); ?>
                        <?php echo $form->error($model, 'po_number'); ?>
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
                        <?php echo $form->dropDownList($model, 'po_vendor_id', $vendors, array('class' => 'form-control', 'prompt' => 'Select Vendor')); ?>
                        <?php echo $form->error($model, 'po_vendor_id'); ?>
                    </div>
                </div>

            </div>
            <div class="hide" id="hidden_details">
                
            </div>
            <div class="box-footer hide">
                <div class="form-group">
                    <div class="col-sm-0 col-sm-offset-2">
                        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary')); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endWidget(); ?>
<div class="row">
    <?php echo $this->renderPartial('_details_form', array('model' => $detail_model)) ?>
</div>

<?php
$user_js_format = JS_USER_DATE_FORMAT;
$js = <<< EOD
    $(document).ready(function(){
        $('.datepicker').datepicker({ format: '$user_js_format' });
    });
    
    function AddPODetails(form, data, hasError){
        if (hasError == false) {
            alert("adad");
        }
        return false;
    }
    
EOD;
$cs->registerScript('_form', $js);
?>