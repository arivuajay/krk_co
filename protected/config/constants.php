<?php
$params = include('params.php');
$params1 = include('params_live.php');
$params = array_merge($params,$params1);
 foreach($params as $key=>$value)
{
		define($key,$value);
} 
