<?php
$this->title = 'Dashboard';
$this->breadcrumbs = array(
    $this->title
);

?>
<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-lg-3 col-xs-6">

        <div class="small-box bg-red">
            <div class="inner">
                <h3>0</h3>
                <p>Total Companies</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>

            <a href="#" class="small-box-footer">
                More info <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">

        <div class="small-box bg-yellow">
            <div class="inner">
                <h3>0</h3>
                <p>Total Users</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">
                More info <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">

        <div class="small-box bg-aqua">
            <div class="inner">
                <h3><?php echo $uncompleted_profie_auth + $uncompleted_profie_perf ?></h3>
                <p>Total PO's</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">
                More info <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>


    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-green">
            <div class="inner">
                <h3>0</h3>
                <p>Total Invoices</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">
                More info <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
</div>

<div class="row">
    <!-- right col (We are only adding the ID to make the widgets sortable)-->
    <section class="col-lg-6 connectedSortable">
        <!-- Calendar -->
        <!-- TO DO List -->
        <div class="box box-primary">
            <div class="box-header">
                <i class="ion ion-clipboard"></i>
                <h3 class="box-title">Announcements</h3>
                <div class="box-tools pull-right">
                    <ul class="pagination pagination-sm inline">
                        <li><a href="#">&laquo;</a></li>
                        <li><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">&raquo;</a></li>
                    </ul>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">
                <ul class="todo-list">
                    <li>
                        <!-- drag handle -->
                        <span class="handle">
                            <i class="fa fa-ellipsis-v"></i>
                            <i class="fa fa-ellipsis-v"></i>
                        </span>
                        <!-- checkbox -->
                        <input type="checkbox" value="" name=""/>
                        <!-- todo text -->
                        <span class="text">PO #123456 will expire in </span>
                        <!-- Emphasis label -->
                        <small class="label label-danger"><i class="fa fa-clock-o"></i> 3 days</small>
                        <!-- General tools such as edit or delete-->
                        <div class="tools">
                            <i class="fa fa-edit"></i>
                            <i class="fa fa-trash-o"></i>
                        </div>
                    </li>

                </ul>
            </div><!-- /.box-body -->
<!--            <div class="box-footer clearfix no-border">
                <button class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add item</button>
            </div>-->
        </div><!-- /.box -->

    </section><!-- right col -->
</div><!-- /.row (main row) -->