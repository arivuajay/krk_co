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
                            <div class="col-sm-5">
                                <a href="#" id="add-new-file" class="btn btn-success">Upload Files</a>
                                <br />
                                <span class="help-block">Notes : Files will be uploaded after you save the Form</span>
                                <ul id="image_preview_list_1" class="image_preview_list">
                                <!--<ul id="image_preview_list">-->
                                    <?php
                                    if (!$model->isNewRecord && !empty($model->pay_shift_advise)):
                                        $rand = $_SESSION['shift_advise_rand']; 
                                        foreach ($model->pay_shift_advise as $uFile):
                                            $_SESSION['payment_files'][$rand][] = $uFile;
                                            $exp = explode('/', $uFile);
                                            $fName = $exp[2];
                                            $VName = substr($fName, 33);
                                            echo '<li class="col-sm-6 col-md-6">';
                                            echo '<div class="thumbnail tile tile-medium tile-teal">';
                                            echo '<a data-url="' . $this->createUrl("/site/payment/upload/_method/delete/file/{$fName}") . '" data-type="POST" href="javascript:void(0);" class="delete_diary_image">';
                                            echo '<i class="fa fa-times-circle fa-lg overlay-icon top-right"></i>';
                                            echo '</a>';
                                            echo CHtml::image($this->createUrl("/".UPLOAD_DIR.$uFile), '', array("class" => "img-responsive"));
                                            echo "<div>$VName</div>";
                                            echo '</div>';
                                            echo '</li>';
                                        endforeach;
                                    endif;
                                    
                                    ?>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'pay_debit_advise', array('class' => 'col-sm-3 control-label')); ?>
                            <div class="col-sm-5">
                                <a href="#" id="add-new-file1" class="btn btn-success">Upload Files</a>
                                <br />
                                <span class="help-block">Notes : Files will be uploaded after you save the Form</span>
                                <ul id="image_preview_list_2" class="image_preview_list">
                                    <?php
                                    if (!$model->isNewRecord && !empty($model->pay_debit_advise)):
                                        $debit = $_SESSION['debit_advise_rand']; 
                                        foreach ($model->pay_debit_advise as $uFile):
                                            $_SESSION['payment_files'][$debit][] = $uFile;
                                            $exp = explode('/', $uFile);
                                            $fName = $exp[2];
                                            $VName = substr($fName, 33);
                                            echo '<li class="col-sm-6 col-md-6">';
                                            echo '<div class="thumbnail tile tile-medium tile-teal">';
                                            echo '<a data-url="' . $this->createUrl("/site/payment/upload/_method/delete/file/{$fName}") . '" data-type="POST" href="javascript:void(0);" class="delete_diary_image">';
                                            echo '<i class="fa fa-times-circle fa-lg overlay-icon top-right"></i>';
                                            echo '</a>';
                                            echo CHtml::image($this->createUrl("/".UPLOAD_DIR.$uFile), '', array("class" => "img-responsive"));
                                            echo "<div>$VName</div>";
                                            echo '</div>';
                                            echo '</li>';
                                        endforeach;
                                    endif;
                                    
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'pay_other_doc', array('class' => 'col-sm-3 control-label')); ?>
                            <div class="col-sm-5">
                                <a href="#" id="add-new-file2" class="btn btn-success">Upload Files</a>
                                <br />
                                <span class="help-block">Notes : Files will be uploaded after you save the Form</span>
                                <ul id="image_preview_list_3" class="image_preview_list">
                                    <?php
                                    if (!$model->isNewRecord && !empty($model->pay_other_doc)):
                                        $other = $_SESSION['other_doc_rand']; 
                                        foreach ($model->pay_other_doc as $uFile):
                                            $_SESSION['payment_files'][$other][] = $uFile;
                                            $exp = explode('/', $uFile);
                                            $fName = $exp[2];
                                            $VName = substr($fName, 33);
                                            echo '<li class="col-sm-6 col-md-6">';
                                            echo '<div class="thumbnail tile tile-medium tile-teal">';
                                            echo '<a data-url="' . $this->createUrl("/site/payment/upload/_method/delete/file/{$fName}") . '" data-type="POST" href="javascript:void(0);" class="delete_diary_image">';
                                            echo '<i class="fa fa-times-circle fa-lg overlay-icon top-right"></i>';
                                            echo '</a>';
                                            echo CHtml::image($this->createUrl("/".UPLOAD_DIR.$uFile), '', array("class" => "img-responsive"));
                                            echo "<div>$VName</div>";
                                            echo '</div>';
                                            echo '</li>';
                                        endforeach;
                                    endif;
                                    
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'pay_deal_id_copy', array('class' => 'col-sm-3 control-label')); ?>
                            <div class="col-sm-5">
                                <a href="#" id="add-new-file3" class="btn btn-success">Upload Files</a>
                                <br />
                                <span class="help-block">Notes : Files will be uploaded after you save the Form</span>
                                <ul id="image_preview_list_4" class="image_preview_list">
                                    <?php
                                    if (!$model->isNewRecord && !empty($model->pay_deal_id_copy)):
                                        $deal = $_SESSION['deal_id_copy_rand']; 
                                        foreach ($model->pay_deal_id_copy as $uFile):
                                            $_SESSION['payment_files'][$deal][] = $uFile;
                                            $exp = explode('/', $uFile);
                                            $fName = $exp[2];
                                            $VName = substr($fName, 33);
                                            echo '<li class="col-sm-6 col-md-6">';
                                            echo '<div class="thumbnail tile tile-medium tile-teal">';
                                            echo '<a data-url="' . $this->createUrl("/site/payment/upload/_method/delete/file/{$fName}") . '" data-type="POST" href="javascript:void(0);" class="delete_diary_image">';
                                            echo '<i class="fa fa-times-circle fa-lg overlay-icon top-right"></i>';
                                            echo '</a>';
                                            echo CHtml::image($this->createUrl("/".UPLOAD_DIR.$uFile), '', array("class" => "img-responsive"));
                                            echo "<div>$VName</div>";
                                            echo '</div>';
                                            echo '</li>';
                                        endforeach;
                                    endif;
                                    
                                    ?>
                                </ul>
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

