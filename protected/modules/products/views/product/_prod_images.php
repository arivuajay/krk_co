<div class="create_user">
    <?php
    $this->widget('xupload.XUpload', array(
		'url' => Yii::app()->createUrl("/products/product/addimage",array("prodid"=>$model->product_id)),
		'model' => $image_model,
		'attribute' => 'file',
		'multiple' => true,
	));

    $this->renderPartial('_avail_images',$this->data);
    ?>
</div>