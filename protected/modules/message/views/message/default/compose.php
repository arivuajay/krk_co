<h1>Messages</h1>
<?php echo $this->renderPartial('//layouts/_message_tabs'); ?>
<h2><?php echo MessageModule::t('Compose New Message'); ?></h2>

<div class="form" style="margin-left:25px;">
	<?php $form = $this->beginWidget('CActiveForm', array(
		'id'=>'message-form',
		'enableAjaxValidation'=>false,
	)); ?>

	<?php echo $form->errorSummary($model,''); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'receiver_id'); ?>
		<?php echo CHtml::textField('receiver', $receiverName) ?>
		<?php echo $form->hiddenField($model,'receiver_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'subject'); ?>
		<?php echo $form->textField($model,'subject'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'body'); ?>
		<?php
		$this->widget('application.extensions.eckeditor.ECKEditor', array(
					'model'=>$model,
					'attribute'=>'body',
					'config' => array(
					'width'=>'70%',
					'height'=>'250px',
					'toolbar'=>array(
					array('Bold','Italic','Underline','Strike','-','NumberedList','BulletedList','-','Outdent','Indent','Blockquote','-','Link','Unlink','-','Table','SpecialChar','-','Cut','Copy','Paste','-','Undo','Redo',),
					),
					),

					));
		?>
		<?php // echo $form->textArea($model,'body'); ?>
		<?php echo $form->error($model,'body'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton(MessageModule::t("Send"),array("class"=>"btn btn-primary")); ?>
		<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'reset','label'=>MessageModule::t("Cancel"))); ?>
	</div>

	<?php $this->endWidget(); ?>

</div>

<?php $this->renderPartial(Yii::app()->getModule('message')->viewPath . '/_suggest'); ?>
<script type="text/javascript">
    $("input[type='reset'],button[type='reset']").live('click',function(){
	    CKEDITOR.instances.Message_body.setData("");
    });
</script>
