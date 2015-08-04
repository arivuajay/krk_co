<?php
/* 
 * Myclass is our custom static function
 */

class Myclass extends CController
{
    public static function GetApplicationmodules($default =  false)
    {
	$modules = Yii::app()->modules;
	if(!$default):
	    $default_modules = array('gii');
	    foreach($default_modules as $def_mod) unset($modules[$def_mod]);
	    
	    foreach($modules as $key => $module):
		$modules[$key]['name'] = $key;
	    endforeach;
	endif; 

	$modules['default'] = array('class'=>'default','name'=>'default');
	
	return array_reverse($modules);
    }

    
    public static function MemberTitles($title=null)
    {
	$array = array('1'=>'Mr.','2'=>'Mrs.','3'=>'Ms.');
	if($title) return $array[$title];
	
	return $array;
    }
    
    public static function ActiveRoles()
    {
	return Role::model()->active()->not_deleted()->findAll(array('order' => 'role_id DESC'));
    }
    
    public static function ActiveCustomerType()
    {
	return CustomerType::model()->active()->findAll(array('order' => 'customer_type_id ASC'));
    }
    
    public static function ActiveDepartment()
    {
	return Department::model()->active()->findAll(array('order' => 'depart_id ASC'));
    }
    
    public static function GetCompanyPrimarycontact($id)
    {
	$model = CompanyContact::model()->find(array('condition'=>'primary_contact = 1 AND company_id='.$id,'order'=>'contact_id DESC'));
	return $model;
    }
    
    public static function StaffSize()
    {
	return array_combine(range(50, 500, 50), range(50, 500, 50));

    }

    public static function MyRoles($id)
    {
	return UserRole::model()->findAll("user_id = {$id}");
    }
    
    public static function MyReporters($id)
    {
	return UserReporting::model()->findAll("user_id = {$id}");
    }
    
    public static function InsertNotification($type,$update_id,$from_user,$to_user)
    {
	$notification = new Updates();
	$notification->notify_type = $type;
	$notification->notify_update_id = $update_id;
	$notification->notify_from_user = $from_user;
	$notification->notify_to_user = $to_user;
	$notification->save(false);
    }
    
    public static function GetUserByRoles($roleid = null)
    {
	$condition = array();
	$connection=Yii::app()->db;
	
	$sql="SELECT a.user_role_id,CONCAT(c.first_name, ' ', c.last_name,' - ',d.name) as fullname FROM {{user_role}} AS a
		LEFT JOIN {{user}} AS b ON b.user_id = a.user_id
		LEFT JOIN {{user_profile}} AS c ON c.user_id = a.user_id
		LEFT JOIN {{role}} AS d ON d.role_id = a.role_id";
	
	if($roleid) $condition[] = "a.role_id = {$roleid}";
	
	if($condition) $sql .= " WHERE ".implode (' ', $condition);

	$users=$connection->createCommand($sql)->queryAll();

	return $users;
    }
    
    public static function GetUserModelByRoles($roleid = null)
    {
	$condition = array();
	$connection=Yii::app()->db;
	if(is_array($roleid)) $roleid = implode (",",$roleid);
	
	$sql="SELECT b.user_id,CONCAT(c.first_name, ' ', c.last_name,' - ',d.name) as fullname FROM {{user_role}} AS a
		LEFT JOIN {{user}} AS b ON b.user_id = a.user_id
		LEFT JOIN {{user_profile}} AS c ON c.user_id = a.user_id
		LEFT JOIN {{role}} AS d ON d.role_id = a.role_id";
	
	if($roleid) $condition[] = "a.role_id IN ({$roleid})";
	
	if($condition) $sql .= " WHERE ".implode (' ', $condition);

	$users=$connection->createCommand($sql)->queryAll();

	return $users;
    }
    
    public static function GetFirstNameByRoles($roleid = null)
    {
	$condition = array();
	$connection=Yii::app()->db;
	$sql="SELECT a.user_role_id,c.first_name as fullname FROM {{user_role}} AS a
		LEFT JOIN {{user}} AS b ON b.user_id = a.user_id
		LEFT JOIN {{user_profile}} AS c ON c.user_id = a.user_id
		LEFT JOIN {{role}} AS d ON d.role_id = a.role_id";

	if($roleid) $condition[] = "a.role_id = {$roleid}";

	if($condition) $sql .= " WHERE ".implode (' ', $condition);

	$users=$connection->createCommand($sql)->queryAll();

	return $users;
    }
    
    public static function GetFirstNameByRolesByuserid($roleid = null)
    {
	$condition = array();
	$connection=Yii::app()->db;
//	$sql="SELECT a.user_id,c.first_name as fullname FROM {{user_role}} AS a
//		LEFT JOIN {{user}} AS b ON b.user_id = a.user_id
//		LEFT JOIN {{user_profile}} AS c ON c.user_id = a.user_id
//		LEFT JOIN {{role}} AS d ON d.role_id = a.role_id";

	$sql="SELECT a.user_id,d.first_name as fullname FROM {{user}} AS a
	    JOIN {{user_role}} AS b ON b.user_id = a.user_id
	    JOIN {{role_permission}} AS c ON c.role_id = b.role_id
	    JOIN {{user_profile}} AS d ON d.user_id = a.user_id
	    WHERE c.access_id = '17' AND a.user_id <> '".Yii::app()->user->id."'
	    GROUP BY a.user_id";
	if($roleid) $condition[] = "a.role_id = {$roleid}";

	if($condition) $sql .= " WHERE ".implode (' ', $condition);

	$users=$connection->createCommand($sql)->queryAll();

	return $users;
    }
    
    public static function GetCompanies()
    {
	return Company::model()->active()->findAll();
    }
    
    public static function GetVendors()
    {
	return Vendor::model()->active()->findAll();
    }
    
    public static function GetComuna()
    {
	return Comuna::model()->findAll();
    }
    
    public static function GetRegion()
    {
	return Region::model()->findAll();
    }
    
    public static function GetProductCategory()
    {
	return Category::model()->active()->findAll("parent_id = 0");
    }
    public static function GetUnitOfManufacture()
    {

       $array = array('1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10');
       return $array;
    }

    public static function GetProductSubCategory($catid)
    {
	return Category::model()->active()->findAll("parent_id = {$catid}");
    }

    public static function GetProductItems()
    {
	return Items::model()->active()->findAll();
    }
    
