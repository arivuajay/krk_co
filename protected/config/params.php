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
    'JS_USER_DATE_FORMAT' => 'mm/dd/yyyy',
    'PHP_USER_DATE_FORMAT' => 'm/d/Y',

    //Product Settings
    'UPLOAD_DIR' => 'uploads',
    'EMAILHEADERIMAGE' => '/themes/adminlte/img/header-logo.png',

    'PAGE_SIZE' => '10',

    'SITENAME' => 'Wipocos',

);

