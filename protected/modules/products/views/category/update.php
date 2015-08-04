<div class="create_user">
    <h1><?php echo Myclass::t('Update Category');?> : <?php echo $model->name; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'pid'=>0)); ?>
</div>