    public static function QuoteProductList($qoute_array)
    {
	$result = array();
	if(is_array($qoute_array)):
	    $i=0;
	    foreach ($qoute_array as $key => $qty):
	    
		$prod = Product::model()->findByPk($key);
		$result[$i]['name'] = $prod->name;
		//$result[$i]['product_amt'] = $prod->product_amt;
		$result[$i]['product_amt'] = Myclass::getprice_via_qty($key, $qty);
		
		$result[$i]['qty']  =  $qty;
		$result[$i]['prod_id']  =  $key;
		$i++;
	    endforeach;
	endif;
	return $result;
    }
    public static function PoProductList($poprod_array)
    {
	$result = array();
	if(is_array($poprod_array)):
	    $i=0;
	    $ven_id = $_REQUEST['venid'];
	    foreach ($poprod_array as $key => $quantity):
		$arr = explode("_", $key);
		$type = $arr[0];
		$uniq_id = $arr[1];
		if($type == 'product'):
		    $prod = Product::model()->findByPk($uniq_id);
		    $assigned_price = self::getVendorPrice($uniq_id,$ven_id);
		else:
		    $prod = Items::model()->findByPk($uniq_id);
		    $assigned_price = self::getVendorPrice($uniq_id,$ven_id,'item');
		endif;
		
		$result[$i]['name'] = $prod->name;
		$result[$i]['vendor_assigned_price'] = $assigned_price;
		$result[$i]['quantity']  =  $quantity;
		$result[$i]['prod_id']  =  $key;
		$i++;
	    endforeach;
	endif;
	return $result;
    }
    public static function getVendorPrice($proid,$venid)
    {
	$vendor_product = VendorProducts::model()->find("ven_prod_id = {$proid} AND ven_id = {$venid}");
	return $vendor_product->ven_prod_price;
    }
    public static function ItemList($qoute_array)
    {
	$result = array();
        
	if(is_array($qoute_array)):
	    $i=0;
	    foreach ($qoute_array as $key => $qty):
		$prod = Items::model()->findByPk($key);
		$result[$i]['name'] = $prod->name;
		$result[$i]['item_id'] = $prod->item_id;
		
		$i++;
	    endforeach;
	endif;
	return $result;
    }
    
    public static function CheckAcessByRole($roleid='',$accessid,$ret= false)
    {
	if(!empty($roleid)):
	    $result = RolePermission::model()->find("role_id = {$roleid} AND access_id = {$accessid}");
	    $ret = (count($result)>0)? true : false;
	endif;
	
	return $ret;
    }
    
    public static function getAccessByRole($id)
    {
	$ids = implode(',', $id);
	return RolePermission::model()->findAll("role_id IN ({$ids})");
    }
   
    public static function GetUserProfile($id = null, $email =null)
    {
	$result = array();
	if($id):
	    $result = UserProfile::model()->find("user_id = {$id}");    
	elseif($email) :
	    $result = UserProfile::model()->find("email_address = '{$email}'");
	endif;
	
	return $result;
    }
    
	/**
	 * Get the parent category 
	 */
	public function getParentCategory() {
		$staticData = array('0' => 'Root Category');		
		$modelData = CHtml::listData(Category::model()->findAll("parent_id=:parent_id",array("parent_id"=>"0")), 'category_id', 'name');		  
		$result = $staticData + $modelData;		
		return $result;
	}
	
