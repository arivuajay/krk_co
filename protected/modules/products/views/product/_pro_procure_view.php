<?php
//print"<pre>";
//print_r($procurement);
//
$userProfile = Myclass::GetUserProfile(1);


?>

<table  border="0" cellspacing="0" width="50%"  class="table table-bordered table-striped" id="list-table" cellpadding="0">

    <tbody>
	
	<tr>
	    <td><?php echo Myclass::t("Quantity"); ?></td>
	    <td><?php echo $procurement[0]->quantity;?></td>
	</tr>
	
	<tr>
	    <td><?php echo Myclass::t("EDD"); ?></td>
	    <td><?php echo $procurement[0]->edd;?></td>
	</tr>
	<tr>
	    <td><?php echo Myclass::t("Created By"); ?></td>
            <td><?php echo $userProfile->first_name.' '.$userProfile->last_name;?></td>
	</tr>
	<tr>
	    <td><?php echo Myclass::t("Created Date"); ?></td>
	    <td><?php echo $procurement[0]->created_date;?></td>
	</tr>


    </tbody>
</table>


