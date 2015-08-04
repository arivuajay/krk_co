<?php

/**
 * This is the model class for table "{{items}}".
 *
 * The followings are the available columns in table '{{items}}':
 * @property integer $item_id
 * @property string $item_code
 * @property string $name
 * @property integer $unit_measure_id
 * @property integer $reorder_limit
 * @property string $description
 * @property integer $imported
 * @property integer $created_by
 * @property string $created_date
 * @property string $modified_date
 * @property string $ip_address
 * @property integer $is_active
 * @property integer $is_deleted
 *
 * The followings are the available model relations:
 * @property ProductItem[] $productItems
 */
class Items extends DefaultColumn
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Items the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function scopes() 
	{
	    $alias = $this->getTableAlias(false, false);
	    return array(
		'active'=>array('condition'=>$alias.'.is_active=1 AND '.$alias.'.is_deleted = 0'),
                'not_deleted'=>array('condition'=>$alias.'.is_deleted = 0'),
	    );
	}
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{items}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name,item_code,unit_measure_id,reorder_limit', 'required'),
			array('unit_measure_id, reorder_limit, imported, created_by, is_active, is_deleted', 'numerical', 'integerOnly'=>true),
			array('item_code, ip_address', 'length', 'max'=>20),
			array('name', 'length', 'max'=>200),
			array('description, modified_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('item_id, item_code, name, unit_measure_id, reorder_limit, description, imported, created_by, created_date, modified_date, ip_address, is_active, is_deleted', 'safe', 'on'=>'search'),
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
			'productItems' => array(self::HAS_MANY, 'ProductItem', 'item_id'),
			'productBoms' => array(self::HAS_MANY, 'ProductBom', 'item_id'),
			'productMinPrice' => array(self::STAT, 'ProductPrice', 'prod_id', 'select'=>'MIN(range_price)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'item_id' => Myclass::t('Item'),
			'item_code' => Myclass::t('Item Code'),
			'name' => Myclass::t('Name'),
			'unit_measure_id' => Myclass::t('Unit Measure'),
			'reorder_limit' => Myclass::t('Reorder Limit'),
			'description' => Myclass::t('Description'),
			'imported' => Myclass::t('Imported'),
			'created_by' => Myclass::t('Created By'),
			'created_date' => Myclass::t('Created Date'),
			'modified_date' => Myclass::t('Modified Date'),
			'ip_address' => Myclass::t('Ip Address'),
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

		$criteria->compare('item_id',$this->item_id);
		$criteria->compare('item_code',$this->item_code,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('unit_measure_id',$this->unit_measure_id);
		$criteria->compare('reorder_limit',$this->reorder_limit);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('imported',$this->imported);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('modified_date',$this->modified_date,true);
		$criteria->compare('ip_address',$this->ip_address,true);
		$criteria->compare('is_active',$this->is_active);
		$criteria->compare('is_deleted',$this->is_deleted);

		Yii::import('application.extensions.alphapager.ApActiveDataProvider');
		
		return new ApActiveDataProvider($this, array(
			    'criteria'=>$criteria,
			    'alphapagination'=>array('attribute'=>'name'),
		    ));
	}

	/**
	* @param string attribute name
	* @return array for XAlphaPagination (A,B,C,etc)
	*/
	public function getAlphaChars($attribute)
	{
	$chars=array();
	$criteria=array(
	'select'=>"DISTINCT(SUBSTR(\"$attribute\",1,1)) AS \"$attribute\"",
	'order'=>"$attribute",
	);
	$models=$this->findAll($criteria);
	foreach($models as $model)
	$chars[]=mb_strtoupper($model->$attribute);
	return $chars;
	}

	public $idwith_scenario,$name_scenario;
	public function afterFind() {
	    $this->idwith_scenario = "item_".$this->item_id;
	    $this->name_scenario = "Item => ".ucfirst($this->name);
	    parent::afterFind();
	}
}	