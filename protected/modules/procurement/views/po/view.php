<?php $this->hiddenpath = '/procurement/po/past'; ?>

<h1><?php echo Myclass::t('PO Request Details');?> #<?php echo $model->po_id; ?></h1>

<table id="yw0" class="custom-detail-view table table-striped table-bordered">
    <tbody>
	<tr class="odd"><th><?php echo Myclass::t('PR ID');?></th><td><?php echo CHtml::link(PO_REQ_PREFIX.$model->po_id,array('/procurement/po/view','id'=>$model->po_id));?></td></tr>
	<tr class="even"><th><?php echo Myclass::t('Company');?></th><td><?php echo ucwords($model->poVen->ven_name); ?></td></tr>
	<tr class="odd"><th><?php echo Myclass::t('Quote Product');?></th><td>
	    <table class="product_view_table table-striped table-bordered">
		<?php
		$total_value = 0;
		echo '<thead><tr><th>'.Myclass::t('Product name').'</th><th>'.Myclass::t('Quantity').'</th><th>'.Myclass::t('Vendor Unit Price').'</th><th>'.Myclass::t('Item Value').'</th><th>'.Myclass::t('Discounts').'</th><th>'.Myclass::t('Net Cost').'</th></tr></thead><tbody>';
		foreach($model->poProducts as $product):
		    if($product->prod_scenario == 'product'):
			$prod_name = $product->product->name; 
		    else:
			$prod_name = $product->item->name; 
		    endif;
		    $total_value += $product->net_cost;
		    $discount = ($product->discounts > 0) ? $product->discounts." %" : "N/A";
		    echo '<tr>';
		    echo '<td align="center">'.$prod_name.'</td>';
		    echo '<td align="center">'.$product->quantity.'</td>';
		    echo '<td align="center">'.$product->vendor_unit_price.'</td>';
		    echo '<td align="center">'.$product->item_value.'</td>';
		    echo '<td align="center">'.$discount.'</td>';
		    echo '<td align="center">'.$product->net_cost.'</td>';
		    echo '</tr>';
		endforeach; 
		echo '</tbody>';
		?>
	    </table>
	</td></tr>
	<tr class="even"><th><?php echo Myclass::t('Total Cost');?></th><td><?php echo Myclass::GetSiteSetting('AMOUNT_FORMAT')."  ".number_format($total_value, '2'); ?></td></tr>
	<tr class="odd"><th><?php echo Myclass::t('Delivery Date');?></th><td><?php echo date(FORMAT_DATE,strtotime($model->po_delivery_date));?></td></tr>
	<tr class="even"><th><?php echo Myclass::t('Created By');?></th><td><?php echo ucwords($model->poCreatedBy->userProfiles->first_name." ".$model->poCreatedBy->userProfiles->last_name) ;?></td></tr>
	<tr class="odd"><th><?php echo Myclass::t('Status');?></th><td><?php echo ($model->po_status==0) ? 'Pending' : 'Approved';?></td></tr>
	<tr class="odd"><th><?php echo Myclass::t('Created Date');?></th><td><?php echo date(FORMAT_DATE,strtotime($model->po_created_on));?></td></tr>
    </tbody>
</table>
<?php echo CHtml::link(Myclass::t('Back'),Yii::app()->request->getUrlReferrer(),array('class'=>'button_link')); ?>
<?php
if($model->po_status == 0):
    echo '<div class="quote_access">';
    if( (in_array('/procurement/po/approve',Yii::app()->user->useraccess)) && (Yii::app()->user->id != $model->po_created_by) ) echo CHtml::link('Approve',array('/procurement/po/approve','id'=>$model->po_id),array('class'=>'approve_link'));
//    echo CHtml::link('Edit Quote',array('/sales/quote/edit','id'=>$model->po_id),array('class'=>'edit_quote_link'));
    echo '</div>';
endif;
?>