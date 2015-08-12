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
<div class="row">
    <div class="col-lg-12 col-xs-12">
        <div class="box box-primary">
            <?php $this->renderPartial('_general_form', compact('model')); ?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12" id="product-form">
        <?php $this->renderPartial('_product_form', compact('detail_model')); ?>
    </div>
    <div class="col-lg-12 col-xs-12" id="po_added_products">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Manage Products</h3>
            </div>
            <div class="box-body">PO Products</div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 col-xs-12">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Other Information</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-lg-6">
                        <ul>
                            <li>Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet</li>
                            <li>Consectetur adipiscing elit Consectetur adipiscing elit Consectetur adipiscing elit</li>
                            <li>Integer molestie lorem at massa Consectetur adipiscing elit Consectetur adipiscing elit</li>
                            <li>Facilisis in pretium nisl aliquet Facilisis in pretium nisl alique</li>
                            <li>Faucibus porta lacus fringilla vel</li>
                            <li>Aenean sit amet erat nunc</li>
                            <li>Eget porttitor lorem</li>
                        </ul>
                        <button type="button" id="submit_po" class="btn btn-success">Submit</button>
                        <button type="button" id="reset_po" class="btn btn-warning">Reset</button>
                        <button type="button" id="preview_po" class="btn btn-info">Preview</button>
                    </div>
                    <div class="col-lg-6">
                        <label class="col-sm-3">Prefered Liner: </label>
                        <div class="col-sm-6">
                        <?php echo CHtml::dropDownList('liner_code', '', CHtml::listData(Liner::model()->active()->findAll(), 'liner_id', 'liner_name'),array('prompt'=>'Select Liner','class'=>'form-control','onchange'=>'js:$("#PurchaseOrder_po_liner_id").val(this.value);')); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php
    $user_js_format = JS_USER_DATE_FORMAT;
    $js = <<< EOD
    $(document).ready(function(){
        $('.datepicker').datepicker({ format: '$user_js_format' });
        var poForm = $('#purchase-order-form');
        $('#submit_po').click(function(){
            poForm.submit();
        });
        $('#reset_po').click(function(){
            poForm[0].reset();
        });
    });
EOD;
    $cs->registerScript('_po_form', $js);
    ?>



