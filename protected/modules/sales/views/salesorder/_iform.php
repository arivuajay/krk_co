<?php
/* @var $this SalesOrderMilestoneController */
/* @var $model SalesOrderMilestone */
/* @var $form CActiveForm */
?>
<?php

//echo CJSON::decode('dfdfd');

?>
<div class="create_user">
	<div class="form">

		<?php if(Yii::app()->user->hasFlash('invoice')){ ?>

		<div class="flash-success">
		<?php //echo Yii::app()->user->getFlash('contact'); ?>
		<p><?php echo Yii::app()->user->getFlash('invoice'); ?></p>
		</div>

		<?php } //else: ?>
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'sales-order-milestone-form',
		'enableAjaxValidation'=>false,
	)); ?>

		<p class="note">Fields with <span class="required">*</span> are required.</p>

		<?php
		   
			
			echo $form->errorSummary($imodel); ?>


			<div class="complex complex_invoice">
			<span class="label">
				<?php echo Yii::t('ui', 'Setup Invoice Milestone'); ?>
			</span>
				<div>
				   
					 <?php if(isset (Yii::app()->session['so_id'])){echo  'Total Order value : '.$orderValue[0]['total_order_value'];}?>
				</div>
			<div class="panel">
	    <table class="templateFrame grid" cellspacing="0">
		    <thead class="templateHead">
			    <tr>
				<td><?php echo $form->labelEx(SalesOrderMilestone::model(),'milestone_amt');?>							</td>
				<td><?php echo $form->labelEx(SalesOrderMilestone::model(),'milestone_date');?></td>
				<td colspan="2"><?php echo $form->labelEx(SalesOrderMilestone::model(),'raise_invoice');?></td>
			    </tr>
		    </thead>

		    <tfoot>
			<tr>
			    <td colspan="4"><div class="add"><a href="javascript:void(0);"><?php echo Yii::t('ui','Add Milestone');?></a></div>
					<textarea class="template" row="0" cols="0">
						<tr class="templateContent">
						    <td><?php echo CHtml::textField('Invoice[{0}][milestone_amt]','',array('style'=>'width:100px')); ?></td>
						    <td><?php echo CHtml::textField('Invoice[{0}][milestone_date]','',array('style'=>'width:80px;vertical-align:top;','class'=>'hashDatepicker','onfocus'=>"$(this).datepicker({ dateFormat: 'yy-mm-dd',changeMonth: true,changeYear: true });")); ?></td>
						    <td><?php echo CHtml::dropDownList('Invoice[{0}][raise_invoice]','',CHtml::listData(Myclass::getRaiseInvoiceType(), 'r_id', 'raise_invoice'), array('empty'=>'Select Type')); ?></td>
						    <td><div class="remove"><a href="#"><?php echo Yii::t('ui','Remove');?></a></div><input type="hidden" class="rowIndex" value="{0}" /></td>
						</tr>
					</textarea>
				</td>
			</tr>
		    </tfoot>
		    <tbody class="templateTarget">
		    <?php
		    foreach($invoice as $i=>$person): ?>
			    <tr class="templateContent">
				    <td><?php echo $form->textField($person,"[$i]milestone_amt",array('style'=>'width:100px','name'=>'Invoice'."[$i][milestone_amt]")); ?></td>
				    <td><?php
					$this->widget('zii.widgets.jui.CJuiDatePicker', array(
					    'name'=>"Invoice[$i][milestone_date]",
					    'language'=>Yii::app()->language=='et' ? 'et' : null,
						    //'value'=>$omodel->shipment_date,
					    'options'=>array(
					    'showAnim'=>'fadeIn', // 'show' (the default), 'slideDown', 'fadeIn', 'fold'
					    'showOn'=>'focus', // 'focus', 'button', 'both'
					    'buttonText'=>Yii::t('ui',''),
					    'buttonImage'=>Yii::app()->request->baseUrl.'/images/calendar.png',
					    'buttonImageOnly'=>true,
					    'dateFormat'=>'yy-mm-dd',
					    ),
					    'htmlOptions'=>array(
					    'style'=>'width:80px;vertical-align:top'
					    ),
					));
					?>
				    </td>
				    <td><?php echo $form->dropDownList($person,"[$i]raise_invoice",CHtml::listData(Myclass::getRaiseInvoiceType(), 'r_id', 'raise_invoice'), array('empty'=>'Select Type','name'=>'Invoice'."[$i]raise_invoice")); ?></td>
				    <td><div class="remove"><?php echo Yii::t('ui','Remove');?></div>
					 <input type="hidden" class="rowIndex" value="<?php echo $i;?>" /></td>
			    </tr>
		    <?php endforeach; ?>
		    </tbody>
	    </table>
			</div><!--panel-->
		</div><!--complex-->

		<div class="row row-fluid">
			<?php //echo $form->labelEx($imodel,'so_id'); ?>
			<?php echo $form->hiddenField($imodel,'so_id',array('value'=> Yii::app()->session['so_id'],'name'=>'so_id')); ?>

		</div>
		

		<div class="row row-fluid buttons">
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Book Order',array('class'=>'btn-primary','name'=>'IFORM')); ?>
		</div>

	<?php $this->endWidget(); ?>

	</div><!-- form -->
</div><!-- create user div -->