<?php
$gridColumns = array(
    'product.proFamily.pro_family_name',
    'product.pro_name',
    'grade_code',
    'grade_short_name',
    'grade_long_name',
    array(
        'header' => 'Actions',
        'class' => 'booster.widgets.TbButtonColumn',
        'htmlOptions' => array('style' => 'width: 180px;;text-align:center', 'vAlign' => 'middle', 'class' => 'action_column'),
        'template' => '{edit_grade}{delete}',
        'buttons' => array(
            'delete' => array(
                'url' => 'Yii::app()->createUrl("/site/masters/grade_delete", array("id"=>$data->grade_id))'
            ),
            'edit_grade' => array(
                'label' => '<i class="glyphicon glyphicon-pencil"></i>',
                'options' => array('title' => 'Update'),
                'url' => 'Yii::app()->createUrl("/site/masters/grade_save", array("id"=>$data->grade_id))',
                'click' => 'function(){ $.ajax({ type:"POST",url:$(this).attr("href"),success:function(text,status) { $("#foot_grade_form").html(text); } }); return false; }',
            ),
        )
    )
);


$this->widget('booster.widgets.TbExtendedGridView', array(
    'id' => 'master_family',
    'type' => 'striped bordered datatable',
    'dataProvider' => $grade_model->dataProvider(),
    'responsiveTable' => true,
    'template' => '{items}{pager}',
    'columns' => $gridColumns,
//    'extraRowColumns' => array('product.pro_name','product.proFamily.pro_family_name'),
//    'extraRowExpression' => '"<b style=\"font-size: 25px; color: #333;\">".$data->product->proFamily->pro_family_name."->".$data->product->pro_name."</b>"',
//    'extraRowHtmlOptions' => array('style' => 'padding:10px'),
    )
);
?>
