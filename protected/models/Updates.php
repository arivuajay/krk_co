<?php

/**
 * This is the model class for table "{{updates}}".
 *
 * The followings are the available columns in table '{{updates}}':
 * @property integer $notify_id
 * @property integer $notify_type
 * @property string $notify_update_id
 * @property integer $notify_status
 * @property integer $notify_from_user
 * @property integer $notify_to_user
 * @property string $notify_on
 * @property string $notify_deleted
 */
class Updates extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Updates the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function scopes() 
	{
	    $alias = $this->getTableAlias(false, false);
	    return array(
		 'active'=>array('condition'=>$alias.'.notify_deleted = "0"'),
		 'latest'=>array('order'=>$alias.'.notify_id DESC'),
		 'newupdatescount'=>array('condition'=>$alias.'.notify_status = 0 AND notify_to_user='.Yii::app()->user->id)
	    );
	}
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{updates}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('notify_type, notify_update_id, notify_on', 'required'),
			array('notify_type, notify_status, notify_from_user, notify_to_user', 'numerical', 'integerOnly'=>true),
			array('notify_deleted', 'length', 'max'=>1),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('notify_id, notify_type, notify_update_id, notify_status, notify_from_user, notify_to_user, notify_on, notify_deleted', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'notify_id' => Myclass::t('Notify'),
			'notify_type' => Myclass::t('Notify Type'),
			'notify_update_id' => Myclass::t('Notify Message'),
			'notify_status' => Myclass::t('Notify Status'),
			'notify_from_user' => Myclass::t('Notify From User'),
			'notify_to_user' => Myclass::t('Notify To User'),
			'notify_on' => Myclass::t('Notify On'),
			'notify_deleted' => Myclass::t('Notify Deleted'),
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

		$criteria->compare('notify_id',$this->notify_id);
		$criteria->compare('notify_type',$this->notify_type);
		$criteria->compare('notify_update_id',$this->notify_update_id,true);
		$criteria->compare('notify_status',$this->notify_status);
		$criteria->compare('notify_from_user',$this->notify_from_user);
		$criteria->compare('notify_to_user',$this->notify_to_user);
		$criteria->compare('notify_on',$this->notify_on,true);
		$criteria->compare('notify_deleted',$this->notify_deleted,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function beforeSave() {
	    if ($this->isNewRecord):
		$this->notify_on = new CDbExpression('NOW()');
	    endif;

	    return parent::beforeSave();
	}
}