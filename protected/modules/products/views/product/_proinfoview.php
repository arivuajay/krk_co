<?php
//print"<pre>";
//print_r($productCategories);exit;
//$pCategories = new ProductCategory();
?>


<table  border="0" cellspacing="0" width="50%"  class="table table-bordered table-striped" id="list-table" cellpadding="0">

    <tbody>
	<tr>
	    <td><?php echo CHtml::activeLabel($productDetail,'name'); ?></td>
	    <td><?php echo $productDetail->name;?></td>
	</tr>
	<tr>
	    <td><?php echo CHtml::activeLabel($productDetail,'weight'); ?></td>
	    <td><?php echo $productDetail->weight;?></td>
	</tr>

        <tr>
	    <td><?php echo Myclass::t('Product Price Details');?> </td>
	    <td>
		    <table  border="0" cellspacing="0" class="table table-bordered" cellpadding="0">
			<thead>
			    <tr class="tablehead">
				    <th><?php echo Myclass::t('S.No');?>#</th>
				    <th><?php echo Myclass::t('Price Range');?></th>
				    <th><?php echo Myclass::t('Price');?></th>
				    
			    </tr>
			</thead>
			<tbody>
			    <?php foreach($productPrice as $key => $price):
                                $range = Myclass::getPriceRangeValue($price->price_range_id);
                                ?>
			    <tr>
				    <td><?php echo $key+1;?></td>
                                    <td><?php echo $range[0]['range_from'].' - '.$range[0]['range_to']; ?></td>
                                    <td><?php echo $price->range_price; ?></td>
				    
			    </tr>
			    <?php endforeach; ?>
			</tbody>
		    </table>
	    </td>
	</tr>
        <tr>
	    <td><?php echo CHtml::activeLabel($productDetail,'description'); ?></td>
	    <td><?php echo $productDetail->description;?></td>
	</tr>
        <tr>
	    <td><?php echo CHtml::activeLabel($productDetail,'product_class_id'); ?></td>
            <td><?php echo Myclass::getProductClassName($productDetail->product_class_id);?></td>
	</tr>
        <tr>
	    <td><?php echo CHtml::activeLabel($productDetail,'created_date'); ?></td>
            <td><?php echo $productDetail->created_date;?></td>
	</tr>
        <tr>
	    <td><?php echo Myclass::t("Category"); ?></td>
            <td><?php echo Myclass::getCategoryName($productCategories[0]->category_id);?></td>
	</tr>
        <tr>
	    <td><?php echo Myclass::t("Sub Category"); ?></td>
            <td><?php echo Myclass::getCategoryName($productCategories[0]->sub_category_id);?></td>
	</tr>
	
    </tbody>
</table>
