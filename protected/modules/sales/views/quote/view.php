<?php
$this->hiddenpath = '/sales/quote/myquotes';
?>

<h1><?php echo Myclass::t('Quote Details');?> #<?php echo $model->quote_id; ?></h1>

<table id="yw0" class="custom-detail-view table table-striped table-condensed">
    <tbody>
	<tr class="odd"><th><?php echo Myclass::t('Quote ID');?></th><td><?php echo $model->quote_id; ?></td></tr>
	<tr class="even"><th><?php echo Myclass::t('Company');?></th><td><?php echo $model->company->name; ?></td></tr>
	<tr class="even"><th><?php echo Myclass::t('Quote Product');?></th><td>
	    <table class="product_view_table">
		<?php 
		echo '<thead><tr><th>'.Myclass::t('Product name').'</th><th>'.Myclass::t('Unit Price').'</th><th>'.Myclass::t('Quantity').'</th><th>'.Myclass::t('Price').'</th><th>'.Myclass::t('Remarks').'</th></tr></thead><tbody>';
		foreach($model->quoteProducts as $product): 
		    $price = $product->quantity * $product->quote_price;
		    echo '<tr>';
		    echo '<td align="center">'.$product->product->name."</td>";
		    echo '<td align="center">'.Myclass::GetSiteSetting("AMOUNT_FORMAT")." ".$product->quote_price."</td>";		    
		    echo '<td align="center">'.$product->quantity."</td>";
		    echo '<td align="center">'.Myclass::GetSiteSetting("AMOUNT_FORMAT")." ".$price."</td>";
		    echo '<td align="center">'.$product->remarks."</td>";
		    echo '</tr>';
		endforeach; 
		echo '</tbody>';
		?>
	    </table>
	</td></tr>
	<tr class="odd"><th><?php echo Myclass::t('Total Price');?></th><td><?php echo Myclass::GetSiteSetting("AMOUNT_FORMAT")." ".$model->gettotalamt;?></td></tr>
	<tr class="even"><th><?php echo Myclass::t('Delivery Date');?></th><td><?php echo $model->delivery_date ;?></td></tr>
	<tr class="odd"><th><?php echo Myclass::t('Created By');?></th><td><?php echo ucwords($model->createdBy->userProfiles->first_name." ".$model->createdBy->userProfiles->last_name) ;?></td></tr>
        <tr class="even"><th><?php echo Myclass::t('Status');?></th><td><?php echo Myclass::getQuoteStatus($model->status);?></td></tr>
	<tr class="odd"><th><?php echo Myclass::t('Created Date');?></th><td><?php echo $model->created_date ;?></td></tr>
    </tbody>
</table>

	<?php echo CHtml::link(Myclass::t('Back'),Yii::app()->request->getUrlReferrer(),array('class'=>'edit_quote_link')); ?>


<?php
if($model->status == 0):
    echo '<div class="quote_access">';
    if(in_array('/sales/quote/approve',Yii::app()->user->useraccess)):
        echo CHtml::link(Myclass::t('Approve Quote'),array('/sales/quote/approve','id'=>$model->quote_id),array('class'=>'approve_link'));
        echo '<br />';
        echo CHtml::link(Myclass::t('Decline Quote'),array('/sales/quote/decline','id'=>$model->quote_id),array('class'=>'approve_link'));
    endif;
    echo CHtml::link(Myclass::t('Edit Quote'),array('/sales/quote/edit','id'=>$model->quote_id,'ret'=>$ret),array('class'=>'edit_quote_link'));
    echo '</div>';
endif;
?>