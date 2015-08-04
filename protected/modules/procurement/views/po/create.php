<h1><?php echo Myclass::t('Create PO');?></h1>
<?php
$this->widget('bootstrap.widgets.BootAlert');

$pro_cat = Myclass::GetProductCategory(); 
$cat_array = array();
foreach ($pro_cat as $cat):
    $cat_array[] = array('value'=>"^{$cat->name}$",'label'=>$cat->name);
endforeach;

echo CHtml::scriptFile(Yii::app()->getBaseUrl(true).'/jqtable/js/jquery.dataTables.columnFilter.js');
echo CHtml::script('$(document).ready(function() {  
			var oTable = $("#create-po-table").dataTable({
			    "aoColumnDefs": [{ \'bSortable\': false, \'aTargets\': [ 0 ] }],
			    "sDom": "<\'row-fluid\'<\'filter\'l><\'search\'f>r>t<\'row-fluid\'<\'span6\'i><\'span6\'p>>",
   			    "sPaginationType": "bootstrap",			    
			    "oLanguage": {"sLengthMenu": "Filter _MENU_","sInfo": "Showing _START_ to _END_ of _TOTAL_ records",},
			    "aLengthMenu": [[5,10,15,20, -1], [5,10,15,20, "All"]],
			    "iDisplayLength": 5
			});     
			oTable.columnFilter({
			    sPlaceHolder: "head:before",
			    aoColumns: [ {"bSearchable": false},null,null,{ sSelector: "#pro_cat_sel", type:"select" ,bRegex:true,values: '.CJSON::encode($cat_array).' }  ]
			});
			
			$("#Po_po_ven_id").live("change",function(){
//			    //if(confirm("Reset Current PO"))
//			    //{
			    window.location.href = "'.Yii::app()->createAbsoluteUrl("/procurement/po/create/venid").'/"+$(this).val();
//			    //}
			});
		    });');
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'create-po-form',
	'enableAjaxValidation'=>false,
)); 
echo $form->errorSummary($model); 
?>
<div class="row-fluid create_quote_customer">
    <?php 
	echo $form->dropDownList($model,'po_ven_id', CHtml::listData(Myclass::GetVendors(), 'ven_id', 'ven_name'), array('empty'=>'Choose Vendor'));	
    ?>
</div>
<?php
if(!$vendor_products):
    echo Myclass::t('Choose Vendor First');
else:    
?>
<div class="crt_po_cat"><label>Choose Category</label><div id="pro_cat_sel"></div></div>
<table width="90%" border="0" cellspacing="0" class="product_DT_view create_quote" id="create-po-table" cellpadding="0">
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
	$baseUrl = Yii::app()->getBaseUrl(true);
	if(!empty($_SESSION['po_cart'][$venid])) $sel_prod_ids = array_keys($_SESSION['po_cart'][$venid]);
	foreach($vendor_products as $key => $product): 
	    if(isset($sel_prod_ids) && !empty($sel_prod_ids)) $checked = (in_array("product_".$product->venProd->product_id,$sel_prod_ids)) ? true : false;
	    else $checked = false;
	if($product->prod_scenario == "product"):
	?>
	<tr>
		<td class="crt_qte_first">
			<?php echo CHtml::checkBox('product_id',$checked,array('value'=>$product->venProd->product_id)); ?>
		</td>
		<td class="crt_qte_cat_inner">
			<table width="100%" cellpadding="5">
				<tr>
					<td valign="top">
					<div class="img_bg"><?php echo CHtml::image($baseUrl.PRO_IMAGE_PATH.$product->venProd->image_path,$product->venProd->name); ?></div>
					</td>
					<td width="100%">
					<?php 
					echo '<span class="product_det"><span class="product_name">'.$product->venProd->name.'</span><span class="product_cat">'; 					
					foreach($product->venProd->productCategories as $pro_category) echo $pro_category->category->name."&nbsp;&gt;&gt;&nbsp;".$pro_category->subcategory->name."<br />"; 
					echo '</span></span>';
					echo "<span>".substr(strip_tags($product->venProd->description),0,255)."</span>";    
					echo '<span class="product_foot"><span class="product_price"><label>'.Myclass::t('Price').' :&nbsp;</label> <span class="prd_val">'.Myclass::GetSiteSetting("AMOUNT_FORMAT")." ".$product->ven_prod_price.'</span></span>';
					echo '<span class="product_more">';
//					echo CHtml::ajaxLink('More&gt;&gt;', $this->createUrl('/sales/quote/modal_product_view',array('id'=>$product->venProd->product_id)), 
//				array('success'=>'function(r){$("#modal_view_product").html(r).modal("toggle"); return false;}'), 
//				array('title'=>'Read More','rel'=>'tooltip'));
					echo CHtml::link(Myclass::t('More&gt;&gt;'),array('/products/product/productdetail','pid'=>$product->venProd->product_id),array('target'=>'_blank','title'=>'Read More','rel'=>'tooltip'));
					echo '</span></span>';
				?>
					</td>
				</tr>
			</table>
		</td>
		<td class="hide"><?php echo $product->venProd->name; ?></td>
		<td class="hide"><?php foreach($product->venProd->productCategories as $pro_category) echo $pro_category->category->name; ?></td>
	</tr>
	<?php elseif($product->prod_scenario == "item"):
	    if(isset($sel_prod_ids) && !empty($sel_prod_ids)) $checked = (in_array("item_".$product->venItem->item_id,$sel_prod_ids)) ? true : false;
	    else $checked = false;
	?>
	<tr>
		<td class="crt_qte_first">
			<?php echo CHtml::checkBox('item_id',$checked,array('value'=>$product->venItem->item_id)); ?>
		</td>
		<td class="crt_qte_cat_inner">
			<table width="100%" cellpadding="5">
				<tr>
					<td valign="top"><div class="img_bg"><?php echo ucwords($product->venItem->name); ?></div></td>
					<td width="100%">
					<?php 
					echo '<span class="product_det"><span class="product_name">'.$product->venItem->name.'</span></span>';
					echo '<span class="product_foot"><span class="product_price">'.Myclass::t('Price').' : '.Myclass::GetSiteSetting("AMOUNT_FORMAT")." ".$product->ven_prod_price.'</span>';
