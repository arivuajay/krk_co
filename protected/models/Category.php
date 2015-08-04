<?php

/**
 * This is the model class for table "{{category}}".
 *
 * The followings are the available columns in table '{{category}}':
 * @property integer $category_id
 * @property string $name
 * @property integer $parent_id
 * @property integer $created_by
 * @property string $created_date
 * @property string $modified_date
 * @property string $ip_address
 * @property integer $is_active
 * @property integer $is_deleted
 *
 * The followings are the available model relations:
 * @property ProductCategory[] $productCategories
 */
class Category extends DefaultColumn
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Category the static model class
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
		 //'parent'=>array('condition'=>$alias.'.parent_id = '.$pid),
	    );
	}
	
	public function parent($pid)
	{
	    $alias = $this->getTableAlias(false, false);
	    $this->getDbCriteria()->mergeWith(array(
		'condition' => $alias.'.parent_id='.$pid
	    ));
	    return $this;
	}
	
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{category}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('category_id', 'required','on'=>'product_register'),
			array('name', 'required'),
			array('parent_id, created_by, is_active, is_deleted', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>200),
			array('ip_address', 'length', 'max'=>20),
			array('modified_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('name,category_id', 'safe'),
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
			'productCategories' => array(self::HAS_MANY, 'ProductCategory', 'category_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'category_id' => Myclass::t('Category'),
			'name' => Myclass::t('Category Name'),
			'parent_id' => Myclass::t('Parent Category'),
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

		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('modified_date',$this->modified_date,true);
		$criteria->compare('ip_address',$this->ip_address,true);
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
                $this->modified_date = new CDbExpression('NOW()');


	    endif;

	    $this->ip_address	 = CHttpRequest::getUserHostAddress();
	    $this->is_active	 = 1;
	    $this->is_deleted	 = 0;

	    return parent::beforeSave();

	}
}