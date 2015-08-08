<?php
/* @var $this CompanyController */
/* @var $dataProvider CActiveDataProvider */

$this->title = 'Manage Masters';
$this->breadcrumbs = array(
    'Manage Masters',
);
$themeUrl = $this->themeUrl;
$cs = Yii::app()->getClientScript();
$cs_pos_end = CClientScript::POS_END;

$cs->registerScriptFile($themeUrl . '/js/datatables/jquery.dataTables.js', $cs_pos_end);
$cs->registerScriptFile($themeUrl . '/js/datatables/dataTables.bootstrap.js', $cs_pos_end);
?>
<div class="box box-solid">
    <div class="box-header well">
        <!-- tools box -->
        <div class="pull-right box-tools">
            <button class="btn btn-primary btn-sm pull-right" data-widget='collapse' data-toggle="tooltip" title="Collapse" style="margin-right: 5px;"><i class="fa fa-minus"></i></button>
        </div><!-- /. tools -->

        <i class="fa fa-th"></i>
        <h3 class="box-title">Product Masters</h3>
    </div>
    <div class="box-body">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li><a href="#company" data-toggle="tab">Manage Company</a></li>
                <li><a href="#permit" data-toggle="tab">Manage Permit</a></li>
                <li><a href="#pro_family" data-toggle="tab">Manage Product Family</a></li>
                <li><a href="#product" data-toggle="tab">Manage Product</a></li>
                <li><a href="#variety" data-toggle="tab">Manage Variety</a></li>
                <li><a href="#size" data-toggle="tab">Manage Size</a></li>
                <li><a href="#grade" data-toggle="tab">Manage Grade</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane" id="company">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="glyphicon glyphicon-book"></i>  Company Master</h3></div>
                        <div class="panel-body">
                            <?php $this->renderPartial('_comapny_index', compact('comp_model')); ?>
                        </div>
                        <div class="panel-footer" id="foot_comp_form">
                            <?php $this->renderPartial('_company_form', compact('comp_model')); ?>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="permit">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="glyphicon glyphicon-book"></i>  Permit Master</h3></div>
                        <div class="panel-body">
                            <div class="col-lg-5" id="foot_perm_form">
                                <?php $this->renderPartial('_permit_form', compact('perm_model')); ?>
                            </div>
                            <div class="col-lg-7">
                                <?php $this->renderPartial('_permit_index', compact('perm_model')); ?>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="tab-pane" id="pro_family">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="glyphicon glyphicon-book"></i>  Product Family Master</h3></div>
                        <div class="panel-body">
                            <?php $this->renderPartial('_product_family_index', compact('pro_family_model')); ?>
                        </div>
                        <div class="panel-footer" id="foot_family_form">
                            <?php $this->renderPartial('_product_family_form', compact('pro_family_model')); ?>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="product">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="glyphicon glyphicon-book"></i>  Product Master</h3></div>
                        <div class="panel-body">
                            <?php $this->renderPartial('_product_index', compact('product_model')); ?>
                        </div>
                        <div class="panel-footer" id="foot_product_form">
                            <?php $this->renderPartial('_product_form', compact('product_model')); ?>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="variety">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="glyphicon glyphicon-book"></i>  Variety Master</h3></div>
                        <div class="panel-body">
                            <?php $this->renderPartial('_variety_index', compact('variety_model')); ?>
                        </div>
                        <div class="panel-footer" id="foot_variety_form">
                            <?php $this->renderPartial('_variety_form', compact('variety_model')); ?>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="size">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="glyphicon glyphicon-book"></i>  Size Master</h3></div>
                        <div class="panel-body">
                            <?php $this->renderPartial('_size_index', compact('size_model')); ?>
                        </div>
                        <div class="panel-footer" id="foot_size_form">
                            <?php $this->renderPartial('_size_form', compact('size_model')); ?>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="grade">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="glyphicon glyphicon-book"></i>  Grade Master</h3></div>
                        <div class="panel-body">
                            <?php $this->renderPartial('_grade_index', compact('grade_model')); ?>
                        </div>
                        <div class="panel-footer" id="foot_grade_form">
                            <?php $this->renderPartial('_grade_form', compact('grade_model')); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.box-body-->
</div>

<div class="box box-solid">
    <div class="box-header well">
        <!-- tools box -->
        <div class="pull-right box-tools">
            <button class="btn btn-primary btn-sm pull-right" data-widget='collapse' data-toggle="tooltip" title="Collapse" style="margin-right: 5px;"><i class="fa fa-minus"></i></button>
        </div><!-- /. tools -->

        <i class="fa fa-th"></i>
        <h3 class="box-title">Vendor Master</h3>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="col-lg-6" id="foot_vendor_form">
                    <?php $this->renderPartial('_vendor_form', compact('vendor_model')); ?>
                </div>
                <div class="col-lg-6">
                    <?php $this->renderPartial('_vendor_index', compact('vendor_model')); ?>
                </div>
            </div>
        </div>
    </div><!-- /.box-body-->
</div>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title"><i class="glyphicon glyphicon-book"></i>  Liner Master</h3></div>
    <div class="panel-body">
        <?php // $this->renderPartial('_liner_form', compact('liner_model')); ?>
    </div>
    <div class="panel-footer" id="foot_family_form">
        <?php // $this->renderPartial('_liner_index', compact('liner_model')); ?>
    </div>
</div>


<?php
$actTab = (is_null($tab)) ? "company" : $tab;
$script = <<< JS
$(document).ready(function(){
    $('.nav-tabs a[href="#$actTab"]').tab('show');
});
JS;

Yii::app()->clientScript->registerScript('_company_js', $script);
?>