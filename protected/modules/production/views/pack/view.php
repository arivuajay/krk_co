<?php 
$this->hiddenpath = '/production/pack/index';
?>
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'quote-form',
	'enableAjaxValidation'=>false,
)); 
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
		<th><?php echo Myclass::t('Pick Qty');?></th>
		<th><?php echo Myclass::t('Pack Qty');?></th>
		<th><?php echo Myclass::t('Pallete / Box Identifier');?></th>
		<th><?php echo Myclass::t('Remarks');?></th>
	</tr>
    </thead>
    <tbody>
	<?php
	$i = 0;
	foreach($quoteproducts as $key => $product):
	    if(!isset($_POST['Pack'])):
		$save_pack = Myclass::getSavePack($so->so_id, $product->product->product_id);
		$pack_value = ($save_pack->pack_qty > 0)? $save_pack->pack_qty :0;
		$boxid_value = @$save_pack->box_id;
		$remarks_value = @$save_pack->remarks;
	    endif;
	?>
	<tr>			 
		<td><?php echo $i+1;?></td>
		<td><?php echo ucwords($product->product->name); ?></td>
		<td><?php echo ucwords($product->product->productClass->name); ?></td>
		<td><?php echo $product->quantity; ?></td>
		<td>
		    <?php echo $form->textField($model,"pack_qty[{$product->product->product_id}]",array('class'=>'input-mini','value'=>$pack_value)); ?>
		    <?php echo $form->hiddenField($model,"actual_qty[{$product->product->product_id}]",array('value'=>$product->quantity)); ?>
		</td>
		<td>
		    <?php echo $form->textField($model,"box_id[{$product->product->product_id}]",array('class'=>'input-medium','value'=>$boxid_value)); ?>
		</td>
		
		<td>
		    <?php echo $form->textField($model,"remarks[{$product->product->product_id}]",array('class'=>'input-medium','value'=>$remarks_value)); ?>
		</td>
	</tr>
	<?php $i++;	endforeach; ?>
    </tbody>
    <?php
     echo CHtml::submitButton(Myclass::t('Pack Release'),array('class'=>'quote_sub','name'=>'pack_release'));
     echo CHtml::submitButton(Myclass::t('Save Pack'),array('class'=>'quote_sub','name'=>'save_pack'));
     echo CHtml::linkButton(Myclass::t('Cancel'),array('class'=>'quote_sub','href'=>'/production/pick/index'));
    ?>
</table>
<?php 
echo $form->hiddenField($model,'salesord_id',array('value'=>$_REQUEST['id']));
$this->endWidget(); 
?>

