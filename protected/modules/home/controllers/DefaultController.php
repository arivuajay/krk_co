<?php

class DefaultController extends Controller
{
    	public function init()
	{
	    if(!Yii::app()->user->isGuest)
		$this->data = array('newupdate_count'=>Updates::model()->active()->newupdatescount()->count());

	    $this->renderPartial('//layouts/_home_mod_left_menu');
	}

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			//'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','reportdetails','getquotationfilterby','quotestatRecords','invoicestatRecords','salestatRecords','salesproduct','updates','notifystatus','assignedPeople','invoicestatistics','profitstatistics','salestatistics','clientstatistics','quotationstatistics','tasks','createtask','googlechart','getchartjson'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionIndex($acttab = "tab1")
	{
	    $records = Updates::model()->active()->latest()->findAll('notify_to_user = "'.Yii::app()->user->id.'"');
	    $this->render('index',compact('records','acttab'));
	}

	public function actionUpdates()
	{
	    $records = Updates::model()->active()->latest()->findAll('notify_to_user = "'.Yii::app()->user->id.'"');
	    $this->render('updates',compact('records'));
	}

	public function actionTasks()
	{
	  if(Yii::app()->request->isAjaxRequest):
		$records = Tasks::model()->active()->my()->viewall()->findAll();
		$output = array();
                foreach ($records as $key => $values) {
                        $output[$key][0] = "&nbsp;";
                        $output[$key][1] = $values->task_date;
			$output[$key][2] = $values->task_description;
                }
                $array['aaData'] = $output;
                echo json_encode($array);exit;
	    endif;
	    $records = Tasks::model()->active()->my()->today()->findAll();
	    $task = new Tasks('insert');

	    if(isset($_POST['Tasks'])):
		$task->attributes = $_POST['Tasks'];
		if($task->validate()):
		    $task->save(false);
		    Yii::app()->user->setFlash('success','Created Task Successfully');
		    $this->redirect(array('/home/default/tasks'));
		endif;
	    endif;
	    $this->render('tasks',compact('records','task'));
	}

	public function actionNotifystatus($id)
	{
	    Updates::model()->updateByPk($id,array('notify_status'=>'1'));
	}

	public function actionAssignedPeople($type,$id,$notifyid)
	{
	    $notify_assigned_to = $_REQUEST['notify_assigned_to'];

	    switch ($type):
		case 'item' || 'product':
		    $model = ProductProcurement::model()->findByPk($id);
		    $model->assigned_to = $notify_assigned_to;
		    $model->save(false);
		    Myclass::InsertNotification('14', $id, Yii::app()->user->id, $notify_assigned_to);
		    $result = "Assigned to ".$model->assignedto->fullname;
		    break;
	    endswitch;

	    Updates::model()->updateByPk($notifyid, array('notify_status'=>'1'));

	    echo $result;
	}

	public function actionInvoicestatistics($from=null,$to=null,$total=null,$update=null)
        {
	    
            $data = $this->actionInvoicestatRecords($from,$to,$update);
            extract($data);
            $amout_format = Myclass::GetSiteSetting("AMOUNT_FORMAT");
             $chartjson['cols'][] =  array('id'=>'','label'=>"Invoice Statistics ( Total($total_count) Invoices :","pattern"=>"","type"=>"string");  
             $chartjson['cols'][] =  array('id'=>'','label'=>"$unpaid_count Invoices Unpaid Invoices","pattern"=>"","type"=>"number");
             $chartjson['cols'][] =  array('id'=>'','label'=>"$paid_count Invoices Paid Invoices","pattern"=>"","type"=>"number");
             $chartjson['cols'][] =  array('id'=>'','label'=>"Total($total_count) Invoices","pattern"=>"","type"=>"number");

            $chartjson['rows'][] =  array('c'=>array(
                                array('v'=>"$unpaid_count Invoices \n Unpaid Invoices",'f'=>null),
                                array('v'=>(float)$unpaid_inv_val,'f'=>null)
                               ));
            $chartjson['rows'][] =  array('c'=>array(
                                array('v'=>"$paid_count Invoices \n Paid Invoices",'f'=>null),
                                array('v'=>(float)$paid_inv_val,'f'=>null)
                               )); 
            $chartjson['rows'][] =  array('c'=>array(
                                array('v'=>"Total($total_count) Invoices",'f'=>null),
                                array('v'=>(float)$total_inv_val,'f'=>null)
                               )); 

            $drawchart = json_encode($chartjson);
            
            echo $drawchart;
            exit;

	    
        }

