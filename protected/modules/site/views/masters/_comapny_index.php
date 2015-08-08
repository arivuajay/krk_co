<?php

$gridColumns = array(
    'company_name',
    'company_address',
    array(
        'header' => 'Actions',
        'class' => 'booster.widgets.TbButtonColumn',
        'htmlOptions' => array('style' => 'width: 180px;;text-align:center', 'vAlign' => 'middle', 'class' => 'action_column'),
        'template' => '{edit}{delete}',
        'buttons' => array(
            'delete' => array(
                'url' => 'Yii::app()->createUrl("/site/masters/company_delete", array("id"=>$data->company_id))'
            ),
            'edit' => array(
                'label' => '<i class="glyphicon glyphicon-pencil"></i>',
                'options' => array('title' => 'Update'),
                'url' => 'Yii::app()->createUrl("/site/masters/company_save", array("id"=>$data->company_id))',
                'click' => 'function(){ $.ajax({ type:"POST",url:$(this).attr("href"),success:function(text,status) { $("#foot_comp_form").html(text); } }); return false; }',
            ),
        )
    )
);



$this->widget('booster.widgets.TbExtendedGridView', array(
    'id' => 'master_company',
    'type' => 'striped bordered datatable',
    'dataProvider' => $comp_model->dataProvider(),
    'responsiveTable' => true,
    'template' => '{items}{pager}',
    'columns' => $gridColumns
        )
);
?>
