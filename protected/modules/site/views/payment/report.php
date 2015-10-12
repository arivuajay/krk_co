<?php
/* @var $this PurchaseorderController */
/* @var $dataProvider CActiveDataProvider */

$this->title = 'Payment Report';
$this->breadcrumbs = array(
    $this->title,
);
$themeUrl = $this->themeUrl;
$cs = Yii::app()->getClientScript();
$cs_pos_end = CClientScript::POS_END;

//$get_report = Yii::app()->createAbsoluteUrl('/site/default/report', array('xml' => 'VENDOR_BALANCE_SHEET'));
$get_report = Yii::app()->createAbsoluteUrl('/site/default/report', array('xml' => 'PAYMENT_REPORT'));
?>

<div id="report_area"></div>

<?php
$js = <<< EOD
    $(document).ready(function () {
        $.get("$get_report", function (data, status) {
            $('#report_area').html(data);
        });
    });
EOD;
$cs->registerScript('_po_report', $js);
?>