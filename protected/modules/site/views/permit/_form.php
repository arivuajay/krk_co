<?php
/* @var $this PermitController */
/* @var $model Permit */
/* @var $form CActiveForm */
?>

<div class="row">
    <div class="col-lg-12 col-xs-12">
        <div class="box box-primary">
            <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'permit-form',
        'htmlOptions' => array('role' => 'form', 'class' => 'form-horizontal'),
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
        ),
	'enableAjaxValidation'=>true,
)); ?>
            <div class="box-body">
                                    <div class="form-group">
                        <?php echo $form->labelEx($model,'permit_id',  array('class' => 'col-sm-2 control-label')); ?>
                        <div class="col-sm-5">
                        <?php echo $form->textField($model,'permit_id',array('class'=>'form-control')); ?>
                        <?php echo $form->error($model,'permit_id'); ?>
                        </div>
                    </div>

                                        <div class="form-group">
                        <?php echo $form->labelEx($model,'company_id',  array('class' => 'col-sm-2 control-label')); ?>
                        <div class="col-sm-5">
                        <?php echo $form->textField($model,'company_id',array('class'=>'form-control')); ?>
                        <?php echo $form->error($model,'company_id'); ?>
                        </div>
                    </div>

                                        <div class="form-group">
                        <?php echo $form->labelEx($model,'permit_no',  array('class' => 'col-sm-2 control-label')); ?>
                        <div class="col-sm-5">
                        <?php echo $form->textField($model,'permit_no',array('class'=>'form-control','size'=>60,'maxlength'=>100)); ?>
                        <?php echo $form->error($model,'permit_no'); ?>
                        </div>
                    </div>

                                        <div class="form-group">
                        <?php echo $form->labelEx($model,'doissue',  array('class' => 'col-sm-2 control-label')); ?>
                        <div class="col-sm-5">
                        <?php echo $form->textField($model,'doissue',array('class'=>'form-control')); ?>
                        <?php echo $form->error($model,'doissue'); ?>
                        </div>
                    </div>

                                        <div class="form-group">
                        <?php echo $form->labelEx($model,'valupto',  array('class' => 'col-sm-2 control-label')); ?>
                        <div class="col-sm-5">
                        <?php echo $form->textField($model,'valupto',array('class'=>'form-control')); ?>
                        <?php echo $form->error($model,'valupto'); ?>
                        </div>
                    </div>

                                        <div class="form-group">
                        <?php echo $form->labelEx($model,'permit_regno',  array('class' => 'col-sm-2 control-label')); ?>
                        <div class="col-sm-5">
                        <?php echo $form->textField($model,'permit_regno',array('class'=>'form-control','size'=>60,'maxlength'=>100)); ?>
                        <?php echo $form->error($model,'permit_regno'); ?>
                        </div>
                    </div>

                                        <div class="form-group">
                        <?php echo $form->labelEx($model,'permit_poissue',  array('class' => 'col-sm-2 control-label')); ?>
                        <div class="col-sm-5">
                        <?php echo $form->textField($model,'permit_poissue',array('class'=>'form-control','size'=>60,'maxlength'=>100)); ?>
                        <?php echo $form->error($model,'permit_poissue'); ?>
                        </div>
                    </div>

                                        <div class="form-group">
                        <?php echo $form->labelEx($model,'permit_file',  array('class' => 'col-sm-2 control-label')); ?>
                        <div class="col-sm-5">
                        <?php echo $form->textField($model,'permit_file',array('class'=>'form-control','size'=>60,'maxlength'=>255)); ?>
                        <?php echo $form->error($model,'permit_file'); ?>
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