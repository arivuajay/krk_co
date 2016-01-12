<?php

class Myclass extends CController {

    public static function encrypt($value) {
        return hash("sha512", $value);
    }

    public static function refencryption($str) {
        return base64_encode($str);
    }

    public static function refdecryption($str) {
        return base64_decode($str);
    }

    public static function t($str = '', $params = array(), $dic = 'app') {
        return Yii::t($dic, $str, $params);
    }

    public static function getRandomString($length = 9) {
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890"; //length:36
        $final_rand = '';
        for ($i = 0; $i < $length; $i++) {
            $final_rand .= $chars[rand(0, strlen($chars) - 1)];
        }
        return $final_rand;
    }

    public static function slugify($text) {
        $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
        $text = trim($text, '-');
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = strtolower($text);
        $text = preg_replace('~[^-\w]+~', '', $text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }

    public static function rememberMe($username, $check) {
        if ($check > 0) {
            $time = time();     // Gets the current server time
            $cookie = new CHttpCookie('wipo_admin_username', $username);

            $cookie->expire = $time + 60 * 60 * 24 * 30;               // 30 days
            Yii::app()->request->cookies['wipo_admin_username'] = $cookie;
        } else {
            unset(Yii::app()->request->cookies['wipo_admin_username']);
        }
    }

    public static function addAuditTrail($message, $class = 'comment-o') {
        $obj = new AuditTrail();
        $obj->aud_message = $message;
        $obj->aud_class = $class;

        $obj->save(false);
        return;
    }
    
    public static function GetInvoiceDetail1($id) {
        
        $invoices = Invoice::model()->active()->findByPk($id);
        $result = $options = array();

        if ($invoices) {
            $options = array();
            $criteria = new CDbCriteria();
            $criteria->select = array('*', 'SUM(inv_det_cotton_qty) as CntrQty');
            $criteria->condition = "inv_id = '{$id}'";
            $criteria->group = 'inv_det_ctnr_no';

            $invoiceItems = InvoiceItems::model()->findAll($criteria);

            $total_inv_amount = 0;
            $totQty = 0;
            foreach ($invoiceItems as $item):
                $options[] = "{$item->inv_det_ctnr_no} - {$item->CntrQty}";
                $total_inv_amount += $item->inv_det_net_amount;
                $totQty += $item->CntrQty;
            endforeach;

            $result['bol_no'] = $invoices->bol_no;
            $result['total_inv_amount'] = $total_inv_amount;
            $result['containers'] = implode("<br />", $options);
            $result['tot_qty'] = $totQty;
        }
        
        return $result;
    }

}
