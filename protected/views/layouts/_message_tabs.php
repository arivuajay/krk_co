<?php 
if (Yii::app()->getModule('message')->getCountUnreadedMessages(Yii::app()->user->getId())): 
	$inboxcount =  "<span class='new_counts'>".Yii::app()->getModule('message')->getCountUnreadedMessages(Yii::app()->user->getId())."</span>";
endif;
$this->widget('bootstrap.widgets.BootMenu', array(
    'type'=>'tabs', // '', 'tabs', 'pills' (or 'list')
    'htmlOptions'=>array('id'=>'message_tab'),
    'stacked'=>false, // whether this is a stacked menu
    'encodeLabel'=>false,
    'items'=>array(
        array('label'=>$inboxcount." ".Yii::t('default','Inbox'),'url'=>array('/message/inbox/inbox')),
        array('label'=>Yii::t('default','Sent'),'url'=>array('/message/sent/sent')),
	array('label'=>Yii::t('default','Compose'), 'url'=>array('/message/compose/compose')),
    ),
)); 
if($this->id <> "inbox")
echo CHtml::script("$(document).ready(function(){ $('ul#message_tab li:first').removeClass('active'); });");

