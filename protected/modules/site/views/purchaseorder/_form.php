<?php
/* @var $this PurchaseorderController */
/* @var $model PurchaseOrder */
/* @var $form CActiveForm */
$themeUrl = $this->themeUrl;
$cs = Yii::app()->getClientScript();
$cs_pos_end = CClientScript::POS_END;

$cs->registerCssFile($themeUrl . '/css/datepick/jquery.datepick.css');
$cs->registerScriptFile($themeUrl . '/js/datepick/jquery.plugin.js', $cs_pos_end);
$cs->registerScriptFile($themeUrl . '/js/datepick/jquery.datepick.js', $cs_pos_end);

if ($model->isNewRecord)
    $posession = 'new';
else
    $posession = "po_{$model->po_id}";
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
    <div class="col-lg-12 col-xs-12" id="po_added_products">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Manage Products</h3>
            </div>
            <div class="box-body"><?php $this->renderPartial('_po_added_products', compact('posession', 'po_products')); ?></div>
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
                            <li>Unsaved product(s) row are <span style="background-color: #f2dede; color:#a94442">&nbsp;RED&nbsp;</span> marked.</li>
                            <li>On Preview screen, Submitted or Saved Products only will display. Unsaved product(s) which are <span style="background-color: #f2dede; color:#a94442">&nbsp;RED&nbsp;</span> row(s) are not display.</li>
                        </ul>
                        <div id="terms">
                        </div>
                        <button type="button" id="save_po" class="btn btn-success" name="save_po">Save</button>
                        <button type="button" id="submit_po" class="btn btn-success" name="submit_po">Submit</button>
                        <?php
                        if ($model->isNewRecord)
                            $reset_link = array('/site/purchaseorder/create', 'open' => 'fresh');
                        else
                            $reset_link = array('/site/purchaseorder/update', 'id' => $model->po_id, 'open' => 'fresh');

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
                                    comp_id = $("#PurchaseOrder_po_company_id").val();
                                    vendor_id = $("#PurchaseOrder_po_vendor_id").val();
                                    lbldate = $("#PurchaseOrder_po_date").val();
                                    liner_id = $("#liner_code").val();

                                    $.get("' . Yii::app()->createUrl("site/purchaseorder/preview") . '", {
                                    "comp_id": comp_id, "vendor_id": vendor_id, "lbldate" : lbldate, "liner_id" : liner_id,"posession": "' . $posession . '"}
                                    ).done(function( data ){
                                        $("#preview_box").html(data);
                                        return false;
                                   });
                                }'
                            ),
                                )
                        );
                        ?>
                    </div>
                    <div class="col-lg-6">
                        <label class="col-sm-3">Prefered Liner: </label>
                        <div class="col-sm-6">
                            <?php
                            echo CHtml::dropDownList('liner_code', $model->po_liner_id, CHtml::listData(Liner::model()->active()->findAll(), 'liner_id', 'liner_name'), array('prompt' => 'Select Liner', 'class' => 'form-control', 'onchange' => 'js:$("#PurchaseOrder_po_liner_id").val(this.value);'));
                            ?>
                        </div>
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
        $this->widget('booster.widgets.TbButton', array(
            'label' => 'Close',
            'url' => '#',
            'htmlOptions' => array('data-dismiss' => 'modal', 'id' => 'preview-dismiss'),
        ));
        ?>
    </div>
    <?php $this->endWidget(); ?>


    <?php
    $user_js_format = JS_USER_DATE_FORMAT;
    $js = <<< EOD
    $(document).ready(function(){
        $('.datepicker').datepick({dateFormat: '$user_js_format'});
        var poForm = $('#purchase-order-form');
        $('#submit_po,#save_po').click(function(){
            $('#purchase-order-form input#action').val($(this).attr('name'));
            poForm.submit();
        });
    });
EOD;
    $cs->registerScript('_po_form', $js);
    ?>