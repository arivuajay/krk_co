<?php
$pro_cat = Myclass::GetProductCategory(); 
$cat_array = array();
foreach ($pro_cat as $cat):
    $cat_array[] = array('value'=>"^{$cat->name}$",'label'=>$cat->name);
endforeach;

echo CHtml::scriptFile(Yii::app()->getBaseUrl(true).'/jqtable/js/jquery.dataTables.columnFilter.js');
echo CHtml::script('$(document).ready(function() {  
			var oTable = $("#assign-price-table").dataTable({
			    "aoColumnDefs": [{ \'bSortable\': false, \'aTargets\': [ 0 ] }],
			    "sDom": "<\'row-fluid\'<\'filter\'l><\'search\'f>r>t<\'row-fluid\'<\'span4\'i><\'span8\'p>>",
   			    "sPaginationType": "bootstrap",			    
			    "oLanguage": {"sLengthMenu": "Filter _MENU_","sInfo": "Showing _START_ to _END_ of _TOTAL_ records",},
			    "aLengthMenu": [[5,10,15,20, -1], [5,10,15,20, "All"]],
			    "iDisplayLength": 5
			});     
			oTable.columnFilter({
			    sPlaceHolder: "head:before",
			    aoColumns: [ {"bSearchable": false},null,null,{ sSelector: "#pro_cat_sel", type:"select" ,bRegex:true,values: '.CJSON::encode($cat_array).' }  ]
			});
		    });');
//$('#tableId').dataTable("aoColumns": [ {"bSearchable": true}, {"bSearchable": false}, {"bSearchable": false}]); 
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'assign-price-form',
	'enableAjaxValidation'=>false,
)); 
echo $form->errorSummary($model); 
echo "<div class='add_new_product'>".Myclass::t('Not in the list')."?".CHtml::link(Myclass::t("Add new"), array("/products/product/create"),array("target"=>"_blank"))."</div>";
?>
	
<div class="crt_qte_cat"><label><?php echo Myclass::t('Choose Category');?></label><div id="pro_cat_sel"></div></div>
<table width="90%" border="0" cellspacing="0" class="product_DT_view create_quote" id="assign-price-table" cellpadding="0">
    <thead class="hide">
	<tr class="tablehead">				 
		<th><?php echo Myclass::t('Product checkbox');?></th>
		<th><?php echo Myclass::t('Product Detail');?></th>
		<th><?php echo Myclass::t('Name');?></th>
		<th><?php echo Myclass::t('All Category');?></th>
	</tr>
    </thead>
    <tbody>
	<?php 
	$i =1;
	$baseUrl = Yii::app()->getBaseUrl(true);
//	var_dump($vendor_products_array); exit;
	if(isset($vendor_products_array))	$sel_prod_ids = array_keys($vendor_products_array);
//	var_dump($sel_prod_ids); exit;
	foreach($products as $product): 
	    if(isset($sel_prod_ids) && !empty($sel_prod_ids)) $checked = (in_array("product_".$product->product_id,$sel_prod_ids)) ? true : false;
	    else $checked = false;
	?>
	
	
	<tr>
		<td class="crt_qte_first">
			<?php echo CHtml::checkBox('product_id',$checked,array('value'=>$product->product_id)); ?>
		</td>
		<td class="crt_qte_cat_inner">
			<table width="100%" cellpadding="5">
				<tr>
					<td valign="top">
					<div class="img_bg"><?php echo CHtml::image($baseUrl.PRO_IMAGE_PATH.$product->image_path,$product->name); ?></div>
					</td>
					<td width="100%">
					<?php 
					echo '<span class="product_det"><span class="product_name">'.$product->name.'</span><span class="product_cat">'; 					
					foreach($product->productCategories as $pro_category) echo $pro_category->category->name."&nbsp;&gt;&gt;&nbsp;".$pro_category->subcategory->name."<br />"; 
					echo '</span></span>';
//					echo '<span class="product_foot"><span class="product_price">Price : '.Myclass::GetSiteSetting('AMOUNT_FORMAT').$product->product_amt.'</span>';
					echo '<span class="product_foot"><span class="product_price"><label>'.Myclass::t('Price').' :&nbsp;</label> <span class="prd_val">'.Myclass::getProductPriceRange($product).'</span></span>';
					echo '<span class="product_more">';
//					echo CHtml::ajaxLink('More&gt;&gt;', $this->createUrl('/sales/quote/modal_product_view',array('id'=>$product->product_id)), 
//				array('success'=>'function(r){$("#modal_view_product").html(r).modal("toggle"); return false;}'), 
//				array('title'=>'Read More','rel'=>'tooltip'));
					echo CHtml::link(Myclass::t('More&gt;&gt;'),array('/products/product/productdetail','pid'=>$product->product_id),array('target'=>'_blank','title'=>'Read More','rel'=>'tooltip'));
					
					echo '</span></span>';
				?>
					</td>
				</tr>
			</table>
		</td>
		<td class="hide"><?php echo $product->name; ?></td>
		<td class="hide"><?php foreach($product->productCategories as $pro_category) echo $pro_category->category->name; ?></td>
	</tr>
	<?php $i++; endforeach;	
	foreach($items as $item): 
	    if(isset($sel_prod_ids) && !empty($sel_prod_ids)) $checked = (in_array("item_".$item->item_id,$sel_prod_ids)) ? true : false;
	    else $checked = false;
	?>
	<tr>
		<td class="crt_qte_first">
			<?php echo CHtml::checkBox('item_id',$checked,array('value'=>$item->item_id)); ?>
		</td>
		<td class="crt_qte_cat_inner">
			<table width="100%" cellpadding="5">
				<tr>
					<td><div class="img_bg"><?php echo ucwords($item->name); ?></div></td>
					<td width="100%">
					<?php 
					echo '<span class="product_det"><span class="product_name">'.$item->name.'</span></span>';
