<?php
/* @var $this PurchaseorderController */
/* @var $dataProvider CActiveDataProvider */

$this->title = 'Purchase Orders';
$this->breadcrumbs = array(
    'Purchase Orders',
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
                        'action' => array('/site/purchaseorder/index'),
                        'htmlOptions' => array('role' => 'form')
                    ));
                    $vendors = Vendor::VendorList();
                    ?>

                    <div class="col-lg-4 col-md-4">
                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'purchase_order_code', array('class' => ' control-label')); ?>
                            <?php echo $form->textField($model, 'purchase_order_code', array('class' => 'form-control', 'size' => 60, 'maxlength' => 255)); ?>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'po_vendor_id', array('class' => ' control-label')); ?>
                            <?php echo $form->dropDownList($model, 'po_vendor_id', $vendors, array('class' => 'form-control', 'prompt' => '')); ?>
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
        <?php echo CHtml::link('<i class="fa fa-plus"></i>&nbsp;&nbsp;Create PurchaseOrder', array('/site/purchaseorder/create'), array('class' => 'btn btn-success pull-right mb10')); ?>
    </div>
</div>

<div class="col-lg-12 col-md-12">
    <div class="row">
        <?php
        $gridColumns = array(
            'purchase_order_code',
            'po_date',
            'poCompany.company_name',
            'poVendor.vendor_name',
            array(
                'header' => 'Vendor notify',
                'value' => function($data) {
                    return CHtml::link('Sent to vendor', array('/site/purchaseorder/sendvendor','id'=>$data->po_id), array("class" => "btn btn-xs btn-primary"));
                },
                'type' => 'raw'
            ),
            array(
                'header' => 'Actions',
                'class' => 'booster.widgets.TbButtonColumn',
                'htmlOptions' => array('style' => 'width: 180px;;text-align:center', 'vAlign' => 'middle', 'class' => 'action_column'),
                'template' => '{view}{update}{delete}',
            )
        );

        $this->widget('booster.widgets.TbExtendedGridView', array(
            'type' => 'striped bordered datatable',
            'dataProvider' => $model->dataProvider(),
            'responsiveTable' => true,
            'template' => '<div class="panel panel-primary"><div class="panel-heading"><div class="pull-right">{summary}</div><h3 class="panel-title"><i class="glyphicon glyphicon-book"></i>  Purchase Orders</h3></div><div class="panel-body">{items}{pager}</div></div>',
            'columns' => $gridColumns
                )
        );
        ?>
    </div>
</div>