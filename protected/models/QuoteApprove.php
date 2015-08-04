<?php

/**
 * This is the model class for table "{{quote_approve}}".
 *
 * The followings are the available columns in table '{{quote_approve}}':
 * @property integer $quote_approve_id
 * @property integer $quote_id
 * @property integer $approved_by
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property Quote $quote
 * @property User $quoteApprove
 */
class QuoteApprove extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return QuoteApprove the static model class
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
		return '{{quote_approve}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('quote_id, approved_by, status', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('quote_approve_id, quote_id, approved_by, status', 'safe', 'on'=>'search'),
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
			'quote' => array(self::BELONGS_TO, 'Quote', 'quote_id'),
			'quoteApprove' => array(self::BELONGS_TO, 'User', 'quote_approve_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'quote_approve_id' => Myclass::t('Quote Approve'),
			'quote_id' => Myclass::t('Quote'),
			'approved_by' => Myclass::t('Approved By'),
			'status' => Myclass::t('Status'),
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

		$criteria->compare('quote_approve_id',$this->quote_approve_id);
		$criteria->compare('quote_id',$this->quote_id);
		$criteria->compare('approved_by',$this->approved_by);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}