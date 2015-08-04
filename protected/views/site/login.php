<?php
$SiteUrl  = Yii::app()->getBaseUrl(true);
?>
<script type="text/javascript" src="<?php echo $SiteUrl;?>/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="<?php echo $SiteUrl;?>/js/jquery.placeholder-enhanced.min.js"></script>
<script type="text/javascript">
$(function(){
    $("input[placeholder], textarea[placeholder]").blur();
});
</script>
<?php
$this->pageTitle=Yii::app()->name . ' - Login';
?>


<?php 
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
)); 
//echo User::model()->encrypt('admin');
?>
<?php $this->widget('bootstrap.widgets.BootAlert'); ?>
<fieldset>
    <?php echo $form->textField($model, 'username', array('class'=>'span3','placeholder'=>$model->getAttributeLabel('username'))); ?>
	<?php echo $form->error($model, 'username'); ?>
	<?php echo $form->passwordField($model, 'password', array('class'=>'span3','placeholder'=>$model->getAttributeLabel('password'))); ?>
	<?php echo $form->error($model, 'password'); ?>
	<div class="remem">
	    <?php echo CHtml::activeCheckBox($model,'rememberMe'); ?>
		<span class="rbr">Remember me</span>
	</div>
	
	<div class="form-actions">
		<?php echo CHtml::submitButton('Login'); ?>
	</div>
    <div class="control-group ">
		<div class="controls">
			<?php echo CHtml::link(Yii::t('user','FORGET_PASSWORD'), array('/site/forgotpassword')); ?>
		</div>
    </div>
</fieldset>
<?php $this->endWidget(); ?>



