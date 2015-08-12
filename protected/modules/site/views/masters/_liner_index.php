<?php

$gridColumns = array(
    'liner_code',
    'liner_name',
    'country.country_name',
    'no_of_free_days',
    array(
        'header' => 'Actions',
        'class' => 'booster.widgets.TbButtonColumn',
        'htmlOptions' => array('style' => 'width: 180px;;text-align:center', 'vAlign' => 'middle', 'class' => 'action_column'),
        'template' => '{edit_liner}{delete}',
        'buttons' => array(
            'delete' => array(
                'url' => 'Yii::app()->createUrl("/site/masters/liner_delete", array("id"=>$data->liner_id))'
            ),
            'edit_liner' => array(
                'label' => '<i class="glyphicon glyphicon-pencil"></i>',
                'options' => array('title' => 'Update'),
                'url' => 'Yii::app()->createUrl("/site/masters/liner_save", array("id"=>$data->liner_id))',
                'click' => 'function(){ $.ajax({ type:"POST",url:$(this).attr("href"),success:function(text,status) { $("#foot_liner_form").html(text); } }); return false; }',
            ),
        )
    )
);



$this->widget('booster.widgets.TbExtendedGridView', array(
    'id' => 'master_liner',
    'type' => 'striped bordered datatable',
    'dataProvider' => $liner_model->dataProvider(),
    'responsiveTable' => true,
    'template' => '{items}{pager}',
    'columns' => $gridColumns
        )
);
?>
