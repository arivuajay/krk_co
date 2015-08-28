<?php

$gridColumns = array(
    array(
        'name' => 'company.company_name',
        'htmlOptions' => array('width' => '150px'),
    ),
    array(
        'name' => 'vendor.vendor_name',
        'htmlOptions' => array('width' => '150px'),
    ),
    'permit_no',
    'valupto',
    'permit_regno',
    'isExpired',
    /*
      'permit_file',
     */
    array(
        'header' => 'Actions',
        'class' => 'booster.widgets.TbButtonColumn',
        'htmlOptions' => array('style' => 'width: 50px;;text-align:center', 'vAlign' => 'middle', 'class' => 'action_column'),
        'template' => '{edit}{delete}',
        'buttons' => array(
            'delete' => array(
                'url' => 'Yii::app()->createUrl("/site/masters/permit_delete", array("id"=>$data->permit_id))'
            ),
            'edit' => array(
                'label' => '<i class="glyphicon glyphicon-pencil"></i>',
                'options' => array('title' => 'Update'),
                'url' => 'Yii::app()->createUrl("/site/masters/permit_save", array("id"=>$data->permit_id))',
                'click' => 'function(){ $.ajax({ type:"POST",url:$(this).attr("href"),success:function(text,status) { $("#foot_perm_form").html(text); } }); return false; }',
            ),
        )
    )
);

$this->widget('booster.widgets.TbExtendedGridView', array(
    'id' => 'master_permit',
    'type' => 'striped bordered datatable',
    'enableSorting' => false,
    'dataProvider' => $perm_model->dataProvider(),
    'responsiveTable' => true,
    'template' => '{items}{pager}',
    'columns' => $gridColumns
        )
);
