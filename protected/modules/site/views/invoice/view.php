<?php
/* @var $this InvoiceController */
/* @var $model Invoice */

$this->title='View #'.$model->inv_no;
$this->breadcrumbs=array(
	'Invoices'=>array('index'),
	'View '.'Invoice',
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
//                    'url' => array('update', 'id' =>  $model->invoice_id ),
//                    'buttonType' => 'link',
//                    'context' => 'primary',
////                    'visible' => UserIdentity::checkAccess(Yii::app()->user->name)
//                )
//        );
//        echo "&nbsp;&nbsp;";
//        $this->widget(
//                'application.components.MyTbButton', array(
//                    'label' => 'Delete',
//                    'url' => array('delete', 'id' =>  $model->invoice_id ),
//                    'buttonType' => 'link',
//                    'context' => 'danger',
//                    'htmlOptions' => array('confirm' => 'Are you sure you want to delete this item?'),
//                    'visible' => UserIdentity::checkAccess(Yii::app()->user->name)
//                )
//        );
//        echo "&nbsp;&nbsp;";
//        $this->widget(
//                'booster.widgets.TbButton', array(
//            'label' => 'Download',
//            'url' => array('view', 'id' =>  $model->invoice_id , 'export' => 'PDF'),
//            'buttonType' => 'link',
//            'context' => 'warning',
////                    'visible' => UserIdentity::checkAccess(Yii::app()->user->name)
//                )
//        );
        ?>
    </p>
    <?php    }
    ?>
    <?php    if ($export) { ?>
        <h3 class="text-center">Invoice <?php echo $this->title ?></h3>
    <?php        
    }
    ?>
    <?php
    $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
        'htmlOptions' => array('class'=>'table table-striped table-bordered'),
	'attributes'=>array(
		'inv_no',
		'inv_date',
            array(
                'name' => 'vendor_id',
                'value' => $model->vendor->vendor_name
            ),
            array(
                'name' => 'company_id',
                'value' => $model->company->company_name
            ),
            array(
                'name' => 'po_id',
                'value' => $model->po->purchase_order_code
            ),
		'permit_no',
		'bol_no',
		'vessel_name',
            array(
                'name' => 'inv_file',
                'type' => 'raw',
                'value' => !empty($model->inv_file) ? CHtml::link('Click to view', $model->getFilePath(false, 'inv_file'), array('target' => '_blank', 'id' => 'inv_file')) : 'Not set'
            ),
            array(
                'name' => 'pkg_list_file',
                'type' => 'raw',
                'value' => !empty($model->pkg_list_file) ? CHtml::link('Click to view', $model->getFilePath(false, 'pkg_list_file'), array('target' => '_blank', 'id' => 'pkg_list_file')) : 'Not set'
            ),
	),
)); ?>
</div>



