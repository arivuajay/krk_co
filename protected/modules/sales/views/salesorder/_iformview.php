<table  border="0" cellspacing="0" width="50%"  class="table table-bordered table-striped" id="list-table" cellpadding="0">
    <tbody>
    <?php if(!empty($soMdetail)): ?>
    <thead>
	<tr>				 
		<th><?php echo Myclass::t('S.No');?>#</th>
		<th><?php echo Myclass::t('Milestone Amt');?></th>
		<th><?php echo Myclass::t('Milestone Date');?></th>
		<th><?php echo Myclass::t('Raise Invoice');?></th>
	</tr>
    </thead>
    <tbody>
	<?php foreach($soMdetail as $key => $soM):
	    if($soM->milestone_amt):?>
	<tr>				 
		<td><?php echo "Payment Milestone ".($key+1);?></td>
		<td><?php echo Myclass::GetSiteSetting('AMOUNT_FORMAT')." ".$soM->milestone_amt;?></td>
		<td><?php echo date(FORMAT_DATE,strtotime($soM->milestone_date)); ?></td>
		<td><?php echo Myclass::getraiseInvoice($soM->raise_invoice); ?></td>
	</tr>
	<?php endif; endforeach; ?>
    </tbody>
    <?php  else:?>
        <tr>
		<td><?php echo Myclass::t('No Milestone Information Available');?></td>
	</tr>
    <?php endif; ?>
</table>