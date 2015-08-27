<?php
/* @var $this PurchaseorderController */
/* @var $model PurchaseOrder */
?>
<table class="table table-bordered">
    <tbody><tr align="center">
            <td valign="top" height="100px">
                <img width="100%" height="101" src="<?php echo $this->themeUrl; ?>/img/krklogo.PNG" alt=""></td>
            <td valign="middle">                                        <div>
                    <table cellspacing="0" style="height:50px;width:125px;border-collapse:collapse;">
                        <tbody><tr>
                                <td valign="middle" align="center" style="font-size:X-Large;font-weight:bold;white-space:nowrap; vertical-align: middle" colspan="2" id="txt_comp_name">
                                    <?php echo @$company->company_name; ?>
                                </td>
                            </tr><tr>
                                <td valign="middle" align="center" style="font-size:Medium; vertical-align: middle" colspan="2" id="txt_comp_addr">
                                    <?php echo @$company->company_address; ?>
                                </td>
                            </tr>
                        </tbody></table>
                </div>
            </td>
            <td valign="middle" align="center" style="vertical-align: middle">
                <label id="lbldate"><?php echo $lbldate; ?></label>
            </td>
        </tr>
        <tr align="center">
            <td colspan="4"><h3>Purchase Order</h3></td>
        </tr>
        <tr>
            <td valign="top" colspan="4">
                <table width="100%" border="0" height="100%">
                    <tbody><tr height="30%">
                            <td>
                                <table width="100%" border="0" height="100%">
                                    <tbody><tr>
                                            <td>
                                                <h2>To</h2>
                                                <div>
                                                    <table cellspacing="0" class="table table-bordered table-condensed">
                                                        <tbody><tr>
                                                                <td style="font-size:Large;font-weight:bold;" colspan="2"><?php echo @$vendor->vendor_name; ?></td>
                                                            </tr><tr>
                                                                <td style="font-size:Medium;" colspan="2">
                                                                    <?php echo @$vendor->vendor_address; ?>
                                                                </td>
                                                            </tr><tr>
                                                                <td style="font-size:Medium;" colspan="2"> <?php echo @$vendor->vendor_city; ?></td>
                                                            </tr><tr>
                                                                <td style="font-size:Medium;" colspan="2"> <?php echo @$vendor->vendor_country; ?></td>
                                                            </tr>
                                                        </tbody></table>
                                                </div>

                                            </td>
                                        </tr>
                                    </tbody></table>
                            </td>
                        </tr>
                        <tr height="40%">
                            <td>
                                <h2>Product Details</h2>
                                <div>
                                    <?php
                                    $po_products = TempSession::model()->byMe()->findAll("session_name = 'po_added_products' AND session_key = '{$posession}'");
                                    ?>
                                    <table cellspacing="0" class="table table-bordered table-condensed">
                                        <thead>
                                            <tr>
                                                <th scope="col">Family</th>
                                                <th scope="col">Product</th>
                                                <th scope="col">Varity</th>
                                                <th scope="col">Size</th>
                                                <th scope="col">Grade</th>
                                                <th scope="col">Qty in CTN</th>
                                                <th scope="col">Price/CTN</th>
                                                <th scope="col">Qty in CTNR</th>
                                                <th scope="col">Net Weight</th>
                                                <th scope="col">Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if ($po_products): foreach ($po_products as $key => $data): $product = $data['session_data']; ?>
                                                    <tr>
                                                        <td><?php echo ProductFamily::model()->findByPk($product['po_det_prod_fmly_id'])->pro_family_name; ?></td>
                                                        <td><?php echo Product::model()->findByPk($product['po_det_product_id'])->pro_name; ?></td>
                                                        <td><?php echo ProductVariety::model()->findByPk($product['po_det_variety_id'])->variety_name; ?></td>
                                                        <td><?php echo implode(CHtml::listData(ProductSize::model()->findAllByAttributes(array("size_id" => $product['po_det_size'])), 'size_id', 'size_name')); ?></td>
                                                        <td><?php echo implode(CHtml::listData(ProductGrade::model()->findAllByAttributes(array("grade_id" => $product['po_det_grade'])), 'grade_id', 'grade_long_name')); ?></td>
                                                        <td><?php echo $product['po_det_net_weight']; ?></td>
                                                        <!--<td><?php echo $product['po_det_currency']; ?></td>-->
                                                        <td><?php echo $product['po_det_cotton_qty']; ?></td>
                                                        <td><?php echo $product['po_det_container_qty']; ?></td>
                                                        <td><?php echo $product['po_det_price']; ?></td>
                                                        <td><?php echo $product['po_det_cotton_qty'] * $product['po_det_price']; ?></td>
                                                    </tr>
                                                <?php endforeach;
                                            endif;
                                            ?>
                                        </tbody>
                                    </table>
                                </div>

                                <h2>Prefered Liner</h2>
                                <div>
                                    <table cellspacing="0" class="table table-bordered table-condensed">
                                        <tbody>
                                            <tr>
                                                <th scope="col">Liner Code</th><th scope="col">Liner Name</th><th scope="col">Free Days</th>
                                            </tr>
                                            <tr>
                                                <td><?php echo @$liner->liner_code; ?></td>
                                                <td><?php echo @$liner->liner_name; ?></td>
                                                <td><?php echo @$liner->no_of_free_days; ?></td>
                                            </tr>
                                        </tbody></table>
                                </div>
                            </td>
                        </tr>
                        <tr height="30%">
                            <td>
                                <h2>Terms &amp; Conditions</h2>
<?php $this->renderPartial('/masters/_terms', array('vendor' => @$vendor))  ?>
                            </td>
                        </tr>
                    </tbody></table>
            </td>
        </tr>
    </tbody>
</table>





