<?php
if(!empty($avail_images)):
    echo '<h3>'.Myclass::t('Available Images').'</h3>';
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'inventory-form',
	'action' => Yii::app()->createUrl("/products/product/productactions"),  //<- your form action here

));
foreach($avail_images as $key => $avail): 
    $status = ($avail->is_active) ? "ok" : "minus";
    $primary = ($avail->is_primary) ? "on" : "off";

?>    
    <div class="span2">
	<div class="span10 pagination-centered">
	    <?php echo CHtml::link(CHtml::image(IMAGE_FOLDER."radio-button_$primary.png",'<i class="icon-hdd"></i>'),array('/products/product/productactions','prodid'=>$avail->prod_id,'id' => $avail->prod_img_id, 'action' => 'primary_set')); ?>	    
	</div>
	<div class="span12 pagination-centered"><?php echo CHtml::image(PRO_LARGE_IMAGE_PATH.$avail->prod_image); ?></div>
	<div class="span10">
	    <div class="pull-left"><?php echo CHtml::link('<i class="icon-'.$status.'-sign"></i>',array('/products/product/productactions','prodid'=>$avail->prod_id,'id' => $avail->prod_img_id, 'action' => 'updatestatus','status'=>$avail->is_active)); ?></div>
	    <div class="pull-right"><?php echo CHtml::link('<i class="icon-trash"></i>',array('/products/product/productactions','prodid'=>$avail->prod_id,'id' => $avail->prod_img_id, 'action' => 'remove'),
			array('onclick'=>"return confirm('".Myclass::t('Are you sure you want to delete')."?')",'title'=>Myclass::t('Delete'),'rel'=>'tooltip')); ?></div>
	</div>	
    </div>
<?php 
endforeach; 
$this->endWidget();
endif;
?>