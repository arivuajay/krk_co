<?php
/* @var $this ExpenseController */
/* @var $model Expense */

$this->title = 'View #' . $model->exp_id;
$this->breadcrumbs = array(
    'Expenses' => array('index'),
    'View ' . 'Expense',
);
?>
<div class="user-view">
    <?php
    $this->widget('zii.widgets.CDetailView', array(
        'data' => $model,
        'htmlOptions' => array('class' => 'table table-striped table-bordered'),
        'attributes' => array(
            'expType.exp_type_name',
            'expSubtype.exp_subtype_name',
            'exp_voucher',
            'exp_pay_mode',
            'exp_ref_no',
            'exp_bank_name',
            'exp_transaction_id',
            'exp_remarks',
            'exp_paid_amount',
            'exp_bol_no',
            array(
                'name' => 'exp_invoices',
                'value' => implode(', ', $model->exp_invoices),
            ),
            array(
                'name' => 'exp_containers',
                'value' => implode(', ', $model->exp_containers),
            ),
            'exp_agent_party'
        ),
    ));
    ?>
</div>