        public function actionSalestatistics($from=null,$to=null,$viewby='product',$filter='5',$update = null)
        {
            $data = $this->actionSalestatRecords($from,$to,$viewby,$filter,$update);
            extract($data);
            $chartjson['cols'][] =  array('id'=>'','label'=>'Topping',"pattern"=>"","type"=>"string");  
             $chartjson['cols'][] =  array('id'=>'','label'=>'Slices',"pattern"=>"","type"=>"number");                                   
                       
//            var_dump($data); exit;
            switch($viewby):
                case 'product' :
                    Yii::app()->fusioncharts->setChartOptions( array("caption"=>"View By Product"));
                    if(!empty($data['top_prod_array'])):
                        foreach($data['top_prod_array'] as $key => $value):
                            $chartjson['rows'][] =  array('c'=>array(
                                array('v'=>$key,'f'=>null),
                                array('v'=>(float)$value,'f'=>null)
                               ));
                        endforeach;
                        echo $drawchart = json_encode($chartjson);
                        exit;
                    else:
                        $chartjson['rows'][] =  array('c'=>array(
                                array('v'=>"No Orders Found",'f'=>null),
                                array('v'=>1,'f'=>null)
                               ));
                echo $drawchart = json_encode($chartjson);
                        exit;
                    endif;
                    break;
                case 'category' :
                    Yii::app()->fusioncharts->setChartOptions( array("caption"=>"View By Category"));
                    if(!empty($data['top_cat_array'])):
                        foreach($data['top_cat_array'] as $key => $value):
                            $chartjson['rows'][] =  array('c'=>array(
                                array('v'=>$key,'f'=>null),
                                array('v'=>(float)$value,'f'=>null)
                               ));
                        endforeach;
                        echo $drawchart = json_encode($chartjson);
                        exit;
                    else:
                        $chartjson['rows'][] =  array('c'=>array(
                                array('v'=>"No Orders Found",'f'=>null),
                                array('v'=>1,'f'=>null)
                               ));
                echo $drawchart = json_encode($chartjson);
                        exit;
                    endif;
                    break;
            endswitch;

            Yii::app()->end();
        }

	public function actionClientstatistics($from=null,$to=null,$viewby='earnval',$filter='5')
        {
            $data = $this->actionClientstatRecords($from,$to,$viewby,$filter);
            extract($data);
            $chartjson['cols'][] =  array('id'=>'','label'=>'Topping',"pattern"=>"","type"=>"string");  
             $chartjson['cols'][] =  array('id'=>'','label'=>'Slices',"pattern"=>"","type"=>"number");
//            var_dump($data); exit;
        switch($viewby):
            case 'earnval':
                
                if(!empty($result_data)):
                    foreach($result_data as $key => $value):
                        $chartjson['rows'][] =  array('c'=>array(
                                array('v'=>$key,'f'=>null),
                                array('v'=>(float)$value,'f'=>null)
                               ));
                    endforeach;
                    echo $drawchart = json_encode($chartjson);
                        exit;
                else:                    
                $chartjson['rows'][] =  array('c'=>array(
                                array('v'=>"No Orders Found",'f'=>null),
                                array('v'=>1,'f'=>null)
                               ));
                echo $drawchart = json_encode($chartjson);
                        exit;
                endif;
                break;
            case 'avgorder':
                
                if(!empty($result_data)):
                    foreach($result_data as $key => $value):
                        $chartjson['rows'][] =  array('c'=>array(
                                array('v'=>$key,'f'=>null),
                                array('v'=>(float)$value,'f'=>null)
                               ));
                    endforeach;
                    echo $drawchart = json_encode($chartjson);
                        exit;
                else:
                    $chartjson['rows'][] =  array('c'=>array(
                                array('v'=>"No Orders Found",'f'=>null),
                                array('v'=>1,'f'=>null)
                               ));
                echo $drawchart = json_encode($chartjson);
                        exit;
                endif;
                break;
            case 'orderqty':
                
                if(!empty($result_data)):
                    foreach($result_data as $key => $value):
                        $chartjson['rows'][] =  array('c'=>array(
                                array('v'=>$key,'f'=>null),
                                array('v'=>(float)$value,'f'=>null)
                               ));
                    endforeach;
                    echo $drawchart = json_encode($chartjson);
                        exit;
                else:
                    $chartjson['rows'][] =  array('c'=>array(
                                array('v'=>"No Orders Found",'f'=>null),
                                array('v'=>1,'f'=>null)
                               ));
                echo $drawchart = json_encode($chartjson);
                        exit;
                endif;
                break;
        endswitch;

        Yii::app()->end();
        }

