<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'invoice-form',
    'htmlOptions' => array('role' => 'form', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data'),
    'clientOptions' => array(
        'validateOnSubmit' => true,
        'validateOnChange' => false,
    ),
    'enableAjaxValidation' => true,
        ));
$companies = Company::CompanyList();
$vendors = Vendor::VendorList();
$poStatus = PurchaseOrder::StatusList();
unset($poStatus[1]);
?>
<div class="box-header">
    <h3 class="box-title">General Info</h3>
</div>
<div class="box-body">
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <?php echo $form->labelEx($model, 'vendor_id', array('class' => 'col-sm-4 control-label')); ?>
                <div class="col-sm-6">
                    <?php echo $form->dropDownList($model, 'vendor_id', $vendors, array('class' => 'form-control', 'prompt' => 'Select Vendor','onchange'=>'$("#po_list").val(""); $("#permit_list").val("");')); ?>
                    <?php echo $form->error($model, 'vendor_id'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'po_id', array('class' => 'col-sm-4 control-label')); ?>
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
                                            vendor: $("#Invoice_vendor_id").val(),
                                            company: $("#Invoice_company_id").val()
                                        },
                                        success: function (data) {
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
                                $("#po_date").val(ui.item.po_date);
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
                    if (!empty($model->po_id))
                        Yii::app()->clientScript->registerScript('trigger_po_info', "$('#po_list').val('" . $model->po->purchase_order_code . "');");

                    echo $form->hiddenField($model, 'po_id');
                    ?>
                    <?php echo $form->error($model, 'po_id'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo CHtml::label('PO date', 'po_date', array('class' => 'col-sm-4 control-label')); ?>
                <div class="col-sm-6">
                    <?php echo CHtml::textField('po_date', '', array('class' => 'form-control', 'readonly' => 'readonly')); ?>
                </div>
            </div>


            <div class="form-group">
                <?php echo $form->labelEx($model, 'inv_no', array('class' => 'col-sm-4 control-label')); ?>
                <div class="col-sm-6">
                    <?php echo $form->textField($model, 'inv_no', array('class' => 'form-control', 'size' => 60, 'maxlength' => 100)); ?>
                    <?php echo $form->error($model, 'inv_no'); ?>
                </div>
            </div>


            <div class="form-group">
                <?php echo $form->labelEx($model, 'inv_date', array('class' => 'col-sm-4 control-label')); ?>
                <div class="col-sm-6">
                    <?php echo $form->textField($model, 'inv_date', array('class' => 'form-control datepicker')); ?>
                    <?php echo $form->error($model, 'inv_date'); ?>
                </div>
            </div>
            
            <div class="form-group">
                <?php echo $form->labelEx($model, 'company_id', array('class' => 'col-sm-4 control-label')); ?>
                <div class="col-sm-6">
                    <?php echo $form->dropDownList($model, 'company_id', $companies, array('class' => 'form-control', 'prompt' => 'Select Company')); ?>
                    <?php echo $form->error($model, 'company_id'); ?>
                </div>
            </div>
            
            <div class="form-group">
                <?php echo $form->labelEx($model, 'inv_eta_date', array('class' => 'col-sm-4 control-label')); ?>
                <div class="col-sm-6">
                    <?php echo $form->textField($model, 'inv_eta_date', array('class' => 'form-control datepicker')); ?>
                    <?php echo $form->error($model, 'inv_eta_date'); ?>
                </div>
            </div>
            
            <div class="form-group">
                <?php echo $form->labelEx($model, 'inv_onboard_date', array('class' => 'col-sm-4 control-label')); ?>
                <div class="col-sm-6">
                    <?php echo $form->textField($model, 'inv_onboard_date', array('class' => 'form-control datepicker')); ?>
                    <?php echo $form->error($model, 'inv_onboard_date'); ?>
                </div>
            </div>
        </div>
        <div class="col-lg-6">

            <div class="form-group">
                <?php echo $form->labelEx($model, 'permit_no', array('class' => 'col-sm-4 control-label')); ?>
                <div class="col-sm-6">
                    <?php
                    $this->widget('application.components.myAutoComplete', array(
                        'source' => 'js: function(request, response) {
                                    $("#permit_list").addClass("load-input");
                                    $.ajax({
                                        url: "' . $this->createUrl('/site/default/getPermitByClient') . '",
                                        dataType: "json",
                                        data: {
                                            term: request.term,
                                            vendor: $("#Invoice_vendor_id").val(),
                                            company: $("#Invoice_company_id").val()
                                        },
                                        success: function (data) {
                                            if(!data.length){
                                                data.push({ id: 0, label: "No data found" });
                                            }
                                            $("#permit_list").removeClass("load-input");
                                            response(data);
                                        }
                                    })
                                 }',
                        'name' => 'permit_list',
                        'options' => array(
                            'minLength' => '0',
                            'autoFill' => false,
                            'focus' => 'js:function( event, ui ) {
                                $( "#permit_list" ).val( ui.item.permit_no );
                                return false;
                            }',
                            'select' => 'js:function( event, ui ) {
                                $("#' . CHtml::activeId($model, 'permit_no') . '").val(ui.item.permit_no);
                                return false;
                            }',
                            'change' => 'js: function(event,ui){
                                            if (ui.item==null){
                                                $("#permit_list").val("");
                                                $("#permit_list").focus();
                                                }
                                            }'
                        ),
                        'htmlOptions' => array(
                            'class' => 'form-control'
                        ),
                        'methodChain' => '.data("autocomplete")._renderItem = function( ul, item ) {
                            if(item.id == 0){
                                return $( "<li></li>" )
                                    .data( "item.autocomplete", item )
                                    .append( "<a>" + item.label +  "</a>" )
                                    .appendTo( ul );
                            }else{
                            return $( "<li></li>" )
                                .data( "item.autocomplete", item )
                                .append( "<a>" + item.permit_no +  "</a>" )
                                .appendTo( ul );
                            }
                        };'
                    ));

                    if (!empty($model->permit_no))
                        Yii::app()->clientScript->registerScript('trigger_permit_info', "$('#permit_list').val('" . $model->permit_no . "');");

                    echo $form->hiddenField($model, 'permit_no');
                    ?>
                    <?php echo $form->error($model, 'permit_no'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'po_cur_status', array('class' => 'col-sm-4 control-label')); ?>
                <div class="col-sm-6">
                    <?php echo $form->dropDownList($model, 'po_cur_status', $poStatus, array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'po_cur_status'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'bol_no', array('class' => 'col-sm-4 control-label')); ?>
                <div class="col-sm-6">
                    <?php echo $form->textField($model, 'bol_no', array('class' => 'form-control', 'size' => 60, 'maxlength' => 100)); ?>
                    <?php echo $form->error($model, 'bol_no'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'vessel_name', array('class' => 'col-sm-4 control-label')); ?>
                <div class="col-sm-6">
                    <?php echo $form->textField($model, 'vessel_name', array('class' => 'form-control', 'size' => 60, 'maxlength' => 100)); ?>
                    <?php echo $form->error($model, 'vessel_name'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'inv_remarks', array('class' => 'col-sm-4 control-label')); ?>
                <div class="col-sm-6">
                    <?php echo $form->textArea($model, 'inv_remarks', array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'inv_remarks'); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="box-header">
    <h3 class="box-title">Upload Relevant Documents</h3>
