<?php  
echo CHtml::script('$(document).ready(function() {  
			$("#list-table").dataTable({
			    "aoColumnDefs": [{ \'bSortable\': false, \'aTargets\': [ 2 ] }],
			    "sDom": "<\'row-fluid\'<\'span3\'l><\'span9\'f>r>t<\'row-fluid\'<\'span4\'i><\'span8\'p>>",
   			    "sPaginationType": "bootstrap",			    
			    "oLanguage": {"sLengthMenu": "_MENU_ ","sInfo": "_START_ to _END_ of _TOTAL_ records","sInfoEmpty":"No Records"}
			});
			$("#list-sub-table").dataTable({
			    "aoColumnDefs": [{ \'bSortable\': false, \'aTargets\': [ 1 ] }],
			    "sDom": "<\'row-fluid\'<\'span3\'l><\'span9\'f>r>t<\'row-fluid\'<\'span3\'i><\'span9\'p>>",
   			    "sPaginationType": "bootstrap",			    
			    "oLanguage": {"sLengthMenu": "_MENU_ ","sInfo": "_START_ to _END_","sInfoEmpty":"No Records"}
			});
			$(".dataTables_filter input").addClass("input-medium");
		    });');
?>
<h1><?php echo Myclass::t('Product Categories');?></h1>
<div class="span6">
	<table  border="0" cellspacing="0" class="table table-bordered table-striped" id="list-table" cellpadding="0">
		<thead>
			<tr class="tablehead">				 
				<th><?php echo Myclass::t('Category');?></th>
				<th><?php echo Myclass::t('Subcategory');?></th>
				<th><?php echo Myclass::t('Action');?></th>                		
			</tr>
		</thead>
		<tbody>
		<?php 
		foreach($categoryModel as $category) :	
		    $status_icon = ($category->is_active==0)?'ok':'minus';
		    $active_cls  = ($category->category_id == @$_REQUEST['pid']) ? 'active' : ''; 
		?>
				<tr class="tablehead <?php echo $active_cls;?>">		
					<td><?php echo $category->name;?></td>
					<!--<td><?php if($category->parent_id == 0) { echo Myclass::t("Root Category"); } else { $categoryinfo = Category::model()->findByPk($category->parent_id); echo $categoryinfo->name; } ?></td>-->
					<td><?php
					echo CHtml::link('<i class="cus-icon-zoom"></i>',array('/products/category/index','pid'=>$category->category_id),array('title'=>'View','rel'=>'tooltip')); 
					
					echo CHtml::link('<i class="cus-icon-plus"></i>',array('/products/category/create','pid'=>$category->category_id),array('title'=>'Add','rel'=>'tooltip'));
					?></td>
	                <td>
	                	<!-- Update / edit -->
             			<?php echo CHtml::link('<i class="cus-icon-pencil"></i>',
	                		  array('/products/category/update','id'=>$category->category_id),array('title'=>Myclass::t('Edit'),'rel'=>'tooltip'));
	                	?>
		                <!-- Delete -->
		                <?php echo CHtml::link('<i class="cus-icon-trash"></i>',array('/products/category/categorydelete','id'=>$category->category_id)
		                ,array('onclick'=>"return confirm('".Myclass::t('Are you sure you want to delete')."?')",'title'=>Myclass::t('Delete'),'rel'=>'tooltip')); ?>
		                <!-- View -->		                
	                </td>	                		
				</tr>
			<?php endforeach;  ?> 
		 </tbody>
	</table>
</div>
<?php if(isset($_REQUEST['pid'])) : ?>
<div class="span5 sub_category">
	<h3 class="sub_cat">Sub Category</h3>
        
	<table  border="0" cellspacing="0" class="table table-bordered table-striped" id="list-sub-table" cellpadding="0">

                <thead>
				<th>Subcategory</th>
				<th>Action</th>                		
			</tr>
		</thead>
                <div class="sub_cat_top">
                    
                        Category :<span>
                    <?php
                    foreach($selectedCategory as $scategory) :
                        echo $name = $scategory->name;
                    ?>
                    <?php endforeach; ?>

                    </span>
		<tbody>
                    
		<?php 
		foreach($subcategoryModel as $category) :				 
		    $status_icon = ($category->is_active==0)?'ok':'minus';
		?>
		    <tr class="tablehead">		
			    <td><?php echo $category->name;?></td>
			    <td>
				    <!-- Update / edit -->
				    <?php echo CHtml::link('<i class="cus-icon-pencil"></i>',
						array('/products/category/update','id'=>$category->category_id),array('title'=>'Edit','rel'=>'tooltip'));
				    ?>
				    <!-- Delete -->
				    <?php echo CHtml::link('<i class="cus-icon-trash"></i>',array('/products/category/categorydelete','id'=>$category->category_id)
				    ,array('onclick'=>"return confirm('Are you sure you want to delete?')",'title'=>'Delete','rel'=>'tooltip')); ?>
				    <!-- View -->	
			    </td>	                		
		    </tr>
		<?php endforeach; ?> 
		 </tbody>
                   </div>
	</table>
      
</div>
<?php endif; ?>