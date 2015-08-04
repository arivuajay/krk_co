<?php
$this->hiddenpath = '/sales/sample/view';
switch($model->sample_status):
    case '0': $status = "Pending Approval";break;
    case '1': $status = "In Transit";break;
    case '2': $status = "In Transit";break;
    case '3': $status = "Returned";break;
endswitch;
?>

<h1>Sample Details #<?php echo $model->sample_id; ?></h1>

<table id="yw0" class="custom-detail-view table table-striped table-condensed">
    <tbody>
	<tr class="odd"><th>Sample ID</th><td><?php echo CHtml::link(SAMPLE_PREFIX.$model->sample_id,array('/sales/sample/viewdetail','id'=>$model->sample_id));?></td></tr>
	<tr class="even"><th>Sample Product</th><td>
	    <table class="product_view_table">
		<?php 
		echo '<thead><tr><th>Product name</th><th>Quantity</th></tr></thead><tbody>';
		foreach($model->samplerProducts as $product): 
		    $name = ($product->prod_scenario == "product") ? $product->product->name : $product->item->name;
		    echo '<tr>';
		    echo '<td align="center">'.$name."</td>";
		    echo '<td align="center">'.$product->qty."</td>";
		    echo '</tr>';
		endforeach; 
		echo '</tbody>';
		?>
	    </table>
	</td></tr>
	<tr class="odd"><th>Created By</th><td><?php echo ucwords($model->samplerBuyer->fullname) ;?></td></tr>
	<tr class="even"><th>Status</th><td><?php echo $status;?></td></tr>
	<tr class="odd"><th>Client name</th><td><?php echo ucwords($model->client_name); ?></td></tr>
	<?php if(!empty($model->despatch_no)):?>
	<tr class="even"><th>Despatch No</th><td><?php echo $model->despatch_no;?></td></tr>
	<?php endif; ?>
	<tr class="odd"><th>Created Date</th><td><?php echo date(FORMAT_DATE,strtotime($model->req_date));?></td></tr>
    </tbody>
</table>
<?php
echo "<span class='span12'>";
if(Yii::app()->user->getState("role") == "admin" && $model->sample_status == '0'):
     $form=$this->beginWidget('CActiveForm', array(
	'id'=>'sample-form',
	'enableAjaxValidation'=>false,
    )); 
    echo "<span class='pull-right'>";
    echo $form->textField($model,'despatch_no',array('placeholder'=>$model->getAttributeLabel('despatch_no')));
    echo $form->error($model,'despatch_no');
    $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'label'=>'Approve'));
//    CHtml::link('Approve',array("/sales/sample/approve","id"=>$model->sample_id),array( "id"=>"approve_link",'class'=>'edit_quote_link'))
    echo "</span>";
    $this->endWidget(); 
endif;
    

if(Yii::app()->user->getState("role") == "admin" && $model->sample_status == '2')
    echo "<span class='pull-right'>".CHtml::link('Set Returned',array("/sales/sample/returnsample","id"=>$model->sample_id),array('class'=>'edit_quote_link'))."</span>";

echo "<span class='pull-left'>".CHtml::link('Back',Yii::app()->request->getUrlReferrer(),array('class'=>'edit_quote_link'))."</span>";
echo "</span>";
?>