//					echo '<span class="product_foot"><span class="product_price"><label>Price :&nbsp;</label> <span class="prd_val">'.Myclass::getProductPriceRange($item).'</span></span>';
					echo '<span class="product_more">';
//					echo CHtml::ajaxLink('More&gt;&gt;', $this->createUrl('/products/items/update',array('id'=>$item->item_id)), 
//				array('success'=>'function(r){$("#modal_view_product").html(r).modal("toggle"); return false;}'), 
//				array('title'=>'Read More','rel'=>'tooltip'));
					echo CHtml::link(Myclass::t('More&gt;&gt;'),array('/products/items/update','id'=>$product->venItem->item_id),array('target'=>'_blank','title'=>'Read More','rel'=>'tooltip'));
					echo '</span></span>';
				?>
					</td>
				</tr>
			</table>
		</td>
		<td class="hide"><?php echo $item->name; ?></td>
		<td class="hide">&nbsp;</td>
	</tr>
	<?php endif; endforeach; ?>
    </tbody>
</table>
<div class="po_cart">
    <h4><?php echo Myclass::t('PO Cart');?></h4>
    <div id="po_cart_div"><?php echo Myclass::t('Product is empty');?></div>
</div>
<?php endif; $this->endWidget(); ?>
</div><!-- form -->

<script type="text/javascript">
$(document).ready(function(){
	<?php if(!empty($_SESSION['po_cart'][$venid])): ?>
	var items = [];
	var data = <?php echo CJSON::encode(Myclass::PoProductList($_SESSION['po_cart'][$venid])); ?>;
	    $.each(data, function(key, val) {
		items.push('<li id="' + val.prod_id + '">' + val.name + '<input class="input-mini" name="po_product['+val.prod_id+']" value="' + val.quantity + '" type="textbox" size="2" maxlength="10" onkeypress="return isNumberKey(event)" /><a class="remove" href="javascript:void(0);">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>');
	    });	

	    $('div#po_cart_div').wrapInner('<ul class="quote_list" />');
	    $('div#po_cart_div ul').html(items.join('')+'<button name="yt0" type="submit" class="btn btn-small btn-danger"><strong>Enter PO Price</strong></button>');
	<?php endif; ?>
	$("#create-po-form").submit(function(){
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
	
//	$('input[name^=po_product').live('change',function() {
//
//	    var product_name = $(this).attr('name').split('[');
//	    var prod_id = product_name[1].split(']');
//	    var task = "update";
//	    var qty = $(this).val();
//	    
//	    _call_quote(task,prod_id[0],'','',qty);
//	    
//	});
	
	$('input[name^=po_product]' ).live('change',function() {
	    var product_name = $(this).attr('name').split('[');
	    
	    var prod_id = product_name[1].split('_');
	    var product_id = parseInt(prod_id[1]);
	    var product_type = prod_id[0];
	    
	    var task = "update";
	    
	    var qty = $(this).val();
	    
	    _call_quote(task,product_id,'',product_type,qty);
	});

	
	$("div#po_cart_div ul li a.remove").live('click',function(){
	    var prod_id = $(this).parent('li').attr('id');
	    var arr = prod_id.split('_');
	    $("input:checkbox[name='product_id'][value='"+prod_id+"']").removeAttr('checked');
	    _call_quote('remove',arr[1],'',arr[0]);
	});
});

function quote_validate()
{
    var msg = null;
    $("input[name^=po_product]").each(function() {
        if($(this).val() == '' || $(this).val() == null || $(this).val() == "0")
	{
	    alert('Product Quantity Cannot be empty');
	    msg += false;
	}
    });
    if(msg == null) { return true;  }
    else { return false; }
    
}

function _call_quote(task,prod_id,assign_price,type,qty)
{
    if(type == null) type = "product";
    $.getJSON('<?php echo $this->createUrl('/procurement/po/assigntopocart');?>', { task: task, prod_id: prod_id,venid:<?php echo $venid;?>,type:type,qty: qty}, 
    function(data) {
		var items = [];
		if(data && data != "")
		{
		    $.each(data, function(key, val) { 
			items.push('<li id="' + val.prod_id + '">' + val.name + '<input class="input-mini" name="po_product['+val.prod_id+']" value="' + val.quantity + '" type="textbox" size="2" maxlength="10" /><a class="remove" href="javascript:void(0);">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>');
		    });	

		    $('div#po_cart_div').wrapInner('<ul class="quote_list" />');
		    $('div#po_cart_div ul').html(items.join('')+'<button name="yt0" type="submit" class="btn btn-small btn-danger"><strong>Enter PO Price</strong></button>');
		}
		else
		{
		    $('div#po_cart_div').html('Product is empty');
		}
	    });
}
</script>

<?php $this->beginWidget('bootstrap.widgets.BootModal', array('id'=>'modal_view_product'));  $this->endWidget(); ?>
