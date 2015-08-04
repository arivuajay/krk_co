<?php
echo CHtml::script('$(document).ready(function() {  
			$("#list-table").dataTable({
			    "aoColumnDefs": [{ \'bSortable\': false, \'aTargets\': [ 1,4 ] }],
			    "sDom": "<\'row-fluid\'<\'span6\'l><\'span6\'f>r>t<\'row-fluid\'<\'span6\'i><\'span6\'p>>",
   			    "sPaginationType": "bootstrap",			    
			    "oLanguage": {"sLengthMenu": "_MENU_ records per page","sInfo": "Showing _START_ to _END_ of _TOTAL_ records",}
			});            
		    });');
?>

<h1>View</h1>

	<table  border="0" cellspacing="0" class="table table-bordered table-striped" id="list-table" cellpadding="0">
		<thead>
			<tr class="tablehead">		
				<td>File id</td>		 
				<td>File Name</td>				
                <td>Created By</td>
                <td>Created Date</td>   
                <td>Action</td>             		
			</tr>
		</thead>
		<tbody>
			<?php 
				if(!empty($fileInfo)) {
				 foreach($fileInfo as $prod) {
             ?>
				<tr class="tablehead">		
					<td><?php echo FILE_PREFIX.$prod->file_id;?></td>
					<td><a href="<?php echo Yii::app()->getBaseUrl(true).UPLOAD_PATH.$prod->file_name; ?>"><?php echo $prod->file_name;?></a></td>
					<td><?php echo $prod->user->user_name;?></td>
					<td><?php echo date("d-m-Y",strtotime($prod->created_date));?></td>		
					<td style="text-align:center;">
						<?php
							echo CHtml::link('<i class="cus-icon-zoom"></i>',array('/importcsv/default/viewproducts','id'=>$prod->file_id),array('title'=>'View','rel'=>'tooltip')); 
						?>
					</td>		
                        		
				</tr>
			<?php } } ?> 
			
				
		 </tbody>
	</table>