	/**
	 * Items unit of measure
	 */
	public function getUnitMeasure() {
		return array('1'=>'nos','2'=>'pcs');
	}

	
    public static function getNotification($id,$type,$notifyid,$notify_status,$notify_from_user,$notify_on)
    {
    $p = new CHtmlPurifier();
    $status_change_url = Yii::app()->createUrl('/home/default/notifystatus',array('id'=>$id));
    
    switch($type):
        case '1': //Quote Added
            $data = Quote::model()->findByPk($notifyid);
	    $from_user = Myclass::GetUserProfile($notify_from_user); 
            $default_img = CHtml::image(NOTIFY_SALES_IMAGE);
	    $url = Yii::app()->createAbsoluteUrl('/sales/quote/view',array('id'=>$data->quote_id));
	    $not_title = 'Quote request # '.$data->quote_id;
	    $title = ($notify_status == 0) ? '<span>*</span>'.$not_title : $not_title;
	    $return_url = CHtml::link($title,$url);
	    $ajax_url = CHtml::ajaxLink($title, $status_change_url,
			array('type'=>POST, 'success' => "function(){ window.location.href ='{$url}' }"), 
			array('href'=>$url)
		    );
	    $status = ($data->status==0)?'Pending':'Approved' ;
	    $notify_title = ($notify_status) ? $return_url : $ajax_url;
	    $notify_msg	  = '<span class="req_dat">Req.Date: '.date(FORMAT_DATE,strtotime($data->created_date)).'</span><span class="exp_date_n">Exp.DD: '.date(FORMAT_DATE,strtotime($data->delivery_date)).'</span>';
	    $notify_from  = '<span class="req_frm">Request From '.ucwords($from_user->first_name." ".$from_user->last_name).'</span><span class="status_frm">Status : '.$status.'</span>';

	    $result = Yii::t('sales','QUOTE_NOTIFICATION',array('{NOTIFY_IMAGE}'=>$default_img,'{NOTIFY_TITLE}'=>$notify_title,'{NOTIFY_MSG}'=>$notify_msg
		,'{NOTIFY_FROM}'=>$notify_from));
            break;
	case '2': //Quote Modified
            $data = Quote::model()->findByPk($notifyid);
	    $from_user = Myclass::GetUserProfile($notify_from_user); 
            $default_img = CHtml::image(NOTIFY_SALES_IMAGE);
	    
	    $url = Yii::app()->createAbsoluteUrl('/sales/quote/view',array('id'=>$data->quote_id));
	    $not_title = 'Quote Updated # '.$data->quote_id;
	    $title = ($notify_status == 0) ? '<span>*</span>'.$not_title : $not_title;
	    $return_url = CHtml::link($title,$url);
	    $ajax_url = CHtml::ajaxLink($title, $status_change_url,
			array('type'=>POST, 'success' => "function(){ window.location.href ='{$url}' }"), 
			array('href'=>$url)
		    );
	    $status = ($data->status==0)?'Pending':'Approved' ;
	    $notify_title = ($notify_status) ? $return_url : $ajax_url;
	    
	    $notify_msg	  = '<span class="req_dat">Req.Date: '.date(FORMAT_DATE,strtotime($data->created_date)).'</span><span class="exp_date_n">Exp.DD: '.date(FORMAT_DATE,strtotime($data->delivery_date)).'</span>';
	    $notify_from  = '<span class="req_frm">Request From '.ucwords($from_user->first_name." ".$from_user->last_name).'</span><span class="status_frm">Status : '.$status.'</span>';

	    $result = Yii::t('sales','QUOTE_NOTIFICATION',array('{NOTIFY_IMAGE}'=>$default_img,'{NOTIFY_TITLE}'=>$notify_title,'{NOTIFY_MSG}'=>$notify_msg
		,'{NOTIFY_FROM}'=>$notify_from));
            break;
	case '3': //Quote Confirmed
            $data = Quote::model()->findByPk($notifyid);
	    $from_user = Myclass::GetUserProfile($notify_from_user); 
            $default_img = CHtml::image(NOTIFY_SALES_IMAGE);
	    
	    $url = Yii::app()->createAbsoluteUrl('/sales/quote/view',array('id'=>$data->quote_id));
	    $not_title = 'Quote Confirmed # '.$data->quote_id;
	    $title = ($notify_status == 0) ? '<span>*</span>'.$not_title : $not_title;
	    $return_url = CHtml::link($title,$url);
	    $ajax_url = CHtml::ajaxLink($title, $status_change_url,
			array('type'=>POST, 'success' => "function(){ window.location.href ='{$url}' }"), 
			array('href'=>$url)
		    );
			
		$createdUser = Myclass::GetUserProfile($data->created_by); 
		$updatedUser = Myclass::GetUserProfile($data->updated_by); 
		
		if($updatedUser) {
			$updatedUsername = ucwords($updatedUser->first_name." ".$updatedUser->last_name);
		} else {
			$updatedUsername = "-";
		}
		
	    $status = ($data->status==0)?'Pending':'Approved' ;
	    $notify_title = ($notify_status) ? $return_url : $ajax_url;
	    $notify_msg	  = '<span class="req_dat">Req.Date: '.date(FORMAT_DATE,strtotime($data->created_date)).'</span><span class="exp_date_n">Exp.DD: '.date(FORMAT_DATE,strtotime($data->delivery_date)).'</span>';
	    $notify_from  = '<span class="req_frm">Request From '.ucwords($createdUser->first_name." ".$createdUser->last_name).'</span><span class="status_frm">Modified By : '.$updatedUsername.'</span><br ><span class="req_frm">Approved By '.ucwords($from_user->first_name." ".$from_user->last_name).'</span><span class="status_frm">Status : '.$status.'</span>';

	    $result = Yii::t('sales','QUOTE_NOTIFICATION',array('{NOTIFY_IMAGE}'=>$default_img,'{NOTIFY_TITLE}'=>$notify_title,'{NOTIFY_MSG}'=>$notify_msg
		,'{NOTIFY_FROM}'=>$notify_from));
            break;
	case '4': //New SO Created
            $data = Salesorder::model()->findByPk($notifyid);
	    $from_user = Myclass::GetUserProfile($notify_from_user);
            $default_img = CHtml::image(NOTIFY_SALES_IMAGE);

	    $url = Yii::app()->createAbsoluteUrl('/sales/salesorder/viewsodetail',array('id'=>$data->so_id));
	    $not_title = 'Sales Order Created # '.$data->so_id;
	    $title = ($notify_status == 0) ? '<span>*</span>'.$not_title : $not_title;
	    $return_url = CHtml::link($title,$url);
	    $ajax_url = CHtml::ajaxLink($title, $status_change_url,
			array('type'=>POST, 'success' => "function(){ window.location.href ='{$url}' }"),
			array('href'=>$url)
		    );
	    $status = ($data->so_status==0)?'Pending':'Approved' ;
	    $notify_title = ($notify_status) ? $return_url : $ajax_url;
	    $notify_msg	  = '<span class="req_dat">Created Date: '.date(FORMAT_DATE,strtotime($data->so_created_date)).'</span>';
	    $notify_from  = '<span class="req_frm">SO Created By '.ucwords($from_user->first_name." ".$from_user->last_name).'</span><span class="status_frm">Status : '.$status.'</span>';

	    $result = Yii::t('sales','QUOTE_NOTIFICATION',array('{NOTIFY_IMAGE}'=>$default_img,'{NOTIFY_TITLE}'=>$notify_title,'{NOTIFY_MSG}'=>$notify_msg
		,'{NOTIFY_FROM}'=>$notify_from));
            break;

	case '5': //Assinged For Pick
            $data = Salesorder::model()->findByPk($notifyid);
	    $from_user = Myclass::GetUserProfile($notify_from_user);
            $default_img = CHtml::image(NOTIFY_PRODUCTIONS_IMAGE);

	    $url = Yii::app()->createAbsoluteUrl('/production/pick/index');
	    $not_title = 'Sales Order Assigned# '.$data->so_id;
	    $title = ($notify_status == 0) ? '<span>*</span>'.$not_title : $not_title;
	    $return_url = CHtml::link($title,$url);
	    $ajax_url = CHtml::ajaxLink($title, $status_change_url,
			array('type'=>POST, 'success' => "function(){ window.location.href ='{$url}' }"),
			array('href'=>$url)
		    );
	    $status = ($data->so_status==0)?'Pending':'Approved' ;
	    $notify_title = ($notify_status) ? $return_url : $ajax_url;
	    $notify_msg	  = '<span class="req_dat">Req.Date: '.date(FORMAT_DATE,strtotime($data->so_created_date)).'</span>';
	    $notify_from  = '<span class="req_frm">Assigned By '.ucwords($from_user->first_name." ".$from_user->last_name).'</span><span class="status_frm">Status : '.$status.'</span>';

	    $result = Yii::t('sales','QUOTE_NOTIFICATION',array('{NOTIFY_IMAGE}'=>$default_img,'{NOTIFY_TITLE}'=>$notify_title,'{NOTIFY_MSG}'=>$notify_msg
		,'{NOTIFY_FROM}'=>$notify_from));
            break;
	case '6': //Request For Pack Manager Assign
            $data = Salesorder::model()->findByPk($notifyid);
	    $from_user = Myclass::GetUserProfile($notify_from_user);
            $default_img = CHtml::image(NOTIFY_PRODUCTIONS_IMAGE);

	    $url = Yii::app()->createAbsoluteUrl('/sales/salesorder/view');
	    $not_title = 'Request for assigning pack order # '.$data->so_id;
	    $title = ($notify_status == 0) ? '<span>*</span>'.$not_title : $not_title;
	    $return_url = CHtml::link($title,$url);
	    $ajax_url = CHtml::ajaxLink($title, $status_change_url,
			array('type'=>POST, 'success' => "function(){ window.location.href ='{$url}' }"),
			array('href'=>$url)
		    );
	    $status = Myclass::findSalesorderStatus($data->so_status);
	    $notify_title = ($notify_status) ? $return_url : $ajax_url;
	    $notify_msg	  = '<span class="req_dat">Req.Date: '.date(FORMAT_DATE,strtotime($data->so_created_date)).'</span>';
	    $notify_from  = '<span class="req_frm">Request From '.ucwords($from_user->first_name." ".$from_user->last_name).'</span><span class="status_frm">Status : '.$status.'</span>';

	    $result = Yii::t('sales','QUOTE_NOTIFICATION',array('{NOTIFY_IMAGE}'=>$default_img,'{NOTIFY_TITLE}'=>$notify_title,'{NOTIFY_MSG}'=>$notify_msg
		,'{NOTIFY_FROM}'=>$notify_from));
            break;
	
	case '7': //Assinged For Pack
            $data = Salesorder::model()->findByPk($notifyid);
	    $from_user = Myclass::GetUserProfile($notify_from_user);
            $default_img = CHtml::image(NOTIFY_PRODUCTIONS_IMAGE);

	    $url = Yii::app()->createAbsoluteUrl('/production/pack/index');
	    $not_title = 'Pack order assigned# '.$data->so_id;
	    $title = ($notify_status == 0) ? '<span>*</span>'.$not_title : $not_title;
	    $return_url = CHtml::link($title,$url);
	    $ajax_url = CHtml::ajaxLink($title, $status_change_url,
			array('type'=>POST, 'success' => "function(){ window.location.href ='{$url}' }"),
			array('href'=>$url)
		    );
	    $status = Myclass::findSalesorderStatus($data->so_status);
	    $notify_title = ($notify_status) ? $return_url : $ajax_url;
	    $notify_msg	  = '<span class="req_dat">Req.Date: '.date(FORMAT_DATE,strtotime($data->so_created_date)).'</span>';
	    $notify_from  = '<span class="req_frm">Request From '.ucwords($from_user->first_name." ".$from_user->last_name).'</span><span class="status_frm">Status : '.$status.'</span>';

	    $result = Yii::t('sales','QUOTE_NOTIFICATION',array('{NOTIFY_IMAGE}'=>$default_img,'{NOTIFY_TITLE}'=>$notify_title,'{NOTIFY_MSG}'=>$notify_msg
		,'{NOTIFY_FROM}'=>$notify_from));
            break;
	
	case '8': //Request For Ship Manager Assign
            $data = Salesorder::model()->findByPk($notifyid);
	    $from_user = Myclass::GetUserProfile($notify_from_user);
            $default_img = CHtml::image(NOTIFY_PRODUCTIONS_IMAGE);

	    $url = Yii::app()->createAbsoluteUrl('/sales/salesorder/view');
	    $not_title = 'Request for assigning ship order # '.$data->so_id;
	    $title = ($notify_status == 0) ? '<span>*</span>'.$not_title : $not_title;
	    $return_url = CHtml::link($title,$url);
	    $ajax_url = CHtml::ajaxLink($title, $status_change_url,
			array('type'=>POST, 'success' => "function(){ window.location.href ='{$url}' }"),
			array('href'=>$url)
		    );
	    $status = Myclass::findSalesorderStatus($data->so_status);
	    $notify_title = ($notify_status) ? $return_url : $ajax_url;
	    $notify_msg	  = '<span class="req_dat">Req.Date: '.date(FORMAT_DATE,strtotime($data->so_created_date)).'</span>';
	    $notify_from  = '<span class="req_frm">Request From '.ucwords($from_user->first_name." ".$from_user->last_name).'</span><span class="status_frm">Status : '.$status.'</span>';

	    $result = Yii::t('sales','QUOTE_NOTIFICATION',array('{NOTIFY_IMAGE}'=>$default_img,'{NOTIFY_TITLE}'=>$notify_title,'{NOTIFY_MSG}'=>$notify_msg
		,'{NOTIFY_FROM}'=>$notify_from));
            break;
	
	case '9': //Assinged For ship
            $data = Salesorder::model()->findByPk($notifyid);
	    $from_user = Myclass::GetUserProfile($notify_from_user);
            $default_img = CHtml::image(NOTIFY_PRODUCTIONS_IMAGE);

	    $url = Yii::app()->createAbsoluteUrl('/production/ship/index');
	    $not_title = 'Ship order assigned# '.$data->so_id;
	    $title = ($notify_status == 0) ? '<span>*</span>'.$not_title : $not_title;
	    $return_url = CHtml::link($title,$url);
	    $ajax_url = CHtml::ajaxLink($title, $status_change_url,
			array('type'=>POST, 'success' => "function(){ window.location.href ='{$url}' }"),
			array('href'=>$url)
		    );
	    $status = Myclass::findSalesorderStatus($data->so_status);
	    $notify_title = ($notify_status) ? $return_url : $ajax_url;
	    $notify_msg	  = '<span class="req_dat">Req.Date: '.date(FORMAT_DATE,strtotime($data->so_created_date)).'</span>';
	    $notify_from  = '<span class="req_frm">Request From '.ucwords($from_user->first_name." ".$from_user->last_name).'</span><span class="status_frm">Status : '.$status.'</span>';

	    $result = Yii::t('sales','QUOTE_NOTIFICATION',array('{NOTIFY_IMAGE}'=>$default_img,'{NOTIFY_TITLE}'=>$notify_title,'{NOTIFY_MSG}'=>$notify_msg
		,'{NOTIFY_FROM}'=>$notify_from));
            break;
	case '10': //Request Procurement from product
	    $data = ProductProcurement::model()->findByPk($notifyid);

	    if($data->identification == "1"):
		$product_name = "Product ".$data->product->name;
		$type = 'product';
	    elseif($data->identification == "2"):	
		$product_name = "Item ".$data->item->name;
		$type = 'item';
	    endif;
	    $va =  CHtml::listData(Myclass::GetFirstNameByRolesByuserid(), 'user_id', 'fullname');
	    $mgr_list = CHtml::dropDownList("notify_assigned_to", '', $va,array('class'=>'input-medium'));
	    $assigned_url = Yii::app()->createUrl('/home/default/assignedPeople',array('type'=>$type,'id'=>$notifyid,'notifyid'=>$id));
	    $ajax_button = CHtml::ajaxSubmitButton('Assign',$assigned_url,
		    array('success'=>'function(data){ $("#return_result_'.$notifyid.' a").hide().html(data).fadeIn("slow");}'),
		    array('onclick'=>'$(this).attr("value","Change Assign");'));
	    $return_result = "<div id='return_result_$notifyid' class='notify_title'><a href='javascript:void(0)'></a></div>";
	    $assign_link = '<form id="user-form" action="'.$assigned_url.'" method="post">'.$mgr_list.$ajax_button.$return_result.'</form>';

	    $from_user = Myclass::GetUserProfile($notify_from_user);
            $default_img = CHtml::image(NOTIFY_PROCURMENT_IMAGE);

	    $url = 'javascript:void(0);';
	    $not_title = 'Procurement Request For "'.$product_name.'"';
	    $title = ($notify_status == 0) ? '<span>*</span>'.$not_title : $not_title;
	    $return_url = CHtml::link($title,$url);
	    $ajax_url = CHtml::ajaxLink($title, $status_change_url,
			array('type'=>POST, 'success' => "function(){ window.location.href ='{$url}' }"),
			array('href'=>$url)
		    );

	    $notify_title = ($notify_status) ? $return_url : $ajax_url;
	    $notify_msg	  = '<span class="req_dat">EDD: '.date(FORMAT_DATE,strtotime($data->edd)).$assign_link.'</span>';
	    $notify_from  = '<span class="req_frm">Created By: '.ucwords($from_user->first_name." ".$from_user->last_name).'</span>';
	    if(!empty($data->assignedto))
	    $notify_from  .= '<span class="status_frm">Assigned to: '.$data->assignedto->fullname.'</span>';

	    $result = Yii::t('sales','QUOTE_NOTIFICATION',array('{NOTIFY_IMAGE}'=>$default_img,'{NOTIFY_TITLE}'=>$notify_title,'{NOTIFY_MSG}'=>$notify_msg
		,'{NOTIFY_FROM}'=>$notify_from));
            break;
	case '11': //PO Request Created for Procurement
            $data = Po::model()->findByPk($notifyid);
	    $from_user = Myclass::GetUserProfile($notify_from_user);
            $default_img = CHtml::image(NOTIFY_PROCURMENT_IMAGE);

	    $url = Yii::app()->createAbsoluteUrl('/procurement/po/view',array('id'=>$data->po_id));
	    $not_title = 'Request For PO Approval# '.$data->po_id;
	    $title = ($notify_status == 0) ? '<span>*</span>'.$not_title : $not_title;
	    $return_url = CHtml::link($title,$url);
	    $ajax_url = CHtml::ajaxLink($title, $status_change_url,
			array('type'=>POST, 'success' => "function(){ window.location.href ='{$url}' }"),
			array('href'=>$url)
		    );
	    $status = ($data->po_status == 0)?"Pending":"Approved";
	    $notify_title = ($notify_status) ? $return_url : $ajax_url;
	    $notify_msg	  = '<span class="req_dat">Cred.Date: '.date(FORMAT_DATE,strtotime($data->po_created_on)).'</span>';
	    $notify_from  = '<span class="req_frm">Cred.By: '.ucwords($from_user->first_name." ".$from_user->last_name).'</span><span class="status_frm">Status : '.$status.'</span>';

	    $result = Yii::t('sales','QUOTE_NOTIFICATION',array('{NOTIFY_IMAGE}'=>$default_img,'{NOTIFY_TITLE}'=>$notify_title,'{NOTIFY_MSG}'=>$notify_msg
		,'{NOTIFY_FROM}'=>$notify_from));
            break;
	case '12': //PO Confirmed
            $data = Po::model()->findByPk($notifyid);
	    $from_user = Myclass::GetUserProfile($notify_from_user); 
            $default_img = CHtml::image(NOTIFY_PROCURMENT_IMAGE);
	    
	    $url = Yii::app()->createAbsoluteUrl('/procurement/po/view',array('id'=>$data->po_id));
	    $not_title = 'PO Request Confirmed # '.$data->po_id;
	    $title = ($notify_status == 0) ? '<span>*</span>'.$not_title : $not_title;
	    $return_url = CHtml::link($title,$url);
	    $ajax_url = CHtml::ajaxLink($title, $status_change_url,
			array('type'=>POST, 'success' => "function(){ window.location.href ='{$url}' }"), 
			array('href'=>$url)
		    );
			
	    $createdUser = Myclass::GetUserProfile($data->po_created_by); 
	    $updatedUser = Myclass::GetUserProfile($data->po_modified_by); 

	    if($updatedUser) {
		    $updatedUsername = ucwords($updatedUser->first_name." ".$updatedUser->last_name);
	    } else {
		    $updatedUsername = "-";
	    }
		
	    $status = ($data->po_status==0)?'Pending':'Approved' ;
	    $notify_title = ($notify_status) ? $return_url : $ajax_url;
	    $notify_msg	  = '<span class="req_dat">Created Date: '.date(FORMAT_DATE,strtotime($data->po_created_on)).'</span><span class="exp_date_n">Exp.DD: '.date(FORMAT_DATE,strtotime($data->po_delivery_date)).'</span>';
	    $notify_from  = '<span class="req_frm">Created By : '.ucwords($createdUser->first_name." ".$createdUser->last_name).'</span><br /><span class="req_frm">Approved By : '.ucwords($from_user->first_name." ".$from_user->last_name).'</span><span class="status_frm">Status : '.$status.'</span>';

	    $result = Yii::t('sales','QUOTE_NOTIFICATION',array('{NOTIFY_IMAGE}'=>$default_img,'{NOTIFY_TITLE}'=>$notify_title,'{NOTIFY_MSG}'=>$notify_msg
		,'{NOTIFY_FROM}'=>$notify_from));
            break;	
	
        case '13': //PO Order Placed
            $data = PoOrder::model()->findByPk($notifyid);
	    $from_user = Myclass::GetUserProfile($notify_from_user); 
            $default_img = CHtml::image(NOTIFY_PROCURMENT_IMAGE);
	    
	    $url = Yii::app()->createAbsoluteUrl('/procurement/po/viewpodetail',array('id'=>$data->po_ord_id));
	    $not_title = 'PO Completed # '.$data->po_ord_id;
	    $title = ($notify_status == 0) ? '<span>*</span>'.$not_title : $not_title;
	    $return_url = CHtml::link($title,$url);
	    $ajax_url = CHtml::ajaxLink($title, $status_change_url,
			array('type'=>POST, 'success' => "function(){ window.location.href ='{$url}' }"), 
			array('href'=>$url)
		    );
			
	    $createdUser = Myclass::GetUserProfile($data->po_ord_created_by); 
		
	    $status = ($data->po_ord_status==0)?'Pending':'Approved' ;
	    $notify_title = ($notify_status) ? $return_url : $ajax_url;
	    $notify_msg	  = '<span class="req_dat">Cred.Date: '.date(FORMAT_DATE,strtotime($data->po_ord_created_date)).'</span>';
	    $notify_from  = '<span class="req_frm">Cred.By: '.ucwords($createdUser->first_name." ".$createdUser->last_name).'</span><span class="status_frm">Status : '.$status.'</span>';

	    $result = Yii::t('sales','QUOTE_NOTIFICATION',array('{NOTIFY_IMAGE}'=>$default_img,'{NOTIFY_TITLE}'=>$notify_title,'{NOTIFY_MSG}'=>$notify_msg
		,'{NOTIFY_FROM}'=>$notify_from));
            break;
	case '14': //PO Order Placed
	    $data = ProductProcurement::model()->findByPk($notifyid);

	    if($data->identification == "1"):
		$product_name = "Product ".$data->product->name;
	    elseif($data->identification == "2"):	
		$product_name = "Item ".$data->item->name;
	    endif;

	    $from_user = Myclass::GetUserProfile($notify_from_user);
            $default_img = CHtml::image(NOTIFY_PROCURMENT_IMAGE);

	    $not_title = 'PO Request For "'.$product_name.'" Qty : '.$data->quantity;
	    $url = Yii::app()->createAbsoluteUrl('/procurement/po/create',array('msg'=>$not_title));	    
	    
	    $title = ($notify_status == 0) ? '<span>*</span>'.$not_title : $not_title;
	    $return_url = CHtml::link($title,$url);
	    $ajax_url = CHtml::ajaxLink($title, $status_change_url,
			array('type'=>POST, 'success' => "function(){ window.location.href ='{$url}' }"),
			array('href'=>$url)
		    );

	    $notify_title = ($notify_status) ? $return_url : $ajax_url;
	    $notify_msg	  = '<span class="req_dat">EDD: '.date(FORMAT_DATE,strtotime($data->edd)).$assign_link.'</span>';
	    $notify_from  = '<span class="req_frm">Created By: '.$data->createdby->fullname.'</span>';
	    if(!empty($data->assignedto))
	    $notify_from  .= '<span class="status_frm">Assigned By: '.ucwords($from_user->first_name." ".$from_user->last_name).'</span>';

	    $result = Yii::t('sales','QUOTE_NOTIFICATION',array('{NOTIFY_IMAGE}'=>$default_img,'{NOTIFY_TITLE}'=>$notify_title,'{NOTIFY_MSG}'=>$notify_msg
		,'{NOTIFY_FROM}'=>$notify_from));
            break;
	case '15': //Sample Created
	    $data = Sampler::model()->findByPk($notifyid);

	    $from_user = Myclass::GetUserProfile($notify_from_user);
            $default_img = CHtml::image(NOTIFY_SALES_IMAGE);

	    $not_title = 'Approval Request For Sample  '.SAMPLE_PREFIX.$notifyid;
	    $url = Yii::app()->createAbsoluteUrl('/sales/sample/viewdetail',array('id'=>$notifyid));	    
	    
	    $title = ($notify_status == 0) ? '<span>*</span>'.$not_title : $not_title;
	    $return_url = CHtml::link($title,$url);
	    $ajax_url = CHtml::ajaxLink($title, $status_change_url,
			array('type'=>POST, 'success' => "function(){ window.location.href ='{$url}' }"),
			array('href'=>$url)
		    );

	    $notify_title = ($notify_status) ? $return_url : $ajax_url;

	    $notify_msg	  = '<span class="req_dat">Created Date: '.date(FORMAT_DATE,strtotime($data->req_date)).'</span>';
	    $notify_from  = '<span class="req_frm">Created By: '.$data->samplerBuyer->fullname.'</span>'; 	

	    $result = Yii::t('sales','QUOTE_NOTIFICATION',array('{NOTIFY_IMAGE}'=>$default_img,'{NOTIFY_TITLE}'=>$notify_title,'{NOTIFY_MSG}'=>$notify_msg
		,'{NOTIFY_FROM}'=>$notify_from));
            break;
    case '16': //Approved Sample
	    $data = Sampler::model()->findByPk($notifyid);

	    $from_user = Myclass::GetUserProfile($notify_from_user);
            $default_img = CHtml::image(NOTIFY_SALES_IMAGE);

	    $not_title = 'Approved Sample for # '.SAMPLE_PREFIX.$data->sample_id;
	    $url = Yii::app()->createAbsoluteUrl('/sales/sample/viewdetail',array('id'=>$notifyid));	    
	    
	    $title = ($notify_status == 0) ? '<span>*</span>'.$not_title : $not_title;
	    $return_url = CHtml::link($title,$url);
	    $ajax_url = CHtml::ajaxLink($title, $status_change_url,
			array('type'=>POST, 'success' => "function(){ window.location.href ='{$url}' }"),
			array('href'=>$url)
		    );

	    $notify_title = ($notify_status) ? $return_url : $ajax_url;
	    $notify_msg	  = '<span class="req_dat">Created Date: '.date(FORMAT_DATE,strtotime($data->req_date)).'</span>';
	    $notify_from  = '<span class="req_frm">Approved By: '.$data->samplerApprover->fullname.'</span>'; 	

	    $result = Yii::t('sales','QUOTE_NOTIFICATION',array('{NOTIFY_IMAGE}'=>$default_img,'{NOTIFY_TITLE}'=>$notify_title,'{NOTIFY_MSG}'=>$notify_msg
		,'{NOTIFY_FROM}'=>$notify_from));
            break;
    case '17': //Sample Return Request
	    $data = Sampler::model()->findByPk($notifyid);

	    $from_user = Myclass::GetUserProfile($notify_from_user);
            $default_img = CHtml::image(NOTIFY_SALES_IMAGE);

	    $not_title = 'Sample Return Request # '.SAMPLE_PREFIX.$data->sample_id;
	    $url = Yii::app()->createAbsoluteUrl('/sales/sample/viewdetail',array('id'=>$notifyid));	    
	    
	    $title = ($notify_status == 0) ? '<span>*</span>'.$not_title : $not_title;
	    $return_url = CHtml::link($title,$url);
	    $ajax_url = CHtml::ajaxLink($title, $status_change_url,
			array('type'=>POST, 'success' => "function(){ window.location.href ='{$url}' }"),
			array('href'=>$url)
		    );

	    $notify_title = ($notify_status) ? $return_url : $ajax_url;
	    $notify_msg	  = '<span class="req_dat">Created Date: '.date(FORMAT_DATE,strtotime($data->req_date)).'</span>';
	    $notify_from  = '<span class="req_frm">Created By : '.ucwords($data->samplerBuyer->fullname).'</span><br /><span class="req_frm">Approved By : '.ucwords($data->samplerApprover->fullname).'</span>';

	    $result = Yii::t('sales','QUOTE_NOTIFICATION',array('{NOTIFY_IMAGE}'=>$default_img,'{NOTIFY_TITLE}'=>$notify_title,'{NOTIFY_MSG}'=>$notify_msg
		,'{NOTIFY_FROM}'=>$notify_from));
            break;
    case '18': //Sample Returned
	    $data = Sampler::model()->findByPk($notifyid);

	    $from_user = Myclass::GetUserProfile($notify_from_user);
            $default_img = CHtml::image(NOTIFY_SALES_IMAGE);

	    $not_title = 'Sample Returned Successfully # '.SAMPLE_PREFIX.$data->sample_id;
	    $url = Yii::app()->createAbsoluteUrl('/sales/sample/viewdetail',array('id'=>$notifyid));	    
	    
	    $title = ($notify_status == 0) ? '<span>*</span>'.$not_title : $not_title;
	    $return_url = CHtml::link($title,$url);
	    $ajax_url = CHtml::ajaxLink($title, $status_change_url,
			array('type'=>POST, 'success' => "function(){ window.location.href ='{$url}' }"),
			array('href'=>$url)
		    );

	    $notify_title = ($notify_status) ? $return_url : $ajax_url;
	    $notify_msg	  = '<span class="req_dat">Created Date: '.date(FORMAT_DATE,strtotime($data->req_date)).'</span>';
	    $notify_from  = '<span class="req_frm">Created By : '.ucwords($data->samplerBuyer->fullname).'</span><br /><span class="req_frm">Approved By : '.ucwords($data->samplerApprover->fullname).'</span>';

	    $result = Yii::t('sales','QUOTE_NOTIFICATION',array('{NOTIFY_IMAGE}'=>$default_img,'{NOTIFY_TITLE}'=>$notify_title,'{NOTIFY_MSG}'=>$notify_msg
		,'{NOTIFY_FROM}'=>$notify_from));
            break;
    case '19': //Quote Declined
        $data = Quote::model()->findByPk($notifyid);
        $from_user = Myclass::GetUserProfile($notify_from_user);
        $default_img = CHtml::image(NOTIFY_SALES_IMAGE);

        $url = Yii::app()->createAbsoluteUrl('/sales/quote/view',array('id'=>$data->quote_id));
        $not_title = 'Quote Declined # '.$data->quote_id;
        $title = ($notify_status == 0) ? '<span>*</span>'.$not_title : $not_title;
        $return_url = CHtml::link($title,$url);
        $ajax_url = CHtml::ajaxLink($title, $status_change_url,
                    array('type'=>POST, 'success' => "function(){ window.location.href ='{$url}' }"),
                    array('href'=>$url)
                );

            $createdUser = Myclass::GetUserProfile($data->created_by);
            $updatedUser = Myclass::GetUserProfile($data->updated_by);

            if($updatedUser) {
                    $updatedUsername = ucwords($updatedUser->first_name." ".$updatedUser->last_name);
            } else {
                    $updatedUsername = "-";
            }
        $status = self::getQuoteStatus($data->status);
            
        $notify_title = ($notify_status) ? $return_url : $ajax_url;
        $notify_msg   = '';
        $notify_from  = '<span class="req_frm">Created By : '.ucwords($createdUser->first_name." ".$createdUser->last_name).'</span><span class="status_frm">Declined By : '.$updatedUsername.'</span><span class="status_frm">Status : '.$status.'</span>';

        $result = Yii::t('sales','QUOTE_NOTIFICATION',array('{NOTIFY_IMAGE}'=>$default_img,'{NOTIFY_TITLE}'=>$notify_title,'{NOTIFY_MSG}'=>$notify_msg
            ,'{NOTIFY_FROM}'=>$notify_from));
        break;

    endswitch;
    return $result;
    }
    
