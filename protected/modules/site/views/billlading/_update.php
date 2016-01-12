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
                                                   $("#BillLading_bl_invoice_id").html(data);
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
                                        'success' => 'function(data){ data = JSON.parse(data); $("#BillLading_bl_number").val(data.bol_no); $("#bl_info #container_list").html(data.containers); $("#BillLading_bl_container_count").val(data.tot_qty); }',
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
                                    echo CHtml::image($this->createUrl("/" . UPLOAD_DIR . $uFile), '', array("class" => "img-responsive"));
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
$user_js_format = JS_USER_DATE_FORMAT;
$new = $model->isNewRecord;
$get_inv_url = Yii::app()->createUrl('/site/default/getInvoiceByPo');
$po_html_id = CHtml::activeId($model, 'bl_po_id');
$inv_html_id = CHtml::activeId($model, 'bl_invoice_id');

$js = <<< EOD
$(document).ready(function(){
    var is_new = '$new';
    
    if(!is_new){
        $.ajax({
            url: "$get_inv_url",
            data: { id: {$model->bl_po_id} },
            success: function (data) {
               $("#$inv_html_id").html(data);
               $("#$inv_html_id").val($model->bl_invoice_id);
            }
        });
    }
    $('.datepicker').datepicker({ format: '$user_js_format' });
                    
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
});
EOD;
$cs->registerScript('_bill_lad_form', $js);
?>
