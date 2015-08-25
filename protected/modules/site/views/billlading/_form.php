<?php
$themeUrl = $this->themeUrl;
$cs = Yii::app()->getClientScript();
$cs_pos_end = CClientScript::POS_END;

$cs->registerCssFile($themeUrl . '/css/datepicker/bootstrap-datepicker.css');
$cs->registerScriptFile($themeUrl . '/js/datepicker/bootstrap-datepicker.js', $cs_pos_end);
?>

<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'bill-lading-form',
    'htmlOptions' => array('role' => 'form', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data'),
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
    'enableAjaxValidation' => true,
        ));
$companies = Company::CompanyList();
$vendors = Vendor::VendorList();
$liners = Liner::LinerList();
?>
<div class="row">
    <div class="col-lg-12 col-xs-12">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">General Info</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-lg-6 col-xs-6">
                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'bl_company_id', array('class' => 'col-sm-3 control-label')); ?>
                            <div class="col-sm-6">
                                <?php
                                $this->widget('booster.widgets.TbSelect2', array(
                                    'model' => $model,
                                    'attribute' => 'bl_company_id',
                                    'data' => $companies,
                                    'options' => array('placeholder' => 'Select Company'),
                                    'htmlOptions' => array('class' => 'form-control'))
                                );
                                ?>
                                <?php echo $form->error($model, 'bl_company_id'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'bl_vendor_id', array('class' => 'col-sm-3 control-label')); ?>
                            <div class="col-sm-6">
                                <?php
                                $this->widget('booster.widgets.TbSelect2', array(
                                    'model' => $model,
                                    'attribute' => 'bl_vendor_id',
                                    'data' => $vendors,
                                    'options' => array('placeholder' => 'Select Vendor'),
                                    'htmlOptions' => array('class' => 'form-control'))
                                );
                                ?>
                                <?php echo $form->error($model, 'bl_vendor_id');
                                ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'bl_po_id', array('class' => 'col-sm-3 control-label')); ?>
                            <div class="col-sm-6">
                                <?php
                                $this->widget('application.components.myAutoComplete', array(
                                    'source' => 'js: function(request, response) {
                                    $.ajax({
                                        url: "' . $this->createUrl('/site/default/getPOSByClient') . '",
                                        dataType: "json",
                                        data: {
                                            term: request.term,
                                            vendor: $("#BillLading_bl_vendor_id").val(),
                                            company: $("#BillLading_bl_company_id").val()
                                        },
                                        success: function (data) {
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
                                            $("#' . CHtml::activeId($model, 'bl_po_id') . '").val(ui.item.po_id);
                                            $.ajax({
                                                url: "' . $this->createUrl('/site/default/getInvoiceByPo') . '",
                                                data: { id: ui.item.po_id },
                                                success: function (data) {
                                                   $("#BillLading_bl_invoice_id").html(data);
                                                }
                                            });
                                            return false;
                                        }',
                                        'change' =>'js: function(event,ui){
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
                                    return $( "<li></li>" )
                                        .data( "item.autocomplete", item )
                                        .append( "<a>" + item.purchase_order_code +  "</a>" )
                                        .appendTo( ul );
                                };'
                                ));

                                echo $form->hiddenField($model, 'bl_po_id', array('class' => 'form-control'));
                                ?>
                                <?php echo $form->error($model, 'bl_po_id'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'bl_invoice_id', array('class' => 'col-sm-3 control-label')); ?>
                            <div class="col-sm-6">
                                <?php
                                echo $form->dropDownList($model, 'bl_invoice_id', array(), array('class' => 'form-control',
                                    'prompt' => 'Select Invoice',
                                    'ajax' => array(
                                        'type' => 'GET',
                                        'datatType' => 'json',
                                        'url' => $this->createUrl('/site/default/getInvoiceDetail'),
                                        'data' => array('id' => 'js:this.value'),
                                        'success' => 'function(data){ data = JSON.parse(data); $("#BillLading_bl_number").val(data.bol_no); $("#BillLading_bl_container_number").html(data.containers); }',
                                )));
                                ?>
                                <?php echo $form->error($model, 'bl_invoice_id'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'bl_number', array('class' => 'col-sm-3 control-label')); ?>
                            <div class="col-sm-6">
                                <?php echo $form->textField($model, 'bl_number', array('class' => 'form-control', 'readonly' => 'readonly')); ?>
                                <?php echo $form->error($model, 'bl_number'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'bl_issue_date', array('class' => 'col-sm-3 control-label')); ?>
                            <div class="col-sm-6">
                                <?php echo $form->textField($model, 'bl_issue_date', array('class' => 'form-control datepicker')); ?>
                                <?php echo $form->error($model, 'bl_issue_date'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xs-6">
                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'bl_issue_place', array('class' => 'col-sm-3 control-label')); ?>
                            <div class="col-sm-6">
                                <?php echo $form->textField($model, 'bl_issue_place', array('class' => 'form-control', 'size' => 60, 'maxlength' => 100)); ?>
                                <?php echo $form->error($model, 'bl_issue_place'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'bl_load_port', array('class' => 'col-sm-3 control-label')); ?>
                            <div class="col-sm-6">
                                <?php echo $form->textField($model, 'bl_load_port', array('class' => 'form-control', 'size' => 60, 'maxlength' => 100)); ?>
                                <?php echo $form->error($model, 'bl_load_port'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'bl_discharge_port', array('class' => 'col-sm-3 control-label')); ?>
                            <div class="col-sm-6">
                                <?php echo $form->textField($model, 'bl_discharge_port', array('class' => 'form-control', 'size' => 60, 'maxlength' => 100)); ?>
                                <?php echo $form->error($model, 'bl_discharge_port'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'bl_vessal_name', array('class' => 'col-sm-3 control-label')); ?>
                            <div class="col-sm-6">
                                <?php echo $form->textField($model, 'bl_vessal_name', array('class' => 'form-control', 'size' => 60, 'maxlength' => 100)); ?>
                                <?php echo $form->error($model, 'bl_vessal_name'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'bl_shipped_date', array('class' => 'col-sm-3 control-label')); ?>
                            <div class="col-sm-6">
                                <?php echo $form->textField($model, 'bl_shipped_date', array('class' => 'form-control datepicker')); ?>
                                <?php echo $form->error($model, 'bl_shipped_date'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'bl_container_number', array('class' => 'col-sm-3 control-label')); ?>
                            <div class="col-sm-6">
                                <?php echo $form->dropDownList($model, 'bl_container_number', array(), array('class' => 'form-control', 'prompt' => 'Select Container')); ?>
                                <?php echo $form->error($model, 'bl_container_number'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'bl_liner_id', array('class' => 'col-sm-3 control-label')); ?>
                            <div class="col-sm-6">
                                <?php echo $form->dropDownList($model, 'bl_liner_id', $liners, array('class' => 'form-control', 'prompt' => 'Select Liner')); ?>
                                <?php echo $form->error($model, 'bl_liner_id'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 col-xs-12">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">BL Info</h3>
            </div>
            <div class="box-body">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'bl_container_count', array('class' => 'col-sm-3 control-label')); ?>
                    <div class="col-sm-6">
                        <?php echo $form->textField($model, 'bl_container_count', array('class' => 'form-control', 'readonly' => 'readonly')); ?>
                        <?php echo $form->error($model, 'bl_container_count'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($model, 'bl_free_days', array('class' => 'col-sm-3 control-label')); ?>
                    <div class="col-sm-6">
                        <?php echo $form->textField($model, 'bl_free_days', array('class' => 'form-control')); ?>
                        <?php echo $form->error($model, 'bl_free_days'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($model, 'bl_frieght_paid', array('class' => 'col-sm-3 control-label')); ?>
                    <div class="col-sm-6">
                        <?php echo $form->radioButtonList($model, 'bl_frieght_paid', array('Y' => 'Yes', 'N' => 'No'), array('class' => 'form-control', 'labelOptions' => array('style' => 'margin-right: 20px;'), 'separator' => '')); ?>
                        <?php echo $form->error($model, 'bl_frieght_paid'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 col-xs-12">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Upload Relavent Documents</h3>
            </div>
            <div class="box-body">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'bl_documents', array('class' => 'col-sm-3 control-label')); ?>
                    <div class="col-sm-6">
                        <?php echo $form->fileField($model, 'bl_documents'); ?>
                        <?php echo $form->error($model, 'bl_documents'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-6">
                    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary')); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<?php $this->endWidget(); ?>

<?php
$user_js_format = JS_USER_DATE_FORMAT;
$js = <<< EOD
$(document).ready(function(){
    $('.datepicker').datepicker({ format: '$user_js_format' });
    $('#BillLading_bl_container_number').on('change',function(){
        _ctn = $(this).find(':selected').data('ctn');
         if(!_ctn) _ctn = 0;
        $('#BillLading_bl_container_count').val(_ctn);
    });
});
EOD;
$cs->registerScript('_bill_lad_form', $js);
?>
