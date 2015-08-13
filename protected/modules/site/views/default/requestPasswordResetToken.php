<?php
$this->title = 'Reset Password';
$this->breadcrumbs = array(
    $this->title
);
?>
<div class="form-box" id="login-box">

    <div class="header"><?php echo CHtml::encode($this->title) ?></div>
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'request-pass',
        'htmlOptions' => array('role' => 'form', 'class' => ''),
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
        'enableAjaxValidation' => true,
    ));
    ?>
    <div class="body bg-gray">
        <?php if (isset($this->flashMessages)): ?>
            <?php foreach ($this->flashMessages as $key => $message) { ?>
                <div class="alert alert-<?php echo $key; ?> fade in">
                    <button type="button" class="close close-sm" data-dismiss="alert">
                        <i class="fa fa-times"></i>
                    </button>
                    <?php echo $message; ?>
                </div>
            <?php } ?>
        <?php endif ?>
        <p>Please fill out the following fields to login:</p>
        <div class="form-group">
            <?php echo $form->labelEx($model, 'email_id') ?>
            <?php echo $form->textField($model, 'email_id', array('autofocus', 'class' => 'form-control')); ?>
            <?php echo $form->error($model, 'email_id') ?>
        </div>
    </div>
    <div class="footer">
        <?php echo CHtml::submitButton('Send', array('class' => 'btn bg-olive btn-block', 'name' => 'send')) ?>
        <p><?php echo CHtml::link('Back to login', array('/site/default/login')) ?></p>
    </div>
    <?php $this->endWidget(); ?>
</div>





