<!DOCTYPE html>
<html lang="en-US" class="bg-black">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo CHtml::encode($this->title); ?></title>
        <?php
        $themeUrl = $this->themeUrl;
        $cs = Yii::app()->getClientScript();

        $cs->registerCssFile($themeUrl . '/lib/bs3/css/bootstrap.css');
        $cs->registerCssFile($themeUrl . '/css/font-awesome/css/font-awesome.css');
        $cs->registerCssFile($themeUrl . '/css/AdminLTE.css');
//        $cs->registerCssFile('http://code.ionicframework.com/ionicons/1.5.2/css/ionicons.min.css');
        $cs->registerCssFile($themeUrl . '/css/bootstrap-theme.css');
        $cs->registerCssFile($themeUrl . '/css/custom.css');
        $cs->registerCssFile($themeUrl . '/css/treeview/css/style.css');
//        $cs->registerCssFile($themeUrl . '/css/loading/style.css');
        $cs->registerCssFile($themeUrl . '/css/holdon/HoldOn.min.css');
        ?>
    </head>
    <body class="skin-green">
        <!--<div class="load-pace hide">Loading&#8230;</div>-->
        <?php $this->renderPartial('//layouts/_headerBar'); ?>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <?php $this->renderPartial('//layouts/_sidebarNav'); ?>

            <?php echo $content; ?>
        </div>
        <?php
        $cs_pos_end = CClientScript::POS_END;

        $cs->registerCoreScript('jquery');

        $cs->registerScriptFile($themeUrl . '/lib/bs3/js/bootstrap.js', $cs_pos_end);
        $cs->registerScriptFile($themeUrl . '/js/dropdown.js', $cs_pos_end);
        $cs->registerScriptFile($themeUrl . '/js/iCheck/icheck.js', $cs_pos_end);
        $cs->registerScriptFile($themeUrl . '/js/app.js', $cs_pos_end);
        $cs->registerScriptFile($themeUrl . '/js/holdon/HoldOn.min.js', $cs_pos_end);

//d        
        ?>
        <script type="text/javascript">
            $(function () {
                HoldOn.open({
                    theme: 'sk-fading-circle',
                    message: "<h4>Please Wait</h4>"
                });
            });
            window.onload = function () {
                HoldOn.close();
            }
        </script>
    </body>
</html>