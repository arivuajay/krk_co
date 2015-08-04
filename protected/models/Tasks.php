<?php

/**
 * This is the model class for table "{{tasks}}".
 *
 * The followings are the available columns in table '{{tasks}}':
 * @property integer $task_id
 * @property string $task_description
 * @property string $task_date
 * @property string $task_created_on
 * @property integer $task_created_by
 * @property integer $is_deleted
 *
 * The followings are the available model relations:
 * @property User $taskCreatedBy
 */
class Tasks extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Tasks the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function scopes() 
	{
	    $alias = $this->getTableAlias(false, false);
	    return array(
		 'active'=>array('condition'=>$alias.'.is_deleted = "0"'),
		 'viewall'=>array('order'=>$alias.'.task_date ASC','condition'=>$alias.'.task_date >= "'.date(FORMAT_DATE).'"'),
		 'my'=>array('condition'=>$alias.'.task_created_by = "'.Yii::app()->user->id.'"'),
		 'today'=>array('condition'=>$alias.'.task_date = "'.date(FORMAT_DATE).'"'),
	    );
	}
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{tasks}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('task_date,task_description', 'required','on'=>'insert'),
			array('task_created_by, is_deleted', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('task_id, task_description, task_status,task_created_ip,task_date, task_created_on, task_created_by, is_deleted', 'safe', 'on'=>'search'),
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
			'taskCreatedBy' => array(self::BELONGS_TO, 'User', 'task_created_by'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'task_id' => Myclass::t('Task'),
			'task_description' => Myclass::t('Task Description'),
			'task_date' => Myclass::t('Task Date'),
			'task_created_on' => Myclass::t('Task Created On'),
			'task_created_by' => Myclass::t('Task Created By'),
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

		$criteria->compare('task_id',$this->task_id);
		$criteria->compare('task_description',$this->task_description,true);
		$criteria->compare('task_date',$this->task_date,true);
		$criteria->compare('task_created_on',$this->task_created_on,true);
		$criteria->compare('task_created_by',$this->task_created_by);
		$criteria->compare('is_deleted',$this->is_deleted);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
		
	public function beforeSave() {
	    if ($this->isNewRecord):
		$this->task_created_on = new CDbExpression('NOW()');
		$this->task_created_by = Yii::app()->user->id;
		$this->task_created_ip = CHttpRequest::getUserHostAddress();
	    endif;

	    return parent::beforeSave();
	}
}