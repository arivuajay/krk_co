<?php

/**
 * This is the model class for table "{{product_images}}".
 *
 * The followings are the available columns in table '{{product_images}}':
 * @property integer $prod_img_id
 * @property integer $prod_id
 * @property string $prod_image
 * @property integer $is_primary
 * @property integer $is_active
 * @property integer $is_deleted
 * @property integer $uploaded_by
 * @property string $uploaded_on
 * @property string $uploder_ip
 *
 * The followings are the available model relations:
 * @property Product $prod
 */
class ProductImages extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ProductImages the static model class
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
		return '{{product_images}}';
	}
	
	public function scopes() 
	{
	    $alias = $this->getTableAlias(false, false);
	    return array(
		 'active'=>array('condition'=>$alias.'.is_deleted = 0')
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
			array('prod_id, prod_image', 'required'),
			array('prod_id, is_primary, is_active, is_deleted, uploaded_by', 'numerical', 'integerOnly'=>true),
			array('uploder_ip', 'length', 'max'=>255),
			array('uploaded_on', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('prod_img_id, prod_id, prod_image, is_primary, is_active, is_deleted, uploaded_by, uploaded_on, uploder_ip', 'safe', 'on'=>'search'),
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
			'prod' => array(self::BELONGS_TO, 'Product', 'prod_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'prod_img_id' => Myclass::t('Prod Img'),
			'prod_id' => Myclass::t('Prod'),
			'prod_image' => Myclass::t('Prod Image'),
			'is_primary' => Myclass::t('Is Primary'),
			'is_active' => Myclass::t('Is Active'),
			'is_deleted' => Myclass::t('Is Deleted'),
			'uploaded_by' => Myclass::t('Uploaded By'),
			'uploaded_on' => Myclass::t('Uploaded On'),
			'uploder_ip' => Myclass::t('Uploder Ip'),
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

		$criteria->compare('prod_img_id',$this->prod_img_id);
		$criteria->compare('prod_id',$this->prod_id);
		$criteria->compare('prod_image',$this->prod_image,true);
		$criteria->compare('is_primary',$this->is_primary);
		$criteria->compare('is_active',$this->is_active);
		$criteria->compare('is_deleted',$this->is_deleted);
		$criteria->compare('uploaded_by',$this->uploaded_by);
		$criteria->compare('uploaded_on',$this->uploaded_on,true);
		$criteria->compare('uploder_ip',$this->uploder_ip,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function afterSave() {
	    $this->uploaded_by = Yii::app()->user->id;
	    $this->uploaded_on =  new CDbExpression('NOW()');
	    $this->uploder_ip  = CHttpRequest::getUserHostAddress();
	    parent::afterSave();
	}
}