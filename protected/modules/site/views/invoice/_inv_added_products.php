<table class="table table-condensed">
    <thead>
        <tr>
            <th scope="col">Family</th>
            <th scope="col">Product</th>
            <th scope="col">Varity</th>
            <th scope="col">Grade</th>
            <th scope="col">Size</th>
            <th scope="col">Net Weight</th>
            <th scope="col">Gross Weight</th>
            <th scope="col">Currency Type</th>
            <th scope="col">Qty in CTN</th>
            <th scope="col">Container No</th>
            <th scope="col">Price/CTN</th>
            <th scope="col">Amount</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($inv_products): foreach ($inv_products as $key => $product): ?>
        <tr data-session-key="<?php echo $key; ?>">
                    <td><?php echo ProductFamily::model()->findByPk($product['inv_det_prod_fmly_id'])->pro_family_name; ?></td>
                    <td><?php echo Product::model()->findByPk($product['inv_det_product_id'])->pro_name; ?></td>
                    <td><?php echo ProductVariety::model()->findByPk($product['inv_det_variety_id'])->variety_name; ?></td>
                    <td><?php echo implode(CHtml::listData(ProductGrade::model()->findAllByAttributes(array("grade_id" => $product['inv_det_grade'])), 'grade_id', 'grade_long_name')); ?></td>
                    <td><?php echo implode(CHtml::listData(ProductSize::model()->findAllByAttributes(array("size_id" => $product['inv_det_size'])), 'size_id', 'size_name')); ?></td>
                    <td><?php echo $product['inv_det_net_weight']; ?></td>
                    <td><?php echo $product['inv_det_gross_weight']; ?></td>
                    <td><?php echo $product['inv_det_currency']; ?></td>
                    <td><?php echo $product['inv_det_cotton_qty']; ?></td>
                    <td><?php echo $product['inv_det_ctnr_no']; ?></td>
                    <td><?php echo $product['inv_det_price']; ?></td>
                    <td><?php echo $product['inv_det_cotton_qty'] * $product['inv_det_price']; ?></td>
                    <td valign="middle">
                        <?php
                        echo CHtml::ajaxLink('<i class="glyphicon glyphicon-pencil"></i>', array('/site/invoice/editInvPrduct'), array(
                            "type" => "GET",
                            "data" => array("posession" => $posession,"key" => $key, "ajax" => true),
                            "beforeSend" => 'js:function(){ $("#product-form .box").append("<div class=\"overlay\"><i class=\"fa fa-refresh fa-spin\"></i></div>"); }',
                            "update" => "#product-form",
                    ), array('live' => false, 'id' => "edit_$key"));
                        echo '&nbsp;&nbsp;';
                        echo CHtml::ajaxLink('<i class="glyphicon glyphicon-trash"></i>', array('/site/invoice/deleteInvPrduct'), array(
                            "data" => array("posession" => $posession,"key" => $key, "ajax" => true),
                            "update" => "#inv_added_products .box-body"
                            ), array('live' => false, 'id' => "delete_$key"));
                        ?>
                    </td>
                </tr>
            <?php endforeach;
        endif; ?>
    </tbody>
</table>