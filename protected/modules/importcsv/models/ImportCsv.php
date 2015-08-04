<?php
/**
 * ImportCSV Module
 *
 * @author Artem Demchenkov <lunoxot@mail.ru>
 * @version 0.0.1
 *
 *  Usage:
 *
 *  1) Copy all the 'importcsv' folder under /protected/modules
 *
 *  2) Register module in /protected/config/main.php
 *     'modules'=>array(
 *		.........
 *               'importcsv'=>array(
 *			'path'=>'upload/importCsv/', // path to folder for saving csv file and file with import params
 *		),
 *              ......
 *	),
 *
 *  3) Do not forget to set permissions for directory 'path'
 *
 *  4) The module is available at http://yourproject/importcsv
 *
 */

class ImportCsv extends CFormModel
{
    /*
     *
     *  Insert new rows to database
     *
     *  $table - db table
     *  $linesArray - lines with values from csv
     *  $poles - list of csv poles
     *  $tableColumns - list of table columns
     *
     */

    public function InsertAll($table, $linesArray, $poles, $tableColumns, $file_id = 50)
    {
            // $polesLength - size of poles array
            // $tableString - rows in table
            // $tableString - items in csv
            // $linesLength - size of lines for insert array

            $polesLength   = sizeof($poles);
            $tableString = '';
            $csvString   = '';
            $n = 0;
            $linesLength = sizeof($linesArray);

            // watching all strings in array
            
            for($k=0; $k<$linesLength; $k++) {

            	//$catid = 17;
            	
                // watching all poles in POST
                $n_in = 0;
                
                for($i=0; $i<$polesLength; $i++) {
                	
                    if($poles[$i]!='') {
	                    if($poles[$i] == 10) {
	                		$linesArray[$k][$poles[$i]-1] = $file_id;
	                	}
	                	
	                	//echo $i."===".$linesArray[$k][$poles[$i]-1];
	                	
	                	if($poles[$i] == 5) {
	                		$catid = 17;
	                		//$catname = CHtml::encode(stripslashes($linesArray[$k][$poles[$i]-1]));
	                		$catname = trim($linesArray[$k][$poles[$i]-1]);
	                		 
	                		// $catname = "Test";
	                		$checkCategory = Category::model()->find('parent_id =0 AND name =:name',array(':name'=>$catname));
	                		
	                		//print_r($checkCategory);
	                		
	                		if(empty($checkCategory)) {
	                			$model = new Category();
	                			$model->name = $catname;
	                			$model->save();
	                			$catid = $model->category_id; 
	                		} else {	                			 
	                			$catid = $checkCategory->category_id;	
	                		}
	                		
	                		 
	                		
	                		$linesArray[$k][$poles[$i]-1] = 1;
	                	}
                	
                        if($k == 0) $tableString = ($n!=0) ? $tableString.", ".$tableColumns[$i] : $tableColumns[$i];

                        if($k == 0 && $n == 0) $csvString = "(";
                        if($k != 0 && $n_in == 0) $csvString = $csvString."), (";

                        $csvString   = ($n_in!=0) ? $csvString.", '".CHtml::encode(stripslashes($linesArray[$k][$poles[$i]-1]))."'" : $csvString."'".CHtml::encode(stripslashes($linesArray[$k][$poles[$i]-1]))."'";
                        
                        
                        if($k == 0 && $n == 0) $newCsvString = "(";
                        if($k != 0 && $n_in == 0) $newCsvString =  "(";
                        
                        
                        $newCsvString = ($n_in!=0) ? $newCsvString.", '".CHtml::encode(stripslashes($linesArray[$k][$poles[$i]-1]))."'" : 
                        $newCsvString."'".CHtml::encode(stripslashes($linesArray[$k][$poles[$i]-1]))."'";
                        
                        
                        $n++;
                        $n_in++;
                        
                        
                    }
                }
                $newTabString = $tableString;
                //$newCsvString = $csvString;
                
                
                
               $sql = "INSERT INTO ".$table."(".$tableString.") VALUES ".$newCsvString.")";
                
               $command=Yii::app()->db->createCommand($sql);

	           if($command->execute())   {	           		
	            	$val = Yii::app()->db->getLastInsertID();
					$prodCat 				= new ProductCategory();
					$prodCat->product_id 	= $val;
					$prodCat->category_id 	= $catid;
					$prodCat->save();					
	           } 
	
	       }

            $csvString = $csvString.")";
            
            return (1);

            // insert $csvString to database
            
           /*$sql="INSERT INTO ".$table."(".$tableString.") VALUES ".$csvString."";
           $command=Yii::app()->db->createCommand($sql);

            if($command->execute())   {            	
				$prodCat = new ProductCategory();
				$prodCat->product_id = 421;
				$prodCat->category_id = 1;
				$prodCat->save();
				Yii::app()->db->getLastInsertID();
                 return (1);
			} else {
                 return (0);
			}*/
    }

    /*
     * 
     *  Update old rows
     *  $table - db table
     *  $csvLine - one line from csv
     *  $poles - list of csv poles
     *  $tableColumns - list of table columns
     *  $needle - value for compare from csv
     *  $tableKey - key for compare from table
     * 
     */

    public function updateOld($table, $csvLine, $poles, $tableColumns, $needle, $tableKey)
    {
        // $polesLength - size of poles array
        // $tableString - rows in table
        // $csvLine - items from csv
        
        $polesLength = sizeof($poles);
        $tableString = '';
        $n           = 0;
        
        for($i=0; $i<$polesLength; $i++) {
            if($poles[$i]!='') {
                $tableString = ($n!=0) ? $tableString.", ".$tableColumns[$i]."='".CHtml::encode(stripslashes($csvLine[$poles[$i]-1]))."'" : $tableColumns[$i]."='".CHtml::encode(stripslashes($csvLine[$poles[$i]-1]))."'";

                $n++;
            }
        }

        // update row in database

        $sql="UPDATE ".$table." SET ".$tableString." WHERE ".$tableKey."='".$needle."'";
        $command=Yii::app()->db->createCommand($sql);

        if($command->execute())
             return (1);
        else
             return (0);
    }

    /*
     * get poles from selected table
     * $table - db table
     * @return array list of db columns
     *
     */

    public function tableColumns($table)
    {
        return Yii::app()->getDb()->getSchema()->getTable($table)->getColumnNames();
    }

    /*
     * get attribute from all rows from selected table
     *
     * $table - db table
     * $attribute - pole in db table
     * @return - rows array
     *
     */

    public function selectRows($table, $attribute)
    {
        $sql = "SELECT ".$attribute." FROM ".$table;
        $command=Yii::app()->db->createCommand($sql);
        return ($command->queryAll());
    }
}

?>
