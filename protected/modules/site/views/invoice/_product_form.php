<?php
$themeUrl = $this->themeUrl;
$cs = Yii::app()->getClientScript();
$cs_pos_end = CClientScript::POS_END;
?>
<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">Product Info</h3>
    </div>
    <div class="box-body" >
        <div class="row">
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'invoice-items-form', 'htmlOptions' => array('role' => 'form', 'class' => 'form-horizontal'),
                'action' => Yii::app()->createUrl('/site/invoice/addProduct'),
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                    'afterValidate' => 'js:AddINVDetails'
                ),
                'enableAjaxValidation' => true,
            ));
            $families = ProductFamily::ProductFamilyList();
            $products = $variety = $grade = $size = array();

            if ($detail_model->inv_det_prod_fmly_id)
                $products = CHtml::listData(Product::model()->active()->findAll(array('order' => 'pro_name', 'condition' => "pro_family_id = '{$detail_model->inv_det_prod_fmly_id}'")), 'product_id', 'pro_name');

            if ($detail_model->inv_det_product_id) {
                $variety = CHtml::listData(ProductVariety::model()->active()->findAll(array('order' => 'variety_name', 'condition' => "product_id = '{$detail_model->inv_det_product_id}'")), 'variety_id', 'variety_name');

                $grade = CHtml::listData(ProductGrade::model()->active()->findAll(array('order' => 'grade_long_name', 'condition' => "product_id = '{$detail_model->inv_det_product_id}'")), 'grade_id', 'grade_long_name');

                $size = CHtml::listData(ProductSize::model()->active()->findAll(array('order' => 'size_name', 'condition' => "product_id = '{$detail_model->inv_det_product_id}'")), 'size_id', 'size_name');
            }
            ?>
            <div class="col-lg-6">
                <div class="form-group">
                    <?php echo $form->labelEx($detail_model, 'inv_det_prod_fmly_id', array('class' => 'col-sm-3 control-label')); ?>
                    <div class="col-sm-6">
                        <?php
                        echo $form->dropDownList($detail_model, 'inv_det_prod_fmly_id', $families, array('class' => 'form-control', 'prompt' => 'Select Family',
                            'ajax' => array(
                                'type' => 'GET',
                                'url' => Yii::app()->createUrl('/site/default/getProductbyFamily'),
                                'update' => '#InvoiceItems_inv_det_product_id',
                                'data' => array('id' => 'js:this.value'))));
                        ?>
                        <?php echo $form->error($detail_model, 'inv_det_prod_fmly_id'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($detail_model, 'inv_det_product_id', array('class' => 'col-sm-3 control-label')); ?>
                    <div class="col-sm-6">
                        <?php
                        echo $form->dropDownList($detail_model, 'inv_det_product_id', $products, array('class' => 'form-control', 'prompt' => 'Select Products',
                            'ajax' => array(
                                'type' => 'GET',
                                'url' => Yii::app()->createUrl('/site/default/getVarietybyProductId'),
                                'update' => '#InvoiceItems_inv_det_variety_id',
                                'data' => array('id' => 'js:this.value'))));
                        ?>
                        <?php echo $form->error($detail_model, 'inv_det_product_id'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($detail_model, 'inv_det_variety_id', array('class' => 'col-sm-3 control-label')); ?>
                    <div class="col-sm-6">
                        <?php echo $form->dropDownList($detail_model, 'inv_det_variety_id', $variety, array('class' => 'form-control', 'prompt' => 'Select Variety')); ?>
                        <?php echo $form->error($detail_model, 'inv_det_variety_id'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($detail_model, 'inv_det_grade', array('class' => 'col-sm-3 control-label')); ?>
                    <div class="col-sm-6">
                        <?php echo $form->dropDownList($detail_model, 'inv_det_grade', $grade, array('class' => 'form-control', 'size' => 4)); ?>
                        <?php echo $form->error($detail_model, 'inv_det_grade'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($detail_model, 'inv_det_size', array('class' => 'col-sm-3 control-label')); ?>
                    <div class="col-sm-6">
                        <?php echo $form->dropDownList($detail_model, 'inv_det_size', $size, array('class' => 'form-control', 'size' => 4)); ?>
                        <?php echo $form->error($detail_model, 'inv_det_size'); ?>
                    </div>
                </div>

            </div>
            <div class="col-lg-6 col-xs-6">

                <div class="form-group">
                    <?php echo $form->labelEx($detail_model, 'inv_det_cotton_qty', array('class' => 'col-sm-3 control-label')); ?>
                    <div class="col-sm-6">
                        <div class="input-group">
                            <?php echo $form->textField($detail_model, 'inv_det_cotton_qty', array('class' => 'form-control', 'size' => 10, 'maxlength' => 10)); ?>
                            <div class="input-group-addon">.00</div>
                        </div>
                        <?php echo $form->error($detail_model, 'inv_det_cotton_qty'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($detail_model, 'inv_det_currency', array('class' => 'col-sm-3 control-label')); ?>
                    <div class="col-sm-6">
                        <?php echo $form->dropDownList($detail_model, 'inv_det_currency', array('INR (INR)' => 'INR (INR)', 'USD ($)' => 'USD ($)'), array('class' => 'form-control', 'onchange' => 'js:$("#fmt_currency").html(this.value)')); ?>
                        <?php echo $form->error($detail_model, 'inv_det_currency'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($detail_model, 'inv_det_price', array('class' => 'col-sm-3 control-label')); ?>
                    <div class="col-sm-6">
                        <div class="input-group">
                            <div class="input-group-addon" id="fmt_currency">INR (INR)</div>
                            <?php echo $form->textField($detail_model, 'inv_det_price', array('class' => 'form-control', 'size' => 10, 'maxlength' => 10)); ?>
                        </div>
                        <?php echo $form->error($detail_model, 'inv_det_price'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($detail_model, 'inv_det_net_weight', array('class' => 'col-sm-3 control-label')); ?>
                    <div class="col-sm-6">
                        <div class="input-group">
                            <?php echo $form->textField($detail_model, 'inv_det_net_weight', array('class' => 'form-control', 'size' => 10, 'maxlength' => 10)); ?>
                            <div class="input-group-addon">Kg</div>
                        </div>
                        <?php echo $form->error($detail_model, 'inv_det_net_weight'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($detail_model, 'inv_det_gross_weight', array('class' => 'col-sm-3 control-label')); ?>
                    <div class="col-sm-6">
                        <div class="input-group">
                            <?php echo $form->textField($detail_model, 'inv_det_gross_weight', array('class' => 'form-control', 'size' => 10, 'maxlength' => 10)); ?>
                            <div class="input-group-addon">Kg</div>
                        </div>
                        <?php echo $form->error($detail_model, 'inv_det_gross_weight'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($detail_model, 'inv_det_ctnr_no', array('class' => 'col-sm-3 control-label')); ?>
                    <div class="col-sm-6">
                        <?php echo $form->textField($detail_model, 'inv_det_ctnr_no', array('class' => 'form-control', 'size' => 10, 'maxlength' => 10)); ?>
                        <?php echo $form->error($detail_model, 'inv_det_ctnr_no'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($detail_model, 'is_delivered', array('class' => 'col-sm-3 control-label')); ?>
                    <div class="col-sm-6">
                        <?php echo $form->radioButtonList($detail_model, 'is_delivered', array('Y' => 'Yes', 'N' => 'no'), array('class' => 'form-control','labelOptions'=>array('style'=>'margin-right: 10px;'), 'separator'=>'')); ?>
                        <?php echo $form->error($detail_model, 'is_delivered'); ?>
                    </div>
                </div>






                <div class="form-group">
                    <?php echo CHtml::submitButton('ADD PRODUCT', array('class' => $detail_model->isNewRecord ? 'btn btn-success' : 'btn btn-primary')); ?>
                </div>
            </div>
            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>

<?php
$grade_url = Yii::app()->createUrl('/site/default/getGradeByProduct');
$size_url = Yii::app()->createUrl('/site/default/getSizeByProduct');
$inv_add_product = Yii::app()->createUrl('/site/invoice/addProduct');
$inv_products_url = Yii::app()->createUrl('/site/invoice/invAddedProducts');

//For create only
if (empty($detail_model->inv_det_prod_fmly_id)) {
    $js = <<< EOD
    $(function(){
        PoProductList();
    });
EOD;
}

$js .= <<< EOD
    $(document).ready(function(){
        $('body').on('change','#InvoiceItems_inv_det_product_id',function(){
            $.ajax({
                'type':'GET','url':'$grade_url','data':{'id':this.value},'cache':false,
                'success':function(html){
                    $("#InvoiceItems_inv_det_grade").html(html);
                }
            });
            $.ajax({
                'type':'GET','url':'$size_url','data':{'id':this.value},'cache':false,
                'success':function(html){
                    $("#InvoiceItems_inv_det_size").html(html);
                }
            });
            return false;
        });
    });

    function PoProductList(){
     $.ajax({
            'url':'$inv_products_url',
            'beforeSend':function(){
                $('#inv_added_products .box').append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
            },
            'success':function(html){
                $("#inv_added_products .box-body").html(html);
                $('#inv_added_products .overlay').remove();
            }
        });
    }

    function AddINVDetails(f, d, e){
        if (e == false) {
            var data=$("#invoice-items-form").serialize();
            $.ajax({
                type: 'POST',
                url: '$inv_add_product',
                data:data,
                success:function(data){
                    PoProductList();
                },
                dataType:'html'
            });
        }
        return false;
    }
EOD;
$cs->registerScript('_inv_product_form', $js);
?>



