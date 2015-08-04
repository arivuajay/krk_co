<?php 
$this->hiddenpath = "/message/sent/sent";
$this->pageTitle=Yii::app()->name . ' - ' . MessageModule::t("Compose Message"); 
$isIncomeMessage = $viewedMessage->receiver_id == Yii::app()->user->getId();
$this->breadcrumbs = array(
		MessageModule::t("Messages"),
		($isIncomeMessage ? MessageModule::t("Inbox") : MessageModule::t("Sent")) => ($isIncomeMessage ? 'inbox' : 'sent'),
		CHtml::encode($viewedMessage->subject),
	);
?>

<?php $this->renderPartial(Yii::app()->getModule('message')->viewPath . '/_navigation') ?>

<?php $form = $this->beginWidget('CActiveForm', array(
	'id'=>'message-delete-form',
	'enableAjaxValidation'=>false,
	'action' => $this->createUrl('delete/', array('id' => $viewedMessage->id))
)); ?>
	<div>
		<?php //echo MessageModule::t("Delete") ?>
		 <?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'type'=>'danger', 'icon'=>'trash white', 'label'=>MessageModule::t("Delete"))); ?>
	</div>
<?php $this->endWidget(); ?>
<table class="mail_box">
<tr>
<?php if ($isIncomeMessage): ?>
	<td class="message-from main_td">From </td>
	<td> <?php echo $viewedMessage->getSenderName() ?></td>
<?php else: ?>
	<td class="message-to main_td">To </td>
	<td> <?php echo $viewedMessage->getReceiverName() ?></td>
<?php endif; ?>
</tr>
<tr>
	<td class="message-subject main_td">Subject </td>
	<td><?php echo $viewedMessage->subject; ?></td>
</tr>
<tr>
	<td class="date main_td">Date </td>
	<td><?php echo date(Yii::app()->getModule('message')->dateFormat, strtotime($viewedMessage->created_at)) ?></td>
</tr>
<tr>
	<td class="main_td">Message	</td>
	<td>
		<div class="message-body">
			<?php echo $viewedMessage->body; ?>
		</div>
	</td>
</tr>
</table>
<h2><?php echo MessageModule::t('Reply') ?></h2>

<div class="form create_user">
	<?php $form = $this->beginWidget('CActiveForm', array(
		'id'=>'message-form',
		'enableAjaxValidation'=>false,
	)); ?>

	<?php echo $form->errorSummary($message); ?>

	<div class="row row-fluid">
		<?php echo $form->hiddenField($message,'receiver_id'); ?>
		<?php echo $form->error($message,'receiver_id'); ?>
	</div>

	<div class="row row-fluid">
		<?php echo $form->labelEx($message,'subject'); ?>
		<?php echo $form->textField($message,'subject'); ?>
		<?php echo $form->error($message,'subject'); ?>
	</div>

	<div class="row row-fluid">
		<?php echo $form->labelEx($message,'body'); ?>
		<?php echo $form->textArea($message,'body'); ?>
		<?php echo $form->error($message,'body'); ?>
	</div>

	<div class="row row-fluid buttons">
		<label>&nbsp;</label>
		<?php //echo CHtml::submitButton(MessageModule::t("Reply")); ?>
		 <?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>MessageModule::t("Reply"))); ?>
	</div>

	<?php $this->endWidget(); ?>
</div>
