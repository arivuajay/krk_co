<?php
echo CHtml::script('$(document).ready(function() {  
			$("#list-table").dataTable({
			    "aoColumnDefs": [{ \'bSortable\': false, \'aTargets\': [ 2,3,4,5 ] }],
			    "sDom": "<\'row-fluid\'<\'span6\'l><\'span6\'f>r>t<\'row-fluid\'<\'span6\'i><\'span6\'p>>",
   			    "sPaginationType": "bootstrap",			    
			    "oLanguage": {"sLengthMenu": "_MENU_ records per page","sInfo": "Showing _START_ to _END_ of _TOTAL_ records",}
			});            
		    });');
?>
<h2>Items</h2>

<table  border="0" cellspacing="0" class="table table-bordered table-striped" id="list-table" cellpadding="0">
    <thead>
	<tr class="tablehead">				 
	    <td><?php echo Myclass::t('Item Name');?></td>
	    <td><?php echo Myclass::t('Item Code');?></td>
	    <td><?php echo Myclass::t('Imported');?></td>
	    <td><?php echo Myclass::t('Unit of Measure');?></td>
	    <td><?php echo Myclass::t('Reorder Limit');?></td> 
	    <td><?php echo Myclass::t('Action');?></td>              		
	</tr>
    </thead>
    <tbody>
	<?php
	foreach ($itemsModel as $item) {
	    $status_icon = ($item->is_active == 0) ? 'minus' : 'ok';

	    $update_image = Yii::app()->request->baseUrl . '/images/update.png';
	    $del_image = Yii::app()->request->baseUrl . '/images/delete.png';
	    $used_image = Yii::app()->request->baseUrl . '/images/green_tick.png';
	    $view_image = Yii::app()->request->baseUrl . '/images/view.png';
	    $add_image = Yii::app()->request->baseUrl . '/images/add.png';
	    ?>
    	<tr class="tablehead">		
    	    <td><?php echo $item->name; ?></td>
    	    <td><?php echo $item->item_code; ?></td>
    	    <td><?php if ($item->imported) {
	    echo Myclass::t("Imported");
	} else {
	    echo Myclass::t("Not Imported");
	} ?></td>
    	    <td><?php $array = Myclass::getUnitMeasure();
	echo $array[$item->unit_measure_id]; ?></td>
    	    <td><?php echo $item->reorder_limit; ?></td>	   
    	    <td>
    		<!-- Update / edit -->
		    <?php
		    echo CHtml::link('<i class="icon-pencil"></i>', array('/products/items/update', 'id' => $item->item_id), array('title' =>Myclass::t('Edit'), 'rel' => 'tooltip'));
		    ?>
    		<!-- Status : Active / In-active -->
		    <?php
		    echo CHtml::link('<i class="icon-' . $status_icon . '-sign"></i>', array('/products/items/changestatus', 'id' => $item->item_id), array('title' =>Myclass::t('Status'), 'rel' => 'tooltip'));
		    ?>
    		<!-- Delete -->
    <?php echo CHtml::link('<i class="icon-trash"></i>', array('/products/items/itemsdelete', 'id' => $item->item_id)
	    , array('onclick' => "return confirm('".Myclass::t('Are you sure you want to delete')."?')", 'title' => Myclass::t('Delete'), 'rel' => 'tooltip'));
    ?>
    <?php
    echo CHtml::link(Myclass::t('Place Pro'), array('/products/items/placeprocurement', 'id' => $item->item_id), array('title' => Myclass::t('Place Procurement Request'), 'rel' => 'tooltip'));
    ?>		                
    	    </td>                             		
    	</tr>
<?php } ?> 


    </tbody>
</table>
