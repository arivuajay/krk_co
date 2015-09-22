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
                'htmlOptions' => array('role' => 'form', 'class' => 'form-horizontal'),
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
<?php
$cs = Yii::app()->getClientScript();
$inv_url = Yii::app()->createAbsoluteUrl('/site/default/getContainerByInvoice');
$js = <<< EOD
    $(document).ready(function () {
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
