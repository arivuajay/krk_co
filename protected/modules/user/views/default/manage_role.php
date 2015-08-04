<?php
/* @var $this UserController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Manage Role Permission'
);

$form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
    'id'=>'horizontalForm',
    'type'=>'horizontal',
)); 

echo $form->errorSummary(array($model),'');
?>
<fieldset>
	<div class="manage_role">
		<h1>Manage Role Permission</h1>
		<div class="control-group">
			<?php echo $form->labelEx($model,'name',array('class'=>'control-label')); ?>
			<?php $selected_roles = array($_REQUEST['role_id']=>array('selected'=>'selected')); //Array ( [2] => Array ( [selected] => selected ) ) ?>    
			<div class="controls">
			<?php echo $form->dropDownList($model,'name', CHtml::listData(Myclass::ActiveRoles(), 'role_id', 'name'), array('empty'=>'Select Role','options'=>$selected_roles,'onchange'=>'javascript: document.location.href="/user/default/managerole/role_id/"+$(this).val();')); ?>
			</div>
		</div>
		
		<div class="row-fluid">
			<table class="manage_role_tbl">
			<?php
			$tempordid = null;
			foreach ($accessmodel as $access):
			$paths = array_filter(explode('/', $access->access_path));

			if($access->orderid != $tempordid):
				if($tempordid != null) echo '</ul></td></tr>';
				echo '<tr><td class="mng_rl_ttl"><h3>'.ucfirst($access->slug_value).'</h3></td><td><ul>';
			endif;
			
			$tempordid = $access->orderid;
			$checked = Myclass::CheckAcessByRole(@$_REQUEST['role_id'],$access->access_id);
			
			echo '<li>'.CHtml::checkBox('role_perm[]', $checked,array('value'=>$access->access_id)).'<span>'.$access->access_name.'</span></li>';
			endforeach;
			?>
			</table>
		</div>
	<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Save')); ?>    
	<?php $this->endWidget(); ?>
	</div>