</div>
<div class="box-body">
    <div class="form-group">
        <?php // echo $form->labelEx($model, 'inv_file', array('class' => 'col-sm-4 control-label')); ?>
        <div class="col-sm-6">
            <?php // echo $form->fileField($model, 'inv_file'); ?>
            <?php // echo $form->error($model, 'inv_file'); ?>
        </div>
    </div>
    <div class="form-group">
        <?php echo $form->labelEx($model, 'inv_file', array('class' => 'col-sm-2 control-label')); ?>
        <div class="col-sm-5">
            <a href="#" id="add-new-file" class="btn btn-success">Upload Invoice</a>
            <br />
            <span class="help-block">Notes : Files will be uploaded after you save the Form</span>
            <ul id="image_preview_list_1" class="image_preview_list">
                <?php
                if (!$model->isNewRecord && !empty($model->inv_file)):
                    $rand = $_SESSION['invoice_rand']; 
                    foreach ($model->inv_file as $uFile):
                        $_SESSION['invoice_files'][$rand][] = $uFile;
                        $exp = explode('/', $uFile);
                        $fName = $exp[2];
                        $VName = substr($fName, 33);
                        echo '<li class="col-sm-6 col-md-3">';
                        echo '<div class="thumbnail tile tile-medium tile-teal">';
                        echo '<a data-url="' . $this->createUrl("/site/invoice/upload/_method/delete/file/{$fName}/upload_type/1") . '" data-type="POST" href="javascript:void(0);" class="delete_diary_image">';
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
        <?php echo $form->labelEx($model, 'pkg_list_file', array('class' => 'col-sm-2 control-label')); ?>
        <div class="col-sm-5">
            <a href="#" id="add-new-file1" class="btn btn-success">Upload Files</a>
            <br />
            <span class="help-block">Notes : Files will be uploaded after you save the Form</span>
            <ul id="image_preview_list_2" class="image_preview_list">
                <?php
                if (!$model->isNewRecord && !empty($model->pkg_list_file)):
                    $pkg = $_SESSION['invoice_pkg']; 
                    foreach ($model->pkg_list_file as $uFile):
                        $_SESSION['invoice_files'][$pkg][] = $uFile;
                        $exp = explode('/', $uFile);
                        $fName = $exp[2];
                        $VName = substr($fName, 33);
                        echo '<li class="col-sm-6 col-md-3">';
                        echo '<div class="thumbnail tile tile-medium tile-teal">';
                        echo '<a data-url="' . $this->createUrl("/site/invoice/upload/_method/delete/file/{$fName}/upload_type/2") . '" data-type="POST" href="javascript:void(0);" class="delete_diary_image">';
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
        <?php // echo $form->labelEx($model, 'pkg_list_file', array('class' => 'col-sm-4 control-label')); ?>
        <div class="col-sm-6">
            <?php // echo $form->fileField($model, 'pkg_list_file'); ?>
            <?php // echo $form->error($model, 'pkg_list_file'); ?>
        </div>
    </div>
</div>
<div id="additioanl_data" class="hidden"></div>
<?php echo CHtml::hiddenField('action'); ?>
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
                    'url' => Yii::app()->createUrl("/site/invoice/upload"),
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
        $("#add-new-file1").bind('click',addFileDialog);
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