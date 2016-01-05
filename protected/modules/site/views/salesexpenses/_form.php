<?php
/* @var $this SalesexpensesController */
/* @var $model SalesExpenses */
/* @var $form CActiveForm */
$themeUrl = $this->themeUrl;
$cs = Yii::app()->getClientScript();
$cs_pos_end = CClientScript::POS_END;
$cs->registerCssFile($themeUrl . '/css/datepick/jquery.datepick.css');
$cs->registerScriptFile($themeUrl . '/js/datepick/jquery.plugin.js', $cs_pos_end);
$cs->registerScriptFile($themeUrl . '/js/datepick/jquery.datepick.js', $cs_pos_end);

?>

<div class="row">
    <div class="col-lg-12 col-xs-12">
        <div class="box box-primary">
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'sales-expenses-form',
                'htmlOptions' => array('role' => 'form', 'class' => 'form-horizontal'),
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                ),
                'enableAjaxValidation' => true,
            ));
            $families = ProductFamily::ProductFamilyList();
            $products = array();
            
            if ($model->product->pro_family_id){
                $products = CHtml::listData(Product::model()->active()->findAll(array('order' => 'pro_name', 'condition' => "pro_family_id = '{$model->product->pro_family_id}'")), 'product_id', 'pro_name');
                $model->sale_exp_fam_id = $model->product->pro_family_id;
            }
            ?>
            <div class="box-body">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'sale_exp_fam_id', array('class' => 'col-sm-2 control-label')); ?>
                    <div class="col-sm-5">
                        <?php
                        echo $form->dropDownList($model, 'sale_exp_fam_id', $families, array('class' => 'form-control', 'prompt' => 'Select Family',
                            'ajax' => array(
                                'type' => 'GET',
                                'url' => Yii::app()->createUrl('/site/default/getProductbyFamily'),
                                'update' => '#SalesExpenses_product_id',
                                'data' => array('id' => 'js:this.value'))));
                        ?>
                        <?php echo $form->error($model, 'sale_exp_fam_id'); ?>
                    </div>
                </div>
                
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'product_id', array('class' => 'col-sm-2 control-label')); ?>
                    <div class="col-sm-5">
                        <?php echo $form->dropDownList($model, 'product_id', $products, array('class' => 'form-control', 'prompt' => 'Select Product')); ?>
                        <?php echo $form->error($model, 'product_id'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($model, 'sale_exp_date', array('class' => 'col-sm-2 control-label')); ?>
                    <div class="col-sm-5">
                        <?php echo $form->textField($model, 'sale_exp_date', array('class' => 'form-control datepicker')); ?>
                        <?php echo $form->error($model, 'sale_exp_date'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($model, 'sale_exp_amount', array('class' => 'col-sm-2 control-label')); ?>
                    <div class="col-sm-5">
                        <?php echo $form->textField($model, 'sale_exp_amount', array('class' => 'form-control', 'size' => 10, 'maxlength' => 10)); ?>
                        <?php echo $form->error($model, 'sale_exp_amount'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($model, 'sale_exp_remarks', array('class' => 'col-sm-2 control-label')); ?>
                    <div class="col-sm-5">
                        <?php echo $form->textArea($model, 'sale_exp_remarks', array('class' => 'form-control', 'rows' => 6, 'cols' => 50)); ?>
                        <?php echo $form->error($model, 'sale_exp_remarks'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($model, 'sales_exp_cust_name', array('class' => 'col-sm-2 control-label')); ?>
                    <div class="col-sm-5">
                        <?php echo $form->textField($model, 'sales_exp_cust_name', array('class' => 'form-control', 'size' => 60, 'maxlength' => 100)); ?>
                        <?php echo $form->error($model, 'sales_exp_cust_name'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($model, 'sales_exp_address', array('class' => 'col-sm-2 control-label')); ?>
                    <div class="col-sm-5">
                        <?php echo $form->textArea($model, 'sales_exp_address', array('class' => 'form-control', 'rows' => 6, 'cols' => 50)); ?>
                        <?php echo $form->error($model, 'sales_exp_address'); ?>
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
    $user_js_format = JS_USER_DATE_FORMAT;
    $js = <<< EOD
$(document).ready(function(){
    $('.datepicker').datepick({dateFormat: '$user_js_format'});
});
EOD;
    $cs->registerScript('_form', $js);
    ?>