<?php
/* @var $this PermitController */
/* @var $model Permit */

$this->title='View #'.$model->permit_id;
$this->breadcrumbs=array(
	'Permits'=>array('index'),
	'View '.'Permit',
);
?>
<div class="user-view">
    <?php    if ($export == false) {
    ?>
    <p>
        <?php        $this->widget(
                'booster.widgets.TbButton', array(
                    'label' => 'Update',
                    'url' => array('update', 'id' =>  $model->permit_id ),
                    'buttonType' => 'link',
                    'context' => 'primary',
//                    'visible' => UserIdentity::checkAccess(Yii::app()->user->name)
                )
        );
        echo "&nbsp;&nbsp;";
        $this->widget(
                'application.components.MyTbButton', array(
                    'label' => 'Delete',
                    'url' => array('delete', 'id' =>  $model->permit_id ),
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
            'url' => array('view', 'id' =>  $model->permit_id , 'export' => 'PDF'),
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
        <h3 class="text-center">Permit <?php echo $this->title ?></h3>
    <?php        
    }
    ?>
    <?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
        'htmlOptions' => array('class'=>'table table-striped table-bordered'),
	'attributes'=>array(
		'permit_id',
		'company_id',
		'permit_no',
		'doissue',
		'valupto',
		'permit_regno',
		'permit_poissue',
		'permit_file',
	),
)); ?>
</div>