        /*
         * Get the product class types
         */

        public function getProductClassType(){

            return ProductClass::model()->active()->findAll(array('order' => 'product_class_id ASC'));
        }

        //Get product Class name
        public function getProductClassName($cid){

            $classdetail = ProductClass::model()->findByPk($cid);
            return $classdetail->name;
        }
        /*
         * Get the raise invoice types
         */

        public function getRaiseInvoiceType(){

            return RaiseInvoice::model()->findAll(array('order' => 'r_id ASC'));
        }
        public function getProducts(){

            return Product::model()->active()->findAll(array('order' => 'product_id ASC'));
        }
	
	public static function getProduct_Items(){
            $product = CHtml::listData(Product::model()->active()->findAll(array('order' => 'product_id ASC')),"idwith_scenario","name_scenario");
	    $items   = CHtml::listData(Items::model()->active()->findAll(array('order' => 'item_id ASC')),"idwith_scenario","name_scenario");
	    $product_items = array_merge($product,$items);
	    return $product_items;
        }
	
	public static function GetSalesorderStatus($key)
	{
	    $array = array('0'=>'pending','1'=>'approved','2'=>'pick','3'=>'pack','4'=>'ship','5'=>'SO Invoiced');
	    
	    return $array[$key+1];
	}
	
	public static function findSalesorderStatus($key)
	{
	    $array = array('0'=>'Book Order','1'=>'Book Order','2'=>'Pick Released','3'=>'Pack Released','4'=>'Ship Released','5'=>'SO Invoiced');
	    
	    return $array[$key];
	}
	
