<?php
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
    <div class="col-lg-12 col-xs-12" id="inv_added_products">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Manage Products</h3>
            </div>
            <div class="box-body">Invoice Products</div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 col-xs-12">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Submit Invoice</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-lg-6">
                        <button type="button" id="submit_po" class="btn btn-success">Submit</button>
                        <button type="button" id="reset_po" class="btn btn-warning">Reset</button>
                        <button type="button" id="preview_po" class="btn btn-info">Preview</button>
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
    var invForm = $('#invoice-form');
    $('#submit_po').click(function(){
        invForm.submit();
    });
    $('#reset_po').click(function(){
        invForm[0].reset();
    });
});
EOD;
$cs->registerScript('_inv_form', $js);
?>