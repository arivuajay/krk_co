<?php
/* @var $this PaymentController */
/* @var $model Payment */

$this->title='View #'.$model->pay_id;
$this->breadcrumbs=array(
	'Payments'=>array('index'),
	'View '.'Payment',
);
?>
<div class="user-view">
    <?php    if ($export == false) {
    ?>
    <p>
        <?php        
//        $this->widget(
//                'booster.widgets.TbButton', array(
//                    'label' => 'Update',
//                    'url' => array('update', 'id' =>  $model->pay_id ),
//                    'buttonType' => 'link',
//                    'context' => 'primary',
////                    'visible' => UserIdentity::checkAccess(Yii::app()->user->name)
//                )
//        );
//        echo "&nbsp;&nbsp;";
        $this->widget(
                'booster.widgets.TbButton', array(
                    'label' => 'Delete',
                    'url' => array('delete', 'id' =>  $model->pay_id ),
                    'buttonType' => 'link',
                    'context' => 'danger',
                    'htmlOptions' => array('confirm' => 'Are you sure you want to delete this item?'),
                    'visible' => UserIdentity::checkAccess(Yii::app()->user->name)
                )
        );
        echo "&nbsp;&nbsp;";
        $this->widget(
                'booster.widgets.TbButton', array(
            'label' => 'Download',
            'url' => array('view', 'id' =>  $model->pay_id , 'export' => 'PDF'),
            'buttonType' => 'link',
            'context' => 'warning',
//                    'visible' => UserIdentity::checkAccess(Yii::app()->user->name)
                )
        );
        ?>
    </p>
    <?php    }
    ?>
    <?php    if ($export) { ?>
        <h3 class="text-center">Payment <?php echo $this->title ?></h3>
    <?php        
    }
    ?>
    <?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
        'htmlOptions' => array('class'=>'table table-striped table-bordered'),
	'attributes'=>array(
                array(
                    'name' => 'vendor_id',
                    'value' => $model->vendor->vendor_name
                ),
                array(
                    'name' => 'pay_type',
                    'value' => Payment::PaymentTypelist($model->pay_type)
                ),
                array(
                    'name' => 'invoice_id',
                    'value' => $model->invoice->inv_no
                ),
                array(
                    'name' => 'po_id',
                    'value' => $model->po->purchase_order_code
                ),
		'invoice_amount',
		'pay_amount',
		'pay_deal_id',
		'pay_inr_rate',
		'pay_date',
		'pay_inr_amount',
		'pay_mode',
		'pay_ref_info',
		'pay_transaction_id',
		'pay_transaction_date',
		'pay_bank_name',
		'pay_remarks',
                array(
                    'name' => 'pay_shift_advise',
                    'type' => 'raw',
                    'value' => !empty($model->pay_shift_advise) ? $model->fileview : 'Not set',
                ),
                array(
                    'name' => 'pay_debit_advise',
                    'type' => 'raw',
                    'value' => !empty($model->pay_debit_advise) ? $model->fileview1 : 'Not set',
                ),
                array(
                    'name' => 'pay_other_doc',
                    'type' => 'raw',
                    'value' => !empty($model->pay_other_doc) ? $model->fileview2 : 'Not set',
                ),
                array(
                    'name' => 'pay_deal_id_copy',
                    'type' => 'raw',
                    'value' => !empty($model->pay_deal_id_copy) ? $model->fileview3 : 'Not set',
                ),
	),
)); ?>
</div>



