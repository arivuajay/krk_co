<?php

$gridColumns = array(
    array(
        'name' => 'vendor_id',
        'value' => '$data->vendor->vendor_name'
    ),
    array(
        'name' => 'pay_type',
        'value' => 'Payment::PaymentTypelist($data->pay_type)'
    ),
    'pay_date',
    'pay_amount',
    array(
        'name' => 'po_id',
        'value' => '$data->po->purchase_order_code'
    ),
    array(
        'name' => 'invoice_id',
        'value' => '$data->invoice->inv_no'
    ),
//		'invoice_amount',
    /*
      'pay_deal_id',
      'pay_inr_rate',
      'pay_date',
      'pay_inr_amount',
      'pay_mode',
      'pay_ref_info',
      'pay_transaction_id',
      'pay_bank_name',
      'pay_remarks',
      'pay_shift_advise',
      'pay_debit_advise',
      'pay_other_doc',
      'pay_deal_id_copy',
     */
    array(
        'header' => 'Actions',
        'class' => 'booster.widgets.TbButtonColumn',
        'htmlOptions' => array('style' => 'width: 180px;;text-align:center', 'vAlign' => 'middle', 'class' => 'action_column'),
        'template' => '{view}{delete}',
        'visible' => !$export
    )
);

if($export)
    $template = '<div class="panel panel-primary"><div class="panel-heading"><h3 class="panel-title"><i class="glyphicon glyphicon-book"></i>  Payments</h3></div><div class="panel-body">{items}</div></div>';
else
    $template = '<div class="panel panel-primary"><div class="panel-heading"><div class="pull-right">{summary} &nbsp;</div><h3 class="panel-title"><i class="glyphicon glyphicon-book"></i>  Payments</h3></div><div class="panel-body">{items}{pager}</div></div>';

$this->widget('booster.widgets.TbExtendedGridView', array(
    'id' => 'payment-base-grid',
    'type' => 'striped bordered datatable',
    'dataProvider' => $model->dataProvider(),
    'responsiveTable' => true,
    'template' => $template,
    'columns' => $gridColumns
        )
);
?>