	public static function getShipmentMode($key = null)
	{
	    $array = array('1'=>'AIR','2'=>'SHIP','3'=>'ROAD');
	    if($key) $array = $array[$key];
	    return $array;
	}
	
	
	public static function getShipmentStatus($key = null)
	{
	    $array = array('1'=>'In Transit','2'=>'Client Received','3'=>'Client Reject');
	    if($key) $array = $array[$key];
	    return $array;
	}
	
	public static function getRaiseInvoice($key = null,$from_po=false)
	{
	    if($from_po):
		$array = CHtml::listData(RaiseInvoice::model()->findAll("scenario = 'invoice'"),'r_id','raise_invoice');
	    else:
		$array = CHtml::listData(RaiseInvoice::model()->findAll("scenario = 'salesorder'"),'r_id','raise_invoice');
	    endif;
	    
	    if($key) $array = $array[$key];
	    
	    return $array;
	}

        public function getProductName($pid){

//            echo "$pid";exit;
            
            $connection=Yii::app()->db;
            $sql="SELECT name FROM tbl_product WHERE product_id = $pid";

            $productname=$connection->createCommand($sql)->queryAll();

            $pname = $productname[0][name];
            
            return $pname;
            
        }
//        public function getraiseInvoice($id){
//
//            //echo "$pid";exit;
//            $connection=Yii::app()->db;
//            $sql="SELECT raise_invoice FROM tbl_raise_invoice WHERE r_id = $id";
//
//            $raisename=$connection->createCommand($sql)->queryAll();
//
//            $rname = $raisename[0][raise_invoice];
//
//            return $rname;
//
//        }

