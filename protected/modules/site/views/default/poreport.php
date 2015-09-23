<?php
/* @var $this ExpenseController */
/* @var $dataProvider CActiveDataProvider */

$this->title = 'PO Report';
$this->breadcrumbs = array(
    'PO Report',
);
$get_report = Yii::app()->createAbsoluteUrl('/site/default/report');
?>
<div id="report_area">
    
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $.get("<?php echo $get_report?>", function (data, status) {
            $('#report_area').html(data);
        });
    });
</script>