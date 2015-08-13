<script type="text/javascript">
    $(document).ready(function () {
        $('.tree li').each(function () {
            if ($(this).children('ul').length > 0) {
                $(this).addClass('parent');
            }
        });
        $('.tree li.parent > a').click(function ( ) {
            $(this).parent().toggleClass('active');
            $(this).parent().children('ul').slideToggle('fast');
        });
    });
</script>
<?php
$auth_menu = array(
    'Admin' => array(
        'default' => 'Dashboard',
        'user' => 'Manage User',
        'masters' => 'Manage Masters',
    ),
);
?>
<div id="wrapper">
    <div class="tree">
        <ul>
            <?php foreach ($auth_menu as $p_menu => $c_menus) { ?>
                <li><a><?php echo $p_menu; ?></a>
                    <?php
                    if (!empty($c_menus)) {
                        if (!$model->isNewRecord)
                            $authorize = $model->authorize;
                        ?>
                        <ul>
                            <?php foreach ($c_menus as $controller => $c_menu) {
                                $checked = isset($authorize->$controller) ? $authorize->$controller == 1 : false;
                                ?>
                                <li><?php echo CHtml::activeCheckBox($model, 'authorize', array('name' => "User[authorize][$controller]", 'checked' => $checked)); ?>&nbsp;&nbsp;&nbsp;<?php echo $c_menu ?></li>
                        <?php } ?>
                        </ul>
                <?php } ?>
                </li>
<?php } ?>
        </ul>
    </div>
</div>
<?php
//$js = <<< EOD
//EOD;
//Yii::app()->getClientScript()->registerScript('_form', $js);
?>