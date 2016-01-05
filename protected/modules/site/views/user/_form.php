<?php
$themeUrl = $this->themeUrl;
$cs = Yii::app()->getClientScript();
$cs_pos_end = CClientScript::POS_END;

$cs->registerCssFile($themeUrl . '/css/datepick/jquery.datepick.css');
$cs->registerScriptFile($themeUrl . '/js/datepick/jquery.plugin.js', $cs_pos_end);
$cs->registerScriptFile($themeUrl . '/js/datepick/jquery.datepick.js', $cs_pos_end);
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'user-form',
    'htmlOptions' => array('role' => 'form', 'class' => 'form-horizontal'),
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
    'enableAjaxValidation' => true,
        ));
?>
<div class="row">

    <div class="col-lg-6 col-xs-6">
        <div class="box box-primary">
            <div class="box-body">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'first_name', array('class' => 'col-sm-2 control-label')); ?>
                    <div class="col-sm-8">
                        <?php echo $form->textField($model, 'first_name', array('class' => 'form-control', 'size' => 60, 'maxlength' => 255)); ?>
                        <?php echo $form->error($model, 'first_name'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($model, 'last_name', array('class' => 'col-sm-2 control-label')); ?>
                    <div class="col-sm-8">
                        <?php echo $form->textField($model, 'last_name', array('class' => 'form-control', 'size' => 60, 'maxlength' => 255)); ?>
                        <?php echo $form->error($model, 'last_name'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($model, 'email_id', array('class' => 'col-sm-2 control-label')); ?>
                    <div class="col-sm-8">
                        <?php echo $form->textField($model, 'email_id', array('class' => 'form-control', 'size' => 60, 'maxlength' => 255)); ?>
                        <?php echo $form->error($model, 'email_id'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($model, 'mobile_no', array('class' => 'col-sm-2 control-label')); ?>
                    <div class="col-sm-8">
                        <?php echo $form->textField($model, 'mobile_no', array('class' => 'form-control', 'size' => 60, 'maxlength' => 100)); ?>
                        <?php echo $form->error($model, 'mobile_no'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($model, 'address', array('class' => 'col-sm-2 control-label')); ?>
                    <div class="col-sm-8">
                        <?php echo $form->textArea($model, 'address', array('class' => 'form-control', 'rows' => 6, 'cols' => 50)); ?>
                        <?php echo $form->error($model, 'address'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($model, 'dojoin', array('class' => 'col-sm-2 control-label')); ?>
                    <div class="col-sm-8">
                        <?php echo $form->textField($model, 'dojoin', array('class' => 'form-control datepicker', 'data-date-end-date'=>"0d", 'value' => (isset($model->dojoin) && $model->dojoin != '0000-00-00') ? date(PHP_USER_DATE_FORMAT, strtotime($model->dojoin)) : '')); ?>
                        <?php echo $form->error($model, 'dojoin'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($model, 'dobirtrh', array('class' => 'col-sm-2 control-label')); ?>
                    <div class="col-sm-8">
                        <?php echo $form->textField($model, 'dobirtrh', array('class' => 'form-control datepicker', 'data-date-end-date'=>"0d", 'value' => (isset($model->dobirtrh) && $model->dobirtrh != '0000-00-00') ? date(PHP_USER_DATE_FORMAT, strtotime($model->dobirtrh)) : '')); ?>
                        <?php echo $form->error($model, 'dobirtrh'); ?>
                    </div>
                </div>

                <!--                <div class="form-group">
                <?php echo $form->labelEx($model, 'status', array('class' => 'col-sm-2 control-label')); ?>
                                    <div class="col-sm-8">
                <?php echo $form->checkBox($model, 'status', array('class' => 'form-control', 'size' => 1, 'maxlength' => 1)); ?>
                <?php echo $form->error($model, 'status'); ?>
                                    </div>
                                </div>-->

            </div><!-- /.box-body -->

        </div>
    </div>
    <div class="col-lg-6 col-xs-6">
        <div class="box box-primary">
            <div class="box-body">
                <div class="form-group">
                    <div class="col-sm-8">
                        <?php $this->renderPartial('_tree', compact('model'));?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-xs-12">
        <div class="form-group">
            <div class="col-sm-0 col-sm-offset-2">
                <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary')); ?>
            </div>
        </div>
    </div>
</div>
<?php $this->endWidget(); ?>

<?php
$user_js_format = JS_USER_DATE_FORMAT;
$js = <<< EOD
    $(document).ready(function(){
        $('.datepicker').datepicker({  minDate: "0",maxDate: "0", format: '$user_js_format' });
    });
EOD;
$cs->registerScript('_form', $js);
?>