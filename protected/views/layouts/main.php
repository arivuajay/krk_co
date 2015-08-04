<!DOCTYPE html>	
<html>
<head>
<meta charset="utf-8">    
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!--<meta name="google-translate-customization" content="b07be5cca51f670a-c85b7afa8565bfdc-gbbf5e76db42900bf-11" />-->
<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<!--<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', includedLanguages: 'es,en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, autoDisplay: false}, 'google_translate_element');
}

</script>
<script type="text/javascript" src="http://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>-->
 
</head>

<body>
<section class="container-fluid">
	<div id="top_header">
	    <div class="logo"><?php    echo CHtml::image(SITE_LOGO,Yii::app()->name); ?></div>
	    <div class="top_welcome"><span class="wcm">Welcome</span> <span><?php echo ucfirst(Yii::app()->user->getState('username')); ?></span> 
		<br />
		<p class="logout"><?php echo CHtml::link(Myclass::t('logout'),array('/site/logout'),array('class'=>'logout_link')); ?></p>
		<br />
<!--		<p class="clean_cache"><?php // echo CHtml::ajaxLink('Clean Cache', array('/site/cleancache'), array('type' =>'POST','success' => "function( data ){ alert( data ); }" )); ?></p>-->
		<?php
		//shortcut
		$translate=Yii::app()->translate;
		//in your layout add
		echo $translate->dropdown();
		//adn this
		//if($translate->hasMessages()){
		//  //generates a to the page where you translate the missing translations found in this page
		//  echo $translate->translateLink('Translate');
		//  //or a dialog
		//  echo $translate->translateDialogLink('Translate','Translate page title');
		//}
		//link to the page where you edit the translations
		echo '<br />';
		echo $translate->editLink('Update Translations');
		echo '&nbsp;';
		//link to the page where you check for all unstranslated messages of the system
		echo $translate->missingLink('Missing Translations');
		?>
