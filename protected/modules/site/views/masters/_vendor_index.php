<?php

$gridColumns = array(
    'vendor_code',
    'vendor_name',
    'vendortype',
//    'vendorType.vendor_type',
    array(
        'header' => 'Actions',
        'class' => 'booster.widgets.TbButtonColumn',
        'htmlOptions' => array('style' => 'width: 100px;;text-align:center', 'vAlign' => 'middle', 'class' => 'action_column'),
        'template' => '{view_vendor}{edit_vendor}{delete}',
        'buttons' => array(
            'delete' => array(
                'url' => 'Yii::app()->createUrl("/site/masters/vendor_delete", array("id"=>$data->vendor_id))'
            ),
            'edit_vendor' => array(
                'label' => '<i class="glyphicon glyphicon-pencil"></i>',
                'options' => array('title' => 'Update'),
                'url' => 'Yii::app()->createUrl("/site/masters/vendor_save", array("id"=>$data->vendor_id))',
                'click' => 'function(){ $.ajax({ type:"POST",url:$(this).attr("href"),success:function(text,status) { $("#foot_vendor_form").html(text); } }); return false; }',
            ),
            'view_vendor' => array(
                'label' => '<i class="glyphicon glyphicon-eye-open"></i>',
                'options' => array('title' => 'View'),
                'url' => 'Yii::app()->createUrl("/site/masters/vendor_view", array("id"=>$data->vendor_id))',
            ),
        )
    )
);

$export_btn = $this->renderExportGridButton('master_vendor', '<i class="fa fa-file-excel-o"></i> Export', array('class' => 'btn btn-xs btn-danger  pull-right', 'url' => '/site/master/index'));

$this->widget('booster.widgets.TbExtendedGridView', array(
    'id' => 'master_vendor',
    'type' => 'striped bordered datatable',
    'enableSorting' => false,
    'dataProvider' => $vendor_model->dataProvider(),
    'responsiveTable' => true,
    'template' => '<div class="pull-right" style="margin-bottom: 10px;">'. $export_btn . '</div><br />{items}{pager}',
    'columns' => $gridColumns
        )
);
