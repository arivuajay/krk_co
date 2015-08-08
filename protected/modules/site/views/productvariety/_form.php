<?php
/* @var $this ProductvarietyController */
/* @var $model ProductVariety */
/* @var $form CActiveForm */
?>

<div class="row">
    <div class="col-lg-12 col-xs-12">
        <div class="box box-primary">
            <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'product-variety-form',
        'htmlOptions' => array('role' => 'form', 'class' => 'form-horizontal'),
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
        ),
	'enableAjaxValidation'=>true,
)); ?>
            <div class="box-body">
                                    <div class="form-group">
                        <?php echo $form->labelEx($model,'pro_family_id',  array('class' => 'col-sm-2 control-label')); ?>
                        <div class="col-sm-5">
                        <?php echo $form->textField($model,'pro_family_id',array('class'=>'form-control')); ?>
                        <?php echo $form->error($model,'pro_family_id'); ?>
                        </div>
                    </div>

                                        <div class="form-group">
                        <?php echo $form->labelEx($model,'product_id',  array('class' => 'col-sm-2 control-label')); ?>
                        <div class="col-sm-5">
                        <?php echo $form->textField($model,'product_id',array('class'=>'form-control')); ?>
                        <?php echo $form->error($model,'product_id'); ?>
                        </div>
                    </div>

                                        <div class="form-group">
                        <?php echo $form->labelEx($model,'variety_name',  array('class' => 'col-sm-2 control-label')); ?>
                        <div class="col-sm-5">
                        <?php echo $form->textField($model,'variety_name',array('class'=>'form-control','size'=>60,'maxlength'=>255)); ?>
                        <?php echo $form->error($model,'variety_name'); ?>
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