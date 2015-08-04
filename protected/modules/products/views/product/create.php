<?php
//var_dump($this->data['ppModel']); exit;

if($this->data['prodid'] > 0):
    //$tab2_content = $this->renderPartial('_inventoryForm',$this->data,true);
else:
echo CHtml::script("$(document).ready(function(){
    $('a[href=\'#yw0_tab_2\']').click(function(){
	alert('".Myclass::t('Please Fill Product Information First')."');
	return false;
    });
});");
    $tab2_content = Myclass::t('Before Fill Product Info First');
endif;

//Default Tabs 
$enabled_tabs = array(
                    'tab1'=>array(
                    'label'=>Myclass::t('Product Information'),
                    'content'=>$this->renderPartial('_productForm',$this->data,true),
                    ),
                    'tab2'=>array(
                    'label'=>Myclass::t('Inventory Details'),
                    'content'=>$this->renderPartial('_inventoryForm',$this->data,true),
                    ),
	);

//BOM Tab when the product class type is assembled

if($this->data['model']->product_class_id == '2'):
    $enabled_tabs['tab3'] = array(
				'label'=>Myclass::t('BOM'),
				'content'=>$this->renderPartial('_bomForm',$this->data,true),
			    );

endif;
if($this->data['prodid'] > 0):
    $enabled_tabs['tab4'] = array(
				'label'=>Myclass::t('Product Images'),
				'content'=>$this->renderPartial('_prod_images',$this->data,true),
			    );
endif;

$this->widget('bootstrap.widgets.BootTabbable',array(
    'activeTab'=>$this->data['active_tab'],
    'tabs'=>$enabled_tabs,
    'htmlOptions'=>array(
        'style'=>'width:auto;'
    )
));

?>
