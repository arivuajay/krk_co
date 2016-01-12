<?php
/* @var $this BillladingController */
/* @var $dataProvider CActiveDataProvider */

$this->title='Bill of Lading';
$this->breadcrumbs=array(
	'Bill of Lading',
);
$themeUrl = $this->themeUrl;
$cs = Yii::app()->getClientScript();
$cs_pos_end = CClientScript::POS_END;

$cs->registerScriptFile($themeUrl . '/js/datatables/jquery.dataTables.js', $cs_pos_end);
$cs->registerScriptFile($themeUrl . '/js/datatables/dataTables.bootstrap.js', $cs_pos_end);
?>
<div class="col-lg-12 col-md-12">
    <div class="row">
        <div class="col-lg-4 col-md-4 row">
            <div class="form-group">
                <label class="control-label">Search: </label>
                <input type="text" class="form-control inline" name="base_table_search" id="base_table_search" />
            </div>
        </div>
        <?php echo CHtml::link('<i class="fa fa-plus"></i>&nbsp;&nbsp;Create BillLading', array('/site/billlading/create'), array('class' => 'btn btn-success pull-right')); ?>
    </div>
</div>

<div class="col-lg-12 col-md-12">
    <div class="row">
<?php
        $gridColumns = array(
//		'bl_number',
		'blPo.purchase_order_code',
		'blInvoice.inv_no',
		'blCompany.company_name',
		'blVendor.vendor_name',
		'blLiner.liner_name',
		array(
                'header' => 'Actions',
                'class' => 'booster.widgets.TbButtonColumn',
                'htmlOptions' => array('style' => 'width: 180px;;text-align:center', 'vAlign' => 'middle', 'class' => 'action_column'),
                'template' => '{view}{update}{delete}',
            )
            );

//            $this->widget('booster.widgets.TbExtendedGridView', array(
//            'type' => 'striped bordered datatable',
//            'dataProvider' => $model->dataProvider(),
//            'responsiveTable' => true,
//            'template' => '<div class="panel panel-primary"><div class="panel-heading"><div class="pull-right">{summary}</div><h3 class="panel-title"><i class="glyphicon glyphicon-book"></i>  Bill of Lading</h3></div><div class="panel-body">{items}{pager}</div></div>',
//            'columns' => $gridColumns
//                )
//        );
//            
                $groupGridColumns = $gridColumns;
    $groupGridColumns[] = array(
        'name' => 'firstLetter',
        'value' => '$data->bl_number',
        'headerHtmlOptions' => array('style'=>'display:none'),
        'htmlOptions' =>array('style'=>'display:none')
    );
     
    $this->widget('booster.widgets.TbGroupGridView', array(
//        'filter'=>$model->search(),
        'type'=>'striped bordered',
        'dataProvider' => $model->dataProvider(),
        'template' => '<div class="panel panel-primary"><div class="panel-heading"><div class="pull-right">{summary}</div><h3 class="panel-title"><i class="glyphicon glyphicon-book"></i>  Bill of Lading</h3></div><div class="panel-body">{items}{pager}</div></div>',
        'extraRowColumns'=> array('firstLetter'),
        'extraRowExpression' => '"<b style=\"font-size: 1.5em; color: #333;\">BOL: ".$data->bl_number."</b>"',
        'extraRowHtmlOptions' => array('style'=>'padding:10px'),
        'columns' => $groupGridColumns
    ));
        ?>
    </div>
</div>