<?php
$this->hiddenpath = "/products/items/create";
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'items-form',
	'enableAjaxValidation'=>false,
)); ?>

    <p class="note"><?php echo Myclass::t('Fields with');?> <span class="required">*</span> <?php echo Myclass::t('are required');?>.</p>

	<?php echo $form->errorSummary($smodel); ?>
	
		<div style="width:100%;">
			<div style="width:50%;float:left">
				<fieldset>
					<legend><?php echo Myclass::t('Place Procurement Request');?></legend>		 
					<div style="padding-left:30px;">
						<div class="row row-fluid row row-fluid-fluid">
							<?php echo $form->labelEx($smodel,'quantity'); ?>
							<?php echo $form->textField($smodel,'quantity',array('size'=>60,'maxlength'=>200,'onkeypress'=>'return isNumberKey(event);')); ?>
						</div>
						<div class="row row-fluid row row-fluid-fluid">
							<?php echo $form->labelEx($smodel,'edd'); ?>
							<?php
//					            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
//									'name'=>'ProductProcurement[edd]',
//									'language'=>Yii::app()->language=='et' ? 'et' : null,
//									'value'=>date("Y-m-d",strtotime($smodel->edd)),
//									    'options'=>array(
//									        'showAnim'=>'fadeIn', // 'show' (the default), 'slideDown', 'fadeIn', 'fold'
//									        'showOn'=>'both', // 'focus', 'button', 'both'
//									        'buttonText'=>Yii::t('ui',''),
//									        'buttonImage'=>Yii::app()->request->baseUrl.'/images/calendar.png',
//									        'buttonImageOnly'=>true,
//									        'dateFormat'=>'yy-mm-dd',
//									    ),
//									    'htmlOptions'=>array(
//									        'style'=>'width:213px;vertical-align:top'
//									    ),
//									));
					                ?>
    <?php
	$this->widget('zii.widgets.jui.CJuiDatePicker', array(
	    'name'=>'ProductProcurement[edd]',
	    'language'=>Yii::app()->language=='et' ? 'et' : null,
	    'options'=>array(
	        'showAnim'=>'fadeIn', // 'show' (the default), 'slideDown', 'fadeIn', 'fold'
	        'showOn'=>'both', // 'focus', 'button', 'both'
	        'buttonText'=>Yii::t('ui',''),
		'minDate'=>'0',
	        'buttonImage'=>Yii::app()->request->baseUrl.'/images/calendar.png',
	        'buttonImageOnly'=>true,
	        'dateFormat'=>'yy-mm-dd',
	    ),
	    'htmlOptions'=>array(
	        'style'=>'width:80px;vertical-align:top'
	    ),
	));
    ?>
						</div>
						<div class="row row-fluid buttons">		
					            <?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'type'=>'primary','icon'=>'ok white', 'label'=>'Request Procurement','htmlOptions'=>array('name'=>'PRODUCT_PROCUREMENT'))); ?>
								<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'reset', 'icon'=>'remove', 'label'=>'Cancel')); ?>
						</div>
					</div>
			</fieldset>
			</div>
			<div style="width:45%;float:left;">
				<fieldset>
					<legend><?php echo Myclass::t('Inventory Settings');?></legend>
					<table width="100%" cellpadding="10" cellspacing="10">
			    		<tr><td width="50%"><label><?php echo Myclass::t('Available Stock');?></label></td><td width="4%">:</td><td><?php echo $model->available_quantity; ?></td></tr>
			    		<tr><td><?php echo Myclass::t('Reorder Limit');?></td><td>:</td><td><?php echo $model->reorder_limit; ?></td></tr>
			    		<tr><td><?php echo Myclass::t('Present inventory level');?></td><td>:</td>
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
		</div>
<?php $this->endWidget(); ?>
</div><!-- form -->