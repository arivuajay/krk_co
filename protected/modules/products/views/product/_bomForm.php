
<div class="create_user">
<div class="form">
<?php
//Unset the values of checkbox which set into session in BOM Setting form
unset($_SESSION['add_item']);

if(isset($_REQUEST['prodid'])):
$prodid = $_REQUEST['prodid'];
$getselected = ProductBom::model()->findAll("product_id = {$prodid}");
endif;


$items = array();
if(!empty($getselected)):
    foreach($getselected as $val){

	$itemName = Myclass::GetItemName($val->item_id);
	$items[$val->item_id] = $itemName;
    }    
endif;


$itemvalues = array();
$i = 0;
if(!empty($getselected)):
foreach($getselected as $val){

    //$itemName = Myclass::GetItemName($val->item_id);
    $itemvalues[$i]['id']= $val->item_id;
    $itemvalues[$i]['value'] = $val->item_value;
//    $itemvalues[$i]['id'] = $val->item_id;
//    $itemvalues[$i]['value'] = $val->item_value;
    $i++;
}
endif;

// $dbJsonVal =  CJSON::encode($itemvalues);
// echo $dbJsonVal;
?>
    <script type="text/javascript">
        var task
        var itemjs = <?php echo CJSON::encode($items); ?>
        
        task = "add";
    $(document).ready(function() {
        $.each(itemjs, function(i, item) {

            $("#itembom_"+i).attr("checked","checked");
            _call_quote_exist(task,item,"itembom_"+i);

        });

        
    });

        

    </script>
    
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'bom-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><?php echo Myclass::t('Fields with');?> <span class="required">*</span> <?php echo Myclass::t('are required');?>.</p>
        <?php echo Myclass::t('BOM Settings');?>
	<?php //echo $form->errorSummary($model);

        ?>

        <div class="row row-fluid row row-fluid-fluid">
                <?php echo $form->labelEx($bmodel,'product_id'); ?>
                <?php echo $form->textField($bmodel,'product_id',array('size'=>60,'maxlength'=>255,'readonly'=>'readonly','value'=>  Myclass::getProductName($prodid))); ?>

        </div>
                
<!--        <div class="row row-fluid">
                <?php //echo $form->labelEx($bmodel,'unit_manufacture'); ?>
                <?php //echo $form->textField($bmodel,'unit_manufacture',array('onkeypress'=>'return isNumberKey(event);'));?>
        </div>-->


	<div class="row span9">
		

<?php
//print"<pre>";
//print_r($Itemmodel);exit;
//var_dump($Itemmodel); exit;

$this->widget('application.extensions.alphapager.ApGridView', array(
	'id'=>'product-grid',
        
	'dataProvider'=>$Itemmodel->search(),
	'filter'=>$Itemmodel,
	'template'=>"{alphapager}\n{pager}\n{items}",

	'columns'=>array(
		'name',
                array(
      'value'=>'CHtml::checkBox("itemid",null,array("value"=>$data->name,"id"=>"itembom_".$data->item_id))',
          //'value'=>CHtml::checkBox("itemid",in_array($Itemmodel->item_id,$items)?true:false,array("value"=>$Itemmodel->name,"id"=>$Itemmodel->item_id)),
       
        'type'=>'raw',
        'htmlOptions'=>array('width'=>5),
        //'visible'=>false,
        ),
            
	),

)); 
?>

     
	</div>

   

    <div class="quote_cart_list span3">
	<h4><?php echo Myclass::t('Associated BOM');?> <br /><sub>(<?php echo Myclass::t('Unit of manufacture Per Item');?>)</sub></h4>
    <div id="quote_cart"><?php echo Myclass::t('Item Is Empty');?></div>
</div>

       

<?php $this->endWidget(); ?>

</div><!-- form -->
</div><!-- crate user -->



<script type="text/javascript">

var sub = <?php echo CJSON::encode($itemvalues); ?>;


