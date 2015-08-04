<?php

/**
 * 
 * Class to update the default columns in the table
 * @author Anandhi
 *
 */
class DefaultColumn extends CActiveRecord
{
	protected function beforeValidate()
	{
		parent::beforeValidate();
		Yii::app()->user->id = 1;
		
		if($this->isNewRecord) {
			$this->created_by 	= Yii::app()->user->id;
			$this->ip_address 	= Yii::app()->request->userHostAddress;				
		}		
		$this->modified_date = date("Y-m-d h:i:s");		
		return parent::beforeValidate();		
	}
}
