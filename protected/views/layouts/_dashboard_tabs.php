<?php 
$active_contacts = ($this->action->id=='updatecontact' || $this->action->id == 'addcontact')?true:false;
$new_count = ($this->data['newupdate_count'] > 0) ? "<span class='new_counts'>".$this->data['newupdate_count']."</span>" : '';
if (Yii::app()->getModule('message')->getCountUnreadedMessages(Yii::app()->user->getId())): 
	$inboxcount =  "<span class='new_counts'>".Yii::app()->getModule('message')->getCountUnreadedMessages(Yii::app()->user->getId())."</span>";
endif;
$this->widget('bootstrap.widgets.BootMenu', array(
    'type'=>'tabs', // '', 'tabs', 'pills' (or 'list')
    'stacked'=>false, // whether this is a stacked menu
    'encodeLabel'=>false,
    'items'=>array(
        array('label'=>$inboxcount.' Inbox','url'=>array('/message')),
        array('label'=>'My Task','#'),
	array('label'=>$new_count.' My Transaction Updates', 'url'=>array('/home/default/updates')),
    ),
)); 
?>