        public function actionSalesproduct()
        {
            Yii::app()->fusioncharts->setChartOptions( array( 'caption'=>'Product Statistics'));

            if(!empty($from) && !empty($to)):
                $top_products   = Salesorder::model()->topProduct()->findAll();
                $top_products_array = CHtml::listData($top_products, "topProduct", "ProductCount");
            else:
                $top_products   = Salesorder::model()->topProduct()->findAll();
                $top_products_array = CHtml::listData($top_products, "topProduct", "ProductCount");
            endif;

            Yii::app()->fusioncharts->addSet(array('label'=>'Top Products', 'value'=>$top_products));
	    Yii::app()->fusioncharts->addSet(array('label'=>'Top Category', 'value'=>$top_category));

            if(Yii::app()->request->isAjaxRequest):
                echo Yii::app()->fusioncharts->getXMLData(false);
            else:
                Yii::app()->fusioncharts->useI18N = true;
                Yii::app()->fusioncharts->getXMLData(true);
            endif;
        }

        public function actionQuotationstatistics($from=null,$to=null,$filter='salesmen',$user=null,$update=null)
        {
            $data = $this->actionQuotestatRecords($from,$to,$filter,$user,$update);
            extract($data);

	    $amout_format = Myclass::GetSiteSetting("AMOUNT_FORMAT");
            $chartjson['cols'][] =  array('id'=>'','label'=>'Topping',"pattern"=>"","type"=>"string");  
             $chartjson['cols'][] =  array('id'=>'','label'=>'Quotation Statistics',"pattern"=>"","type"=>"number");

            $chartjson['rows'][] =  array('c'=>array(
                                array('v'=>"Total($quote_qty) Quote \n $amout_format $quote_value",'f'=>null),
                                array('v'=>(float)$quote_value,'f'=>null)
                               ));
            $chartjson['rows'][] =  array('c'=>array(
                                array('v'=>"Total($so_qty) SO \n $amout_format $so_value",'f'=>null),
                                array('v'=>(float)$so_value,'f'=>null)
                               )); 
           

            $drawchart = json_encode($chartjson);
            
            echo $drawchart;
            exit;

            
        }

	public function actionProfitstatistics()
        {
//	Profit, expenses and Sales Statistics
            
            Yii::app()->fusioncharts->setChartOptions( array( 'caption'=>'Quotation Statistics'));
	    $past = Invoice::model()->past()->count();
	    $paid = Invoice::model()->paid()->count();
	    $new = Invoice::model()->new()->count();
             $chartjson['cols'][] =  array('id'=>'','label'=>'Topping',"pattern"=>"","type"=>"string");  
             $chartjson['cols'][] =  array('id'=>'','label'=>'Slices',"pattern"=>"","type"=>"number");

            $chartjson['rows'][] =  array('c'=>array(
                                array('v'=>'Past Invoices','f'=>null),
                                array('v'=>(float)$new,'f'=>null)
                               ));
            $chartjson['rows'][] =  array('c'=>array(
                                array('v'=>'Paid Invoices','f'=>null),
                                array('v'=>(float)$paid,'f'=>null)
                               )); 
            $chartjson['rows'][] =  array('c'=>array(
                                array('v'=>'New Invoices','f'=>null),
                                array('v'=>(float)$past,'f'=>null)
                               )); 

            $drawchart = json_encode($chartjson);
            
            echo $drawchart;
            exit;
            Yii::app()->fusioncharts->addSet(array('label'=>'Past Invoices', 'value'=>$new));
            Yii::app()->fusioncharts->addSet(array('label'=>'Paid Invoices', 'value'=>$paid));
            Yii::app()->fusioncharts->addSet(array('label'=>'New Invoices', 'value'=>$past));

            Yii::app()->fusioncharts->useI18N = true;

            Yii::app()->fusioncharts->getXMLData(true);
        }

