<?php
$gridColumns = array(
    'po.poVendor.vendor_name',
    'po.purchase_order_code',
    'po.po_date',
    'postatus',
    'createdbyname',
    'familyname', 
    'productname', 
    'varietyname', 
    'sizenames', 
    'gradenames', 
    'totalamount',
//    array(
//        'header' => 'Actions',
//        'class' => 'booster.widgets.TbButtonColumn',
//        'htmlOptions' => array('style' => 'width: 180px;;text-align:center', 'vAlign' => 'middle', 'class' => 'action_column'),
//        'template' => '{view}{delete}',
//        'viewButtonUrl' => 'Yii::app()->createUrl("/site/purchaseorder/view", array("id" => $data->po_id))',
//        'deleteButtonUrl' => 'Yii::app()->createUrl("/site/purchaseorder/delete", array("id" => $data->po_id))',
//        'visible' => !$export
//    )
);

if ($export)
    $template = '<div class="panel panel-primary"><div class="panel-heading"><h3 class="panel-title"><i class="glyphicon glyphicon-book"></i>  PO Report</h3></div><div class="panel-body">{items}</div></div>';
else
    $template = '<div class="panel panel-primary"><div class="panel-heading"><div class="pull-right">{summary} &nbsp;</div><h3 class="panel-title"><i class="glyphicon glyphicon-book"></i>  PO Report</h3></div><div class="panel-body">{items}{pager}</div></div>';

$this->widget('booster.widgets.TbExtendedGridView', array(
    'id' => 'po-base-grid',
    'type' => 'striped bordered datatable',
    'dataProvider' => $detail_model->dataProvider(),
    'responsiveTable' => true,
    'template' => $template,
    'columns' => $gridColumns
        )
);
?>


