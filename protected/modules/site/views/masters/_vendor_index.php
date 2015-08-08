<?php

$gridColumns = array(
    'vendor_code',
    'vendor_name',
    'vendorType.vendor_type',
    array(
        'header' => 'Actions',
        'class' => 'booster.widgets.TbButtonColumn',
        'htmlOptions' => array('style' => 'width: 50px;;text-align:center', 'vAlign' => 'middle', 'class' => 'action_column'),
        'template' => '{edit_vendor}{delete}',
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
        )
    )
);

$this->widget('booster.widgets.TbExtendedGridView', array(
    'id' => 'master_vendor',
    'type' => 'striped bordered datatable',
    'enableSorting' => false,
    'dataProvider' => $vendor_model->dataProvider(),
    'responsiveTable' => true,
    'template' => '{items}{pager}',
    'columns' => $gridColumns
        )
);
