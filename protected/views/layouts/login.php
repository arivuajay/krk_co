<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<?php $baseurl = Yii::app()->getBaseUrl(true); ?>

<style type="text/css">
a, a:hover{
	color:#6D4112;
}
form{
	margin:0;
}
#login_page{
	background:url(<?php echo $baseurl;?>/images/login_bg.jpg) no-repeat center top #EEF0ED;
	min-height:650px;
}
.login_part{
	background:url(<?php echo $baseurl;?>/images/login.png) no-repeat left top transparent;
	border:0;
	float:none !important;
	height:100%;
	min-height:520px;
	margin:0 auto !important;
	width:494px !important;
}
#login_page #content{
	margin:0 auto;
	width:266px;
}
.form-actions{
	background:none;
	border:0;
	margin:5px 0 0 0;
	padding: 0;
	width: 95%;
}
input:focus{
	box-shadow:0 0 0 0;
}
#login_page input{
	background:url(<?php echo $baseurl;?>/images/login_input.png) no-repeat center center transparent;
	box-shadow: none;
	border:0;
	color:#fff;
	height:20px;
	line-height:20px;
	margin:0;
	padding-left:15px;
	width:248px;
}
#login_page input[type="checkbox"]{
	background:none;
	border:0;
	height:12px\9;
	width:12px\9;
}
#login_page input#LoginForm_username{
	margin:0 0 6px 0;
}
#login_page input#LoginForm_password{
	margin:8px 0 6px 0;
	color:#fff;
}
#login_page input[type="submit"]{
	background:url(<?php echo $baseurl;?>/images/login_btn.png) no-repeat center center transparent;
	color:#fff;
	height:30px;
	padding:0px;
	text-transform:uppercase;
	width:85px;
}
.login_sec{
	padding: 240px 50px 100px 65px;
    text-align: center;
    width: 266px;
}
.control-group {
	margin:30px 0 5px 0;
	width: 100%;
}
.remem{
	float:left;
	margin: 0px 0 0px 73px;
    width: 70%;
}
#login_page .remem input{
	float:left;
	margin:4px 0 0;
	padding-left:0px;
	width:20px;
}
.rbr{
	color:#6d4112;
	float:left;
	line-height: 22px;
	margin-bottom: 10px;
	padding-left: 5px;
}
.errorMessage{
	color:#f20000;
	font-weight:bold;
}
</style>
</head>
    <body>

<div id="login_page">
	<div class="row">
		<div class="login_part">
			<div id="content">
				<div class="login_sec">
					<?php echo $content; ?>
				</div>
			</div>
		</div><!-- content -->
	</div>    
</div>  
	</body>
</html>

<?php
Yii::app()->clientScript->registerScript(
   'myHideEffect',
   '$(".alert").animate({opacity: 1.0}, 2000).fadeOut("slow");',
   CClientScript::POS_READY
);
?>