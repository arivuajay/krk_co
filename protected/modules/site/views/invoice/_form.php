<?php
$themeUrl = $this->themeUrl;
$cs = Yii::app()->getClientScript();
$cs_pos_end = CClientScript::POS_END;

$cs->registerCssFile($themeUrl . '/css/datepick/jquery.datepick.css');
$cs->registerScriptFile($themeUrl . '/js/datepick/jquery.plugin.js', $cs_pos_end);
$cs->registerScriptFile($themeUrl . '/js/datepick/jquery.datepick.js', $cs_pos_end);
if ($model->isNewRecord)
    $posession = Yii::app()->user->getState('guid');
else
    $posession = "inv_{$model->invoice_id}";
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
        <?php $this->renderPartial('_product_form', compact('model', 'detail_model', 'posession')); ?>
    </div>
    <div class="col-lg-12 col-xs-12" id="inv_added_products">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Manage Products</h3>
            </div>
            <div class="box-body"><?php $this->renderPartial('_inv_added_products', compact('posession', 'inv_products')); ?></div>
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
                        <ul>
                            <li>Unsaved product(s) row are <span style="background-color: #f2dede; color:#a94442">&nbsp;RED&nbsp;</span> marked.</li>
                            <li>On Preview screen, Submitted or Saved Products only will display. Unsaved product(s) which are <span style="background-color: #f2dede; color:#a94442">&nbsp;RED&nbsp;</span> row(s) are not display.</li>
                        </ul>
                        <button type="button" id="save_inv" class="btn btn-success" name="save_inv">Save</button>
                        <button type="button" id="submit_inv" class="btn btn-success" name="submit_inv">Submit</button>
                        <?php
                        if ($model->isNewRecord)
                            $reset_link = array('/site/invoice/create', 'open' => 'fresh');
                        else
                            $reset_link = array('/site/invoice/update', 'id' => $model->invoice_id, 'open' => 'fresh');

                        echo CHtml::link('Reset', $reset_link, array("id" => "reset_po", "class" => "btn btn-warning"));
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
                                    "comp_id": comp_id, "vendor_id": vendor_id, "lbldate" : lbldate,"posession": "' . $posession . '"}
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
    <div class="modal-body" id="preview_box"></div>
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
    $('.datepicker').datepick({dateFormat: '$user_js_format'});
    var invForm = $('#invoice-form');
    $('#submit_inv,#save_inv').click(function(){
        $('#invoice-form input#action').val($(this).attr('name'));
        invForm.submit();
    });
});
EOD;
    $cs->registerScript('_inv_form', $js);
    ?>