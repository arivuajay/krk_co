<?php
$this->title = $name;
?>

<?php if (Yii::app()->user->isGuest) { ?>
    <div class="form-box" id="login-box">

        <div class="header"><?php echo $error['code']; ?></div>
        <div class="body bg-gray">
            <p>Oops! <?php echo $message; ?>.</p>
            <p>
                We could not find the page you were looking for.
                Meanwhile, you may <a href='<?php echo Yii::app()->createAbsoluteUrl('site/default/login') ?>'>return to login</a>
            </p>
        </div>
    </div>
<?php } else { ?>
    <!-- Main content -->
    <section class="content">

        <div class="error-page">
            <h2 class="headline text-info"> <?php echo $error['code']; ?></h2>
            <div class="error-content">
                <h3><i class="fa fa-warning text-yellow"></i> Oops! <?php echo $message; ?>.</h3>
                <p>
                    We could not find the page you were looking for.
                    Meanwhile, you may <a href='<?php echo Yii::app()->createAbsoluteUrl('site/default/index') ?>'>return to dashboard</a> or try using the search form.
                </p>

            </div><!-- /.error-content -->
        </div><!-- /.error-page -->

    </section><!-- /.content -->

<?php } ?>

