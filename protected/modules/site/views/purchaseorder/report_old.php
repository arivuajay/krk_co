<?php
/* @var $this PurchaseorderController */
/* @var $dataProvider CActiveDataProvider */

$this->title = 'PO Report';
$this->breadcrumbs = array(
    'PO Report',
);
$themeUrl = $this->themeUrl;
$cs = Yii::app()->getClientScript();
$cs_pos_end = CClientScript::POS_END;

$cs->registerCssFile($themeUrl . '/css/datepick/jquery.datepick.css');
$cs->registerScriptFile($themeUrl . '/js/datepick/jquery.plugin.js', $cs_pos_end);
$cs->registerScriptFile($themeUrl . '/js/datepick/jquery.datepick.js', $cs_pos_end);
$cs->registerScriptFile($themeUrl . '/js/datatables/jquery.dataTables.js', $cs_pos_end);
$cs->registerScriptFile($themeUrl . '/js/datatables/dataTables.bootstrap.js', $cs_pos_end);
?>
<div class="col-lg-12 col-md-12" id="advance-search-block">
    <div class="row mb10" id="advance-search-label">
        <?php echo CHtml::link('<i class="fa fa-angle-right"></i> Show Advance Search', 'javascript:void(0);', array('class' => 'pull-right')); ?>
    </div>
    <div class="row" id="advance-search-form" style="display: block">
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
                        'action' => array('/site/purchaseorder/report'),
                        'htmlOptions' => array('role' => 'form')
                    ));
                    $vendors = Vendor::VendorList();
                    ?>

                    <div class="col-lg-4 col-md-4">
                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'purchase_order_code', array('class' => ' control-label')); ?>
                            <?php echo $form->textField($detail_model, 'f_purchase_order_code', array('class' => 'form-control', 'size' => 60, 'maxlength' => 255)); ?>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'po_vendor_id', array('class' => ' control-label')); ?>
                            <?php echo $form->dropDownList($detail_model, 'f_po_vendor_id', $vendors, array('class' => 'form-control', 'prompt' => '')); ?>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'from_date', array('class' => ' control-label')); ?>
                            <?php echo $form->textField($detail_model, 'f_from_date', array('class' => 'form-control datepicker')); ?>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'to_date', array('class' => ' control-label')); ?>
                            <?php echo $form->textField($detail_model, 'f_to_date', array('class' => 'form-control datepicker')); ?>
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
        echo CHtml::link('<i class="fa fa-plus"></i>&nbsp;&nbsp;Create PurchaseOrder', array('/site/purchaseorder/create'), array('class' => 'btn btn-success pull-right mb10'));
        echo '<div class="col-md-1">';
        $this->widget(
                'booster.widgets.TbButton', array(
            'label' => ' Export PDF',
            'icon' => 'fa fa-file-pdf-o',
            'url' => '#',
            'buttonType' => 'link',
            'context' => 'warning',
            'htmlOptions' => array('id' => 'export_pdf')
//                    
                )
        );
        echo '</div>';
        echo '<div class="col-md-1">';
        echo $this->renderExportGridButton('po-base-grid', '<i class="fa fa-file-excel-o"></i> Export CSV', array('class' => 'btn btn-danger'));
        echo '</div>';
        ?>
    </div>
</div>

<div class="col-lg-12 col-md-12">
    <div class="row">
        <?php $this->renderPartial('_grid', compact('model', 'detail_model')); ?>
    </div>
</div>

<?php
$user_js_format = JS_USER_DATE_FORMAT;
$js = <<< EOD
    $(document).ready(function(){
        $('.datepicker').datepick({dateFormat: '$user_js_format'});
    });
EOD;
$cs->registerScript('_po_report', $js);

Yii::app()->clientScript->registerScript('exportgrid', "$('#export_pdf').on('click',function() {
    var downloadUrl=$('#po-base-grid').yiiGridView('getUrl');
    downloadUrl+=((downloadUrl.indexOf('?')==-1)?'?':'&');
    downloadUrl+='export=PDF';
    window.open( downloadUrl ,'_blank');
});");
?>