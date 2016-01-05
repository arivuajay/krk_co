<?php
/* @var $this ExpenseController */
/* @var $model Expense */
/* @var $form CActiveForm */
?>

<div class="row">
    <div class="col-lg-12 col-xs-12">
        <div class="box box-primary">
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'expense-form',
                'htmlOptions' => array('role' => 'form', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data'),
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                ),
                'enableAjaxValidation' => true,
            ));
            $exp_types = ExpenseType::ExpenseTypeList();
            if ($model->isNewRecord) {
                $exp_sub_types = $invoices = $containers = array();
            } else {
                $exp_sub_types = ExpenseSubtype::ExpenseSubTypeList($model->exp_type_id);
                $invoices = CHtml::listData(Invoice::model()->findAll("bol_no = '$model->exp_bol_no'"), 'inv_no', 'inv_no');
                $containers = array();
                foreach ($model->exp_invoices as $inv) {
                    $criteria = new CDbCriteria();
                    $criteria->select = 'inv_det_ctnr_no';
                    $criteria->group = 'inv_det_ctnr_no';
                    $criteria->with = array('inv');
                    $criteria->condition = "inv.inv_no = $inv";
                    $cont_nos = InvoiceItems::model()->findAll($criteria);
                    foreach ($cont_nos as $key => $cont_no) {
                        $containers[$cont_no->inv_det_ctnr_no] = $cont_no->inv_det_ctnr_no;
                    }
                }
            }

            $bol = array();
            $criteria = new CDbCriteria();
            $criteria->select = 'bl_number';
            $criteria->group = 'bl_number';
            $bol_nos = BillLading::model()->findAll($criteria);
            foreach ($bol_nos as $key => $bol_no) {
                $bol[$bol_no->bl_number] = $bol_no->bl_number;
            }
            ?>
            <div class="box-body">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'exp_type_id', array('class' => 'col-sm-2 control-label')); ?>
                    <div class="col-sm-5">
                        <?php
                        echo $form->dropDownList($model, 'exp_type_id', $exp_types, array('class' => 'form-control', 'prompt' => 'Select Type',
                            'ajax' => array(
                                'type' => 'GET',
                                'url' => Yii::app()->createUrl('/site/default/getExpSubTypeByType'),
                                'update' => '#Expense_exp_subtype_id',
                                'data' => array('id' => 'js:this.value'))
                        ));
                        ?>
                        <?php echo $form->error($model, 'exp_type_id'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($model, 'exp_subtype_id', array('class' => 'col-sm-2 control-label')); ?>
                    <div class="col-sm-5">
                        <?php echo $form->dropDownList($model, 'exp_subtype_id', $exp_sub_types, array('class' => 'form-control', 'prompt' => 'Select Sub Type')); ?>
                        <?php echo $form->error($model, 'exp_subtype_id'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($model, 'exp_voucher', array('class' => 'col-sm-2 control-label')); ?>
                    <div class="col-sm-5">
                        <?php echo $form->textField($model, 'exp_voucher', array('class' => 'form-control', 'size' => 50, 'maxlength' => 50)); ?>
                        <?php echo $form->error($model, 'exp_voucher'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($model, 'exp_pay_mode', array('class' => 'col-sm-2 control-label')); ?>
                    <div class="col-sm-5">
                        <?php echo $form->textField($model, 'exp_pay_mode', array('class' => 'form-control', 'size' => 50, 'maxlength' => 50)); ?>
                        <?php echo $form->error($model, 'exp_pay_mode'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($model, 'exp_ref_no', array('class' => 'col-sm-2 control-label')); ?>
                    <div class="col-sm-5">
                        <?php echo $form->textField($model, 'exp_ref_no', array('class' => 'form-control', 'size' => 50, 'maxlength' => 50)); ?>
                        <?php echo $form->error($model, 'exp_ref_no'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($model, 'exp_bank_name', array('class' => 'col-sm-2 control-label')); ?>
                    <div class="col-sm-5">
                        <?php echo $form->textField($model, 'exp_bank_name', array('class' => 'form-control', 'size' => 50, 'maxlength' => 50)); ?>
                        <?php echo $form->error($model, 'exp_bank_name'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($model, 'exp_transaction_id', array('class' => 'col-sm-2 control-label')); ?>
                    <div class="col-sm-5">
                        <?php echo $form->textField($model, 'exp_transaction_id', array('class' => 'form-control', 'size' => 50, 'maxlength' => 50)); ?>
                        <?php echo $form->error($model, 'exp_transaction_id'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($model, 'exp_remarks', array('class' => 'col-sm-2 control-label')); ?>
                    <div class="col-sm-5">
                        <?php echo $form->textArea($model, 'exp_remarks', array('class' => 'form-control', 'rows' => 6, 'cols' => 50)); ?>
                        <?php echo $form->error($model, 'exp_remarks'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($model, 'exp_paid_amount', array('class' => 'col-sm-2 control-label')); ?>
                    <div class="col-sm-5">
                        <?php echo $form->textField($model, 'exp_paid_amount', array('class' => 'form-control', 'size' => 10, 'maxlength' => 10)); ?>
                        <?php echo $form->error($model, 'exp_paid_amount'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($model, 'exp_bol_no', array('class' => 'col-sm-2 control-label')); ?>
                    <div class="col-sm-5">
                        <?php
                        echo $form->dropDownList($model, 'exp_bol_no', $bol, array('class' => 'form-control', 'prompt' => 'Select BOL',
                            'ajax' => array(
                                'type' => 'GET',
                                'url' => Yii::app()->createUrl('/site/default/getInvoiceByBol'),
                                'update' => '#Expense_exp_invoices',
                                'data' => array('id' => 'js:this.value'))
                        ));
                        ?>
                        <?php echo $form->error($model, 'exp_bol_no'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($model, 'exp_invoices', array('class' => 'col-sm-2 control-label')); ?>
                    <div class="col-sm-5">
                        <?php
                        echo $form->dropDownList($model, 'exp_invoices', $invoices, array('class' => 'form-control', 'multiple' => 'multiple'));
                        ?>
                        <?php echo $form->error($model, 'exp_invoices'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($model, 'exp_containers', array('class' => 'col-sm-2 control-label')); ?>
                    <div class="col-sm-5">
                        <?php echo $form->dropDownList($model, 'exp_containers', $containers, array('class' => 'form-control', 'multiple' => 'multiple')); ?>
                        <?php echo $form->error($model, 'exp_containers'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($model, 'exp_agent_party', array('class' => 'col-sm-2 control-label')); ?>
                    <div class="col-sm-5">
                        <?php echo $form->textField($model, 'exp_agent_party', array('class' => 'form-control')); ?>
                        <?php echo $form->error($model, 'exp_agent_party'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($model, 'exp_file', array('class' => 'col-sm-2 control-label')); ?>
                    <div class="col-sm-5">
                        <a href="#" id="add-new-file" class="btn btn-success">Upload Files</a>
                        <br />
                        <span class="help-block">Notes : Files will be uploaded after you save the Form</span>
                        <ul id="image_preview_list">
                            <?php
                            if (!$model->isNewRecord && !empty($model->exp_file)):
                                $rand = $_SESSION['expense_rand']; 
                                foreach ($model->exp_file as $uFile):
                                    $_SESSION['expense_files'][$rand][] = $uFile;
                                    $exp = explode('/', $uFile);
                                    $fName = $exp[2];
                                    $VName = substr($fName, 33);
                                    echo '<li class="col-sm-6 col-md-3">';
                                    echo '<div class="thumbnail tile tile-medium tile-teal">';
                                    echo '<a data-url="' . $this->createUrl("/site/expense/upload/_method/delete/file/{$fName}") . '" data-type="POST" href="javascript:void(0);" class="delete_diary_image">';
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
                    'url' => Yii::app()->createUrl("/site/expense/upload"),
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
