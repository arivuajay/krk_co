<?php
$whitelist = array('127.0.0.1', '::1');
if (in_array($_SERVER['REMOTE_ADDR'], $whitelist)) {
    $mailsendby = 'smtp';
} else {
    $mailsendby = 'phpmail';
}

// Custom Params Value
return array(
    //Global Settings
    'EMAILLAYOUT' => 'file', // file(file concept) or db(db_concept)
    'EMAILTEMPLATE' => '/mailtemplate/',
    'MAILSENDBY' => $mailsendby,
    //EMAIL Settings
    'SMTPHOST' => 'smtp.gmail.com',
    'SMTPPORT' => '465', // Port: 465 or 587
    'SMTPUSERNAME' => 'marudhuofficial@gmail.com',
    'SMTPPASS' => 'ninja12345',
    'SMTPAUTH' => true, // Auth : true or false
    'SMTPSECURE' => 'ssl', // Secure :tls or ssl
    'NOREPLYMAIL' => 'noreply@krkinternational.com',
    'CONTACTMAIL' => 'contact@krkinternational.com',
    'JS_SHORT_DATE_FORMAT' => 'yy-mm-dd',
    'PHP_SHORT_DATE_FORMAT' => 'Y-m-d',

    //Product Settings
    'UPLOAD_DIR' => 'uploads',
    'EMAILHEADERIMAGE' => '/themes/adminlte/img/header-logo.png',

    'PAGE_SIZE' => '10',

    'SITENAME' => 'Wipocos',
    'EMAILHEADERIMAGE' => '',

    'DEFAULT_COUNTRY_ID' => '2',
    'DEFAULT_NATIONALITY_ID' => '2',
    'DEFAULT_LANGUAGE_ID' => '5',

    'DEFAULT_AUTHOR_RIGHT_HOLDER_ID' => '1',
    'DEFAULT_AUTHOR_GROUP_RIGHT_HOLDER_ID' => '1',
    'DEFAULT_AUTHOR_MANAGED_RIGHTS_TERRITORY_ID' => '8',


    'DEFAULT_PERFORMER_RIGHT_HOLDER_ID' => '1',
    'DEFAULT_PERFORMER_GROUP_RIGHT_HOLDER_ID' => '1',

    'DEFAULT_PUBLISHER_RIGHT_HOLDER_ID' => '23',
    'DEFAULT_PUBLISHER_GROUP_RIGHT_HOLDER_ID' => '2',

    'DEFAULT_PRODUCER_RIGHT_HOLDER_ID' => '3',
    'DEFAULT_PRODUCER_GROUP_RIGHT_HOLDER_ID' => '3',

    'DEFAULT_FACTOR_ID' => '5',
    'DEFAULT_TYPE_ID' => '4',
    'DEFAULT_RECORD_TYPE_ID' => '1',

    'DEFAULT_SOCIETY_ID' => '10',

    'DEFAULT_WORK_RIGHTHOLDER_AUTHOR_ROLE' => '7',
    'DEFAULT_WORK_RIGHTHOLDER_PERFORMER_ROLE' => '8',
);