        public function actionInvoicestatRecords($from = null,$to=null,$update = NULL)
        {
            $inv_criteria = '';
            if($from && $to):
                $inv_criteria  = "inv_due_date BETWEEN '$from' AND '$to'";
                $paid_criteria = "paid_inv_date BETWEEN '$from' AND '$to'";
            endif;
            $unpaid_inv_val = 0;$paid_inv_val = 0;$total_inv_val = 0;
             //Qty
            $unpaid_count = Invoice::model()->invoice()->indue()->active()->count($inv_criteria);
	    $paid_count   = Invoice::model()->invoice()->paid()->active()->count($inv_criteria);
	    $total_count  = Invoice::model()->invoice()->active()->count($inv_criteria);
            //Value
	    $unpaid = Invoice::model()->invoice()->indue()->active()->sumofinvamount()->find($inv_criteria);
	    $paid   = Invoice::model()->invoice()->paid()->active()->sumofinvamount()->find($inv_criteria);
	    $total  = Invoice::model()->invoice()->active()->sumofinvamount()->find($inv_criteria);

            $unpaid_inv_val = $unpaid->sumInv;
            $paid_inv_val   = $paid->sumInv;
            $total_inv_val  = $total->sumInv;
	    $min_date = Invoice::model()->invoice()->indue()->active()->mindate()->find($inv_criteria);
	    $min_date = date(FORMAT_DATE,strtotime($min_date->mindate));
            if($update):
                $data = compact('unpaid_count','paid_count','total_count','unpaid_inv_val','paid_inv_val','total_inv_val','min_date');
                echo json_encode($data);
            endif;
            return compact('unpaid_count','paid_count','total_count','unpaid_inv_val','paid_inv_val','total_inv_val','min_date');
        }

       public function actionSalestatRecords($from=null,$to=null,$viewby='product',$filter='5',$update=null)
        {
            $so_criteria = ''; $so_and_criteria = '';
            $total_value = 0;$top_products = array();$top_category= array();
            $top_cat_array = array();$top_prod_array = array();
            
            if($from && $to):
                $so_criteria  = "so_created_date BETWEEN '$from' AND '$to'";
                $so_and_criteria = "AND so_created_date BETWEEN '$from' AND '$to'";
            endif;
            $total_qty	    = Salesorder::model()->approved()->count($so_criteria);
            $total    = Salesorder::model()->approved()->sumTotal()->find($so_criteria);
	    $min_date    = Salesorder::model()->approved()->mindate()->find($so_criteria);
	    $so_min_date = date(FORMAT_DATE,strtotime($min_date->soMinDate));
	    
            $total_value = $total->sumofTotal;

        $connection=Yii::app()->db;

        switch($viewby):
            case 'product':
                $top_prod_sql="SELECT Product.name as TopProduct, COUNT(*) as ProductCount,SUM(soProducts.order_value) as each_value FROM `{{salesorder}}` `t`
                    LEFT OUTER JOIN `{{so_products}}` `soProducts` ON (`soProducts`.`so_id`=`t`.`so_id`)
                    LEFT OUTER JOIN `{{product}}` `Product` ON (`Product`.`product_id`=`soProducts`.`product_id`)
                    WHERE (Product.name <> '0' OR Product.name <> 'null') $so_and_criteria
                    GROUP BY soProducts.product_id
                    ORDER BY ProductCount DESC
                    LIMIT $filter";
                $top_products = $connection->createCommand($top_prod_sql)->queryAll();
                break;
            case 'category':
                $top_cat_sql="SELECT Cat.name as TopCategory,COUNT(*) as Categorycount,SUM(soProducts.order_value) as each_value  FROM `{{salesorder}}` `t`
                    LEFT JOIN `{{so_products}}` `soProducts` ON (`soProducts`.`so_id`=`t`.`so_id`)
                    LEFT JOIN `{{product_category}}` `ProductCat` ON (`ProductCat`.`product_id`=`soProducts`.`product_id`)
                    LEFT JOIN `{{category}}` `Cat` ON (`Cat`.`category_id`=`ProductCat`.`category_id`)
                    WHERE (ProductCat.category_id <> '0' OR ProductCat.category_id <> 'null') $so_and_criteria
                    GROUP BY ProductCat.category_id
                    ORDER BY Categorycount,Cat.name DESC
                    LIMIT $filter";
                $top_category = $connection->createCommand($top_cat_sql)->queryAll();
                break;
        endswitch;
        
       
        $amount_format = Myclass::GetSiteSetting("AMOUNT_FORMAT");
        if(!empty ($top_category)):
            foreach($top_category as $cat):
                $name = $cat['TopCategory']." \n".$amount_format." ".$cat['each_value'];
                $top_cat_array[$name] = $cat['Categorycount'];
            endforeach;
        endif;
        if(!empty ($top_products)):
            foreach($top_products as $prod):
                $name = $prod['TopProduct']." \n".$amount_format." ".$prod['each_value'];
                $top_prod_array[$name] = $prod['ProductCount'];
            endforeach;
        endif;

        if($update):
            $data = compact('total_qty','total_value','top_products','top_category','so_min_date');
            echo json_encode($data);
        endif;
        return compact('total_qty','total_value','top_cat_array','top_prod_array','so_min_date');
        }