	public static function getSaveShip($so_id,$prod_id)
	{
            $save_ship = Ship::model()->find("salesord_id = {$so_id} AND prod_id = {$prod_id}");
            return $save_ship;
	}
        public function getApprovedBy($userId)
	{
	    $userdetail = User::model()->findAll('user_id =:param_user_id',array('param_user_id'=>$userId));
	    return $userdetail[0][user_name];
        }
	
	public static function getSavePick($so_id,$prod_id)
	{
            $save_pick = Pick::model()->find("salesord_id = {$so_id} AND product_id = {$prod_id}" );
            return $save_pick;
	}
	
	public static function getSavePack($so_id,$prod_id)
	{
            $save_pack = Pack::model()->find("salesord_id = {$so_id} AND product_id = {$prod_id}" );
            return $save_pack;
	}

	public static function GetSiteSetting($key,$column='param_value')
	{
	    $result = Sitesettings::model()->find("param_key = '{$key}'");
	    return $result->$column;
	}

        public function getUserRoleId($user_id){

            $data_role = UserRole::model()->find('user_id=:param_user_id',array('param_user_id'=>$user_id));
            return $data_role->user_role_id;

        }

        public function getProductInfo($product_id){

            return $product_info = Product::model()->findByPk($product_id);
            
            
        }

