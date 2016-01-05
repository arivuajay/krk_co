<?php

$gridColumns = array(
    'proFamily.pro_family_name',
    'product_code',
    'pro_name',
    array(
        'header' => 'Actions',
        'class' => 'booster.widgets.TbButtonColumn',
        'htmlOptions' => array('style' => 'width: 180px;;text-align:center', 'vAlign' => 'middle', 'class' => 'action_column'),
        'template' => '{edit}{delete}',
        'buttons' => array(
            'delete' => array(
                'url' => 'Yii::app()->createUrl("/site/masters/product_delete", array("id"=>$data->pro_family_id))'
            ),
            'edit' => array(
                'label' => '<i class="glyphicon glyphicon-pencil"></i>',
                'options' => array('title' => 'Update'),
                'url' => 'Yii::app()->createUrl("/site/masters/product_save", array("id"=>$data->product_id))',
                'click' => 'function(){ $.ajax({ type:"POST",url:$(this).attr("href"),success:function(text,status) { $("#foot_product_form").html(text); } }); return false; }',
            ),
        )
    )
);


$this->widget('booster.widgets.TbExtendedGridView', array(
    'id' => 'master_product',
    'type' => 'striped bordered datatable',
    'dataProvider' => $product_model->dataProvider(),
    'responsiveTable' => true,
    'template' => '{items}{pager}',
    'columns' => $gridColumns,
//    'extraRowColumns' => array('proFamily.pro_family_name'),
//    'extraRowExpression' => '"<b style=\"font-size: 25px; color: #333;\">".$data->proFamily->pro_family_name."</b>"',
//    'extraRowHtmlOptions' => array('style' => 'padding:10px'),
        )
);
?>