       public function actionClientstatRecords($from=null,$to=null,$viewby='earnval',$filter='5')
        {
            $so_criteria = ''; $so_and_criteria = '';

            if($from && $to):
                $so_criteria  = "so_created_date BETWEEN '$from' AND '$to'";
                $so_and_criteria = "AND so_created_date BETWEEN '$from' AND '$to'";
            endif;

        switch($viewby):
            case 'earnval':
                $query="SELECT company.name as label,SUM(orderdetail.total_order_value) as value FROM `{{salesorder}}` `t`
                    LEFT OUTER JOIN `{{company}}` `company` ON (`t`.`customer_id`=`company`.`company_id`)
                    LEFT OUTER JOIN `{{orderdetail}}` `orderdetail` ON (`t`.`so_id`=`orderdetail`.`so_id`)
                    WHERE (t.so_status > 0) $so_and_criteria
                    GROUP BY customer_id
                    ORDER BY value DESC
                    LIMIT $filter";
                break;
            case 'avgorder':
                $query="SELECT company.name as label,ROUND(AVG(orderdetail.total_order_value)) as value FROM `{{salesorder}}` `t`
                    LEFT OUTER JOIN `{{company}}` `company` ON (`t`.`customer_id`=`company`.`company_id`)
                    LEFT OUTER JOIN `{{orderdetail}}` `orderdetail` ON (`t`.`so_id`=`orderdetail`.`so_id`)
                    WHERE (t.so_status > 0) $so_and_criteria
                    GROUP BY customer_id
                    ORDER BY value DESC
                    LIMIT $filter";
                break;
            case 'orderqty':
                $query="SELECT company.name as label, COUNT(*) as value FROM `{{salesorder}}` `t`
                    LEFT OUTER JOIN `{{company}}` `company` ON (`t`.`customer_id`=`company`.`company_id`)
                    LEFT OUTER JOIN `{{orderdetail}}` `orderdetail` ON (`t`.`so_id`=`orderdetail`.`so_id`)
                    WHERE (t.so_status > 0) $so_and_criteria
                    GROUP BY customer_id
                    ORDER BY value DESC
                    LIMIT $filter";
                break;
        endswitch;
        
        $connection=Yii::app()->db;
        $result = $connection->createCommand($query)->queryAll();

        $amount_format = Myclass::GetSiteSetting("AMOUNT_FORMAT");
        $result_data = array();
        switch($viewby):
            case 'earnval':
                if(!empty ($result)):
                    foreach($result as $cat):
                        $result_data[$cat['label']] = $cat['value'];
                    endforeach;
                endif;
                break;
            case 'avgorder':
                if(!empty ($result)):
                    foreach($result as $cat):
                        $result_data[$cat['label']] = $cat['value'];
                    endforeach;
                endif;
                break;
            case 'orderqty':
                if(!empty ($result)):
                    foreach($result as $cat):
                        $result_data[$cat['label']] = $cat['value'];
                    endforeach;
                endif;
                break;
        endswitch;

//        if(Yii::app()->request->isAjaxRequest):
//            $data = compact('result_data','cmp_min_date');
//            echo json_encode($data);
//        endif;
        return compact('result_data','cmp_min_date');
        }

