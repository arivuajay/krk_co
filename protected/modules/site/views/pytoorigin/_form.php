<?php
$themeUrl = $this->themeUrl;
$cs = Yii::app()->getClientScript();
$cs_pos_end = CClientScript::POS_END;

$cs->registerCssFile($themeUrl . '/css/datepick/jquery.datepick.css');
$cs->registerScriptFile($themeUrl . '/js/datepick/jquery.plugin.js', $cs_pos_end);
$cs->registerScriptFile($themeUrl . '/js/datepick/jquery.datepick.js', $cs_pos_end);

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
                    <?php // echo $form->labelEx($model, 'pyto_file', array('class' => 'col-sm-2 control-label')); ?>
                    <div class="col-sm-5">
                        <?php // echo $form->fileField($model, 'pyto_file'); ?>
                        <?php // echo $form->error($model, 'pyto_file'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'pyto_file', array('class' => 'col-sm-2 control-label')); ?>
                    <div class="col-sm-5">
                        <a href="#" id="add-new-file" class="btn btn-success">Upload Invoice</a>
                        <br />
                        <span class="help-block">Notes : Files will be uploaded after you save the Form</span>
                        <ul id="image_preview_list_1" class="image_preview_list">
                            <?php
                            if (!$model->isNewRecord && !empty($model->pyto_file)):
                                $rand = $_SESSION['pyto_rand']; 
                                foreach ($model->pyto_file as $uFile):
                                    $_SESSION['pytoorigin_files'][$rand][] = $uFile;
                                    $exp = explode('/', $uFile);
                                    $fName = $exp[2];
                                    $VName = substr($fName, 33);
                                    echo '<li class="col-sm-6 col-md-3">';
                                    echo '<div class="thumbnail tile tile-medium tile-teal">';
                                    echo '<a data-url="' . $this->createUrl("/site/pytoorigin/upload/_method/delete/file/{$fName}/upload_type/1") . '" data-type="POST" href="javascript:void(0);" class="delete_diary_image">';
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
                    <?php // echo $form->labelEx($model, 'origin_file', array('class' => 'col-sm-2 control-label')); ?>
                    <div class="col-sm-5">
                        <?php // echo $form->fileField($model, 'origin_file'); ?>
                        <?php // echo $form->error($model, 'origin_file'); ?>
                    </div>
                </div>
            
            <div class="form-group">
                <?php echo $form->labelEx($model, 'origin_file', array('class' => 'col-sm-2 control-label')); ?>
                <div class="col-sm-5">
                    <a href="#" id="add-new-file1" class="btn btn-success">Upload Invoice</a>
                    <br />
                    <span class="help-block">Notes : Files will be uploaded after you save the Form</span>
                    <ul id="image_preview_list_2" class="image_preview_list">
                        <?php
                        if (!$model->isNewRecord && !empty($model->origin_file)):
                            $rand = $_SESSION['origin_rand']; 
                            foreach ($model->origin_file as $uFile):
                                $_SESSION['pytoorigin_files'][$rand][] = $uFile;
                                $exp = explode('/', $uFile);
                                $fName = $exp[2];
                                $VName = substr($fName, 33);
                                echo '<li class="col-sm-6 col-md-3">';
                                echo '<div class="thumbnail tile tile-medium tile-teal">';
                                echo '<a data-url="' . $this->createUrl("/site/pytoorigin/upload/_method/delete/file/{$fName}/upload_type/1") . '" data-type="POST" href="javascript:void(0);" class="delete_diary_image">';
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
                    'url' => Yii::app()->createUrl("/site/pytoorigin/upload"),
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
<?php
$user_js_format = JS_USER_DATE_FORMAT;
$js = <<< EOD
$(document).ready(function(){
    $('.datepicker').datepick({dateFormat: '$user_js_format'});
});
EOD;
$cs->registerScript('_pyto_origin_form', $js);
?>