        public function getPriceRange(){
//            $priceRange = ProductPriceRange::model()->active()->findAll();
	    $connection=Yii::app()->db;
	    $sql="SELECT a.*,CONCAT(a.range_from, ' - ', a.range_to) as ranges FROM {{product_price_range}} AS a
		  WHERE a.is_active=1 AND a.is_deleted = 0";
	    
	    $priceRange = $connection->createCommand($sql)->queryAll();
	    
	    return $priceRange;
        }
        public function getPriceRangeValue($prid = null){
//            $priceRange = ProductPriceRange::model()->active()->findAll();
	    $connection=Yii::app()->db;
	    $sql="SELECT a.*,CONCAT(a.range_from, ' - ', a.range_to) as ranges FROM {{product_price_range}} AS a
		  WHERE a.is_active=1 AND a.is_deleted = 0 AND prid = $prid";

	    $priceRange = $connection->createCommand($sql)->queryAll();
//            print"<pre>";
//            print_r($priceRange);exit;
	    return $priceRange;
        }
   

        public function getProductClass($prodid = null){

           $classType = Product::model()->findByPk($prodid);
           return $classType->product_class_id;
           
        }


        public function getCategoryName($cat_id)
        {

            $cat_list = Category::model()->findByPk($cat_id);
            return $cat_list->name;
            
        }
	public static function TriggerInvoice($so_id,$status)
	{
//	    1=>Book Confirm,2=>Pick Released,3=>Pack Released,4=>Ship Confirm,5=>PO Release,6>Receipt,7=>Confirm QC
//	    1=>Book Order,2=>Pick Released,3=>Pack Released,4=>Ship Released,5=>PO Release,6=>Receipt,7=>Confirm QC

	    $so_inv_status = array('1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7');
	    $current_inv_stats = $so_inv_status[$status];
	    if(isset($current_inv_stats)):
		if($current_inv_stats > 4):
		    $somodel    = PoOrder::model()->findByPk($so_id);
		    $scenario = "poorder";
		    $milestones = PoOrderMilestone::model()->find("po_ord_id = {$so_id} AND raise_invoice = {$current_inv_stats}");
		else:
		    $scenario = "salesorder";
		    $somodel    = Salesorder::model()->findByPk($so_id);
		    $milestones = SalesOrderMilestone::model()->find("so_id = {$so_id} AND raise_invoice = {$current_inv_stats}");
		endif;
		if($milestones):
		    $invoice = new Invoice();
		    $invoice->inv_scenario = $scenario;
		    $invoice->inv_milestone_id =  $milestones->milestone_id;
		    $invoice->inv_so_id = $so_id;
		    $invoice->inv_due_date = $milestones->milestone_date;
		    $invoice->inv_payment = $milestones->milestone_amt;
		    $invoice->save(false);
		endif;
	    endif;	    
	}


        //Get item name
        public function GetItemName($itemId){

            $itemlist = Items::model()->findByPk($itemId);
            return $itemlist->name;

        }
        //Get item value
        public function GetItemValue($itemId){

            $itemlist = ProductBom::model()->find($itemId);
            
            return $itemlist->item_value;

        }
	
