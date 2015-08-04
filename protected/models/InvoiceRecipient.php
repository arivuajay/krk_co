<?php

/**
 * This is the model class for table "{{invoice_recipient}}".
 *
 * The followings are the available columns in table '{{invoice_recipient}}':
 * @property integer $inv_rec_id
 * @property integer $inv_id
 * @property integer $recipient_id
 * @property integer $inv_rec_deleted
 *
 * The followings are the available model relations:
 * @property Invoice $inv
 */
class InvoiceRecipient extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return InvoiceRecipient the static model class
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
		return '{{invoice_recipient}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('inv_id,recipient_id','required'),
			array('inv_id, inv_rec_deleted', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('inv_rec_id, inv_id, recipient_id, inv_rec_deleted', 'safe', 'on'=>'search'),
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
			'inv' => array(self::BELONGS_TO, 'Invoice', 'inv_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'inv_rec_id' => Myclass::t('Inv Rec'),
			'inv_id' => Myclass::t('Inv'),
			'recipient_id' => Myclass::t('Recipient'),
			'inv_rec_deleted' => Myclass::t('Inv Rec Deleted'),
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

		$criteria->compare('inv_rec_id',$this->inv_rec_id);
		$criteria->compare('inv_id',$this->inv_id);
		$criteria->compare('recipient_id',$this->recipient_id);
		$criteria->compare('inv_rec_deleted',$this->inv_rec_deleted);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}