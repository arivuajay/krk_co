<?php
$themeUrl = $this->themeUrl;
$cs = Yii::app()->getClientScript();
$cs_pos_end = CClientScript::POS_END;

$cs->registerCssFile($themeUrl . '/css/datepicker/bootstrap-datepicker.css');
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
        <?php $this->renderPartial('_product_form', compact('model', 'detail_model')); ?>
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
                        <?php
                        echo CHtml::link('Reset', array('/site/invoice/create', 'open' => 'fresh'), array("id" => "reset_po", "class" => "btn btn-warning"));
                        echo '&nbsp;';
                        $this->widget(
                            'booster.widgets.TbButton', array(
                            'label' => 'Preview',
                            'context' => 'info',
                            'htmlOptions' => array(
                                'id' => 'preview_po',
                                'data-toggle' => 'modal',
                                'data-target' => '#previewModal',
                                'onclick' => '{
                                    $("#preview_box").html("<div>Loading...</div>");
                                    comp_id = $("#Invoice_company_id").val();
                                    vendor_id = $("#Invoice_vendor_id").val();
                                    lbldate = $("#po_date").val();

                                    $.get("' . Yii::app()->createUrl("site/invoice/preview") . '", {
                                    "comp_id": comp_id, "vendor_id": vendor_id, "lbldate" : lbldate}
                                    ).done(function( data ){
                                        $("#preview_box").html(data);
                                   });
                                }'
                            ),
                                )
                        );

                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php $this->beginWidget('booster.widgets.TbModal', array('id' => 'previewModal')); ?>
    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h4>Preview</h4>
    </div>
    <div class="modal-body" id="preview_box">
    </div>

    <div class="modal-footer">
        <?php
        $this->widget(
                'booster.widgets.TbButton', array(
            'label' => 'Close',
            'url' => '#',
            'htmlOptions' => array('data-dismiss' => 'modal', 'id' => 'preview-dismiss'),
                )
        );
        ?>
    </div>

    <?php $this->endWidget(); ?>

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