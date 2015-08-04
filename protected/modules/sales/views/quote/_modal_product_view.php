<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <?php echo CHtml::image(SML_SITE_LOGO); ?>
    <h3><?php echo $data->name; ?> Detail</h3>
</div>

<div class="modal-body modal-product-detail">
    <div class="short_desc">
	<span><label><?php echo Myclass::t('SKU'); ?></label><?php echo $data->sku; ?></span>
	<span><label><?php echo Myclass::t('Category'); ?></label><?php foreach ($data->productCategories as $pro_category)
	echo $pro_category->category->name; ?></span>
	<span><label><?php echo Myclass::t('Sub-category'); ?></label><?php foreach ($data->productCategories as $pro_category)
	echo $pro_category->subcategory->name; ?></span>
	<span><label><?php echo Myclass::t('Weight'); ?></label><?php echo $data->weight; ?></span>
	<span><label><?php echo Myclass::t('Product Class'); ?></label><?php echo $data->productClass->name; ?></span>
	<div class="long_desc">
	    <p><?php echo strip_tags($data->description); ?></p>
	</div>
    </div>
    <div class="image">
<?php echo CHtml::image($baseUrl . PRO_LARGE_IMAGE_PATH . $data->image_path, $data->name); ?>
    </div>
</div>

<div class="modal-footer">
    <?php
    $this->widget('bootstrap.widgets.BootButton', array(
	'label' => 'Close',
	'url' => '#',
	'htmlOptions' => array('data-dismiss' => 'modal'),
    ));
    ?>
</div>