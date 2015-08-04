<?php 
$this->pageTitle=Yii::app()->name . ' - Forgot Password';
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
)); 
?>
<fieldset>
    <?php echo $form->textField($model, 'email', array('class'=>'span3','placeholder'=>$model->getAttributeLabel('email'))); ?>
	<?php echo $form->error($model, 'email'); ?>
	<div class="form-actions">
	</br>
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>
	</br>
    <div class="control-group ">
		<div class="controls">
			<?php echo CHtml::link(Yii::t('user','BACK_TO_LOGIN'), array('/site/login')); ?>
		</div>
    </div>
</fieldset>
<?php $this->endWidget(); ?>



