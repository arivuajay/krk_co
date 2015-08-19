<?php
/* @var $this MasterController */
/* @var $model Vendor */

$this->title = 'View: ' . $model->vendor_name;
$this->breadcrumbs = array(
    'Master' => array('index'),
    'View ' . 'Vendor',
);
?>
<div class="user-view">
    <?php if ($export == false) {
        ?>
        <p>
            <?php
//            $this->widget(
//                    'booster.widgets.TbButton', array(
//                'label' => 'Update',
//                'url' => array('/site.', 'id' => $model->vendor_id),
//                'buttonType' => 'link',
//                'context' => 'primary',
////                    'visible' => UserIdentity::checkAccess(Yii::app()->user->name)
//                    )
//            );
//            echo "&nbsp;&nbsp;";
//            $this->widget(
//                    'booster.widgets.TbButton', array(
//                'label' => 'Delete',
//                'url' => array('delete', 'id' => $model->vendor_id),
//                'buttonType' => 'link',
//                'context' => 'danger',
//                'htmlOptions' => array('confirm' => 'Are you sure you want to delete this item?'),
//                'visible' => UserIdentity::checkAccess(Yii::app()->user->name)
//                    )
//            );
//            echo "&nbsp;&nbsp;";
//            $this->widget(
//                    'booster.widgets.TbButton', array(
//                'label' => 'Download',
//                'url' => array('view', 'id' => $model->vendor_id, 'export' => 'PDF'),
//                'buttonType' => 'link',
//                'context' => 'warning',
////                    'visible' => UserIdentity::checkAccess(Yii::app()->user->name)
//                    )
//            );
            ?>
        </p>
    <?php }
    ?>
    <?php if ($export) { ?>
        <h3 class="text-center">Liner <?php echo $this->title ?></h3>
        <?php
    }
    ?>
    <?php
    $this->widget('zii.widgets.CDetailView', array(
        'data' => $model,
        'htmlOptions' => array('class' => 'table table-striped table-bordered'),
        'attributes' => array(
            'vendor_code',
            array(
                'name' => 'vendor_type_id',
                'value' => $model->vendorType->vendor_type
            ),
            'vendor_name',
            'vendor_address',
            'vendor_city',
            'vendor_country',
            'vendor_contact_person',
            'vendor_mobile_no',
            'vendor_office_no',
            'vendor_email',
            'vendor_website',
            'vendor_trade_mark',
            'vendor_remarks',
             array(
                'name' => 'status',
                'type' => 'raw',
                'value' => $model->status == 1 ? '<i class="fa fa-circle text-green" title="Active"></i>' : '<i class="fa fa-circle text-red" title="In-active"></i>'
            ),
        ),
    ));
    ?>
</div>



