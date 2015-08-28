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
                'id' => 'purchase-order-details-form', 'htmlOptions' => array('role' => 'form', 'class' => 'form-horizontal'),
                'action' => Yii::app()->createUrl('/site/purchaseorder/addProduct', array('posession' => $posession)),
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                    'validateOnChange' => false,
                    'beforeValidate' => 'js:b4AddProd',
                    'afterValidate' => 'js:AddPODetails'
                ),
                'enableAjaxValidation' => true,
            ));
            $families = ProductFamily::ProductFamilyList();
            $products = $variety = $grade = $size = array();

            if ($detail_model->po_det_prod_fmly_id)
                $products = CHtml::listData(Product::model()->active()->findAll(array('order' => 'pro_name', 'condition' => "pro_family_id = '{$detail_model->po_det_prod_fmly_id}'")), 'product_id', 'pro_name');

            if ($detail_model->po_det_product_id) {
                $variety = CHtml::listData(ProductVariety::model()->active()->findAll(array('order' => 'variety_name', 'condition' => "product_id = '{$detail_model->po_det_product_id}'")), 'variety_id', 'variety_name');

                $grade = CHtml::listData(ProductGrade::model()->active()->findAll(array('order' => 'grade_long_name', 'condition' => "product_id = '{$detail_model->po_det_product_id}'")), 'grade_id', 'grade_long_name');

                $size = CHtml::listData(ProductSize::model()->active()->findAll(array('order' => 'size_name', 'condition' => "product_id = '{$detail_model->po_det_product_id}'")), 'size_id', 'size_name');
            }
            ?>
            <div class="col-lg-6">
                <div class="form-group">
                    <?php echo $form->labelEx($detail_model, 'po_det_prod_fmly_id', array('class' => 'col-sm-3 control-label')); ?>
                    <div class="col-sm-6">
                        <?php
                        echo $form->dropDownList($detail_model, 'po_det_prod_fmly_id', $families, array('class' => 'form-control', 'prompt' => 'Select Family',
                            'ajax' => array(
                                'type' => 'GET',
                                'url' => Yii::app()->createUrl('/site/default/getProductbyFamily'),
                                'update' => '#PurchaseOrderDetails_po_det_product_id',
                                'data' => array('id' => 'js:this.value'))));
                        ?>
                        <?php echo $form->error($detail_model, 'po_det_prod_fmly_id'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($detail_model, 'po_det_product_id', array('class' => 'col-sm-3 control-label')); ?>
                    <div class="col-sm-6">
                        <?php
                        echo $form->dropDownList($detail_model, 'po_det_product_id', $products, array('class' => 'form-control', 'prompt' => 'Select Products',
                            'ajax' => array(
                                'type' => 'GET',
                                'url' => Yii::app()->createUrl('/site/default/getVarietybyProductId'),
                                'update' => '#PurchaseOrderDetails_po_det_variety_id',
                                'data' => array('id' => 'js:this.value'))));
                        ?>
                        <?php echo $form->error($detail_model, 'po_det_product_id'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($detail_model, 'po_det_variety_id', array('class' => 'col-sm-3 control-label')); ?>
                    <div class="col-sm-6">
                        <?php echo $form->dropDownList($detail_model, 'po_det_variety_id', $variety, array('class' => 'form-control', 'prompt' => 'Select Variety')); ?>
                        <?php echo $form->error($detail_model, 'po_det_variety_id'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($detail_model, 'po_det_grade', array('class' => 'col-sm-3 control-label')); ?>
                    <div class="col-sm-6">
                        <?php echo $form->dropDownList($detail_model, 'po_det_grade', $grade, array('class' => 'form-control', 'multiple' => 'multiple', 'size' => 4)); ?>
                        <?php echo $form->error($detail_model, 'po_det_grade'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($detail_model, 'po_det_size', array('class' => 'col-sm-3 control-label')); ?>
                    <div class="col-sm-6">
                        <?php echo $form->dropDownList($detail_model, 'po_det_size', $size, array('class' => 'form-control', 'multiple' => 'multiple', 'size' => 4)); ?>
                        <?php echo $form->error($detail_model, 'po_det_size'); ?>
                    </div>
                </div>

            </div>
            <div class="col-lg-6 col-xs-6">
                <div class="form-group">
                    <?php echo $form->labelEx($detail_model, 'po_det_net_weight', array('class' => 'col-sm-3 control-label')); ?>
                    <div class="col-sm-6">
                        <?php echo $form->textField($detail_model, 'po_det_net_weight', array('class' => 'form-control', 'size' => 10, 'maxlength' => 10)); ?>
                        <?php echo $form->error($detail_model, 'po_det_net_weight'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($detail_model, 'po_det_container_qty', array('class' => 'col-sm-3 control-label')); ?>
                    <div class="col-sm-6">
                        <?php echo $form->textField($detail_model, 'po_det_container_qty', array('class' => 'form-control', 'size' => 10, 'maxlength' => 10)); ?>
                        <?php echo $form->error($detail_model, 'po_det_container_qty'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($detail_model, 'po_det_cotton_qty', array('class' => 'col-sm-3 control-label')); ?>
                    <div class="col-sm-6">
                        <?php echo $form->textField($detail_model, 'po_det_cotton_qty', array('class' => 'form-control', 'size' => 10, 'maxlength' => 10)); ?>
                        <?php echo $form->error($detail_model, 'po_det_cotton_qty'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($detail_model, 'po_det_currency', array('class' => 'col-sm-3 control-label')); ?>
                    <div class="col-sm-6">
                        <?php echo $form->dropDownList($detail_model, 'po_det_currency', array('INR (INR)' => 'INR (INR)', 'USD ($)' => 'USD ($)'), array('class' => 'form-control', 'onchange' => 'js:$("#fmt_currency").html(this.value)')); ?>
                        <?php echo $form->error($detail_model, 'po_det_currency'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($detail_model, 'po_det_price', array('class' => 'col-sm-3 control-label')); ?>
                    <div class="col-sm-6">
                        <div class="input-group">
                            <div class="input-group-addon" id="fmt_currency">INR (INR)</div>
                            <?php echo $form->textField($detail_model, 'po_det_price', array('class' => 'form-control', 'size' => 10, 'maxlength' => 10)); ?>
                        </div>
                        <?php echo $form->error($detail_model, 'po_det_price'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <?php echo CHtml::submitButton('ADD PRODUCT', array('id' => 'add_prod', "data-loading-text" => "Validating...", 'class' => $detail_model->isNewRecord ? 'btn btn-success' : 'btn btn-primary')); ?>
                </div>
            </div>
            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>

<?php
$grade_url = Yii::app()->createUrl('/site/default/getGradeByProduct');
$size_url = Yii::app()->createUrl('/site/default/getSizeByProduct');
$po_add_product = Yii::app()->createUrl('/site/purchaseorder/addProduct', array('posession' => $posession));
$po_products_url = Yii::app()->createUrl('/site/purchaseorder/poAddedProducts', array('posession' => $posession));

//For create only
$js = <<< EOD
    $(document).ready(function(){
        $('body').on('change','#PurchaseOrderDetails_po_det_product_id',function(){
            $.ajax({
                'type':'GET','url':'$grade_url','data':{'id':this.value},'cache':false,
                'success':function(html){
                    $("#PurchaseOrderDetails_po_det_grade").html(html);
                }
            });
            $.ajax({
                'type':'GET','url':'$size_url','data':{'id':this.value},'cache':false,
                'success':function(html){
                    $("#PurchaseOrderDetails_po_det_size").html(html);
                }
            });
            return false;
        });

        $('body').on('click','.delete_prod',function(){
           if(confirm('Are you sure want to remove?')){
                _uid = $(this).data('uid');
                $('#po_added_products table tr[data-session-key="'+_uid+'"]').animate( {backgroundColor:'red'}, 500).fadeOut(500,function() {
                    $('#purchase-order-form #additioanl_data textarea#addt_'+_uid).remove();
                    $('#po_added_products table tr[data-session-key="'+_uid+'"]').remove();
                });
            }

            return false;
        });
    });

    function newSum() {
        var _table = $('#po_added_products table');
        var total_qty_ctn = total_qty_cntr = total_amt = 0;
        _table.find('tbody tr').each(function()  {
            total_qty_ctn  += parseInt($(this).find('td:nth-child(8)').html());
            total_qty_cntr += parseInt($(this).find('td:nth-child(9)').html());
            total_amt      += parseInt($(this).find('td:nth-child(11)').html());
        });

        _table.find('tfoot tr.totalRow th:nth-child(2)').html(total_qty_ctn);
        _table.find('tfoot tr.totalRow th:nth-child(3)').html(total_qty_cntr);
        _table.find('tfoot tr.totalRow th:nth-child(5)').html(total_amt);
        return true;
    }

    var _addProBtn;
    function b4AddProd(form){
        _addProBtn = $("#add_prod").button("loading");
        return true;
    }
    function AddPODetails(f, d, e){
        if (e == false) {
            var data=$("#purchase-order-details-form").serialize();
            $.ajax({
                type: 'POST',
                url: '$po_add_product',
                data:data,
                success:function(data){
                    data = $.parseJSON(data);
                    $('#purchase-order-form #additioanl_data').append('<textarea name="OrderDetails[]" id="addt_'+data.key_no+'">'+JSON.stringify(data.mdlData)+'</textarea>');
                    $('#po_added_products table tbody').append(data.bindData);
                    newSum();
                },
            });
        }
         _addProBtn.button('reset');
        return false;
    }
EOD;
$cs->registerScript('_po_product_form', $js);
?>



