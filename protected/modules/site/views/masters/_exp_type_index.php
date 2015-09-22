<?php

$gridColumns = array(
    'exp_type_name',
    array(
        'header' => 'Actions',
        'class' => 'booster.widgets.TbButtonColumn',
        'htmlOptions' => array('style' => 'width: 180px;;text-align:center', 'vAlign' => 'middle', 'class' => 'action_column'),
        'template' => '{edit_exp_type}{delete}',
        'buttons' => array(
            'delete' => array(
                'url' => 'Yii::app()->createUrl("/site/masters/exp_type_delete", array("id"=>$data->exp_type_id))'
            ),
            'edit_exp_type' => array(
                'label' => '<i class="glyphicon glyphicon-pencil"></i>',
                'options' => array('title' => 'Update'),
                'url' => 'Yii::app()->createUrl("/site/masters/exp_type_save", array("id"=>$data->exp_type_id))',
                'click' => 'function(){ $.ajax({ type:"POST",url:$(this).attr("href"),success:function(text,status) { $("#foot_exp_type_form").html(text); } }); return false; }',
            ),
        )
    )
);

$this->widget('booster.widgets.TbExtendedGridView', array(
    'type' => 'striped bordered datatable',
    'dataProvider' => $exp_type_model->dataProvider(),
    'responsiveTable' => true,
    'template' => '{items}{pager}',
    'columns' => $gridColumns
        )
);
?>
            