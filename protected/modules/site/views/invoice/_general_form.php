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
                    <?php echo $form->dropDownList($model, 'vendor_id', $vendors, array('class' => 'form-control', 'prompt' => 'Select Vendor')); ?>
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
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <?php echo $form->labelEx($model, 'company_id', array('class' => 'col-sm-4 control-label')); ?>
                <div class="col-sm-6">
                    <?php echo $form->dropDownList($model, 'company_id', $companies, array('class' => 'form-control', 'prompt' => 'Select Company')); ?>
                    <?php echo $form->error($model, 'company_id'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'permit_no', array('class' => 'col-sm-4 control-label')); ?>
                <div class="col-sm-6">
                    <?php echo $form->textField($model, 'permit_no', array('class' => 'form-control', 'size' => 60, 'maxlength' => 100)); ?>
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

        </div>
    </div>
</div>
<div class="box-header">
    <h3 class="box-title">Upload Relevant Documents</h3>
</div>
<div class="box-body">
    <div class="form-group">
        <?php echo $form->labelEx($model, 'inv_file', array('class' => 'col-sm-4 control-label')); ?>
        <div class="col-sm-6">
            <?php echo $form->fileField($model, 'inv_file'); ?>
            <?php echo $form->error($model, 'inv_file'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'pkg_list_file', array('class' => 'col-sm-4 control-label')); ?>
        <div class="col-sm-6">
            <?php echo $form->fileField($model, 'pkg_list_file'); ?>
            <?php echo $form->error($model, 'pkg_list_file'); ?>
        </div>
    </div>
</div>
<div id="additioanl_data" class="hidden"></div>
<?php echo CHtml::hiddenField('action'); ?>
<?php $this->endWidget(); ?>