$(document).ready(function(){

        $("#bom-form").submit(function(){
	    return item_validate();
	});

$('input:checkbox').live('click',function() {

   var task;
	    if($(this).is(':checked'))
	    {
		task = "add";
    	    }
	    else
	    {
		task = "remove";
	    }
            
            var item_value = $(this).val();
            var item_id = $(this).attr('id');

            _call_quote(task,item_value,item_id);
            

});

});


function _call_quote(task,item_value,item_id)
{

    var temp;
    
    $.getJSON('<?php echo $this->createUrl('/products/product/addtoitem');?>', { task: task, item_value: item_value, item_id: item_id }, function(data) {
		//alert(data);
		var items = [];
                var newitem =  '<?php echo CJSON::encode($itemvalues);?>';
              
             
//                alert(newitem.value);
		if(data && data !="")
		{
                    
		    $.each(data, function(key, val) {
                     
//                    var i =  jQuery.inArray(key, newitem);
//                        $.post("<?php //echo Yii::app()->createAbsoluteUrl('/products/product/itemvalue');?>",{itemid:val.item_id},function(result){
//
//                        var itemvalue = result;
//                        alert(itemvalue);
//
//
//                        });
                            
//           alert(newitem);
//                        $.each(newitem, function(key1, val1) {
//
//
//                            alert(val1.value);
//                            exit;
//                        });

                    
//                    $.each(sub,function(k,v){
//                        if(val.item_id == v.id){
//                             temp = v.value;
//                        }
//                    });
			items.push('<li id="' + val.item_id + '">' + val.name + '<input class="input-mini" name="item['+val.item_id+']"  type="textbox" size="2" maxlength="10" /></li>');
		    });

                    $('div#quote_cart').wrapInner('<ul class="quote_list1" />');
		    $('div#quote_cart ul').html(items.join('')+'<input type="submit" value="Save" /><input type="reset" value="Cancel" />');
		}
		else
		{
		    $('div#quote_cart').html('Items Is Empty');
		}
	    });
}





function _call_quote_exist(task,item_value,item_id)
{

    var temp;

    $.getJSON('<?php echo $this->createUrl('/products/product/addtoitem');?>', { task: task, item_value: item_value, item_id: item_id }, function(data) {
		//alert(data);
		var items = [];
                var newitem =  '<?php echo CJSON::encode($itemvalues);?>';


//                alert(newitem.value);
		if(data && data !="")
		{

		    $.each(data, function(key, val) {

//                    var i =  jQuery.inArray(key, newitem);
//                        $.post("<?php //echo Yii::app()->createAbsoluteUrl('/products/product/itemvalue');?>",{itemid:val.item_id},function(result){
//
//                        var itemvalue = result;
//                        alert(itemvalue);
//
//
//                        });

//           alert(newitem);
//                        $.each(newitem, function(key1, val1) {
//
//
//                            alert(val1.value);
//                            exit;
//                        });


                    $.each(sub,function(k,v){
                        if(val.item_id == v.id){
                             temp = v.value;
                        }
                    });
			items.push('<li id="' + val.item_id + '">' + val.name + '<input class="input-mini" name="item['+val.item_id+']" value='+temp+' type="textbox" size="2" maxlength="10" /></li>');
		    });

                    $('div#quote_cart').wrapInner('<ul class="quote_list1" />');
		    $('div#quote_cart ul').html(items.join('')+'<input type="submit" value="Save" /><input type="reset" value="Cancel" />');
		}
		else
		{
		    $('div#quote_cart').html('Items Is Empty');
		}
	    });
}

function item_validate(){

var msg = null;


    $("input[name^=item]").each(function() {
        
        if($(this).val() == '' || $(this).val() == null)
	{
            
	    alert('Item Cannot be null');
	    msg += false;
	}
    });

     

    if(msg == null) { return true;  }
    else { return false; }


}


</script>