<div class="modal fade" id="addNewFile" aria-hidden="true" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 id="editName" class="modal-title">Add Files</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                <?php
                Yii::import("ext.xupload.models.XUploadForm");
                $imgModel = new XUploadForm;
                $this->widget('xupload.XUpload', array(
                    'url' => Yii::app()->createUrl("/site/payment/upload"),
                    'model' => $imgModel,
                    'attribute' => 'file',
                    'multiple' => true,
                    'htmlOptions' => array('id' => 'image-form'),
                    'options' => array(
                        'maxFileSize' => '1000000000',
                    ),
                ));
                ?>
                    
                </div>
            </div>
            <div class="modal-footer">
                <div class="pull-right">
                    <button aria-hidden="true" data-dismiss="modal" class="btn btn-success" type="button">Done</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- The template to display files available for download -->
<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.templates/beta1/jquery.tmpl.js"></script>
<script id="template-on-preview" type="text/x-jQuery-tmpl">
    <li class="col-sm-12 col-md-6">
    <div class="thumbnail tile tile-medium tile-teal">
    <a class="delete_diary_image" href="javascript:void(0);" data-type="POST" data-url="${delete_url}">
    <i class="fa fa-times-circle fa-lg overlay-icon top-right"></i>
    </a>
    <img src="${thumbnail_url}" class="img-responsive" />
    <div>${img_name}</div>
    </div>
    </li>
</script>

<?php
$cs = Yii::app()->getClientScript();
$inv_url = Yii::app()->createAbsoluteUrl('/site/default/getContainerByInvoice');
$js = <<< EOD
    $(document).ready(function () {

        $("#add-new-file").bind('click',addFileDialog);
        $("#add-new-file1").bind('click',addFileDialog);
        $("#add-new-file2").bind('click',addFileDialog);
        $("#add-new-file3").bind('click',addFileDialog);
        function addFileDialog(event,ui) {
                var _target = $('#addNewFile');
                if (! _target) return false;
                
                
                _target.modal("show");
                return false;
        }
        $( "#add-new-file" ).click(function() {
            $( ".icheckbox_minimal" ).html( "<input type='hidden' name='upload_type' id='upload_type' value='1'>" );
        });
        $( "#add-new-file1" ).click(function() {
            $( ".icheckbox_minimal" ).html( "<input type='hidden' name='upload_type' id='upload_type' value='2'>" );
        });
        $( "#add-new-file2" ).click(function() {
            $( ".icheckbox_minimal" ).html( "<input type='hidden' name='upload_type' id='upload_type' value='3'>" );
        });
        $( "#add-new-file3" ).click(function() {
            $( ".icheckbox_minimal" ).html( "<input type='hidden' name='upload_type' id='upload_type' value='4'>" );
        });
        $("#template-on-preview").template("listAttendees");
        $('#image-form').bind('fileuploaddone', function (e, data) {
            var type = $(this).find('#upload_type').val();
            $.tmpl("listAttendees", data.result).appendTo("ul#image_preview_list_"+type);
        });
        
        $("a.delete_diary_image").live('click',function(){
            if(confirm("Are you sure to remove this File ?")){
                _dataType = $(this).data('type');
                _dataUrl = $(this).data('url');
                var _curImg = $(this);
                $.ajax({
                    type: _dataType,
                    url: _dataUrl
                }).done(function( msg ){
                    _dataUrl = _curImg.data('url');
                    $("button[data-url='"+_dataUrl+"']").closest("tr").remove()
                    _curImg.parents('li').remove();
                });
            }
        });
        
        $('#image-form').bind('fileuploaddestroy', function (e, data) {
            _dataURL = data.url;
            var pieces = _dataURL.split(/[\s/]+/);
            _imgURL = pieces[pieces.length-1];
            _imgURL = data.url;
            $("ul#image_preview_list li a[data-url='"+_imgURL+"']").closest("li").remove();
        });
        
        $('#Expense_exp_invoices').change(function () {
            $("#Expense_exp_containers").empty();
            $('#Expense_exp_invoices :selected').each(function (i, selected) {
                $.ajax({
                    type: 'GET',
                    url: '$inv_url',
                    data: {id: selected.value},
                    success: function (data) {
                        $("#Expense_exp_containers").append(data);
                    }
                });
            });
        })
    });
EOD;
$cs->registerScript('_form', $js);
?>

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