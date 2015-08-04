<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style type="text/css">
<!--
body{ font-size:12px; }
-->
</style>
</head>

<body style="font-family:Arial, Helvetica, sans-serif;">
<!-- HEADER -->
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="50%">&nbsp;</td>
    <td colspan="4" width="50%"  rowspan="7">&nbsp;</td>
  </tr>
  <tr>
    <td style="text-transform:uppercase; text-align:center;font-size: 20px; font-weight:bold; letter-spacing: 1px;" align="center">
	<?php echo $model->company->name;?></td>
  </tr>
  <tr>
    <td style="text-align:center;padding:5px; font-size:10px;font-weight:bold;" align="center">Industria, Distribuidora, Importadora y Exportadora de art&#205;culos de Cuero, art&#205;culos de Marketing, art&#205;culos de Oficina,Electrodom&#233;sticos y Vajilla. Arriendo y Reparaci&#243;n de carpas y toldos.</td>
  </tr>
  <tr>
    <td style="text-align:center;font-weight: bold; font-size: 11px; color: #FF0000;" align="center">Av.Inglaterra 1436 - Independencia - Santiago - Chille</td>
  </tr>
  <tr>
    <td style="text-align:center;font-weight: bold; font-size: 10px;" align="center">Fonos (56-2): 7374874 - 7352803 - 7355591 - 7355594</td>
  </tr>
  <tr>
    <td style="text-align:center;font-weight: bold; font-size: 10px;" align="center">Fax: 7774248 - Email: marroqctm@cristalinternet.cl </td>
  </tr>
  <tr>
      <td style="text-align:center;" align="center"><img src="<?php echo Yii::app()->getBaseUrl(true);?>/images/tm_logo.png" alt="Logo" width="86" height="104" border="0" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td  width="5%">&nbsp;</td>
    <td  style="border-bottom: solid 1px #000;font-size: 13px" align="left" width="17%"><em>Santiago,</em></td>
    <td style="border-bottom: solid 1px #000;font-size: 13px" align="left" width="24%"><em>de</em></td>
    <td style="border-bottom: solid 1px #000;font-size: 13px" align="left" width="11%"><em>de</em></td>
  </tr>
</table>
<!--HEADER END-->
<!--SUBHEADER-->
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="31" align="left" colspan="3" style="border-bottom: solid 1px #000; vertical-align: bottom;font-size: 13px; font-style: italic;">Se&#241;or(es): <?php echo $model->company->name;?></td>
  </tr>
  <tr>
    <td width="39%" align="left" height="31" style="border-bottom: solid 1px #000; vertical-align: bottom;font-size: 13px; font-style: italic;">R.U.T.: <?php echo $model->company->company_rutno;?></td>
    <td width="31%" align="left" height="31" style="border-bottom: solid 1px #000; vertical-align: bottom;font-size: 13px; font-style: italic;">Direcci&#243;n: <?php echo $model->company->shipping_address; ?></td>
    <td width="30%" align="left" height="31" style="border-bottom: solid 1px #000; vertical-align: bottom;font-size: 13px; font-style: italic;">&nbsp;</td>
  </tr>
  <tr>
    <td height="31" style="border-bottom: solid 1px #000; vertical-align: bottom;font-size: 13px; font-style: italic;">Comuna: 
	<?php echo $model->company->shipping_state; ?></td>
    <td height="31" style="border-bottom: solid 1px #000; vertical-align: bottom;font-size: 13px; font-style: italic;">Ciudad: 
	<?php echo $model->company->shipping_city; ?></td>
    <td height="31" style="border-bottom: solid 1px #000; vertical-align: bottom;font-size: 13px; font-style: italic;">&nbsp;</td>
  </tr>
  <tr>
    <td height="30" style="border-bottom: solid 1px #000; vertical-align: bottom;font-size: 13px; font-style: italic;">Giro: 
	<?php echo $model->company->customer_type->customer_type; ?></td>
    <td height="30" style="border-bottom: solid 1px #000; vertical-align: bottom;font-size: 13px; font-style: italic;">Fonos: 
	<?php echo $model->company->office_phone; ?></td>
    <td height="30" style="border-bottom: solid 1px #000; vertical-align: bottom;font-size: 13px; font-style: italic;">Email: 
	<?php echo $model->company->email; ?></td>
  </tr>
  <tr>
    <td height="29" style="border-bottom: solid 1px #000; vertical-align: bottom;font-size: 13px; font-style: italic;">Factura n<sup>0</sup> </td>
    <td height="29" style="border-bottom: solid 1px #000; vertical-align: bottom;font-size: 13px; font-style: italic;">O/C:</td>
    <td height="29" style="border-bottom: solid 1px #000; vertical-align: bottom;font-size: 13px; font-style: italic;">Cond. de venta: </td>
  </tr>
  <tr>
    <td height="29" style="font-size: 12px; font-style: italic;" >Por lo siguiente: </span></td>
    <td height="29" style="font-size: 12px; font-style: italic;">&nbsp;</td>
    <td height="29" style="font-size: 12px; font-style: italic;" >&nbsp;</td>
  </tr>
