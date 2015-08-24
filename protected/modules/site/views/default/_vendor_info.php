<fieldset>
    <legend>Vendor Information</legend>
    <?php
    $this->widget('zii.widgets.CDetailView', array(
        'data' => $result,
        'attributes' => array(
            'vendor_code',
            'vendor_name',
            'vendor_address',
            'vendor_city',
            'vendor_country',
            'vendor_contact_person',
            'vendor_mobile_no',
            'vendor_office_no',
            'vendor_email',
            'vendor_website',
            'vendor_trade_mark',
            'vendor_remarks',
        ),
        'htmlOptions' => array('class' => 'table-condensed')
    ));
    ?>
</fieldset>


