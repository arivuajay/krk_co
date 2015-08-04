<?php

/**
 * This is the model class for table "{{sampler}}".
 *
 * The followings are the available columns in table '{{sampler}}':
 * @property integer $sample_id
 * @property integer $buyer_id
 * @property string $req_date
 * @property integer $sample_status
 * @property integer $is_deleted
 *
 * The followings are the available model relations:
 * @property SamplerProduct[] $samplerProducts
 */
class Sampler extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Sampler the static model class
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
		return '{{sampler}}';
	}
	
	public function scopes() 
	{
	    $alias = $this->getTableAlias(false, false);
	    return array(
		'active'=>array('condition'=>$alias.'.is_deleted = 0'),
		'all'=>array('condition'=>''),
		'my'=>array('condition'=>$alias.'.buyer_id = '.Yii::app()->user->id),
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
			array('client_name', 'required'),
			array('despatch_no', 'required','on'=>'approve'),
			array('buyer_id, sample_status, is_deleted', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('sample_id,despatch_no,approved_by, buyer_id, req_date, sample_status, is_deleted', 'safe', 'on'=>'search'),
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
			'samplerProducts' => array(self::HAS_MANY, 'SamplerProduct', 'sam_id'),
			'samplerBuyer' => array(self::BELONGS_TO, 'User', 'buyer_id'),
			'samplerApprover' => array(self::BELONGS_TO, 'User', 'approved_by'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'sample_id' => Myclass::t('Sample'),
			'buyer_id' => Myclass::t('Buyer'),
			'req_date' => Myclass::t('Req Date'),
			'sample_status' => Myclass::t('Sample Status'),
			'despatch_no' => Myclass::t('Despatch No'),
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

		$criteria->compare('sample_id',$this->sample_id);
		$criteria->compare('buyer_id',$this->buyer_id);
		$criteria->compare('req_date',$this->req_date,true);
		$criteria->compare('sample_status',$this->sample_status);
		$criteria->compare('is_deleted',$this->is_deleted);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function beforeSave() {
	    if ($this->isNewRecord):
		$this->req_date = new CDbExpression('NOW()');
		$this->buyer_id = Yii::app()->user->id;
	    endif;

	    return parent::beforeSave();
	}
}