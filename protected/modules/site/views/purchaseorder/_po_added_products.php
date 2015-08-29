<table class="table table-condensed">
    <thead>
        <tr>
            <th scope="col">Family</th>
            <th scope="col">Product</th>
            <th scope="col">Varity</th>
            <th scope="col">Grade</th>
            <th scope="col">Size</th>
            <th scope="col">Net Weight</th>
            <th scope="col">Currency Type</th>
            <th scope="col">Qty in CTN</th>
            <th scope="col">Qty in CTNR</th>
            <th scope="col">Price/CTN</th>
            <th scope="col">Amount</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($po_products): $ctn_qty = $cntr_qty = $amount = 0; ?>
            <?php
            $json_data = '';
            foreach ($po_products as $key => $data):
                $json_data .='<textarea name="OrderDetails[]" id="addt_' . $key . '">' . $data . '</textarea>';
                $product = CJSON::decode($data);

                $ctn_qty += $product['po_det_cotton_qty'];
                $cntr_qty += $product['po_det_container_qty'];
                $item_price = $product['po_det_cotton_qty'] * $product['po_det_price'];
                $amount += $item_price;
                ?>
                <tr data-session-key="<?php echo $key; ?>">
                    <td><?php echo ProductFamily::model()->findByPk($product['po_det_prod_fmly_id'])->pro_family_name; ?></td>
                    <td><?php echo Product::model()->findByPk($product['po_det_product_id'])->pro_name; ?></td>
                    <td><?php echo ProductVariety::model()->findByPk($product['po_det_variety_id'])->variety_name; ?></td>
                    <td><?php echo implode(",", CHtml::listData(ProductGrade::model()->findAllByAttributes(array("grade_id" => $product['po_det_grade'])), 'grade_id', 'grade_long_name')); ?></td>
                    <td><?php echo implode(",", CHtml::listData(ProductSize::model()->findAllByAttributes(array("size_id" => $product['po_det_size'])), 'size_id', 'size_name')); ?></td>
                    <td><?php echo $product['po_det_net_weight']; ?></td>
                    <td><?php echo $product['po_det_currency']; ?></td>
                    <td><?php echo $product['po_det_cotton_qty']; ?></td>
                    <td><?php echo $product['po_det_container_qty']; ?></td>
                    <td><?php echo $product['po_det_price']; ?></td>
                    <td><?php echo $item_price; ?></td>
                    <td valign="middle">
                        <?php
//                        echo CHtml::ajaxLink('<i class="glyphicon glyphicon-pencil"></i>', array('/site/purchaseorder/editPoPrduct'), array(
//                            "type" => "GET",
//                            "data" => array("posession" => $posession, "key" => $key, "ajax" => true),
//                            "beforeSend" => 'js:function(){ $("#product-form .box").append("<div class=\"overlay\"><i class=\"fa fa-refresh fa-spin\"></i></div>"); }',
//                            "update" => "#product-form",
//                                ), array('live' => false, 'id' => "edit_$key"));
//                        echo '&nbsp;&nbsp;';
                        echo CHtml::link('<i class="glyphicon glyphicon-trash"></i>', "javascript:void(0);", array('class' => 'delete_prod', 'data-uid' => "$key"));
                        ?>
                    </td>
                </tr>
                    <?php endforeach;
                endif; ?>
    </tbody>
    <tfoot>
        <tr class="totalRow">
            <th colspan="7">&nbsp;</th>
            <th><?php echo $ctn_qty; ?></th>
            <th><?php echo $cntr_qty ?></th>
            <th>&nbsp;</th>
            <th><?php echo $amount; ?></th>
            <th>&nbsp;</th>
        </tr>
    </tfoot>
</table>
<?php
$cs = Yii::app()->getClientScript();
$js = <<< EOD
    $(document).ready(function(){
        $('#purchase-order-form #additioanl_data').html('$json_data');
    });
EOD;
$cs->registerScript('_po_products', $js);
?>