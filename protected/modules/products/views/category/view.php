<?php
echo CHtml::script('$(document).ready(function() {  
			$("#list-table").dataTable({
			    "aoColumnDefs": [{ \'bSortable\': false, \'aTargets\': [ 1 ] }],
			    "sDom": "<\'row-fluid\'<\'span6\'l><\'span6\'f>r>t<\'row-fluid\'<\'span6\'i><\'span6\'p>>",
   			    "sPaginationType": "bootstrap",			    
			    "oLanguage": {"sLengthMenu": "_MENU_ records per page","sInfo": "Showing _START_ to _END_ of _TOTAL_ records",}
			});            
		    });');
?>

<h1><?php echo Myclass::t('View Category');?> <?php echo $model->name; ?></h1>

<table  border="0" cellspacing="0" class="table table-bordered table-striped" id="list-table" cellpadding="0">
    <thead>
	<tr class="tablehead">				 
	    <td><?php echo Myclass::t('Category Name');?></td>				
	    <td><?php echo Myclass::t('Action');?></td>                		
	</tr>
    </thead>
    <tbody>
	<?php
	foreach ($subCategories as $category) {
	    $status_icon = ($category->is_active == 0) ? 'ok' : 'minus';
	    $update_image = Yii::app()->request->baseUrl . '/images/update.png';
	    $del_image = Yii::app()->request->baseUrl . '/images/delete.png';
	    $used_image = Yii::app()->request->baseUrl . '/images/green_tick.png';
	    $view_image = Yii::app()->request->baseUrl . '/images/view.png';
	    $add_image = Yii::app()->request->baseUrl . '/images/add.png';
	    ?>
    	<tr class="tablehead">		
    	    <td><?php echo $category->name; ?></td>					
    	    <td>
    		<!-- Update / edit -->
		    <?php
		    echo CHtml::link('<i class="icon-pencil"></i>', array('/products/category/update', 'id' => $category->category_id), array('title' =>Myclass::t('Edit'), 'rel' => 'tooltip'));
		    ?>
    		<!-- Status : Active / In-active -->
		    <?php
		    echo CHtml::link('<i class="icon-' . $status_icon . '-sign"></i>', array('/products/category/changestatus', 'id' => $category->category_id), array('title' =>Myclass::t('Status'), 'rel' => 'tooltip'));
		    ?>
    		<!-- Delete -->
		    <?php echo CHtml::link('<i class="icon-trash"></i>', array('/products/category/categorydelete', 'id' => $category->category_id)
			    , array('onclick' => "return confirm('".Myclass::t('Are you sure you want to delete')."?')", 'title' =>Myclass::t('Delete'), 'rel' => 'tooltip'));
		    ?>		                		              
    	    </td>	                		
    	</tr>
<?php } ?> 


    </tbody>
</table>