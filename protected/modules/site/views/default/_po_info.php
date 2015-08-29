<fieldset>
    <legend>PO History</legend>
    <table class="table table-condensed">
        <thead>
            <tr>
                <th scope="col">Family</th>
                <th scope="col">Product</th>
                <th scope="col">Varity</th>
                <th scope="col">Grade</th>
                <th scope="col">Size</th>
                <th scope="col">Qty in CTN</th>
                <th scope="col">Price/CTN</th>
                <th scope="col">Qty in CTNR</th>
                <th scope="col">Net Weight</th>
                <th scope="col">Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->purchaseOrderDetails): $ctn_qty = $cntr_qty = $amount = 0;
                foreach ($result->purchaseOrderDetails as $key => $product):
                    $ctn_qty += $product['po_det_cotton_qty'];
                    $cntr_qty += $product['po_det_container_qty'];
                    $item_price = $product['po_det_cotton_qty'] * $product['po_det_price'];
                    $amount += $item_price;
                    ?>
                    <tr>
                        <td><?php echo ProductFamily::model()->findByPk($product['po_det_prod_fmly_id'])->pro_family_name; ?></td>
                        <td><?php echo Product::model()->findByPk($product['po_det_product_id'])->pro_name; ?></td>
                        <td><?php echo ProductVariety::model()->findByPk($product['po_det_variety_id'])->variety_name; ?></td>
                        <td><?php echo implode(",", CHtml::listData(ProductGrade::model()->findAllByAttributes(array("grade_id" => $product['po_det_grade'])), 'grade_id', 'grade_long_name')); ?></td>
                        <td><?php echo implode(",", CHtml::listData(ProductSize::model()->findAllByAttributes(array("size_id" => $product['po_det_size'])), 'size_id', 'size_name')); ?></td>
                        <td><?php echo $product['po_det_cotton_qty']; ?></td>
                        <td><?php echo $product['po_det_price']; ?></td>
                        <td><?php echo $product['po_det_container_qty']; ?></td>
                        <td><?php echo $product['po_det_net_weight']; ?></td>
                        <td><?php echo $item_price; ?></td>
                    </tr>
                    <?php
                endforeach;
            endif;
            ?>
        </tbody>
        <tfoot>
            <tr class="totalRow">
                <th colspan="5">&nbsp;</th>
                <th><?php echo $ctn_qty; ?></th>
                <th>&nbsp;</th>
                <th><?php echo $cntr_qty ?></th>
                <th>&nbsp;</th>
                <th><?php echo $amount; ?></th>
            </tr>
        </tfoot>
    </table>
</fieldset>
<fieldset>
    <legend>Invoice History</legend>
    <table class="table table-condensed">
        <thead>
            <tr>
                <th scope="col">Family</th>
                <th scope="col">Product</th>
                <th scope="col">Varity</th>
                <th scope="col">Grade</th>
                <th scope="col">Size</th>
                <th scope="col">Cntr.No/Qty</th>
                <th scope="col">Price/CTN</th>
                <th scope="col">Net Weight</th>
                <th scope="col">Amount</th>
            </tr>
        </thead>
        <?php if ($result->invoices): ?>
            <tbody>
                <?php foreach ($result->invoices as $invoice): ?>
                    <tr><th colspan="10">Invoice #<?php echo $invoice->inv_no . "-" . PurchaseOrder::StatusList($invoice->po_cur_status); ?></th></tr>
                    <?php
                    $ctn_qty = $amount = 0;
                    foreach ($invoice->invoiceItems as $product):
                        $ctn_qty += $product['inv_det_cotton_qty'];
                        $item_price = $product['inv_det_cotton_qty'] * $product['inv_det_price'];
                        $amount += $item_price;
                        ?>
                        <tr>
                            <td><?php echo ProductFamily::model()->findByPk($product['inv_det_prod_fmly_id'])->pro_family_name; ?></td>
                            <td><?php echo Product::model()->findByPk($product['inv_det_product_id'])->pro_name; ?></td>
                            <td><?php echo ProductVariety::model()->findByPk($product['inv_det_variety_id'])->variety_name; ?></td>
                            <td><?php echo implode(",", CHtml::listData(ProductGrade::model()->findAllByAttributes(array("grade_id" => $product['inv_det_grade'])), 'grade_id', 'grade_long_name')); ?></td>
                            <td><?php echo implode(",", CHtml::listData(ProductSize::model()->findAllByAttributes(array("size_id" => $product['inv_det_size'])), 'size_id', 'size_name')); ?></td>
                            <td><?php echo $product['inv_det_ctnr_no'] . "/" . $product['inv_det_cotton_qty']; ?></td>
                            <td><?php echo $product['inv_det_price']; ?></td>
                            <td><?php echo $product['inv_det_net_weight']; ?></td>
                            <td><?php echo $item_price; ?></td>
                        </tr>
        <?php endforeach; ?>
                    <tr class="totalRow">
                        <th colspan="5">&nbsp;</th>
                        <th><?php echo $ctn_qty; ?></th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th><?php echo $amount; ?></th>
                    </tr>
            <?php endforeach; ?>
            </tbody>
<?php endif; ?>
    </table>
</fieldset>

