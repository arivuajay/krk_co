<?php
echo CHtml::script('$(document).ready(function() {
			$("#list-table").dataTable({
			    "aoColumns": [{ "asSorting": [ "desc", "asc" ] },null,null,null,null,null],
			    "aoColumnDefs": [{ \'bSortable\': false, \'aTargets\': [ 5 ] }],
			    "sDom": "<\'row-fluid\'<\'span6\'l><\'span6\'f>r>t<\'row-fluid\'<\'span6\'i><\'span6\'p>>",
   			    "sPaginationType": "bootstrap",
			    "oLanguage": {"sLengthMenu": "_MENU_ records per page","sInfo": "Showing _START_ to _END_ of _TOTAL_ records"}
			});
		    });');
?>

<h1><?php echo Myclass::t('View Product');?></h1>
<?php


$form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
));
?>
<table  border="0" cellspacing="0"  class="table table-bordered table-striped" id="list-table" cellpadding="0">
    <thead>
	<tr class="tablehead">
		<th><?php echo Myclass::t('SKU');?>#</th>
		<th><?php echo Myclass::t('Product Name');?></th>
		<th><?php echo Myclass::t('Category');?></th>
		<th><?php echo Myclass::t('Sub Category');?></th>
		<th><?php echo Myclass::t('Image');?></th>
		<th><?php echo Myclass::t('Actions');?></th>
	</tr>
    </thead>
    <tbody>
	<?php
       $i = 0;
	foreach($product as $pro):
	?>
	<tr>
		<td>
                <?php echo $pro->sku;?></td>
                <td>
                <?php echo CHtml::link(ucwords($pro->name),array('/products/product/create','prodid'=>$pro->product_id),
			array('title'=>Myclass::t('View'),'rel'=>'tooltip'));?></td>

		<td><?php echo Myclass::getCategoryName($pro->productCategories[$i]['category_id']);?></td>
		<td><?php echo Myclass::getCategoryName($pro->productCategories[$i]['sub_category_id']); ?></td>
		
		<td valign="top"><div class="img_bg input-mini pagination-centered"><?php echo CHtml::image($baseUrl.PRO_IMAGE_PATH.$pro->image_path,$pro->name); ?></div></td>
		<td>

		<!-- Update / edit -->

                <?php
		echo CHtml::link('<i class="cus-icon-pencil"></i>',array('/products/product/create','prodid'=>$pro->product_id),
		    array('title'=>Myclass::t('Edit'),'rel'=>'tooltip'));
		echo CHtml::link('<i class="icon-trash"></i>',array('/products/product/deleteproduct','prodid'=>$pro->product_id),
			array('onclick'=>"return confirm('".Myclass::t('Are you sure you want to delete')."?')",'title'=>Myclass::t('Delete'),'rel'=>'tooltip')); 
		?>
        	</td>
	</tr>

	<?php  endforeach; $i++; ?>
    </tbody>
</table>
<?php $this->endWidget(); ?>

