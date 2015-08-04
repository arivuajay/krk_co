<?php
/* @var $this OrderdetailController */
/* @var $omodel Orderdetail */
/* @var $form CActiveForm */
?>
 <script type = "text/javascript">

function go(){

    var x = document.getElementById("Orderdetail_tax").value;

    var y = document.getElementById("Orderdetail_line_total").value;

    

   if(x == ''){
       x = 0;
   }
    total=parseInt(y)*(parseInt(x)/100)+parseInt(y);
    $("#Orderdetail_total_order_value").attr("value", total);

    //document.getElementById(“Orderdetail_total_order_value”).innerHTML=total;

}

//function doSum(e){
//
//    var value=e.val();
//    alert(value);
//}

                </script>
  <?php

$taxval = Myclass::GetSiteSetting('TAX_VALUE');


?>
<div class="create_user">
<div class="form">

    <?php if(Yii::app()->user->hasFlash('order_detail')){ ?>

    <div class="flash-success">
    <?php //echo Yii::app()->user->getFlash('contact'); ?>
    <p><?php echo Yii::app()->user->getFlash('order_detail'); ?></p>
    </div>

    <?php } //else: ?>
<?php
//print"<pre>";
//print_r($QuoteProduct);exit;
if(empty ($_REQUEST[id])){

    $Product = new Product();
    $soproducts = new SoProducts();
}


//Getting products from master products to display in auto suggest
    $ProductValue = Myclass::getProducts();

    $Products = array();
    foreach($ProductValue as $p){

    $Products[] = $p->name;
    }

 


//$omodelAll = Orderdetail::model()->findAll();
//if(empty ($omodel)){
//    echo "empty";
//}else{
//    echo "not";
//}
//exit;
//print"<pre>";
//print_r($omodel);exit;
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'orderdetail-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($omodel); ?>
        <span class="label">
            <?php echo Yii::t('ui', 'Place Order detail'); ?>
        </span>
        <div class="row row-fluid">
		<?php echo $form->labelEx($omodel,'order_date'); ?>
		<?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
    'name'=>'Orderdetail[order_date]',
    'language'=>Yii::app()->language=='et' ? 'et' : null,
            'value'=>$omodel->order_date,
    'options'=>array(
        'showAnim'=>'fadeIn', // 'show' (the default), 'slideDown', 'fadeIn', 'fold'
        'showOn'=>'both', // 'focus', 'button', 'both'
        'buttonText'=>Yii::t('ui',''),
        'buttonImage'=>Yii::app()->request->baseUrl.'/images/calendar.png',
        'buttonImageOnly'=>true,
        'dateFormat'=>'yy-mm-dd',
    ),
    'htmlOptions'=>array(
        'style'=>'width:80px;vertical-align:top'
    ),
));
        ?>
	</div>

	<div class="row row-fluid">
		<?php echo $form->labelEx($omodel,'shipment_date'); ?>
		<?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
    'name'=>'Orderdetail[shipment_date]',
    'language'=>Yii::app()->language=='et' ? 'et' : null,
            'value'=>$omodel->shipment_date,
    'options'=>array(
        'showAnim'=>'fadeIn', // 'show' (the default), 'slideDown', 'fadeIn', 'fold'
        'showOn'=>'both', // 'focus', 'button', 'both'
        'buttonText'=>Yii::t('ui',''),
        'buttonImage'=>Yii::app()->request->baseUrl.'/images/calendar.png',
        'buttonImageOnly'=>true,
        'dateFormat'=>'yy-mm-dd',
    ),
    'htmlOptions'=>array(
        'style'=>'width:80px;vertical-align:top'
    ),
));
        ?>
	</div>
        
	<div class="complex">
        
        <div class="panel">
            <table class="templateFrame grid" cellspacing="0">
                <thead class="templateHead">
                    <tr>
                        <td>
                            <?php echo $form->labelEx(Orderdetail::model(),'product_name');?>
                        </td>
                        <td>
                            <?php echo $form->labelEx(Orderdetail::model(),'quantity');?>
                        </td>
                        <td>
                            <?php echo $form->labelEx(Orderdetail::model(),'quote_price');?>
                        </td>
                        <td>
                            <?php echo $form->labelEx(Orderdetail::model(),'order_value');?>
                        </td>
                        
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <td colspan="4">
                            <div class="add"><?php if(!isset($_REQUEST[id])){?><a href="#"><?php echo Yii::t('ui','Add Product Details');}?></a></div>
                            <textarea class="template" row row-fluids="0" cols="0">
                                <tr class="templateContent">
                                    <td>
                                        <?php //echo CHtml::textField('QuoteProduct[{0}][product]','',array('style'=>'width:100px'));
//                                        $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
//    'name'=>'QuoteProduct[{0}][product]',
//                                            'id'=>'avi',
//    'source'=>array('pro','prod','produc'),
//
//    // additional javascript options for the autocomplete plugin
//    'options'=>array(
//        'minLength'=>'2',
//    ),
//    'htmlOptions'=>array(
//        'style'=>'height:20px;'
//    ),
//));

