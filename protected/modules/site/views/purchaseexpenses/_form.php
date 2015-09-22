<?php
/* @var $this PurchaseexpensesController */
/* @var $model PurchaseExpenses */
/* @var $form CActiveForm */
$themeUrl = $this->themeUrl;
$cs = Yii::app()->getClientScript();
$cs_pos_end = CClientScript::POS_END;
?>

<div class="box box-primary">
    <div class="box-header">
        <div class="col-lg-6">
            <h3 class="box-title">Expense Info</h3>
        </div>
        <div class="col-lg-6">
            <h3 class="box-title">PO Info</h3>
        </div>
    </div>
    <div class="box-body" >
        <div class="row">
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'purchase-expenses-form',
                'htmlOptions' => array('role' => 'form', 'class' => 'form-horizontal'),
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                ),
                'enableAjaxValidation' => true,
            ));
            ?>
            <div class="col-lg-6">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'po_id', array('class' => 'col-sm-2 control-label')); ?>
                    <div class="col-sm-8">
                        <?php
                        $this->widget('application.components.myAutoComplete', array(
                            'source' => 'js: function(request, response) {
                                    $("#po_list").addClass("load-input");
                                    $.ajax({
                                        url: "' . $this->createUrl('/site/default/getPOSByClient') . '",
                                        dataType: "json",
                                        data: {
                                            term: request.term,
                                            vendor: "",
                                            company: ""
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
                                $.ajax({
                                        url: "' . $this->createUrl('/site/default/getPODetails') . '",
                                        type: "POST",
                                        data: {
                                            po_id: ui.item.po_id,
                                        },
                                        success: function (data) {
                                            $("#po_info").html(data);
                                        }
                                    })
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
                    <?php echo $form->labelEx($model, 'pur_exp_date', array('class' => 'col-sm-2 control-label')); ?>
                    <div class="col-sm-8">
                        <?php echo $form->textField($model, 'pur_exp_date', array('class' => 'form-control datepicker')); ?>
                        <?php echo $form->error($model, 'pur_exp_date'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($model, 'pur_exp_amount', array('class' => 'col-sm-2 control-label')); ?>
                    <div class="col-sm-8">
                        <?php echo $form->textField($model, 'pur_exp_amount', array('class' => 'form-control', 'size' => 10, 'maxlength' => 10)); ?>
                        <?php echo $form->error($model, 'pur_exp_amount'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($model, 'pur_exp_remarks', array('class' => 'col-sm-2 control-label')); ?>
                    <div class="col-sm-8">
                        <?php echo $form->textArea($model, 'pur_exp_remarks', array('class' => 'form-control', 'rows' => 6, 'cols' => 50)); ?>
                        <?php echo $form->error($model, 'pur_exp_remarks'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-8 col-sm-offset-1">
                        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary')); ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-xs-6">
                <div id="po_info">
                    <?php if (!$model->isNewRecord) { ?>
                        <?php $this->renderPartial('/default/_po_details', array('model' => $model->po)); ?>
                    <?php } else { ?>
                        No View Found
                    <?php } ?>
                </div>
            </div>
            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>
<?php
$user_js_format = JS_USER_DATE_FORMAT;
$js = <<< EOD
    $(document).ready(function(){
        $('.datepicker').datepicker({ format: '$user_js_format' });
    });
EOD;
$cs->registerScript('_form', $js);
?>