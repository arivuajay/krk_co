<h1><?php echo Myclass::t('Update Sitesettings');?> <?php echo $model->settings_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>