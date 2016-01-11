<?php
$themeUrl = $this->themeUrl;
$cs = Yii::app()->getClientScript();
$cs_pos_end = CClientScript::POS_END;

$cs->registerCssFile($themeUrl . '/css/datepick/jquery.datepick.css');
$cs->registerScriptFile($themeUrl . '/js/datepick/jquery.plugin.js', $cs_pos_end);
$cs->registerScriptFile($themeUrl . '/js/datepick/jquery.datepick.js', $cs_pos_end);
?>

<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'bill-lading-form',
    'htmlOptions' => array('role' => 'form', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data'),
    'clientOptions' => array(
        'validateOnSubmit' => true,
        'validateOnChange' => false,
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
                                $po = '';
                                if (!$model->isNewRecord) {
                                    $po = $model->blPo->purchase_order_code;
                                }
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
                                                data = data.replace("<option value=\'\'>Select Invoice</option>","");
                                                   $("#select-from, #BillLading_bl_invoice_id").html(data);
                                                   $("#select-to").html("");
//                                                   $("#BillLading_bl_invoice_id").html(data);
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
                                    'value' => $po,
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
                            <div class="col-sm-9">
                                <?php echo $form->labelEx($model, 'bl_invoice_id', array('class' => '')); ?>
                                <div class="row">
                                    <?php
//                                echo $form->dropDownList($model, 'bl_invoice_id', array(), array('class' => 'form-control',
//                                    'prompt' => 'Select Invoice',
//                                    'ajax' => array(
//                                        'type' => 'GET',
//                                        'datatType' => 'json',
//                                        'url' => $this->createUrl('/site/default/getInvoiceDetail'),
//                                        'data' => array('id' => 'js:this.value'),
//                                        'success' => 'function(data){ data = JSON.parse(data); $("#BillLading_bl_number").val(data.bol_no); $("#bl_info #container_list").html(data.containers); $("#BillLading_bl_container_count").val(data.tot_qty); }',
//                                )));
                                    ?>
                                    <?php
                                    $selected_options = $invoices = array();
                                    if ($selected_options && is_array($selected_options)) {
                                        $selected_keys = array_flip(array_keys($selected_options));
                                        $remain_invoices = array_diff_key($invoices, $selected_keys);
                                        $selected_invoices = array_intersect_key($invoices, $selected_keys);
                                    } else {
                                        $remain_invoices = $invoices;
                                        $selected_invoices = array();
                                    }

                                    echo '<div class="col-sm-5">';
                                    echo CHtml::dropDownList('Invoice_Source', array(), $remain_invoices, array('class' => 'form-control', 'multiple' => true, 'id' => 'select-from', 'size' => 7));
                                    echo '</div><div class="col-sm-2 mt30"><button type="button" id="btn-add-select" class="btn btn-default btn-sm">>></button><br />';
                                    echo '<br /><button type="button" id="btn-remove-select" class="btn btn-default btn-sm"><<</button></div><div class="col-sm-5">';
                                    echo CHtml::dropDownList('Invoice_Destination', array(), $selected_invoices, array('class' => 'form-control', 'multiple' => true, 'id' => 'select-to', 'size' => 7));
                                    echo $form->dropDownList($model, 'bl_invoice_id', $invoices, array('class' => 'hide', 'multiple' => true, 'options' => $selected_options, 'size' => 7));
                                    echo '</div>';
                                    ?>
                                    <?php echo $form->error($model, 'bl_invoice_id'); ?>
                                </div>
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
                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'bl_issue_place', array('class' => 'col-sm-3 control-label')); ?>
                            <div class="col-sm-6">
                                <?php echo $form->textField($model, 'bl_issue_place', array('class' => 'form-control', 'size' => 60, 'maxlength' => 100)); ?>
                                <?php echo $form->error($model, 'bl_issue_place'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xs-6">
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
                            <?php echo $form->labelEx($model, 'bl_liner_id', array('class' => 'col-sm-3 control-label')); ?>
                            <div class="col-sm-6">
                                <?php
                                echo $form->dropDownList($model, 'bl_liner_id', $liners, array('class' => 'form-control', 'prompt' => 'Select Liner',
                                    'ajax' => array(
                                        'type' => 'GET',
                                        'url' => Yii::app()->createUrl('/site/default/getLinerInfo'),
                                        'success' => 'function(data){ data = JSON.parse(data); $("#def_liner_days").html("Max. Days : "+data.no_of_free_days); }',
                                        'data' => array('id' => 'js:this.value'))));
                                ?>
                                <?php echo $form->error($model, 'bl_liner_id'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'bl_remarks', array('class' => 'col-sm-3 control-label')); ?>
                            <div class="col-sm-6">
                                <?php echo $form->textArea($model, 'bl_remarks', array('class' => 'form-control')); ?>
                                <?php echo $form->error($model, 'bl_remarks'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="row" id="bl_info">
    <div class="col-lg-12 col-xs-12">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">BL Info</h3>
            </div>
            <div class="box-body">
                <div class="form-group">
                    <?php echo CHtml::label('&nbsp;', '', array('class' => 'col-sm-3')); ?>
                    <div class="col-sm-6" id="container_list"></div>
                </div>

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
                        <div class="input-group">
                            <div class="input-group-addon" id="def_liner_days"></div>
                            <?php echo $form->textField($model, 'bl_free_days', array('class' => 'form-control', 'maxlength' => 15, 'size' => 15)); ?>
                        </div>
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
                    <?php // echo $form->labelEx($model, 'bl_documents', array('class' => 'col-sm-3 control-label')); ?>
                    <div class="col-sm-6">
                        <?php // echo $form->fileField($model, 'bl_documents'); ?>
                        <?php // echo $form->error($model, 'bl_documents'); ?>
                    </div>
                </div>
                
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'bl_documents', array('class' => 'col-sm-2 control-label')); ?>
                    <div class="col-sm-5">
                        <a href="#" id="add-new-file" class="btn btn-success">Upload Files</a>
                        <br />
                        <span class="help-block">Notes : Files will be uploaded after you save the Form</span>
                        <ul id="image_preview_list">
                            <?php
                            if (!$model->isNewRecord && !empty($model->bl_documents)):
                                $rand = $_SESSION['billlading_rand']; 
                                foreach ($model->bl_documents as $uFile):
                                    $_SESSION['billlading_files'][$rand][] = $uFile;
                                    $exp = explode('/', $uFile);
                                    $fName = $exp[2];
                                    $VName = substr($fName, 33);
                                    echo '<li class="col-sm-6 col-md-3">';
                                    echo '<div class="thumbnail tile tile-medium tile-teal">';
                                    echo '<a data-url="' . $this->createUrl("/site/billlading/upload/_method/delete/file/{$fName}") . '" data-type="POST" href="javascript:void(0);" class="delete_diary_image">';
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
                    <div class="col-sm-6">
                        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary')); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->endWidget(); ?>

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
                    'url' => Yii::app()->createUrl("/site/billlading/upload"),
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
    <li class="col-sm-6 col-md-3">
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
        
        function addFileDialog(event,ui) {
                var _target = $('#addNewFile');
                if (! _target) return false;

                _target.modal("show");
                return false;
        }
        
        $("#template-on-preview").template("listAttendees");
        $('#image-form').bind('fileuploaddone', function (e, data) {
            $.tmpl("listAttendees", data.result).appendTo("ul#image_preview_list");
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
$new = $model->isNewRecord ? 'true' : 'false';
$get_inv_url = Yii::app()->createUrl('/site/default/getInvoiceByPo');
$get_inv_det_url = Yii::app()->createUrl('/site/default/getInvoiceDetail');
$po_html_id = CHtml::activeId($model, 'bl_po_id');
$inv_html_id = CHtml::activeId($model, 'bl_invoice_id');

$js = <<< EOD
$(document).ready(function(){
    var is_new = '$new';
    
    if(is_new == 'false'){
        $.ajax({
            url: "$get_inv_url",
            data: { id: '{$model->bl_po_id}' },
            success: function (data) {
                data = data.replace("<option value=\'\'>Select Invoice</option>","");
                $("#select-from, #BillLading_bl_invoice_id").html(data);
                $("#select-to").html("");
//               $("#$inv_html_id").html(data);
//               $("#$inv_html_id").val($model->bl_invoice_id);
            }
        });
    }
    $('.datepicker').datepick({dateFormat: '$user_js_format'});
                    
    $('#btn-add-select').click(function(){
        $('#select-from option:selected').each( function() {
            $('#select-to').append("<option value='"+$(this).val()+"'>"+$(this).text()+"</option>");
            $('#BillLading_bl_invoice_id option[value="'+$(this).val()+'"]').attr('selected','selected');
            $(this).remove();
            
            updateInvDetails($(this).val());
        });
        return false;
    });
    $('#btn-remove-select').click(function(){
        $('#select-to option:selected').each( function() {
            $('#select-from').append("<option value='"+$(this).val()+"'>"+$(this).text()+"</option>");
            $('#BillLading_bl_invoice_id option[value="'+$(this).val()+'"]').removeAttr('selected','selected');
            $(this).remove();
        });
                    
        $("#bl_info #container_list").html(''); 
        $("#BillLading_bl_container_count").val(0);
        $('#select-to option').each( function() {
            updateInvDetails($(this).val());
        });
        return false;
    });
    
    function updateInvDetails(inv_id){
        $.ajax({
            url: "$get_inv_det_url",
            data: { id: inv_id },
            success: function (data) {
                data = JSON.parse(data); 
                $("#BillLading_bl_number").val(data.bol_no); 
                $("#bl_info #container_list").append('<br />'+data.containers);
                old_val = $("#BillLading_bl_container_count").val();
                if(old_val == ''){
                    old_val = 0;
                }
                tot = parseFloat(old_val) + parseFloat(data.tot_qty); 
                $("#BillLading_bl_container_count").val(tot); 
            }
        });
    }
});
EOD;
$cs->registerScript('_bill_lad_form', $js);
?>
