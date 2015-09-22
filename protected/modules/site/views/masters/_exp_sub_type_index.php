<?php

$gridColumns = array(
    'expType.exp_type_name',
    'exp_subtype_name',
    array(
        'header' => 'Actions',
        'class' => 'booster.widgets.TbButtonColumn',
        'htmlOptions' => array('style' => 'width: 180px;;text-align:center', 'vAlign' => 'middle', 'class' => 'action_column'),
        'template' => '{edit_exp_subtype}{delete}',
        'buttons' => array(
            'delete' => array(
                'url' => 'Yii::app()->createUrl("/site/masters/exp_subtype_delete", array("id"=>$data->exp_subtype_id))'
            ),
            'edit_exp_subtype' => array(
                'label' => '<i class="glyphicon glyphicon-pencil"></i>',
                'options' => array('title' => 'Update'),
                'url' => 'Yii::app()->createUrl("/site/masters/exp_subtype_save", array("id"=>$data->exp_subtype_id))',
                'click' => 'function(){ $.ajax({ type:"POST",url:$(this).attr("href"),success:function(text,status) { $("#foot_exp_subtype_form").html(text); } }); return false; }',
            ),
        )
    )
);

$this->widget('booster.widgets.TbExtendedGridView', array(
    'type' => 'striped bordered datatable',
    'dataProvider' => $exp_subtype_model->dataProvider(),
    'responsiveTable' => true,
    'template' => '{items}{pager}',
    'columns' => $gridColumns
        )
);
?>
            