<?php
/* @var $this PytooriginController */
/* @var $dataProvider CActiveDataProvider */

$this->title = 'Pyto Origins';
$this->breadcrumbs = array(
    'Pyto Origins',
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
                        'action' => array('/site/pytoorigin/index'),
                        'htmlOptions' => array('role' => 'form')
                    ));
                    $vendors = Vendor::VendorList();
                    ?>

                    <div class="col-lg-4 col-md-4">
                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'pyto_cert_no', array('class' => ' control-label')); ?>
                            <?php echo $form->textField($model, 'pyto_cert_no', array('class' => 'form-control', 'size' => 60, 'maxlength' => 255)); ?>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'origin_cert_no', array('class' => ' control-label')); ?>
                            <?php echo $form->textField($model, 'origin_cert_no', array('class' => 'form-control', 'size' => 60, 'maxlength' => 255)); ?>
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
        <?php echo CHtml::link('<i class="fa fa-plus"></i>&nbsp;&nbsp;Create PytoOrigin', array('/site/pytoorigin/create'), array('class' => 'btn btn-success pull-right mb10')); ?>
    </div>
</div>

<div class="col-lg-12 col-md-12">
    <div class="row">
        <?php
        $gridColumns = array(
            'pytoPo.purchase_order_code',
            'pytoInvoice.inv_no',
            'pytoCompany.company_name',
            'pytoVendor.vendor_name',
            'pyto_cert_no',
            'doinspection',
            'origin_cert_no',
            /*
              'pyto_file',
              'origin_file',
             */
            array(
                'header' => 'Actions',
                'class' => 'booster.widgets.TbButtonColumn',
                'htmlOptions' => array('style' => 'width: 180px;;text-align:center', 'vAlign' => 'middle', 'class' => 'action_column'),
                'template' => '{view}{delete}',
            )
        );

        $this->widget('booster.widgets.TbExtendedGridView', array(
            'type' => 'striped bordered datatable',
            'dataProvider' => $model->dataProvider(),
            'responsiveTable' => true,
            'template' => '<div class="panel panel-primary"><div class="panel-heading"><div class="pull-right">{summary}</div><h3 class="panel-title"><i class="glyphicon glyphicon-book"></i>  Pyto Origins</h3></div><div class="panel-body">{items}{pager}</div></div>',
            'columns' => $gridColumns
                )
        );
        ?>
    </div>
</div>