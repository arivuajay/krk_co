<?php
$pro_cat = Myclass::GetProductCategory(); 
$cat_array = array();
foreach ($pro_cat as $cat):
    $cat_array[] = array('value'=>"^{$cat->name}$",'label'=>$cat->name);
endforeach;

echo CHtml::scriptFile(Yii::app()->getBaseUrl(true).'/jqtable/js/jquery.dataTables.columnFilter.js');
echo CHtml::script('$(document).ready(function() {  
			var oTable = $("#quote-table").dataTable({
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
<h1><?php echo Yii::t('sales','CREATE_QUOTES');?></h1>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'quote-form',
	'enableAjaxValidation'=>false,
)); 
echo $form->errorSummary(array($model),''); 
?>
    <div class="row-fluid create_quote_customer">
	    <?php echo $form->dropDownList($model,'company_id', CHtml::listData(Myclass::GetCompanies(), 'company_id', 'name'), array('empty'=>'Choose Customer')); ?>
	</div>
	
<div class="crt_qte_cat"><label><?php echo Myclass::t('Choose Product Category');?></label><div id="pro_cat_sel"></div></div>
<table width="90%" border="0" cellspacing="0" class="product_DT_view create_quote" id="quote-table" cellpadding="0">
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
	$sel_prod_ids = array_keys($_SESSION['add_quote']);
	foreach($products as $product): 
	    if(isset($sel_prod_ids) && !empty($sel_prod_ids)) $checked = (in_array($product->product_id,$sel_prod_ids)) ? true : false;
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
					echo "<span>".substr(strip_tags($product->description),0,255)."</span>";    
					echo '<span class="product_foot"><span class="product_price"><label>'.Myclass::t('Price').' :&nbsp;</label> <span class="prd_val">'.Myclass::getProductPriceRange($product).'</span></span>';
					echo '<span class="product_more">';
//					echo CHtml::ajaxLink('More&gt;&gt;', $this->createUrl('/sales/quote/modal_product_view',array('id'=>$product->product_id)),
//				array('success'=>'function(r){$("#modal_view_product").html(r).modal("toggle"); return false;}'),
//				array('title'=>'Read More','rel'=>'tooltip'));
					echo CHtml::link(Myclass::t('More').'&gt;&gt;',array('/products/product/productdetail','pid'=>$product->product_id),array('target'=>'_blank','title'=>'Read More','rel'=>'tooltip'));
					echo '</span></span>';
				?>
					</td>
				</tr>
			</table>
		</td>
		<td class="hide"><?php echo $product->name; ?></td>
		<td class="hide"><?php foreach($product->productCategories as $pro_category) echo $pro_category->category->name; ?></td>
	</tr>
	<?php $i++; endforeach;	?>
    </tbody>
</table>
<div class="quote_cart_list">
    <h4><?php echo Myclass::t('Quote Cart');?></h4>
    <div id="quote_cart"><?php echo Myclass::t('Quote Is Empty');?></div>
</div>
<?php
$this->endWidget(); ?>
</div><!-- form -->

<script type="text/javascript">
    $(document).ready(function(){
	<?php if(!empty($quote_prod)): ?>
	var items = [];
	var data = <?php echo $quote_prod; ?>;
	    $.each(data, function(key, val) {
		items.push('<li id="' + val.prod_id + '">' + val.name + '<input class="input-mini" name="quote_product['+val.prod_id+']" value="' + val.qty + '" type="textbox" size="2" maxlength="10" onkeypress="return isNumberKey(event)" /><a class="remove" href="javascript:void(0);">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>');
	    });	

	    $('div#quote_cart').wrapInner('<ul class="quote_list" />');//.wrapInner('<form method="post" onSubmit="return quote_validate();" action="<?php echo CHtml::normalizeUrl(array('/sales/quote/makequoteprice')) ?>" class="quote_list" />');
	    $('div#quote_cart ul').html(items.join('')+'<button name="yt0" type="submit" class="btn btn-small btn-danger"><strong>Enter Quote Price</strong></button>');
	<?php endif; ?>
	    
	$("#quote-form").submit(function(){
	    return quote_validate();
	});
	
	$('input#product_id' ).live('click',function() {
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
	
	
	$('input[name^=quote_product]' ).live('change',function() {
	    var product_name = $(this).attr('name').split('[');
	    var prod_id = parseInt(product_name[1]);
	    var task = "update";
	    var qty = $(this).val();
	    
	    _call_quote(task,prod_id,qty);
	    
	});
    
	$("div#quote_cart ul li a.remove").live('click',function(){
	    var prod_id = $(this).parent('li').attr('id');
	    $("input:checkbox[name='product_id'][value='"+prod_id+"']").removeAttr('checked');
	    _call_quote('remove',prod_id);
	});
});    
function quote_validate()
{
    var msg = null;
    $("input[name^=quote_product]").each(function() {
        if($(this).val() == '' || $(this).val() == null)
	{
	    alert('Product Quantity Cannot be null');
	    msg += false;
	}
    });
    if(msg == null) { return true;  }
    else { return false; }
    
}

function _call_quote(task,prod_id,qty)
{
    $.getJSON('<?php echo $this->createUrl('/sales/quote/addtoquote');?>', { task: task, prod_id: prod_id , qty: qty }, function(data) {
		//alert(data);
		var items = [];
		if(data && data !="")
		{
		    $.each(data, function(key, val) {
			items.push('<li id="' + val.prod_id + '">' + val.name + '<input class="input-mini" name="quote_product['+val.prod_id+']" value="' + val.qty + '" type="textbox" size="2" maxlength="10" onkeypress="return isNumberKey(event)" /><a class="remove" href="javascript:void(0);">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>');
		    });	

$('div#quote_cart').wrapInner('<ul class="quote_list" />');//.wrapInner('<form method="post" onSubmit="return quote_validate();" action="<?php echo CHtml::normalizeUrl(array('/sales/quote/makequoteprice')) ?>" class="quote_list" />');
		    $('div#quote_cart ul').html(items.join('')+'<button name="yt0" type="submit" class="btn btn-small btn-danger"><strong>Enter Quote Price</strong></button>');
		}
		else
		{
		    $('div#quote_cart').html('Quote Is Empty');
		}
	    });
}


</script>


<?php $this->beginWidget('bootstrap.widgets.BootModal', array('id'=>'modal_view_product'));  $this->endWidget(); ?>