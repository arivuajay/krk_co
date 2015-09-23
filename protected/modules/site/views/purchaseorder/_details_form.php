<?php
/* @var $this PurchaseOrderDetailsController */
/* @var $detail_model PurchaseOrderDetails */
/* @var $form CActiveForm */

$themeUrl = $this->themeUrl;
$cs = Yii::app()->getClientScript();
$cs_pos_end = CClientScript::POS_END;

$form = $this->beginWidget('CActiveForm', array(
    'id' => 'purchase-order-details-form', 'htmlOptions' => array('role' => 'form', 'class' => 'form-horizontal'),
    'action' => Yii::app()->createUrl('/site/purchaseorder/addProduct'),
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
                <?php echo $form->labelEx($detail_model, 'po_det_prod_fmly_id', array('class' => 'col-sm-3 control-label')); ?>
                <div class="col-sm-6">
                    <?php
                    echo $form->dropDownList($detail_model, 'po_det_prod_fmly_id', $families, array('class' => 'form-control', 'prompt' => 'Select Family',
                        'ajax' => array(
                            'type' => 'GET',
                            'url' => Yii::app()->createUrl('/site/masters/getProductbyFamily'),
                            'update' => '#PurchaseOrderDetails_po_det_product_id',
                            'data' => array('id' => 'js:this.value'))));
                    ?>
                    <?php echo $form->error($detail_model, 'po_det_prod_fmly_id'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($detail_model, 'po_det_product_id', array('class' => 'col-sm-3 control-label')); ?>
                <div class="col-sm-6">
                    <?php
                    echo $form->dropDownList($detail_model, 'po_det_product_id', array(), array('class' => 'form-control', 'prompt' => 'Select Product',
                        'ajax' => array(
                            'type' => 'GET',
                            'url' => Yii::app()->createUrl('/site/masters/getVarietybyProductId'),
                            'update' => '#PurchaseOrderDetails_po_det_variety_id',
                            'data' => array('id' => 'js:this.value'))));
                    ?>
                    <?php echo $form->error($detail_model, 'po_det_product_id'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($detail_model, 'po_det_variety_id', array('class' => 'col-sm-3 control-label')); ?>
                <div class="col-sm-6">
                    <?php echo $form->dropDownList($detail_model, 'po_det_variety_id', array(), array('class' => 'form-control', 'prompt' => 'Select Variety')); ?>
                    <?php echo $form->error($detail_model, 'po_det_variety_id'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($detail_model, 'po_det_grade', array('class' => 'col-sm-3 control-label')); ?>
                <div class="col-sm-6">
                    <?php echo $form->dropDownList($detail_model, 'po_det_grade', array(), array('class' => 'form-control', 'multiple' => 'multiple', 'size' => 4)); ?>
                    <?php echo $form->error($detail_model, 'po_det_grade'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($detail_model, 'po_det_size', array('class' => 'col-sm-3 control-label')); ?>
                <div class="col-sm-6">
                    <?php echo $form->dropDownList($detail_model, 'po_det_size', array(), array('class' => 'form-control', 'multiple' => 'multiple', 'size' => 4)); ?>
                    <?php echo $form->error($detail_model, 'po_det_size'); ?>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="col-lg-6 col-xs-6">
    <div class="box box-primary">
        <div class="box-body">
            <div class="form-group">
                <?php echo $form->labelEx($detail_model, 'po_det_net_weight', array('class' => 'col-sm-3 control-label')); ?>
                <div class="col-sm-6">
                    <?php echo $form->textField($detail_model, 'po_det_net_weight', array('class' => 'form-control', 'size' => 10, 'maxlength' => 10)); ?>
                    <?php echo $form->error($detail_model, 'po_det_net_weight'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($detail_model, 'po_det_container_qty', array('class' => 'col-sm-3 control-label')); ?>
                <div class="col-sm-6">
                    <?php echo $form->textField($detail_model, 'po_det_container_qty', array('class' => 'form-control', 'size' => 10, 'maxlength' => 10)); ?>
                    <?php echo $form->error($detail_model, 'po_det_container_qty'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($detail_model, 'po_det_cotton_qty', array('class' => 'col-sm-3 control-label')); ?>
                <div class="col-sm-6">
                    <?php echo $form->textField($detail_model, 'po_det_cotton_qty', array('class' => 'form-control', 'size' => 10, 'maxlength' => 10)); ?>
                    <?php echo $form->error($detail_model, 'po_det_cotton_qty'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($detail_model, 'po_det_currency', array('class' => 'col-sm-3 control-label')); ?>
                <div class="col-sm-6">
                    <?php echo $form->dropDownList($detail_model, 'po_det_currency', array('R' => 'INR (INR)', 'D' => 'Dollar ($)'), array('class' => 'form-control')); ?>
                    <?php echo $form->error($detail_model, 'po_det_currency'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($detail_model, 'po_det_price', array('class' => 'col-sm-3 control-label')); ?>
                <div class="col-sm-6">
                    <?php echo $form->textField($detail_model, 'po_det_price', array('class' => 'form-control', 'size' => 10, 'maxlength' => 10)); ?>
                    <?php echo $form->error($detail_model, 'po_det_price'); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-0 col-sm-offset-1">
                    <?php echo CHtml::submitButton('ADD', array('class' => $detail_model->isNewRecord ? 'btn btn-success' : 'btn btn-primary')); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endWidget(); ?>
<?php
$grade_url = Yii::app()->createUrl('/site/masters/getGradeByProduct');
$size_url = Yii::app()->createUrl('/site/masters/getSizeByProduct');

$js = <<< EOD
    $(document).ready(function(){
        $('body').on('change','#PurchaseOrderDetails_po_det_product_id',function(){
            $.ajax({
                'type':'GET','url':'$grade_url','data':{'id':this.value},'cache':false,
                'success':function(html){
                    $("#PurchaseOrderDetails_po_det_grade").html(html);
                }
            });
            $.ajax({
                'type':'GET','url':'$size_url','data':{'id':this.value},'cache':false,
                'success':function(html){
                    $("#PurchaseOrderDetails_po_det_size").html(html);
                }
            });
            return false;
        });
    });

    function AddPODetails(f, d, e){
        if (e == false) {
            var settings=$(f).data("settings");
            var attributes=settings.attributes;
            $.each(attributes,function(index,item){
                console.log(item);
                console.log(item.value);
            });
        }
        return false;
    }
EOD;
$cs->registerScript('_po_product_form', $js);
?>

