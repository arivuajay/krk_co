<?php
// Custom Params Value
return array(
	//Global Settings
	'ENV'=>'development',
	'SITE_LOGO'=>'/images/logo.png',
	'SML_SITE_LOGO'=>'/images/sml_logo.png',
	'SITEURL'=> 'http://184.106.189.143:9007',
        //Registration Settings
        'REGISTER_ACTIVATION'=>false,
    
        //EMAIL Settings
        'SMTPHOST'=>'smtp.gmail.com',
        'SMTPPORT'=>'465',  // Port: 465 or 587 
        'SMTPUSERNAME'=>'arivuoptisol@gmail.com',
	'SMTPPASS'=>'9788686092',
        'SMTPAUTH'=>true,    // Auth : true or false
        'SMTPSECURE'=>'ssl', // Secure :tls or ssl
	
        'EMAILLAYOUT'=>'file',  // file(file concept) or db(db_concept)
        'EMAILTEMPLATE'=>'/mailtemplate/',
        'EMAILHEADERIMAGE'=>'/images/email-header.png',
        'INFOEMAIL'=>'info@empresasctm.com',
        'SITESUPPORTEMAIL'=>'support@empresasctm.com',
        'NOREPLYMAIL'=>'noreply@empresasctm.com',
        'CONTACTMAIL'=>'contact@empresasctm.com',
    
	//Product Settings
	'IMAGE_FOLDER'=>'/images/',
	'PRO_IMAGE_PATH'=>'/images/product_images/',
	'PRO_LARGE_IMAGE_PATH'=>'/images/product_images/large/',
	'PRO_DEFAULT_IMAGE'=>'default.jpg',
	'FORMAT_DATE'=>'Y-m-d',
	'JS_FORMAT_DATE'=>'yy-mm-dd',
	'QUOTE_PREFIX'=>'Q_',
	'SO_PREFIX'=>'SO_',
	'INVOICE_PREFIX'=>'INV_',
	'PAYMENT_PREFIX'=>'PAY_',
	'MANUAL_PREFIX'=>'MAN_',    
	'MEMO_PREFIX'=>'MEM_',
	'VENDOR_PREFIX'=>'VEN_',
	'PO_REQ_PREFIX'=>'PR_',
	'SAMPLE_PREFIX'=>'SAM_',
	'PO_PREFIX'=>'PO_',

	//base path
	'B_PATH'=>"/home/ctmsite/ctm/",
	'UPLOAD_PATH'=>"/upload/importCsv/",
	'FILE_PREFIX'=>'',
	'DOWNLOAD_PATH' => 'downloads/',
    
        //Notification Images
    	'NOTIFY_FINANCE_IMAGE'=>'/images/icons/notification/p_finance.png',
    	'NOTIFY_HOME_IMAGE'=>'/images/icons/notification/p_home.png',
    	'NOTIFY_PROCURMENT_IMAGE'=>'/images/icons/notification/p_procurment.png',
    	'NOTIFY_PRODUCTIONS_IMAGE'=>'/images/icons/notification/p_productions.png',
    	'NOTIFY_PRODUCTS_IMAGE'=>'/images/icons/notification/p_products.png',
    	'NOTIFY_SALES_IMAGE'=>'/images/icons/notification/p_sales.png',
    	'NOTIFY_SETTINGS_IMAGE'=>'/images/icons/notification/p_settings.png',
	'NOTIFY_USER_IMAGE'=>'/images/icons/notification/p_user.png',
);  
