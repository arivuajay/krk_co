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
                        array('label' => '<i class="fa fa-music"></i> <span>Purchase Order</span>', 'url' => array('/site/purchaseorder/index')),
                        array('label' => '<i class="fa fa-user"></i> <span>Invoice & Packing List</span>', 'url' => array('/site/invoice/index')),
                        array('label' => '<i class="fa fa-user"></i> <span>Bill of Lading</span>', 'url' => array('/site/billlading/index')),
                        array('label' => '<i class="fa fa-user"></i> <span>Pyto & Origin</span>', 'url' => array('/site/pytoorigin/index')),
                        array('label' => '<i class="fa fa-weixin"></i> <span>Process Chart</span>', 'url' => '#'),
                        array('label' => '<i class="fa fa-user"></i> <span>Permit</span>', 'url' => '#'),
                        array('label' => '<i class="fa fa-user"></i> <span>Purchase Reports</span>', 'url' => '#'),
                    ),
                ),
            ),
            'htmlOptions' => array('class' => 'sidebar-menu')
        ));
        ?>
    </section>
</aside>
