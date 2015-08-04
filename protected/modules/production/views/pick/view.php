<?php 
$this->hiddenpath = '/production/pick/index';
?>
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'quote-form',
	'enableAjaxValidation'=>false,
)); 
//var_dump($quoteproducts);
echo $form->errorSummary(array($model),''); 
if($form->errorSummary(array($model),'')):
    echo Yii::t('production','FORCEPROCEED');
endif;
?>
<table  border="0" cellspacing="0" class="table table-bordered" cellpadding="0">
    <thead>
	<tr class="tablehead">				 
		<th><?php echo Myclass::t('S.#');?></th>
		<th><?php echo Myclass::t('Product Name');?></th>
		<th><?php echo Myclass::t('Product Class');?></th>
		<th><?php echo Myclass::t('Order Qty');?></th>
		<th><?php echo Myclass::t('Inventory');?></th>
		<th><?php echo Myclass::t('Pick Qty');?></th>
		<th><?php echo Myclass::t('Actions');?></th>
	</tr>
    </thead>
    <tbody>
	<?php
	$i = 0;
	foreach($quoteproducts as $key => $product):
	    if(!isset($_POST['Pick'])):
		$pro_pick = $save_pick[$i];
		$pick_value = ($pro_pick > 0)? $pro_pick :0;
	    endif;
	    $require_qty = $product->quantity;
	    list($inventory_image,$inventor_status) = Myclass::getPickInventoryLevel($require_qty,$product->product->available_quantity,$product->product->re_order_limit);
	?>
	<?php if($product->product->productClass->product_class_id == '1'){ ?>
	<tr>				 
		<td><?php echo $i+1;?></td>
		<td><?php echo ucwords($product->product->name); ?></td>
		<td><?php echo ucwords($product->product->productClass->name); ?></td>
		<td style="text-align: center;"><?php echo $product->quantity; ?></td>
		<td style="text-align: center;"><?php echo CHtml::image(Yii::app()->getBaseUrl(true)."/images/$inventory_image.png"); ?></td>
		<td style="text-align: center;">
		    <?php echo $form->textField($model,"pick_qty[][{$product->product->product_id}]",array('class'=>'input-mini','value'=>$pick_value)); ?>
		    <?php echo $form->hiddenField($model,"actual_qty[][{$product->product->product_id}]",array('value'=>$product->quantity)); ?>
		    <?php echo $form->hiddenField($model,"product_class[][{$product->product->product_id}]",array('value'=>'1')); ?>
		</td>
		<td style="text-align: center;"><?php 
    		    echo CHtml::link(($inventor_status!= '1') ? Myclass::t("View Inventory") : Myclass::t("Request Inventory Refill") , array('/products/product/create','prodid'=>$product->product->product_id,'active_tab'=>'tab2'), 
				array('target'=>'_blank','title'=>Myclass::t('Read More'),'rel'=>'tooltip'));
//			echo CHtml::ajaxLink(($inventor_status) ? "View Inventory" : "Request Inventory Refill" , $this->createUrl('/production/pick/modal_inventory_product',array('id'=>$product->product->product_id,'soid'=>$so->so_id)), 
//				array('success'=>'function(r){$("#modal_inventory_product").html(r).modal("toggle"); return false;}'), 
//				array('title'=>'Read More','rel'=>'tooltip'));
		?></td>
	</tr>
	<?php $i++;} else { ?> 
	<tr>				 
		<td><?php echo $i+1;?></td>
		<td><?php echo ucwords($product->product->name); ?></td>
		<td><?php echo ucwords($product->product->productClass->name); ?></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<?php 
	if(isset($product->product->AssembleItems)):
	    foreach($product->product->AssembleItems as $item):
	    if(!isset($_POST['Pick'])):
		$pro_pick = $save_pick[$i];
		$pick_value = ($pro_pick > 0)? $pro_pick :0;
	    endif;
	    $require_qty = $product->quantity * $item->item_value;

	    list($item_inv_image,$item_inv_status) = Myclass::getPickInventoryLevel($require_qty,$item->item->available_quantity,$item->item->reorder_limit);
	    ?>
	<tr  class="border-disable">				 
		<td>&nbsp;</td>
		<td class="sub_items"><?php echo ucwords($item->item->name); ?></td>
		<td>&nbsp;</td>
		<td><?php echo $require_qty; ?></td>
		<td><?php echo CHtml::image(Yii::app()->getBaseUrl(true)."/images/$item_inv_image.png"); ?></td>
		<td>
		    <?php echo $form->textField($model,"pick_qty[][{$item->item->item_id}]",array('class'=>'input-mini','value'=>$pick_value)); ?>
		    <?php echo $form->hiddenField($model,"actual_qty[][{$item->item->item_id}]",array('value'=>$require_qty)); ?>
		    <?php echo $form->hiddenField($model,"product_class[][{$item->item->item_id}]",array('value'=>'2')); ?>
		</td>
		<td><?php 
    		    echo CHtml::link(($item_inv_status != '1') ? Myclass::t("View Inventory") : Myclass::t("Request Inventory Refill") , array('/products/items/placeprocurement','id'=>$item->item->item_id), 
				array('target'=>'_blank','title'=>Myclass::t('Read More'),'rel'=>'tooltip'));
		?></td>
	</tr>
	<?php $i++; endforeach; endif; ?>	
	<?php } ?>
	<?php endforeach; ?>
    </tbody>
    <?php
     echo CHtml::submitButton(Myclass::t('Pick Release'),array('class'=>'quote_sub','name'=>'pick_release'));
     echo CHtml::submitButton(Myclass::t('Save Pick'),array('class'=>'quote_sub','name'=>'save_pick'));
     echo CHtml::linkButton(Myclass::t('Cancel'),array('class'=>'quote_sub','href'=>'/production/pick/index'));
    ?>
</table>
<?php 
echo $form->hiddenField($model,'salesord_id',array('value'=>$_REQUEST['id']));
$this->endWidget(); 
?>

<?php 
Yii::app()->clientScript->registerCoreScript('jquery.ui');
Yii::app()->clientScript->registerCssFile(Yii::app()->clientScript->getCoreScriptUrl().'/jui/css/base/jquery-ui.css');

$this->beginWidget('bootstrap.widgets.BootModal', array('id'=>'modal_inventory_product')); $this->endWidget(); 
echo CHtml::css(".border-disable td{ border-top:none;padding:0 8px;vertical-align:middle;text-align:center;}");
?>