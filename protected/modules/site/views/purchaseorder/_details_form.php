<?php
/* @var $this PurchaseOrderDetailsController */
/* @var $model PurchaseOrderDetails */
/* @var $form CActiveForm */

$form = $this->beginWidget('CActiveForm', array(
    'id' => 'purchase-order-details-form', 'htmlOptions' => array('role' => 'form', 'class' => 'form-horizontal'),
    'clientOptions' => array(
        'validateOnSubmit' => true,
        'afterValidate' => 'js:AddPODetails'
    ),
    'enableAjaxValidation' => true,
        ));
$families = ProductFamily::ProductFamilyList();
$products = Product::ProductList();
?>
<div class="col-lg-6 col-xs-6">
    <div class="box box-primary">
        <div class="box-body">

            <div class="form-group">
                <?php echo $form->labelEx($model, 'po_det_prod_fmly_id', array('class' => 'col-sm-3 control-label')); ?>
                <div class="col-sm-6">
                    <?php
                    echo $form->dropDownList($model, 'po_det_prod_fmly_id', $families, array('class' => 'form-control', 'prompt' => '',
                        'ajax' => array(
                            'type' => 'GET',
                            'url' => Yii::app()->createUrl('/site/masters/getProductbyFamily'), //or $this->createUrl('loadcities') if '$this' extends CController
                            'update' => '#PurchaseOrderDetails_po_det_product_id',
                            'data' => array('id' => 'js:this.value'))));
                    ?>
                    <?php echo $form->error($model, 'po_det_prod_fmly_id'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'po_det_product_id', array('class' => 'col-sm-3 control-label')); ?>
                <div class="col-sm-6">
                    <?php echo $form->dropDownList($model, 'po_det_product_id', $products, array('class' => 'form-control', 'prompt' => '')); ?>
                    <?php echo $form->error($model, 'po_det_product_id'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'po_det_variety_id', array('class' => 'col-sm-3 control-label')); ?>
                <div class="col-sm-6">
                    <?php echo $form->textField($model, 'po_det_variety_id', array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'po_det_variety_id'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'po_det_grade', array('class' => 'col-sm-3 control-label')); ?>
                <div class="col-sm-6">
                    <?php echo $form->textField($model, 'po_det_grade', array('class' => 'form-control', 'size' => 60, 'maxlength' => 500)); ?>
                    <?php echo $form->error($model, 'po_det_grade'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'po_det_size', array('class' => 'col-sm-3 control-label')); ?>
                <div class="col-sm-6">
                    <?php echo $form->textField($model, 'po_det_size', array('class' => 'form-control', 'size' => 60, 'maxlength' => 500)); ?>
                    <?php echo $form->error($model, 'po_det_size'); ?>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="col-lg-6 col-xs-6">
    <div class="box box-primary">
        <div class="box-body">

            <div class="form-group">
                <?php echo $form->labelEx($model, 'po_det_net_weight', array('class' => 'col-sm-3 control-label')); ?>
                <div class="col-sm-6">
                    <?php echo $form->textField($model, 'po_det_net_weight', array('class' => 'form-control', 'size' => 10, 'maxlength' => 10)); ?>
                    <?php echo $form->error($model, 'po_det_net_weight'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'po_det_container_qty', array('class' => 'col-sm-3 control-label')); ?>
                <div class="col-sm-6">
                    <?php echo $form->textField($model, 'po_det_container_qty', array('class' => 'form-control', 'size' => 10, 'maxlength' => 10)); ?>
                    <?php echo $form->error($model, 'po_det_container_qty'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'po_det_cotton_qty', array('class' => 'col-sm-3 control-label')); ?>
                <div class="col-sm-6">
                    <?php echo $form->textField($model, 'po_det_cotton_qty', array('class' => 'form-control', 'size' => 10, 'maxlength' => 10)); ?>
                    <?php echo $form->error($model, 'po_det_cotton_qty'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'po_det_currency', array('class' => 'col-sm-3 control-label')); ?>
                <div class="col-sm-6">
                    <?php echo $form->dropDownList($model, 'po_det_currency', array('R' => 'INR (INR)', 'D' => 'Dollar ($)'), array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'po_det_currency'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'po_det_price', array('class' => 'col-sm-3 control-label')); ?>
                <div class="col-sm-6">
                    <?php echo $form->textField($model, 'po_det_price', array('class' => 'form-control', 'size' => 10, 'maxlength' => 10)); ?>
                    <?php echo $form->error($model, 'po_det_price'); ?>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="col-lg-12 col-xs-12">
    <div class="form-group">
        <div class="col-sm-0 col-sm-offset-1">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary')); ?>
        </div>
    </div>
</div>
<?php $this->endWidget(); ?>
  