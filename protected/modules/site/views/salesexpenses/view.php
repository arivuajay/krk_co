<?php
/* @var $this SalesexpensesController */
/* @var $model SalesExpenses */

$this->title = 'View #' . $model->sale_exp_id;
$this->breadcrumbs = array(
    'Sales Expenses' => array('index'),
    'View ' . 'SalesExpenses',
);
?>
<div class="user-view">
    <?php
    $this->widget('zii.widgets.CDetailView', array(
        'data' => $model,
        'htmlOptions' => array('class' => 'table table-striped table-bordered'),
        'attributes' => array(
            array(
                'name' => 'Product Family',
                'value' => $model->product->proFamily->pro_family_name
            ),
            array(
                'name' => 'product_id',
                'value' => $model->product->pro_name
            ),
            'sale_exp_date',
            'sale_exp_amount',
            'sale_exp_remarks',
            'sales_exp_cust_name',
            'sales_exp_address',
        ),
    ));
    ?>
</div>



