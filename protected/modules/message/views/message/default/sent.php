<h1>Messages</h1>
<?php echo $this->renderPartial('//layouts/_message_tabs'); ?>

<h2><?php echo MessageModule::t('Sent'); ?></h2>

<?php if ($messagesAdapter->data): ?>
	<?php $form = $this->beginWidget('CActiveForm', array(
		'id'=>'message-delete-form',
		'enableAjaxValidation'=>false,
		'action' => $this->createUrl('delete/')
	)); ?>

	<table class="dataGrid mail_box">
		<tr>
			<th  class="label mail_check"><input type="checkbox" /></th>
			<th  class="label">To</th>
			<th  class="label">Subject</th>
			<th  class="label">Date</th>
		</tr>
		<?php foreach ($messagesAdapter->data as $index => $message): ?>
			<tr>
				<td class="mail_check">
					<?php echo CHtml::checkBox("Message[$index][selected]"); ?>
				</td>
				<td>
					<?php echo $form->hiddenField($message,"[$index]id"); ?>
					<?php echo $message->getReceiverName() ?>
				</td>
				<td><a href="<?php echo $this->createUrl('view/', array('message_id' => $message->id)) ?>"><?php echo $message->subject ?></a></td>
				<td><span class="date"><?php echo date(Yii::app()->getModule('message')->dateFormat, strtotime($message->created_at)) ?></span></td>
			</tr>
		<?php endforeach ?>
	</table>

	<div class="row buttons cmn_btn">
		 <?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'type'=>'danger', 'icon'=>'trash white', 'label'=>MessageModule::t("Delete Selected"))); ?>
		<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'reset','label'=>MessageModule::t("Cancel"))); ?>
	</div>

	<?php $this->endWidget(); ?>

	<?php $this->widget('CLinkPager', array('pages' => $messagesAdapter->getPagination())) ?>
<?php endif; ?>
