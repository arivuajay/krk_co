<?php
$gridColumns = array(
    'size_code',
    'size_name',
    array(
        'header' => 'Actions',
        'class' => 'booster.widgets.TbButtonColumn',
        'htmlOptions' => array('style' => 'width: 180px;;text-align:center', 'vAlign' => 'middle', 'class' => 'action_column'),
        'template' => '{edit_size}{delete}',
        'buttons' => array(
            'delete' => array(
                'url' => 'Yii::app()->createUrl("/site/masters/size_delete", array("id"=>$data->size_id))'
            ),
            'edit_size' => array(
                'label' => '<i class="glyphicon glyphicon-pencil"></i>',
                'options' => array('title' => 'Update'),
                'url' => 'Yii::app()->createUrl("/site/masters/size_save", array("id"=>$data->size_id))',
                'click' => 'function(){ $.ajax({ type:"POST",url:$(this).attr("href"),success:function(text,status) { $("#foot_size_form").html(text); } }); return false; }',
            ),
        )
    )
);


$gridColumns[] = array(
    'name' => 'product.pro_name',
    'headerHtmlOptions' => array('style' => 'display:none'),
    'htmlOptions' => array('style' => 'display:none')
);
$gridColumns[] = array(
    'name' => 'product.proFamily.pro_family_name',
    'headerHtmlOptions' => array('style' => 'display:none'),
    'htmlOptions' => array('style' => 'display:none')
);


$this->widget('booster.widgets.TbGroupGridView', array(
    'id' => 'master_family',
    'type' => 'striped bordered datatable',
    'dataProvider' => $size_model->dataProvider(),
    'responsiveTable' => true,
    'template' => '{items}{pager}',
    'columns' => $gridColumns,
    'extraRowColumns' => array('product.pro_name','product.proFamily.pro_family_name'),
    'extraRowExpression' => '"<b style=\"font-size: 25px; color: #333;\">".$data->product->proFamily->pro_family_name."->".$data->product->pro_name."</b>"',
    'extraRowHtmlOptions' => array('style' => 'padding:10px'),
    )
);
?>
