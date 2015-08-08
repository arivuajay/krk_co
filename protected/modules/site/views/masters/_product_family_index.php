<?php
$gridColumns = array(
    'pro_family_code',
    'pro_family_name',
    array(
        'header' => 'Actions',
        'class' => 'booster.widgets.TbButtonColumn',
        'htmlOptions' => array('style' => 'width: 180px;;text-align:center', 'vAlign' => 'middle', 'class' => 'action_column'),
        'template' => '{edit}{delete}',
        'buttons' => array(
            'delete' => array(
                'url' => 'Yii::app()->createUrl("/site/masters/family_delete", array("id"=>$data->pro_family_id))'
            ),
            'edit' => array(
                'label' => '<i class="glyphicon glyphicon-pencil"></i>',
                'options' => array('title' => 'Update'),
                'url' => 'Yii::app()->createUrl("/site/masters/family_save", array("id"=>$data->pro_family_id))',
                'click' => 'function(){ $.ajax({ type:"POST",url:$(this).attr("href"),success:function(text,status) { $("#foot_family_form").html(text); } }); return false; }',
            ),
        )
    )
);



$this->widget('booster.widgets.TbExtendedGridView', array(
    'id' => 'master_family',
    'type' => 'striped bordered datatable',
    'dataProvider' => $pro_family_model->dataProvider(),
    'responsiveTable' => true,
    'template' => '{items}{pager}',
    'columns' => $gridColumns
        )
);
?>
