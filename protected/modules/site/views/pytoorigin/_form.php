<?php
$themeUrl = $this->themeUrl;
$cs = Yii::app()->getClientScript();
$cs_pos_end = CClientScript::POS_END;

$cs->registerCssFile($themeUrl . '/css/datepicker/bootstrap-datepicker.css');
$cs->registerScriptFile($themeUrl . '/js/datepicker/bootstrap-datepicker.js', $cs_pos_end);

$companies = Company::CompanyList();
$vendors = Vendor::VendorList();
?>

<div class="row">
    <div class="col-lg-12 col-xs-12">
        <div class="box box-primary">
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'pyto-origin-form',
                'htmlOptions' => array('role' => 'form', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data'),
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                ),
                'enableAjaxValidation' => true,
            ));
            ?>
            <div class="box-header">
                <h3 class="box-title">Pytosanitary Certificate</h3>
            </div>
            <div class="box-body">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'pyto_company_id', array('class' => 'col-sm-2 control-label')); ?>
                    <div class="col-sm-5">
                        <?php
                        $this->widget('booster.widgets.TbSelect2', array(
                            'model' => $model,
                            'attribute' => 'pyto_company_id',
                            'data' => $companies,
                            'options' => array('placeholder' => 'Select Company'),
                            'htmlOptions' => array('class' => 'form-control'))
                        );
//                        echo $form->dropDownList($model, 'pyto_company_id',$companies, array('class' => 'form-control'));
                        ?>
                        <?php echo $form->error($model, 'pyto_company_id'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($model, 'pyto_vendor_id', array('class' => 'col-sm-2 control-label')); ?>
                    <div class="col-sm-5">
                        <?php
                        $this->widget('booster.widgets.TbSelect2', array(
                            'model' => $model,
                            'attribute' => 'pyto_vendor_id',
                            'data' => $vendors,
                            'options' => array('placeholder' => 'Select Vendor'),
                            'htmlOptions' => array('class' => 'form-control'))
                        );
//                        echo $form->dropDownList($model, 'pyto_vendor_id',$vendors, array('class' => 'form-control'));
                        ?>
                        <?php echo $form->error($model, 'pyto_vendor_id'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($model, 'pyto_po_id', array('class' => 'col-sm-2 control-label')); ?>
                    <div class="col-sm-5">
                        <?php
                        $this->widget('application.components.myAutoComplete', array(
                            'source' => 'js: function(request, response) {
                                    $.ajax({
                                        url: "' . $this->createUrl('/site/default/getPOSByClient') . '",
                                        dataType: "json",
                                        data: {
                                            term: request.term,
                                            vendor: $("#PytoOrigin_pyto_vendor_id").val(),
                                            company: $("#PytoOrigin_pyto_company_id").val()
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
                                        $("#' . CHtml::activeId($model, 'pyto_po_id') . '").val(ui.item.po_id);
                                        $.ajax({
                                            url: "' . $this->createUrl('/site/default/getInvoiceByPo') . '",
                                            data: { id: ui.item.po_id },
                                            success: function (data) {
                                               $("#PytoOrigin_pyto_invoice_id").html(data);
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


                        echo $form->hiddenField($model, 'pyto_po_id', array('class' => 'form-control'));
                        ?>
                        <?php echo $form->error($model, 'pyto_po_id'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($model, 'pyto_invoice_id', array('class' => 'col-sm-2 control-label')); ?>
                    <div class="col-sm-5">
                        <?php echo $form->dropDownList($model, 'pyto_invoice_id', array(), array('class' => 'form-control','prompt' => 'Select Invoice')); ?>
                        <?php echo $form->error($model, 'pyto_invoice_id'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($model, 'pyto_cert_no', array('class' => 'col-sm-2 control-label')); ?>
                    <div class="col-sm-5">
                        <?php echo $form->textField($model, 'pyto_cert_no', array('class' => 'form-control', 'size' => 60, 'maxlength' => 150)); ?>
                        <?php echo $form->error($model, 'pyto_cert_no'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($model, 'doinspection', array('class' => 'col-sm-2 control-label')); ?>
                    <div class="col-sm-5">
                        <?php echo $form->textField($model, 'doinspection', array('class' => 'form-control datepicker')); ?>
                        <?php echo $form->error($model, 'doinspection'); ?>
                    </div>
                </div>
            </div>

            <div class="box-header">
                <h3 class="box-title">Certificate of Origin</h3>
            </div>
            <div class="box-body">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'origin_cert_no', array('class' => 'col-sm-2 control-label')); ?>
                    <div class="col-sm-5">
                        <?php echo $form->textField($model, 'origin_cert_no', array('class' => 'form-control', 'size' => 60, 'maxlength' => 150)); ?>
                        <?php echo $form->error($model, 'origin_cert_no'); ?>
                    </div>
                </div>
            </div>

            <div class="box-header">
                <h3 class="box-title">Upload Relavent Documents</h3>
            </div>
            <div class="box-body">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'pyto_file', array('class' => 'col-sm-2 control-label')); ?>
                    <div class="col-sm-5">
                        <?php echo $form->fileField($model, 'pyto_file'); ?>
                        <?php echo $form->error($model, 'pyto_file'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($model, 'origin_file', array('class' => 'col-sm-2 control-label')); ?>
                    <div class="col-sm-5">
                        <?php echo $form->fileField($model, 'origin_file'); ?>
                        <?php echo $form->error($model, 'origin_file'); ?>
                    </div>
                </div>
            </div>


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
    $('.datepicker').datepicker({ format: '$user_js_format' });
});
EOD;
$cs->registerScript('_pyto_origin_form', $js);
?>