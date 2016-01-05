<?php
/* @var $this PaymentController */
/* @var $model Payment */
/* @var $form CActiveForm */
$themeUrl = $this->themeUrl;
$cs = Yii::app()->getClientScript();
$cs_pos_end = CClientScript::POS_END;

$cs->registerCssFile($themeUrl . '/css/datepick/jquery.datepick.css');
$cs->registerScriptFile($themeUrl . '/js/datepick/jquery.plugin.js', $cs_pos_end);
$cs->registerScriptFile($themeUrl . '/js/datepick/jquery.datepick.js', $cs_pos_end);
?>

<div class="row">
    <div class="col-lg-12 col-xs-12">
        <div class="box box-primary">
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'payment-form',
                'htmlOptions' => array('role' => 'form', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data'),
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                ),
                'enableAjaxValidation' => true,
            ));
            $form->hiddenField($model, 'invoice_currency', array('value' => 'USD ($)'));
            $vendors = Vendor::VendorList();
            $payment_types = Payment::PaymentTypelist();
            ?>
            <div class="box-body">
                <div class="row">
                    <div class="col-lg-6 col-xs-6">
                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'vendor_id', array('class' => 'col-sm-3 control-label')); ?>
                            <div class="col-sm-6">
                                <?php
                                echo $form->dropDownList($model, 'vendor_id', $vendors, array('class' => 'form-control', 'prompt' => 'Select Vendor',
                                    'onchange' => '
                                $("#po_list").val("");
                                '));
                                ?>
                                <?php echo $form->error($model, 'vendor_id'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'pay_type', array('class' => 'col-sm-3 control-label')); ?>
                            <div class="col-sm-6">
                                <?php echo $form->dropDownList($model, 'pay_type', $payment_types, array('class' => 'form-control', 'prompt' => 'Select Payment Types')); ?>
                                <?php echo $form->error($model, 'pay_type'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'po_id', array('class' => 'col-sm-3 control-label')); ?>
                            <div class="col-sm-6">
                                <?php
                                $this->widget('application.components.myAutoComplete', array(
                                    'source' => 'js: function(request, response) {
                                    $("#po_list").addClass("load-input");
                                    $.ajax({
                                        url: "' . $this->createUrl('/site/default/getPOSByClient') . '",
                                        dataType: "json",
                                        data: {
                                            term: request.term,
                                            vendor: $("#Payment_vendor_id").val(),
                                            company: ""
                                        },
                                        success: function (data) {
                                            console.log($("#Payment_vendor_id").val());
                                            if(!data.length){
                                                data.push({ id: 0, label: "No data found" });
                                            }
                                            $("#po_list").removeClass("load-input");
                                            response(data);
                                        }
                                    })
                                 }',
                                    'name' => 'po_list',
                                    'options' => array(
                                        'minLength' => '0',
                                        'autoFill' => false,
                                        'focus' => 'js:function( event, ui ) {
                                $( "#po_list" ).val( ui.item.purchase_order_code );
                                return false;
                            }',
                                        'select' => 'js:function( event, ui ) {
                                            $("#' . CHtml::activeId($model, 'po_id') . '").val(ui.item.po_id);
                                            $.ajax({
                                                url: "' . $this->createUrl('/site/default/getInvoiceByPo') . '",
                                                data: { id: ui.item.po_id },
                                                success: function (data) {
                                                   $("#Payment_invoice_id").html(data);
                                                }
                                            });
                                            return false;
                                        }',
                                        'change' => 'js: function(event,ui){
                                            if (ui.item==null){
                                                $("#po_list").val("");
                                                $("#po_list").focus();
                                                }
                                            }'
                                    ),
                                    'htmlOptions' => array(
                                        'class' => 'form-control'
                                    ),
                                    'methodChain' => '.data( "autocomplete" )._renderItem = function( ul, item ) {
                            if(item.id == 0){
                                return $( "<li></li>" )
                                    .data( "item.autocomplete", item )
                                    .append( "<a>" + item.label +  "</a>" )
                                    .appendTo( ul );
                            }else{
                            return $( "<li></li>" )
                                .data( "item.autocomplete", item )
                                .append( "<a>" + item.purchase_order_code +  "</a>" )
                                .appendTo( ul );
                            }
                        };'
                                ));
                                echo $form->hiddenField($model, 'po_id');
                                ?>
                                <?php // echo $form->textField($model, 'po_id', array('class' => 'form-control')); ?>
                                <?php echo $form->error($model, 'po_id'); ?>
                            </div>

                        </div>

                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'invoice_id', array('class' => 'col-sm-3 control-label')); ?>
                            <div class="col-sm-6">
                                <?php
                                echo $form->dropDownList($model, 'invoice_id', array(), array('class' => 'form-control',
                                    'prompt' => 'Select Invoice',
                                    'ajax' => array(
                                        'type' => 'GET',
                                        'datatType' => 'json',
                                        'url' => $this->createUrl('/site/default/getInvoiceDetail'),
                                        'data' => array('id' => 'js:this.value'),
                                        'success' => 'function(data){ data = JSON.parse(data); $("#Payment_invoice_amount").val(data.total_inv_amount); }',
                                )));
                                ?>
                                <?php // echo $form->textField($model, 'invoice_id', array('class' => 'form-control')); ?>
                                <?php echo $form->error($model, 'invoice_id'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'invoice_amount', array('class' => 'col-sm-3 control-label')); ?>
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <div class="input-group-addon" id="fmt_currency">USD ($)</div>
                                    <?php echo $form->textField($model, 'invoice_amount', array('class' => 'form-control', 'size' => 10, 'maxlength' => 10, 'readonly' => true, 'style' => 'z-index: 1;')); ?>
                                </div>
                                <?php echo $form->error($model, 'invoice_amount'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'pay_amount', array('class' => 'col-sm-3 control-label')); ?>
                            <div class="col-sm-6">
                                <?php echo $form->textField($model, 'pay_amount', array('class' => 'form-control inr_calc', 'size' => 10, 'maxlength' => 10)); ?>
                                <?php echo $form->error($model, 'pay_amount'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'pay_deal_id', array('class' => 'col-sm-3 control-label')); ?>
                            <div class="col-sm-6">
                                <?php echo $form->textField($model, 'pay_deal_id', array('class' => 'form-control', 'size' => 60, 'maxlength' => 100)); ?>
                                <?php echo $form->error($model, 'pay_deal_id'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'pay_inr_rate', array('class' => 'col-sm-3 control-label')); ?>
                            <div class="col-sm-6">
                                <?php echo $form->textField($model, 'pay_inr_rate', array('class' => 'form-control inr_calc', 'size' => 10, 'maxlength' => 10)); ?>
                                <?php echo $form->error($model, 'pay_inr_rate'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'pay_date', array('class' => 'col-sm-3 control-label')); ?>
                            <div class="col-sm-6">
                                <?php echo $form->textField($model, 'pay_date', array('class' => 'form-control datepicker')); ?>
                                <?php echo $form->error($model, 'pay_date'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'pay_inr_amount', array('class' => 'col-sm-3 control-label')); ?>
                            <div class="col-sm-6">
                                <?php echo $form->textField($model, 'pay_inr_amount', array('class' => 'form-control', 'size' => 10, 'maxlength' => 10, 'readonly' => true)); ?>
                                <?php echo $form->error($model, 'pay_inr_amount'); ?>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'pay_mode', array('class' => 'col-sm-3 control-label')); ?>
                            <div class="col-sm-6">
                                <?php echo $form->textField($model, 'pay_mode', array('class' => 'form-control', 'size' => 50, 'maxlength' => 50)); ?>
                                <?php echo $form->error($model, 'pay_mode'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-xs-6">

                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'pay_ref_info', array('class' => 'col-sm-3 control-label')); ?>
                            <div class="col-sm-6">
                                <?php echo $form->textField($model, 'pay_ref_info', array('class' => 'form-control', 'size' => 60, 'maxlength' => 100)); ?>
                                <?php echo $form->error($model, 'pay_ref_info'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'pay_transaction_id', array('class' => 'col-sm-3 control-label')); ?>
                            <div class="col-sm-6">
                                <?php echo $form->textField($model, 'pay_transaction_id', array('class' => 'form-control', 'size' => 50, 'maxlength' => 50)); ?>
                                <?php echo $form->error($model, 'pay_transaction_id'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'pay_transaction_date', array('class' => 'col-sm-3 control-label')); ?>
                            <div class="col-sm-6">
                                <?php echo $form->textField($model, 'pay_transaction_date', array('class' => 'form-control datepicker')); ?>
                                <?php echo $form->error($model, 'pay_transaction_date'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'pay_bank_name', array('class' => 'col-sm-3 control-label')); ?>
                            <div class="col-sm-6">
                                <?php echo $form->textField($model, 'pay_bank_name', array('class' => 'form-control', 'size' => 50, 'maxlength' => 50)); ?>
                                <?php echo $form->error($model, 'pay_bank_name'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'pay_remarks', array('class' => 'col-sm-3 control-label')); ?>
                            <div class="col-sm-6">
                                <?php echo $form->textArea($model, 'pay_remarks', array('class' => 'form-control', 'rows' => 6, 'cols' => 50)); ?>
                                <?php echo $form->error($model, 'pay_remarks'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'pay_shift_advise', array('class' => 'col-sm-3 control-label')); ?>
                            <div class="col-sm-6">
                                <?php echo $form->fileField($model, 'pay_shift_advise'); ?>
                                <?php echo $form->error($model, 'pay_shift_advise'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'pay_debit_advise', array('class' => 'col-sm-3 control-label')); ?>
                            <div class="col-sm-6">
                                <?php echo $form->fileField($model, 'pay_debit_advise'); ?>
                                <?php echo $form->error($model, 'pay_debit_advise'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'pay_other_doc', array('class' => 'col-sm-3 control-label')); ?>
                            <div class="col-sm-6">
                                <?php echo $form->fileField($model, 'pay_other_doc'); ?>
                                <?php echo $form->error($model, 'pay_other_doc'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'pay_deal_id_copy', array('class' => 'col-sm-3 control-label')); ?>
                            <div class="col-sm-6">
                                <?php echo $form->fileField($model, 'pay_deal_id_copy'); ?>
                                <?php echo $form->error($model, 'pay_deal_id_copy'); ?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div><!-- /.box-body -->
        <div class="box-footer">
            <div class="form-group">
                <div class="col-sm-0 col-sm-offset-2">
                    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary')); ?>
                </div>
            </div>
        </div>
        <?php $this->endWidget(); ?>
    </div>
</div><!-- ./col -->
</div>

<?php
$user_js_format = JS_USER_DATE_FORMAT;
$js = <<< EOD
$(document).ready(function(){
    $('.datepicker').datepick({dateFormat: '$user_js_format'});
    $( ".inr_calc" ).keyup(function() {
        pay_amt = $("#Payment_pay_amount").val();
        inr_rate = $("#Payment_pay_inr_rate").val();
        
        inr_amt = 0;
        if($.isNumeric(pay_amt) && $.isNumeric(inr_rate)){
            inr_amt = inr_rate * pay_amt;
        }
        $("#Payment_pay_inr_amount").val(inr_amt);
    });
});
EOD;
$cs->registerScript('_payment', $js);
?>