</table>
<!--SUBHEADER END-->
<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0">
	<tr>
		<td height="400" colspan="4" align="center" valign="top">
		<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
	    <td width="10%" style="text-align:center;" align="center" height="31"><em>Cantidad</em></td>
	    <td style="text-align:center;" align="center" width="65%"><em>Art&#205;culo</em></td>
	    <td style="text-align:center;" align="center" width="10%"><em>Precio Unit </em></td>
	    <td style="text-align:center;" align="center" width="15%"><em>Total</em></td>
    </tr>
	<?php foreach($model->soProducts as $key=>$product): ?>
    <tr>
		<td align="center" valign="top"><?php echo $product->quote_price;?></td>
		<td align="center" valign="top"><?php echo $product->product->name;?></td>
		<td align="center" valign="top"><?php echo $product->quantity;?></td>
		<td align="center" valign="top"><?php echo $product->order_value;?></td>
    </tr>
	<?php endforeach; ?>
		</table>
		</td>
	</tr>	
  <tr>
    <td colspan="2" rowspan="3"><table width="100%" align="center"  border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="2%">&nbsp;</td>
        <td width="7%" style="font-size: 10px; font-style: italic;">Nombre:</td>
        <td width="61%" style="border-bottom: solid 1px #000; vertical-align: bottom; border-right: solid 1px #000;">&nbsp;</td>
        <td width="30%" rowspan="5" style="font-style: italic;"><table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td height="31" colspan="3" align="center" style="font-style:italic;text-align:center;">CANCELADO</td>
            </tr>
          
         
          <tr>
            <td width="52%" height="36" valign="bottom" align="left" style="font-style:italic;text-align:left;">Santiago,</td>
            <td width="22%" valign="bottom" style="font-style:italic;">de</td>
            <td width="26%" valign="bottom" style="font-style:italic;">de</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td style="font-size: 10px; font-style: italic;">R.U.T:</td>
        <td width="61%" style="border-bottom: solid 1px #000; vertical-align: bottom; border-right: solid 1px #000;"><span style="border-bottom: solid 1px #000; vertical-align: bottom;font-size: 13px; font-style: italic;"><?php echo $model->company->company_rutno;?></span></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td style="font-size: 10px; font-style: italic;">Fecha:</td>
        <td width="61%" style="border-bottom: solid 1px #000; vertical-align: bottom; border-right: solid 1px #000;"><?php echo $model->company->company_rutno;?></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td style="font-size: 10px; font-style: italic;">Recinto:</td>
        <td width="61%" style="border-bottom: solid 1px #000; vertical-align: bottom; border-right: solid 1px #000;">&nbsp;</td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td style="font-size: 10px; font-style: italic;">Firma:</td>
        <td width="61%" style="border-right: solid 1px #000;">&nbsp;</td>
        </tr>
    </table></td>
    <td rowspan="3">&nbsp;</td>
    <td><?php echo $model->orderdetail->line_total; ?></td>
  </tr>
  <tr>
    <td><?php echo $model->orderdetail->tax; ?></td>
  </tr>
  <tr>
    <td><?php echo $model->orderdetail->total_order_value; ?></td>
  </tr>
</table>
<!--FOOTER-->
<table width="100%" border="0">
  <tr>
    <td width="46%" align="justify" style="font-size: 8px;font-style: italic;">
      <div align="justify">Ei acuse de recibo que se declara en este acto, de acuerdo a lo dispuesto en la letra b) del Art. 4<sup>0</sup>, y la letra c) del Art, 5<sup>0</sup>de la Ley 19.983, acredita que la entrega de mercaderias o sevicio(s) prostado(s) ha(n) sido recibido(s) en total confirmidad. </div>
    </td>
    <td width="54%">&nbsp;</td>
  </tr>
</table>
</body>
</html>
