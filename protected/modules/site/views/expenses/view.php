<?php
/* @var $this ExpensesController */
/* @var $model Expenses */

$this->title = 'View #' . $model->exp_id;
$this->breadcrumbs = array(
    'Expenses' => array('index'),
    'View ' . 'Expenses',
);
?>
<div class="user-view">
    <?php
    $this->widget('zii.widgets.CDetailView', array(
        'data' => $model,
        'htmlOptions' => array('class' => 'table table-striped table-bordered'),
        'attributes' => array(
//		'exp_id',
            'exp_name',
            'exp_amount',
            'exp_remarks',
            array(
                'name' => 'exp_type',
                'value' => $model->getExpensetypelist($model->exp_type)
            ),
        ),
    ));
    ?>
</div>



