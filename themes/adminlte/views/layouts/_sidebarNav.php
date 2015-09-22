<aside class="left-side sidebar-offcanvas">
    <section class="sidebar">
        <?php if (!Yii::app()->user->isGuest) : ?>
            <div class="user-panel">
                <div class="pull-left image">
                    <?php echo CHtml::image("{$this->themeUrl}/img/avatar5.png", 'User Image', array('class' => 'img-circle')) ?>
                </div>
                <div class="pull-left info">
                    <p>Hello, <?php echo Inflector::camel2words(Yii::app()->user->name) ?></p>
                    <a href="#">
                        <i class="fa fa-circle text-success"></i> Online
                    </a>
                </div>
            </div>
        <?php endif ?>

        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                    <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i
                            class="fa fa-search"></i></button>
                </span>
            </div>
        </form>
        <?php
        $this->widget('application.components.MyMenu', array(
            'activateParents' => true,
            'encodeLabel' => false,
            'activateItems' => true,
            'items' => array(
                array('label' => '<i class="fa fa-briefcase"></i> <span>Admin</span><i class="fa pull-right fa-angle-left"></i>',
                    'url' => '#',
                    'itemOptions' => array('class' => 'treeview active'),
                    'submenuOptions' => array('class' => 'treeview-menu'),
                    'items' => array(
                        array('label' => '<i class="fa fa-weixin"></i> <span>Dashboard</span>', 'url' => array('/site/default/index')),
                        array('label' => '<i class="fa fa-music"></i> <span>Manage User</span>', 'url' => array('/site/user/index')),
                        array('label' => '<i class="fa fa-user"></i> <span>Manage Masters</span>', 'url' => array('/site/masters/index')),
                    ),
                ),
                array('label' => '<i class="fa fa-briefcase"></i> <span>Import Purchase</span><i class="fa pull-right fa-angle-left"></i>',
                    'url' => '#',
                    'itemOptions' => array('class' => 'treeview active'),
                    'submenuOptions' => array('class' => 'treeview-menu'),
                    'items' => array(
                        array('label' => '<i class="fa fa-music"></i> <span>Purchase Order</span>', 'url' => array('/site/purchaseorder/index'), 'active' => (Yii::app()->controller->id == 'purchaseorder' && Yii::app()->controller->action->id == 'index')),
                        array('label' => '<i class="fa fa-user"></i> <span>Invoice & Packing List</span>', 'url' => array('/site/invoice/index')),
                        array('label' => '<i class="fa fa-user"></i> <span>Bill of Lading</span>', 'url' => array('/site/billlading/index')),
                        array('label' => '<i class="fa fa-user"></i> <span>Pyto&Orgine Certificate</span>', 'url' => array('/site/pytoorigin/index')),
                        array('label' => '<i class="fa fa-user"></i> <span>Payment</span>', 'url' => array('/site/payment/index'), 'active' => (Yii::app()->controller->id == 'payment' && Yii::app()->controller->action->id == 'index')),
                        array('label' => '<i class="fa fa-user"></i> <span>Expenses</span>', 'url' => array('/site/expense/index')),
//                        array('label' => '<i class="fa fa-briefcase"></i> <span>Expenses</span><i class="fa pull-right fa-angle-left"></i>',
//                            'url' => '#',
//                            'itemOptions' => array('class' => 'treeview active'),
//                            'submenuOptions' => array('class' => 'treeview-menu'),
//                            'items' => array(
//                                array('label' => '<i class="fa fa-user"></i> <span>Purchase</span>', 'url' => array('/site/purchaseexpenses/index')),
//                                array('label' => '<i class="fa fa-user"></i> <span>Sales</span>', 'url' => array('/site/salesexpenses/index')),
//                            ),
//                        ),
//                        array('label' => '<i class="fa fa-weixin"></i> <span>Process Chart</span>', 'url' => '#'),
//                        array('label' => '<i class="fa fa-user"></i> <span>Permit</span>', 'url' => '#'),
                    ),
                ),
                array('label' => '<i class="fa fa-briefcase"></i> <span>Purchase Report</span><i class="fa pull-right fa-angle-left"></i>',
                    'url' => '#',
                    'itemOptions' => array('class' => 'treeview active'),
                    'submenuOptions' => array('class' => 'treeview-menu'),
                    'items' => array(
                        array('label' => '<i class="fa fa-music"></i> <span>PO Report</span>', 'url' => array('/site/purchaseorder/report'), 'active' => (Yii::app()->controller->id == 'purchaseorder' && Yii::app()->controller->action->id == 'report')),
                        array('label' => '<i class="fa fa-user"></i> <span>Payment Report</span>', 'url' => array('/site/payment/report'), 'active' => (Yii::app()->controller->id == 'payment' && Yii::app()->controller->action->id == 'report')),
                    ),
                ),
            ),
            'htmlOptions' => array('class' => 'sidebar-menu')
        ));
        ?>
    </section>
</aside>