        public function actionQuotestatRecords($from = null,$to=null,$filter='salesmen',$user=null,$update = null)
        {

            $quote_criteria = '';$so_criteria='';
            if($from && $to):
                $quote_criteria  = "created_date BETWEEN '$from' AND '$to'";
                $so_criteria	 = "so_created_date BETWEEN '$from' AND '$to'";
            endif;
	    if(!empty($user)):
		if($filter=='salesmen'):
		    $quote_criteria .= " AND created_by = '$user'";
		    $so_criteria	.= " AND so_created_by = '$user'";		
		elseif($filter=='client'):
		    $quote_criteria .= " AND company_id = '$user'";
		    $so_criteria	.= " AND customer_id = '$user'";		
		endif;
	    endif;

            $quote_qty  = Quote::model()->confirmed()->count($quote_criteria);
            $quotetotal = Quote::model()->confirmed()->sumTotal()->find($quote_criteria);
            $quote_value   = $quotetotal->sumofTotal;
            
            $so_qty   = Salesorder::model()->active()->count($so_criteria);
            $total    = Salesorder::model()->active()->sumTotal()->find($so_criteria);
            $so_value = $total->sumofTotal;
	    
	    $quotemin_date = Quote::model()->completed()->mindate()->find($quote_criteria);
	    $quotemin_date = date(FORMAT_DATE,strtotime($quotemin_date->quotemindate));
	    
            if($update):
                $data = compact('quote_qty','quote_value','so_qty','so_value','quotemin_date');
                echo json_encode($data);
            endif;
            return compact('quote_qty','quote_value','so_qty','so_value','quotemin_date');
        }
	
	
	public function actionReportdetails($id='2',$type='so')
	{
	    $result = array();
	    switch($type):
		case 'so'   : $result = Salesorder::model()->findByPk($id); break;
		case 'quote': $result = Quote::model()->findByPk($id); break;
	    endswitch;
	    
	    $this->render('report_view',compact('type','result'));
	}
	
	public function actionGetquotationfilterby($filterby)
	{
	    $data = array(''=>'Choose Person');
	    
	    if($filterby == 'salesmen'):
		$result = Myclass::GetUserModelByRoles(array('1','2','7','8'));
		if(!empty($result)):
		    foreach ($result as $key => $value):
			$data[$value['user_id']] = $value['fullname'];
		    endforeach;
		endif;
	    elseif($filterby == 'client'):
		$result = Myclass::GetCompanies();
		if(!empty($result)):
		    foreach ($result as $key => $value):
			$data[$value->company_id] = $value->name;
		    endforeach;
		endif;
	    endif;
	    echo CJSON::encode($data); exit;
	}
        
        public function actionGooglechart()
        {
            $this->render('googlechart');
        }
        
        public function actionGetchartjson()
        {
            echo '{
                    "cols": [
                          {"id":"","label":"Topping","pattern":"","type":"string"},
                          {"id":"","label":"Slices","pattern":"","type":"number"}
                        ],
                    "rows": [
                          {"c":[{"v":"Mushrooms","f":null},{"v":3,"f":null}]},
                          {"c":[{"v":"Onions","f":null},{"v":1,"f":null}]},
                          {"c":[{"v":"Olives","f":null},{"v":1,"f":null}]},
                          {"c":[{"v":"Zucchini","f":null},{"v":1,"f":null}]},
                          {"c":[{"v":"Pepperoni","f":null},{"v":2,"f":null}]}
                        ]
                  }';
            Yii::app()->end();
        }
}