<!--		<div id="google_translate_element"></div>-->
	    </div>
	</div>
	<div id="main_menu">
    <?php 
    $this->widget('bootstrap.widgets.BootNavbar', array(
    'fixed'=>false,
    'brand'=>false,
    'collapse'=>true, // requires bootstrap-responsive.css
    'htmlOptions'=>array('class'=>'topmenu'),
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.BootMenu',
	    'checkAccess'=>true,
            'items'=>array(
			array('label'=>Myclass::t('HOME'),'url'=>'#','items'=>array(
			    array('label'=>Yii::t('default','HOME'), 'url'=>array('/home/default/index')),
			    array('label'=>Yii::t('default','INBOX'), 'url'=>array('/message/inbox/inbox')),
			    array('label'=>Yii::t('default','My Tasks'), 'url'=>array('/home/default/tasks')),
			    array('label'=>Yii::t('default','My Txn Updates'), 'url'=>array('/home/default/updates'))
			),'itemOptions'=>array('class'=>'home')),
			array('label'=>Myclass::t('Users'), 'url'=>'#', 'items'=>array(
			    array('label'=>Yii::t('default','Create User'), 'url'=>array('/user/default/create')),
			    array('label'=>Yii::t('default','View Users'), 'url'=>array('/user/default/index')),
			    array('label'=>Yii::t('default','Manage Role Permission'), 'url'=>array('/user/default/managerole'))
			),'itemOptions'=>array('class'=>'user')),
			array('label'=>Yii::t('default','Sales'), 'url'=>'#','items'=>array(
			    array('label'=>Yii::t('default','Company')),
			    array('label'=>Yii::t('default','Create Company'), 'url'=>array('/sales/default/createcompany')),
			    array('label'=>Yii::t('default','View Company'), 'url'=>array('/sales/default/viewcompanies')),
			    array('label'=>Yii::t('default','Quotes')),
			    array('label'=>Yii::t('default','Create a quote'), 'url'=>array('/sales/quote/create')),
			    array('label'=>Yii::t('default','My Quotes'), 'url'=>array('/sales/quote/myquotes')),
			    array('label'=>Yii::t('default','Sales Orders')),
			    array('label'=>Yii::t('default','Create SO'), 'url'=>array('/sales/salesorder/create')),
			    array('label'=>Yii::t('default','My SO'), 'url'=>array('/sales/salesorder/view')),
			    array('label'=>Yii::t('default','Sample Request')),
			    array('label'=>Yii::t('default','Create Sample Request'), 'url'=>array('/sales/sample/create')),
			    array('label'=>Yii::t('default','My Sample Request'), 'url'=>array('/sales/sample/view')),
			),'itemOptions'=>array('class'=>'sales')),
			array('label'=>Yii::t('default','Products'), 'url'=>'#','items'=>array(
			    array('label'=>Yii::t('default','Products')),
			    array('label'=>Yii::t('default','Add Product'),'url'=>array('/products/product/create')),
			    array('label'=>Yii::t('default','View Product'),'url'=>array('/products/product/view')),			    
			    array('label'=>Yii::t('default','Product Category'),'url'=>array('/products/category/index')),
			    array('label'=>Yii::t('default','Import'), 'url'=>Yii::app()->createUrl('/importcsv/default/index')),
			    array('label'=>Yii::t('default','Items')),
			    array('label'=>Yii::t('default','View Items'),'url'=>array('/products/items/index')),
			    array('label'=>Yii::t('default','Add Items'), 'url'=>array('/products/items/create')),
			),'itemOptions'=>array('class'=>'products')),
			array('label'=>Yii::t('default','Production'), 'url'=>'#','items'=>array(
			    array('label'=>Yii::t('default','Production')),
			    array('label'=>Yii::t('default','Pick'),'url'=>array('/production/pick/index')),
			    array('label'=>Yii::t('default','Pack'),'url'=>array('/production/pack/index')),
			    array('label'=>Yii::t('default','Ship'),'url'=>array('/production/ship/index')),
			),'itemOptions'=>array('class'=>'production')),
			array('label'=>Yii::t('default','Finance'), 'url'=>'#','items'=>array(
			    array('label'=>Yii::t('default','Finance')),
			    array('label'=>Yii::t('default','Invoices'),'url'=>array('/finance/invoice/index')),
			    array('label'=>Yii::t('default','Memo'),'url'=>array('/finance/memo/past')),
			    array('label'=>Yii::t('default','Payments'),'url'=>array('/finance/invoice/induepayments')),
			    array('label'=>Yii::t('default','Account Summary'),'url'=>array('/finance/invoice/accountsummary')),
			),'itemOptions'=>array('class'=>'finance')),
			array('label'=>Yii::t('default','Procurement'), 'url'=>'#','items'=>array(
			    array('label'=>Yii::t('default','PO Requests')),
			    array('label'=>Yii::t('default','Create PO Requests'),'url'=>array('/procurement/po/create')),
			    array('label'=>Yii::t('default','Past PO Requests'),'url'=>array('/procurement/po/past')),
			    array('label'=>Yii::t('default','Manual PO'),'url'=>array('/procurement/po/manualpo')),
			    array('label'=>Yii::t('default','Vendors')),
			    array('label'=>Yii::t('default','Setup Vendor'),'url'=>array('/procurement/vendor/create')),
			    array('label'=>Yii::t('default','Vendor List'),'url'=>array('/procurement/vendor/index')),
			),'itemOptions'=>array('class'=>'procurement')),
			array('label'=>Yii::t('default','Settings'),  'url'=>'#','items'=>array(
			    array('label'=>Yii::t('default','Settings')),
			    array('label'=>Yii::t('default','Role'),'url'=>array('/settings/role/index')),
			    array('label'=>Yii::t('default','Application'),'url'=>array('/settings/sitesettings/index')),
			    array('label'=>Yii::t('default','Product'),'url'=>array('/settings/productclass/index')),
			),'itemOptions'=>array('class'=>'settings')),		                    
            ),
        ),
	    ),
    )); 
    ?>
	</div><!-- logo_menu -->
	
	<div class="container">
	<?php echo $content; ?>
	</div>
	<footer>
		<div id="footer">
			<p><?php echo Yii::t('default','Copyright');?> &copy; <?php echo date('Y').' by '. Yii::app()->name; ?><br/><?php echo Yii::t('default','All Rights Reserved');?>.</p>
		</div>
	</footer>

</section><!-- page -->
</body>
	
<?php
$baseurl = Yii::app()->getBaseUrl(true);
$cs = Yii::app()->getClientScript();

$cs->registerCssFile($baseurl.'/jqtable/css/DT_bootstrap.css');
$cs->registerCssFile($baseurl.'/css/style.css');
$cs->registerCssFile($baseurl.'/css/dev.css');

$cs->registerScriptFile($baseurl.'/js/html5.js');
$cs->registerScriptFile($baseurl.'/jqtable/js/jquery.dataTables.min.js');
$cs->registerScriptFile($baseurl.'/js/jquery.dataTables.columnFilter.js');
$cs->registerScriptFile($baseurl.'/jqtable/js/DT_bootstrap.js');
$cs->registerScriptFile($baseurl.'/js/application.js');

$cs->registerScriptFile($baseurl.'/js/common.js');

$cs->registerScriptFile($baseurl.'/js/jquery.calculation.min.js');    
$cs->registerScriptFile($baseurl.'/js/jquery.format.js');

$cs->registerScriptFile($baseurl.'/js/template.js');

?>
</html>