//                                        $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
//                                'id'=>'business',
//				'name'=>'QuoteProduct[{0}][product]',
//				//'value'=>$casesmodel->business_name,
//                               	'source'=>$this->createUrl('site/searchproduct'),
//				// additional javascript options for the autocomplete plugin
//				'options'=>array(
//						'showAnim'=>'fold',
//
//				),
//                                //additional html options
//                                'htmlOptions'=>array('style'=>'height:20px;'),
//			));

                                        echo CHtml::dropDownList('QuoteProduct[{0}][product]','',CHtml::listData(Myclass::getProducts(), 'product_id', 'name'), array('empty'=>'Select Product'));
		?>

                                        
                                    </td>
                                    <td>
                                        <?php echo CHtml::textField('QuoteProduct[{0}][quantity]','',array('style'=>'width:100px')); ?>
                                    </td>
                                    <td>
                                        <?php echo CHtml::textField('QuoteProduct[{0}][quote_price]','',array('style'=>'width:100px')); ?>
                                    </td>
                                    <td>
                                        <?php echo CHtml::textField('QuoteProduct[{0}][order_value]','',array('style'=>'width:100px')); ?>
                                    </td>
                                    
                                    <td>
                                        <div class="remove"><a href="#"><?php echo Yii::t('ui','Remove');?></a></div>
                                        <input type="hidden" class="row row-fluidIndex" value="{0}" />
                                    </td>
                                </tr>
                            </textarea>
                        </td>
                    </tr>
                </tfoot>
                <tbody class="templateTarget">

                <?php
                $orderv = '';

                $quan = '';
                $readonly = '';
                foreach($QuoteProduct as $i=>$person):
//                    echo $person->quantity;
//                    echo $person->quote_price;exit;
                    
                       if(isset($_REQUEST[id])){

                           $orderv = $person->quantity * $person->quote_price;
                           $quan += $orderv;
                           $total_order_value = $quan*($taxval/100)+$quan;
                           $readonly = 'readonly';
                           ?>
                           
               
                               <?php
                           }
                 
                    ?>

                    <tr class="templateContent">
                        <td>
                            <?php 

                            if(isset($_REQUEST[id])){
				    $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
					'name'=>'QuoteProduct'."[$i][product]",
					'source'=>$Products,
					    'value'=>$person->product->product_id,
					// additional javascript options for the autocomplete plugin
					'options'=>array(
					    'minLength'=>'2',
					),
					'htmlOptions'=>array(
					    'style'=>'height:20px;',
					    'readonly'=>'readonly',
					    'class'=>'hide'
					),
				    ));
			    echo '<input type="text" value="'.$person->product->name.'" readonly="readonly" style="height:20px;" />';
                                }
                                else
                                {
                                    echo CHtml::dropDownList('QuoteProduct'."[$i][product]",'',CHtml::listData(Myclass::getProducts(), 'product_id', 'name'), array('empty'=>'Select Product'));
                                }
                              
                            ?>
                        </td>
                        <td>
                            <?php if(isset ($_REQUEST[id])){echo $form->textField($person,"[$i]quantity",array('style'=>'width:100px','readonly'=>'readonly'));}else{echo $form->textField($soproducts,"quantity",array('style'=>'width:100px','name'=>'QuoteProduct'."[$i][quantity]"));} ?>
                        </td>
                        <td>
                            <?php if(isset ($_REQUEST[id])){echo $form->textField($person,"[$i]quote_price",array('style'=>'width:100px','readonly'=>'readonly'));}else{echo $form->textField($soproducts,"quote_price",array('style'=>'width:100px','name'=>'QuoteProduct'."[$i][quote_price]"));} ?>
                        </td>
                        <td>
                            <?php if(isset ($_REQUEST[id])){echo $form->textField($person,"[$i]order_value",array('style'=>'width:100px','value'=>$orderv,'readonly'=>'readonly'));}else{echo $form->textField($soproducts,"order_value",array('style'=>'width:100px','name'=>'QuoteProduct'."[$i][order_value]"));} ?>
                        </td>
                        
                        <td>
                            <div id="remove_offer" class="remove"><?php echo Yii::t('ui','Remove');?>
                            <input type="hidden" class="row row-fluidIndex" value="<?php echo $i;?>" /></div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div><!--panel-->
    </div><!--complex-->

    
        <div class="row row-fluid">
		<?php echo $form->labelEx($omodel,'line_total'); ?>
		<?php echo $form->textField($omodel,'line_total',array('value'=>$quan,'readonly'=>$readonly,'onblur'=>"go()")); ?>
		
	</div>
        <div class="row row-fluid">
		<?php //echo $form->labelEx($omodel,'quote_id'); ?>
		<?php echo $form->hiddenField($omodel,'so_id',array('value'=>Yii::app()->session['so_id'])); ?>

	</div>

	<div class="row row-fluid">
		<?php echo $form->labelEx($omodel,'tax'); ?>
		<?php echo $form->textField($omodel,'tax',array('value'=> $taxval ,'onblur'=>"go()",'readonly'=>'readonly')); ?>
		
	</div>

	<div class="row row-fluid">
		<?php echo $form->labelEx($omodel,'total_order_value'); ?>
		<?php echo $form->textField($omodel,'total_order_value',array('value'=>$total_order_value,'readonly'=>'readonly')); ?>
		
	</div>
    
	<div class="row row-fluid">
		<?php // echo $form->labelEx($omodel,'total_order_value'); ?>
		

	</div>
    
    
    

	<div class="row row-fluid buttons">
		<label>&nbsp;</label>
		<?php //echo CHtml::link('Back To Costomer Information',array('salesorder/create')); ?>
		<?php echo CHtml::submitButton($omodel->isNewRecord ? 'Save' : 'Save',array('class'=>'btn-primary')); ?>
		<?php //echo CHtml::link('Next',array('salesorder/create'));
                
                
                ?>

	</div>
<?php $this->endWidget(); ?>

</div><!-- form -->
</div><!-- create user div -->