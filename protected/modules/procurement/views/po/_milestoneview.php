<table  border="0" cellspacing="0" width="50%"  class="table table-bordered table-striped" id="list-table" cellpadding="0">
    <tbody>
    <?php if(!empty($milestones)): ?>
    <thead>
	<tr>				 
		<th><?php echo Myclass::t('S.#'); ?></th>
		<th><?php echo Myclass::t('Milestone Amt'); ?></th>
		<th><?php echo Myclass::t('Milestone Date'); ?></th>
		<th><?php echo Myclass::t('Raise Invoice'); ?></th>
	</tr>
    </thead>
    <tbody>
	<?php foreach($milestones as $key => $milestone): ?>
	<tr>				 
		<td><?php echo Myclass::t("Payment Milestone ").($key+1);?></td>
		<td><?php echo Myclass::GetSiteSetting('AMOUNT_FORMAT')." ".$milestone->milestone_amt;?></td>
		<td><?php echo date(FORMAT_DATE,strtotime($milestone->milestone_date)); ?></td>
		<td><?php echo Myclass::getraiseInvoice($milestone->raise_invoice,true); ?></td>
	</tr>
	<?php endforeach; ?>
    </tbody>
    <?php  else:?>
        <tr>
		<td><?php echo Myclass::t('No Milestone Information Available'); ?></td>
	</tr>
    <?php endif; ?>
</table>