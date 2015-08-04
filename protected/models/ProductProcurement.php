<?php

/**
 * This is the model class for table "{{product_procurement_request}}".
 *
 * The followings are the available columns in table '{{product_procurement_request}}':
 * @property integer $ppid
 * @property integer $quantity
 * @property string $edd
 * @property string $created_by
 * @property string $modified_by
 * @property integer $is_active
 * @property integer $is_deleted
 */
class ProductProcurement extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ProductProcurement the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{product_procurement_request}}';
	}

        public function scopes()
	{
	    $alias = $this->getTableAlias(false, false);
	    return array(
		 'active'=>array('condition'=>$alias.'.is_active=1 AND '.$alias.'.is_deleted = 0')
	    );
	}
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('quantity, edd', 'required'),
			array('quantity','numerical'),
			array('quantity, is_active, is_deleted', 'numerical', 'integerOnly'=>true),
			array('created_by, modified_by', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ppid, quantity, edd, created_by, modified_by, is_active, is_deleted', 'safe'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
                    'product' =>array(self::BELONGS_TO,'Product','prod_id'),
		    'item' =>array(self::BELONGS_TO,'Items','prod_id'),
		    'assignedto' =>array(self::BELONGS_TO,'User','assigned_to'),
		    'createdby' =>array(self::BELONGS_TO,'User','created_by'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ppid' => Myclass::t('Ppid'),
			'quantity' => Myclass::t('Quantity'),
			'edd' => Myclass::t('EDD'),
			'created_by' => Myclass::t('Created By'),
			'modified_by' => Myclass::t('Modified By'),
			'is_active' => Myclass::t('Is Active'),
			'is_deleted' => Myclass::t('Is Deleted'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('ppid',$this->ppid);
		$criteria->compare('quantity',$this->quantity);
		$criteria->compare('edd',$this->edd,true);
		$criteria->compare('created_by',$this->created_by,true);
		$criteria->compare('modified_by',$this->modified_by,true);
		$criteria->compare('is_active',$this->is_active);
		$criteria->compare('is_deleted',$this->is_deleted);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function beforeSave() {
	    if ($this->isNewRecord):
		$this->created_date = new CDbExpression('NOW()');
		$this->created_by = Yii::app()->user->id;
            else:
                $this->modified_by = Yii::app()->user->id;
	    endif;

	    $this->ip_address	 = CHttpRequest::getUserHostAddress();

	    return parent::beforeSave();

	}
}