	public static function getprice_via_qty($prod_id,$qty)
	{
	    $qty_price = ProductPrice::model()->with(array(
		'priceRange'=>array('select'=>false,"condition"=>"priceRange.range_from <= '$qty' AND priceRange.range_to >= '$qty'")))
		->find(array("select"=>"range_price","condition"=>"prod_id = {$prod_id}"));
		
	    return $qty_price->range_price;
	}
	
    public static function AssignProductList($assign_array)
    {
	$result = array();
	if(is_array($assign_array)):
	    $i=0;
	    foreach ($assign_array as $key => $assign_price):
		$arr = explode("_", $key);
		$type = $arr[0];
		$uniq_id = $arr[1];

		if($type == 'product'):
		    $prod = Product::model()->findByPk($uniq_id);
		else:
		    $prod = Items::model()->findByPk($uniq_id);
		endif;

		$result[$i]['name']	    =  $prod->name;
		$result[$i]['assign_price'] =  ($assign_price > 0) ? $assign_price : $prod->productMinPrice;
		$result[$i]['prod_id']	    =  $key;
		$i++;
	    endforeach;
	endif;

	return $result;
    }
    
    public function getDiscountsRange()
    {
	return array(
	    "0"=>"N/A",
	    "5"=>"5%",
	    "10"=>"10%",
	    "15"=>"15%",
	    "20"=>"20%",
	    "25"=>"25%",
	    "30"=>"30%",
	    "35"=>"35%",
	    "40"=>"40%",
	    "45"=>"45%",
	    "50"=>"50%",
	    );
    }
    
    public static function UpdateProduct($update_prod,$prod_class)
    {
	if(is_array($update_prod)):
	    foreach ($update_prod as $product_id => $qty):
		if($prod_class == '1')
		    Product::model()->updateCounters(array('available_quantity'=>$qty),array('condition' => "product_id = '$product_id'"));
		elseif($prod_class == '2')
		    Items::model()->updateCounters(array('available_quantity'=>$qty),array('condition' => "item_id = '$product_id'"));
	    endforeach;   
	endif;
    }
    
    public static function AddMilestone($ord_id,$products)
    {
	if(is_array($products)):
	    foreach ($products as $product_id => $qty):
		$arr = explode("_",$product_id);
		$receipts = new PoOrdReceipts();
		$receipts->po_ord_id = $ord_id;
		$receipts->product_id = $arr[1];
		$receipts->prod_scenario = $arr[0];
		$receipts->quantity = $qty;
		$receipts->save(false);
	    endforeach;   
	endif;
    }
    
    public static function getInventoryLevel($actual_qty = 0,$reorder_limit = 0)
    {
	return ($actual_qty >= $reorder_limit) ? true : false;
    }
    
    public static function getPickInventoryLevel($require_qty = 0,$avali_qty = 0,$reorder_limit = 0)
	    
	    
    {

	switch(true):
		case  ($require_qty > $avali_qty): //Red
			$res = '1';
			$res_img = 'red';
			break;
		case  ($require_qty <= $avali_qty && $reorder_limit > ($avali_qty - $require_qty) ): //Orange
			$res = '2';
			$res_img = 'orange';
			break;
		case  ($require_qty < $avali_qty && $reorder_limit <= ($avali_qty - $require_qty)): //Green		    
			$res = '3';
			$res_img = 'green';
			break;
	endswitch;
	
	return array($res_img,$res);
    }
    
    public static function getProductPriceRange($product)
    {
	$result = null;
	foreach($product->productPrice as $prod_price):
	   $result .= $prod_price->priceRange->range_from."-".$prod_price->priceRange->range_to."&nbsp;:&nbsp;<span class='product_value'>".Myclass::GetSiteSetting('AMOUNT_FORMAT')."&nbsp;".$prod_price->range_price."</span><br />";
	endforeach;
	return $result;
    }

    public static function getQuoteStatus($state)
    {
        switch($state):
                case '0': $status = 'Pending'; break;
                case '1': $status = 'Approved'; break;
                case '2': $status = 'Declined'; break;
        endswitch;

        return $status;
    }
    
    public static function getFinanceInvoice($id)
    {
        $invoiceArray = array();
        $invoicemodel = Invoice::model()->invoice()->findByPk($id);
        
        if($invoicemodel===null)
            throw new CHttpException(404,'The requested page does not exist.');
        
        $cust_name = $invoicemodel->invSo->company->name;
        $company_rutno = $invoicemodel->invSo->company->company_rutno;
        $email = $invoicemodel->invSo->company->email;
        $office_phone = $invoicemodel->invSo->company->office_phone;
        $city = $invoicemodel->invSo->company->shipping_city;
        $state = $invoicemodel->invSo->company->shipping_state; 
        $company_type = $invoicemodel->invSo->company->customer_type->customer_type; 
            
        $invoiceArray['customer_name'] = $cust_name;
        $invoiceArray['RUT_NO'] = $company_rutno;
        $invoiceArray['email'] = $email;
        $invoiceArray['office_phone'] = $office_phone;
        $invoiceArray['city'] = $city;
        $invoiceArray['state'] = $state;
        $invoiceArray['company_type'] = $company_type;
        
        return $invoiceArray;
    }
    
    public static function getClientETA($clientId,$from=null,$to=null)
    {
        $so_criteria = ''; $so_and_criteria = '';

            if($from && $to):
                $so_criteria  = "so_created_date BETWEEN '$from' AND '$to'";
                $so_and_criteria = "AND so_created_date BETWEEN '$from' AND '$to'";
            endif;
        
        $query="SELECT SUM(orderdetail.total_order_value) as value FROM `{{salesorder}}` `t`
                LEFT OUTER JOIN `{{company}}` `company` ON (`t`.`customer_id`=`company`.`company_id`)
                LEFT OUTER JOIN `{{orderdetail}}` `orderdetail` ON (`t`.`so_id`=`orderdetail`.`so_id`)
                WHERE (t.so_status > 0 AND t.customer_id = '$clientId') $so_and_criteria
                GROUP BY customer_id
                ORDER BY value DESC
                LIMIT 1";
        
        $connection=Yii::app()->db;
        $result = $connection->createCommand($query)->queryRow();
        if($result)
            return $result;        
    }
    
    public static function getSalesStatByProd($from=null,$to=null,$filter='5')
    {
        $so_criteria = ''; $so_and_criteria = '';

            if($from && $to):
                $so_criteria  = "so_created_date BETWEEN '$from' AND '$to'";
                $so_and_criteria = "AND so_created_date BETWEEN '$from' AND '$to'";
            endif;
        
        $query="SELECT Product.name as TopProduct, COUNT(*) as ProductCount,SUM(soProducts.order_value) as each_value FROM `{{salesorder}}` `t`
                    LEFT OUTER JOIN `{{so_products}}` `soProducts` ON (`soProducts`.`so_id`=`t`.`so_id`)
                    LEFT OUTER JOIN `{{product}}` `Product` ON (`Product`.`product_id`=`soProducts`.`product_id`)
                    WHERE (Product.name <> '0' OR Product.name <> 'null') $so_and_criteria
                    GROUP BY soProducts.product_id
                    ORDER BY ProductCount DESC
                    LIMIT $filter";
        
        $connection=Yii::app()->db;
        $result = $connection->createCommand($query)->queryAll();
                
        return $result;        
    }
    
	public static function t($str='',$params=array(),$dic='default') {
		return Yii::t($dic, $str, $params);
	}
}
