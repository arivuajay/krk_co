<?php

$this->hiddenpath = "/products/product/view";

//Default Tabs After Creating SO
$enabled_tabs = array(
		'tab1'=>array(
		    'label'=>Myclass::t('Product Information'),
		    'content'=>$this->renderPartial('_proinfoview', array('productDetail'=>$productDetail,'productPrice'=>$productPrice,'productCategories'=>$productCategories),true,false),
		),
		'tab2'=>array(
		    'label'=>Myclass::t('Procurement Details'),
		    'content'=>$this->renderPartial('_pro_procure_view', array('procurement'=>$procurement),true,false),
		),
		'tab3'=>array(
		    'label'=>Myclass::t('BOM Details'),
		    'content'=>$this->renderPartial('_bom_detail_view', array('productDetail'=>$productDetail,'productBom'=>$productBom),true,false),
		),
		'tab4'=>array(
		    'label'=>Myclass::t('Images'),
		    'content'=>$this->renderPartial('_avail_images', array('avail_images'=>$avail_images),true,false),
		)
	);


$this->widget('bootstrap.widgets.BootTabbable',array(
    'activeTab'=>'tab1',
    'tabs'=>$enabled_tabs,
    'htmlOptions'=>array(
        'style'=>'width:auto;'
    )
));

?>