//					echo '<span class="product_foot"><span class="product_price">Price : '.Myclass::GetSiteSetting('AMOUNT_FORMAT').$item->product_amt.'</span>';
//					echo '<span class="product_foot"><span class="product_price"><label>Price :&nbsp;</label> <span class="prd_val">'.Myclass::getProductPriceRange($item).'</span></span>';
					echo '<span class="product_more">';
//					echo CHtml::ajaxLink('More&gt;&gt;', $this->createUrl('/products/items/update',array('id'=>$item->item_id)), 
//				array('success'=>'function(r){$("#modal_view_product").html(r).modal("toggle"); return false;}'), 
//				array('title'=>'Read More','rel'=>'tooltip'));
					echo CHtml::link(Myclass::t('More&gt;&gt;'),array('/products/items/update','id'=>$item->item_id),array('target'=>'_blank','title'=>'Read More','rel'=>'tooltip'));
					echo '</span></span>';
				?>
					</td>
				</tr>
			</table>
		</td>
		<td class="hide"><?php echo $item->name; ?></td>
		<td class="hide">&nbsp;</td>
	</tr>
	<?php $i++; endforeach;	?>
    </tbody>
</table>
<div class="assign_price_list">
    <h4><?php echo Myclass::t('Assign Vendor Price');?></h4>
    <div id="assign_list_div"><?php echo Myclass::t('Product is empty');?></div>
</div>
<?php $this->endWidget(); ?>
</div><!-- form -->

<script type="text/javascript">
$(document).ready(function(){
	<?php if(!empty($vendor_products) && $vendor_products != "[]"): ?>
	var items = [];
	var data = <?php echo $vendor_products; ?>;
	    $.each(data, function(key, val) {
		items.push('<li id="' + val.prod_id + '">' + val.name + '<input class="input-mini" id="VendorProductsPrice'+key+'" name="VendorProducts['+key+'][ven_prod_price]" value="' + val.assign_price + '" type="textbox" size="2" maxlength="10" /><input name="VendorProducts['+key+'][ven_prod_id]" value="'+val.prod_id+'" type="hidden" /><a class="remove" href="javascript:void(0);">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>');
	    });	

	    $('div#assign_list_div').wrapInner('<ul class="quote_list" />');
	    $('div#assign_list_div ul').html(items.join('')+'<button name="yt2" type="submit" class="btn btn-danger"><i class="icon-ok icon-white"></i> Save Price</button>');
	<?php endif; ?>
	    
	$("#assign-price-form").submit(function(){
	    return quote_validate();
	});
	
	$('input#product_id').live('click',function() {
	    var task;
	    if($(this).is(':checked'))
	    {
		task = "add";
    	    }
	    else
	    {
		task = "remove";
	    }
	    
	    var prod_id = $(this).val();
	    _call_quote(task,prod_id);
	});
	
	$('input#item_id').live('click',function() {
	    var task;
	    if($(this).is(':checked'))
	    {
		task = "add";
    	    }
	    else
	    {
		task = "remove";
	    }
	    
	    var item_id = $(this).val();
	    _call_quote(task,item_id,'','item');
	});
    
	$("div#assign_list_div ul li a.remove").live('click',function(){
	    var prod_id = $(this).parent('li').attr('id');
	     var arr = prod_id.split("_");
	    $("input:checkbox[name='product_id'][value='"+prod_id+"']").removeAttr('checked');
	    _call_quote('remove',arr[1],'',arr[0]);
	});
	
	$("input[id^=VendorProductsPrice]").live('change',function(){
	    var prod_id = $(this).parent('li').attr('id');
	    var arr = prod_id.split("_");
	    var assign_price = $(this).val();
	    _call_quote('add',arr[1],assign_price,arr[0]);
	});
});

function quote_validate()
{
    var msg = null;
    $("input[id^=VendorProductsPrice]").each(function() {
        if($(this).val() == '' || $(this).val() == null || $(this).val() == "0")
	{
	    alert('Assign Price Cannot be empty');
	    msg += false;
	}
    });
    if(msg == null) { return true;  }
    else { return false; }
    
}

function _call_quote(task,prod_id,assign_price,type)
{
    if(type == null) type = "product";
    $.getJSON('<?php echo $this->createUrl('/procurement/vendor/assigntoproduct');?>', { task: task, prod_id: prod_id, assign_price:assign_price,type:type}, 
    function(data) {
		var items = [];
		if(data && data != "")
		{
		    $.each(data, function(key, val) { 
			items.push('<li id="' + val.prod_id + '">' + val.name + '<input class="input-mini" id="VendorProductsPrice'+key+'" name="VendorProducts['+key+'][ven_prod_price]" value="' + val.assign_price + '" type="textbox" size="2" maxlength="10" /><input name="VendorProducts['+key+'][ven_prod_id]" value="'+val.prod_id+'" type="hidden" /><a class="remove" href="javascript:void(0);">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>');
		    });	

		    $('div#assign_list_div').wrapInner('<ul class="quote_list" />');
		    $('div#assign_list_div ul').html(items.join('')+'<button name="yt2" type="submit" class="btn btn-danger"><i class="icon-ok icon-white"></i> Save Price</button>');
		}
		else
		{
		    $('div#assign_list_div').html('Product is empty');
		}
	    });
}


</script>
<div id="tese" style="display:none;"></div>
<?php $this->beginWidget('bootstrap.widgets.BootModal', array('id'=>'modal_view_product'));  $this->endWidget(); ?>