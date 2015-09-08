<?php
/* @var $this PaymentController */
/* @var $dataProvider CActiveDataProvider */

$this->title = 'Payments';
$this->breadcrumbs = array(
    'Payments',
);
$themeUrl = $this->themeUrl;
$cs = Yii::app()->getClientScript();
$cs_pos_end = CClientScript::POS_END;

$cs->registerScriptFile($themeUrl . '/js/datatables/jquery.dataTables.js', $cs_pos_end);
$cs->registerScriptFile($themeUrl . '/js/datatables/dataTables.bootstrap.js', $cs_pos_end);
?>
<div class="col-lg-12 col-md-12" id="advance-search-block">
    <div class="row mb10" id="advance-search-label">
        <?php echo CHtml::link('<i class="fa fa-angle-right"></i> Hide Advance Search', 'javascript:void(0);', array('class' => 'pull-right')); ?>
    </div>
    <div class="row" id="advance-search-form" style="display: block;">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="glyphicon glyphicon-search"></i>  Search
                </h3>
                <div class="clearfix"></div>
            </div>
            <section class="content">
                <div class="row">
                    <?php
                    $form = $this->beginWidget('CActiveForm', array(
                        'id' => 'search-form',
                        'method' => 'get',
                        'action' => array('/site/payment/index'),
                        'htmlOptions' => array('role' => 'form')
                    ));
                    $vendors = Vendor::VendorList();
                    $payment_types = Payment::PaymentTypelist();
                    ?>

                    <div class="col-lg-4 col-md-4">
                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'vendor_id', array('class' => ' control-label')); ?>
                            <?php echo $form->dropDownList($model, 'vendor_id', $vendors, array('class' => 'form-control', 'prompt' => '')); ?>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'pay_type', array('class' => ' control-label')); ?>
                            <?php echo $form->dropDownList($model, 'pay_type', $payment_types, array('class' => 'form-control', 'prompt' => '')); ?>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'invoice_id', array('class' => ' control-label')); ?>
                            <?php echo $form->textField($model, 'invoice_id', array('class' => 'form-control')); ?>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2">
                        <div class="form-group">
                            <label>&nbsp;</label>
                            <?php echo CHtml::submitButton('Search', array('class' => 'btn btn-primary form-control')); ?>
                        </div>
                    </div>
                    <?php $this->endWidget(); ?>
                </div>
            </section>


        </div>
    </div>
</div>

<div class="col-lg-12 col-md-12">
    <div class="row">
        <!--        <div class="col-lg-4 col-md-4 row">
                    <div class="form-group">
                        <label class="control-label">Search: </label>
                        <input type="text" class="form-control inline" name="base_table_search" id="base_table_search" />
                    </div>
                </div>-->
        <?php
        echo CHtml::link('<i class="fa fa-plus"></i>&nbsp;&nbsp;Create Payment', array('/site/payment/create'), array('class' => 'btn btn-success pull-right mb10'));
        ?>

    </div>
</div>


<div class="col-lg-12 col-md-12">
    <div class="row">
        <?php $this->renderPartial('_grid', compact('model')); ?>
    </div>
</div>