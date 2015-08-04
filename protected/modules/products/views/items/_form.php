<?php
$this->hiddenpath = "/products/items/create";
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'items-form',
	'enableAjaxValidation'=>false,
)); ?>

    <p class="note"><?php echo Myclass::t('Fields with');?> <span class="required">*</span> <?php echo Myclass::t('are required');?>.</p>

	<?php echo $form->errorSummary($model); ?>
		<div style="width:100%;">
			<div style="width:60%;float:left;">
				<div class="row-fluid">
					<?php echo $form->labelEx($model,'item_code'); ?>
					<?php echo $form->textField($model,'item_code',array('size'=>20,'maxlength'=>20)); ?>
					<?php //echo $form->error($model,'item_code'); ?>
				</div>

				<div class="row-fluid">
					<?php echo $form->labelEx($model,'name'); ?>
					<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>200)); ?>
					<?php //echo $form->error($model,'name'); ?>
				</div>
				<div class="row-fluid">
					<?php echo $form->labelEx($model,'imported'); ?>
					<?php echo $form->checkBox($model,'imported'); ?>
					<?php //echo $form->error($model,'imported'); ?>
				</div>
				<div class="row-fluid">
					<?php echo $form->labelEx($model,'unit_measure_id'); ?>
					<?php echo $form->dropDownList($model,'unit_measure_id',Myclass::getUnitMeasure()); ?>
					<?php //echo $form->error($model,'unit_measure_id'); ?>
				</div>	
				<div class="row-fluid">
					<?php echo $form->labelEx($model,'reorder_limit'); ?>
					<?php echo $form->textField($model,'reorder_limit'); ?>
					<?php //echo $form->error($model,'reorder_limit'); ?>
				</div>
			</div>
			<?php if(!$model->isNewRecord) { ?>
				<div style="width:40%;float:left;font-size:14px;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;">
					<fieldset>
						<legend><?php echo Myclass::t('Inventory Settings'); ?></legend>
						<table width="100%" cellpadding="10" cellspacing="10">
				    		<tr><td width="50%"><label><?php echo Myclass::t('Available Stock'); ?></label></td><td width="4%">:</td><td><?php echo $model->available_quantity; ?></td></tr>
				    		<tr><td><?php echo Myclass::t('Reorder Limit'); ?></td><td>:</td><td><?php echo $model->reorder_limit; ?></td></tr>
				    		<tr><td><?php echo Myclass::t('Present inventory level'); ?></td><td>:</td>
				    			<td>
				    			<?php 
								 if(Myclass::getInventoryLevel($model->available_quantity,$model->reorder_limit)):
								     echo CHtml::image(Yii::app()->getBaseUrl(true)."/images/green.png");
								 else:    
								     echo CHtml::image(Yii::app()->getBaseUrl(true)."/images/red.png");
								 endif;
								 ?>
				    			</td>
				    		</tr>
				    	</table>	
			    	</fieldset>
				</div>	
			<?php } ?>	
		</div>		
				<?php //echo $form->labelEx($model,'description'); ?>
					<?php //echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
					<?php //echo $form->error($model,'description'); ?>
				<div class="row-fluid" style="float:left;">
                                    <?php echo $form->labelEx($model,'description'); ?>
                                    
                                    <?php $this->widget('application.extensions.eckeditor.ECKEditor', array(
                                    'model'=>$model,
                                    'attribute'=>'description',
                                    'config' => array(
                                    'width'=>'500px',
                                    'height'=>'100px',
                                    'toolbar'=>array(
                                    array('Bold','Italic','Underline','Strike','-','NumberedList','BulletedList','-','Outdent','Indent','Blockquote','-','Link','Unlink','-','Table','SpecialChar','-','Cut','Copy','Paste','-','Undo','Redo',),
                                    ),
                                    ),

                                    )); ?>
				</div>
				<div class="row-fluid buttons" style="float:left;">
					<label>&nbsp;</label>
					<?php echo CHtml::submitButton($model->isNewRecord ? Myclass::t('Create') : Myclass::t('Save')); ?>
				</div>

<?php $this->endWidget(); ?>

</div><!-- form -->