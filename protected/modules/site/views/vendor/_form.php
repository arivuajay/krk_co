<?php
/* @var $this VendorController */
/* @var $model Vendor */
/* @var $form CActiveForm */
?>

<div class="row">
    <div class="col-lg-12 col-xs-12">
        <div class="box box-primary">
            <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'vendor-form',
        'htmlOptions' => array('role' => 'form', 'class' => 'form-horizontal'),
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
        ),
	'enableAjaxValidation'=>true,
)); ?>
            <div class="box-body">
                                    <div class="form-group">
                        <?php echo $form->labelEx($model,'vendor_type_id',  array('class' => 'col-sm-2 control-label')); ?>
                        <div class="col-sm-5">
                        <?php echo $form->textField($model,'vendor_type_id',array('class'=>'form-control')); ?>
                        <?php echo $form->error($model,'vendor_type_id'); ?>
                        </div>
                    </div>

                                        <div class="form-group">
                        <?php echo $form->labelEx($model,'vendor_name',  array('class' => 'col-sm-2 control-label')); ?>
                        <div class="col-sm-5">
                        <?php echo $form->textField($model,'vendor_name',array('class'=>'form-control','size'=>50,'maxlength'=>50)); ?>
                        <?php echo $form->error($model,'vendor_name'); ?>
                        </div>
                    </div>

                                        <div class="form-group">
                        <?php echo $form->labelEx($model,'vendor_address',  array('class' => 'col-sm-2 control-label')); ?>
                        <div class="col-sm-5">
                        <?php echo $form->textArea($model,'vendor_address',array('class'=>'form-control','rows'=>6, 'cols'=>50)); ?>
                        <?php echo $form->error($model,'vendor_address'); ?>
                        </div>
                    </div>

                                        <div class="form-group">
                        <?php echo $form->labelEx($model,'vendor_city',  array('class' => 'col-sm-2 control-label')); ?>
                        <div class="col-sm-5">
                        <?php echo $form->textField($model,'vendor_city',array('class'=>'form-control','size'=>60,'maxlength'=>255)); ?>
                        <?php echo $form->error($model,'vendor_city'); ?>
                        </div>
                    </div>

                                        <div class="form-group">
                        <?php echo $form->labelEx($model,'vendor_country',  array('class' => 'col-sm-2 control-label')); ?>
                        <div class="col-sm-5">
                        <?php echo $form->textField($model,'vendor_country',array('class'=>'form-control','size'=>60,'maxlength'=>255)); ?>
                        <?php echo $form->error($model,'vendor_country'); ?>
                        </div>
                    </div>

                                        <div class="form-group">
                        <?php echo $form->labelEx($model,'vendor_contact_person',  array('class' => 'col-sm-2 control-label')); ?>
                        <div class="col-sm-5">
                        <?php echo $form->textField($model,'vendor_contact_person',array('class'=>'form-control','size'=>60,'maxlength'=>255)); ?>
                        <?php echo $form->error($model,'vendor_contact_person'); ?>
                        </div>
                    </div>

                                        <div class="form-group">
                        <?php echo $form->labelEx($model,'vendor_mobile_no',  array('class' => 'col-sm-2 control-label')); ?>
                        <div class="col-sm-5">
                        <?php echo $form->textField($model,'vendor_mobile_no',array('class'=>'form-control','size'=>60,'maxlength'=>100)); ?>
                        <?php echo $form->error($model,'vendor_mobile_no'); ?>
                        </div>
                    </div>

                                        <div class="form-group">
                        <?php echo $form->labelEx($model,'vendor_office_no',  array('class' => 'col-sm-2 control-label')); ?>
                        <div class="col-sm-5">
                        <?php echo $form->textField($model,'vendor_office_no',array('class'=>'form-control','size'=>60,'maxlength'=>100)); ?>
                        <?php echo $form->error($model,'vendor_office_no'); ?>
                        </div>
                    </div>

                                        <div class="form-group">
                        <?php echo $form->labelEx($model,'vendor_email',  array('class' => 'col-sm-2 control-label')); ?>
                        <div class="col-sm-5">
                        <?php echo $form->textField($model,'vendor_email',array('class'=>'form-control','size'=>60,'maxlength'=>255)); ?>
                        <?php echo $form->error($model,'vendor_email'); ?>
                        </div>
                    </div>

                                        <div class="form-group">
                        <?php echo $form->labelEx($model,'vendor_website',  array('class' => 'col-sm-2 control-label')); ?>
                        <div class="col-sm-5">
                        <?php echo $form->textField($model,'vendor_website',array('class'=>'form-control','size'=>60,'maxlength'=>255)); ?>
                        <?php echo $form->error($model,'vendor_website'); ?>
                        </div>
                    </div>

                                        <div class="form-group">
                        <?php echo $form->labelEx($model,'vendor_trade_mark',  array('class' => 'col-sm-2 control-label')); ?>
                        <div class="col-sm-5">
                        <?php echo $form->textField($model,'vendor_trade_mark',array('class'=>'form-control','size'=>60,'maxlength'=>255)); ?>
                        <?php echo $form->error($model,'vendor_trade_mark'); ?>
                        </div>
                    </div>

                                        <div class="form-group">
                        <?php echo $form->labelEx($model,'vendor_remarks',  array('class' => 'col-sm-2 control-label')); ?>
                        <div class="col-sm-5">
                        <?php echo $form->textArea($model,'vendor_remarks',array('class'=>'form-control','rows'=>6, 'cols'=>50)); ?>
                        <?php echo $form->error($model,'vendor_remarks'); ?>
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