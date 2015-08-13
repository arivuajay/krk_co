<?php
/* @var $this BillladingController */
/* @var $model BillLading */

$this->title='View #'.$model->bl_id;
$this->breadcrumbs=array(
	'Bill of Lading'=>array('index'),
	'View '.'BillLading',
);
?>
<div class="user-view">
    <?php    if ($export == false) {
    ?>
    <p>
        <?php        $this->widget(
                'booster.widgets.TbButton', array(
                    'label' => 'Update',
                    'url' => array('update', 'id' =>  $model->bl_id ),
                    'buttonType' => 'link',
                    'context' => 'primary',
//                    'visible' => UserIdentity::checkAccess(Yii::app()->user->name)
                )
        );
        echo "&nbsp;&nbsp;";
        $this->widget(
                'application.components.MyTbButton', array(
                    'label' => 'Delete',
                    'url' => array('delete', 'id' =>  $model->bl_id ),
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
            'url' => array('view', 'id' =>  $model->bl_id , 'export' => 'PDF'),
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
        <h3 class="text-center">BillLading <?php echo $this->title ?></h3>
    <?php        
    }
    ?>
    <?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
        'htmlOptions' => array('class'=>'table table-striped table-bordered'),
	'attributes'=>array(
		'bl_id',
		'bl_company_id',
		'bl_vendor_id',
		'bl_po_id',
		'bl_invoice_id',
		'bl_number',
		'bl_issue_date',
		'bl_issue_place',
		'bl_load_port',
		'bl_discharge_port',
		'bl_vessal_name',
		'bl_shipped_date',
		'bl_container_number',
		'bl_liner_id',
		'bl_container_count',
		'bl_free_days',
		'bl_frieght_paid',
		'bl_documents',
	),
)); ?>
</div>



