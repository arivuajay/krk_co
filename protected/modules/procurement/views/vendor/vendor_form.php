<?php
$this->hiddenpath = '/procurement/vendor/create';
//var_dump($this->data);
echo CHtml::css(".tab-content{overflow:hidden;}");
if(!$this->data['model']->ven_id):
echo CHtml::script("$(document).ready(function(){
    $('a[href=\'#vendor_tab_tab_2\'],a[href=\'#vendor_tab_tab_3\']').click(function(){
	alert('".Myclass::t('Please Fill Vendor Profile First')."');
	return false;
    });
});");
    $title = '<h1>'.Myclass::t('Create Vendor').'</h1>';
    $tab2_content = Myclass::t('Before Save Your Vendor Information');
    $tab3_content = Myclass::t('Before Save Your Vendor Information');
else:
    $title = "<h1>{$this->data['model']->ven_name} ".Myclass::t('Details')."</h1>";
    $tab2_content = $this->renderPartial('_ven_contact',$this->data,true);
    $tab3_content = $this->renderPartial('_assign_price',$this->data,true);
endif;

echo $title;
$this->widget('bootstrap.widgets.BootAlert');

$this->widget('bootstrap.widgets.BootTabbable',array(
    'activeTab'=>$this->data['acttab'],
    'id'=>'vendor_tab',
    'tabs'=>array(
        'tab1'=>array(
            'label'=>Myclass::t('Profile'),
            'content'=>$this->renderPartial('_create_vendor',$this->data,true),
        ),
        'tab2'=>array(
            'label'=>Myclass::t('Contacts'),
            'content'=>$tab2_content,
        ),
        'tab3'=>array(
            'label'=>Myclass::t('Assign Price'),
	    'content'=>$tab3_content,
        )
    ),
));
?>
