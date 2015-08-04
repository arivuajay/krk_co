<h1>Messages</h1>
<?php echo $this->renderPartial('//layouts/_message_tabs'); ?>
<?php $this->pageTitle=Yii::app()->name . ' - '.MessageModule::t("inbox"); ?>
<?php
	$this->breadcrumbs=array(
		MessageModule::t("Messages"),
		MessageModule::t("Inbox"),
	);
?>

<?php

echo CHtml::script('$(document).ready(function() {
			$("#list-table").dataTable({			   
			    "aoColumnDefs": [{ \'bSortable\': false, \'aTargets\': [ 0 ] }],
			    "sDom": "<\'row-fluid\'<\'span6\'l><\'span6\'f>r>t<\'row-fluid\'<\'span6\'i><\'span6\'p>>",
   			    "sPaginationType": "bootstrap",
			    "oLanguage": {"sLengthMenu": "_MENU_ records per page","sInfo": "Showing _START_ to _END_ of _TOTAL_ records"}
			});
		    });');
?>

<?php $this->renderPartial(Yii::app()->getModule('message')->viewPath . '/_navigation') ?>

<h2><?php //echo MessageModule::t('Inbox'); ?></h2>

<!--<table  border="0" cellspacing="0"  class="table table-bordered table-striped" <?php if ($messagesAdapter->data): ?> id="list-table" <?php endif; ?> cellpadding="0">
   	 <thead>
		<tr class="tablehead">
			<th width="4%"></th>			
			<th>From</th>
			<th>Subject</th>
			<th>Date</th>
		</tr>
	</thead>
--><?php if ($messagesAdapter->data): ?>
	<?php $form = $this->beginWidget('CActiveForm', array(
		'id'=>'message-delete-form',
		'enableAjaxValidation'=>false,
		'action' => $this->createUrl('delete/')
	)); ?>
	<div class="row buttons" style="margin-left:0px;">
		 <?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'type'=>'danger', 'icon'=>'trash white', 'label'=>MessageModule::t("Delete Selected"))); ?>
		 <?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'reset','label'=>MessageModule::t("Cancel"))); ?>
	</div>
	<table  border="0" cellspacing="0"  class="table table-bordered table-striped" <?php if ($messagesAdapter->data): ?> id="list-table" <?php endif; ?> cellpadding="0">
	   	 <thead>
			<tr class="tablehead">
				<th width="4%"></th>			
				<th><?php echo MessageModule::t('From'); ?></th>
				<th><?php echo MessageModule::t('Subject'); ?></th>
				<th><?php echo MessageModule::t('Date'); ?></th>
			</tr>
		</thead>
	
	 <tbody>
		<?php foreach ($messagesAdapter->data as $index => $message): ?>
			<tr class="<?php echo $message->is_read ? MessageModule::t('read') : MessageModule::t('unread') ?>">
				<td>
					<?php echo CHtml::checkBox("Message[$index][selected]"); ?>
					<?php echo $form->hiddenField($message,"[$index]id"); ?>
				</td>
				<td>
					<?php echo $message->getSenderName(); ?>
				</td>
				<td><a href="<?php echo $this->createUrl('view/', array('message_id' => $message->id)) ?>"><?php echo $message->subject ?></a></td>
				<td><span class="date"><?php echo date(Yii::app()->getModule('message')->dateFormat, strtotime($message->created_at)) ?></span></td>
			</tr>
		<?php endforeach ?>
	</tbody>
	</table>

	<div class="row buttons cmn_btn">
		<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'type'=>'danger', 'icon'=>'trash white', 'label'=>MessageModule::t("Delete Selected"))); ?>
		<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'reset','label'=>MessageModule::t("Cancel"))); ?>
	</div>

<?php $this->endWidget(); ?>
	<?php $this->widget('CLinkPager', array('pages' => $messagesAdapter->getPagination())) ?>
<?php else:  ?>
<table  border="0" cellspacing="0"  class="table table-bordered table-striped" <?php if ($messagesAdapter->data): ?> id="list-table" <?php endif; ?> cellpadding="0">
   	 <thead>
		<tr class="tablehead">
			<th width="4%"></th>			
			<th><?php echo MessageModule::t('From'); ?></th>
			<th><?php echo MessageModule::t('Subject'); ?></th>
			<th><?php echo MessageModule::t('Date'); ?></th>
		</tr>
	</thead>
<tbody><tr align="center"><td colspan="4" align="center"><?php echo MessageModule::t('No mail(s) found!'); ?></td></tr></tbody>
</table>
<?php endif; ?>



