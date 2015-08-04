<?php

/**
 * This is the model class for table "{{sales_order_milestone}}".
 *
 * The followings are the available columns in table '{{sales_order_milestone}}':
 * @property integer $milestone_id
 * @property double $milestone_amt
 * @property string $milestone_date
 * @property integer $on_completion_id
 * @property string $raise_invoice
 * @property integer $so_id
 */
class SalesOrderMilestone extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SalesOrderMilestone the static model class
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
		return '{{sales_order_milestone}}';
	}

        public function scopes()
	{
	    $alias = $this->getTableAlias(false, false);
//	    return array(
//		 //'active'=>array('condition'=>$alias.'.is_active=1')
//	    );
	    return array(
//		'soactive'=>array('condition'=>$alias.'so.is_active=1')
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
			array('soproductlist', 'valid_so_mile'),
			array('milestone_amt', 'numerical'),
			array('raise_invoice', 'length', 'max'=>255),
			array('milestone_date,milestone_amt', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('milestone_id,created_date,milestone_amt, milestone_date, on_completion_id, raise_invoice, so_id', 'safe'),
		);
	}

	public function valid_so_mile($milestone,$order_val,&$model)
	{
	    $total_value = 0;
	    $dublicate_value = false;
	    $raise_invoice = array();
	    if($milestone)
	    {
	    $count_prod = count($milestone['milestone_amt']);
		for($i = 0; $i < $count_prod; $i++)
		{
		    $total_value += $milestone['milestone_amt'][$i];
		    if (in_array($milestone['raise_invoice'][$i], $raise_invoice))
		    {
			$dublicate_value = true;
		    }
		    $raise_invoice[] = $milestone['raise_invoice'][$i];
		    if(!empty($milestone['milestone_amt'][$i]) && empty($milestone['milestone_date'][$i]))
			$model->addError ('milestone_date', Myclass::t('Milestone date cannot be empty'));
		}
		if($total_value == 0) $model->addError('milestone_amt', Myclass::t('Please Add Milestones'));
		elseif($total_value != $order_val) $model->addError('milestone_amt', Myclass::t('Milestone Amount Not Equal Order Value'));
		
		if($dublicate_value) { $model->addError('milestone_amt', Myclass::t('Raise Invoice should not be same')); }
	    }
	    else
	    {
		$model->addError('milestone_amt', Myclass::t('Please Add Milestones'));
	    }
	    return true;
	}
	
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
                    'SalesOrderMilestone'=>array(self::HAS_MANY,'salesorder','so_id'),
		    'so' => array(self::BELONGS_TO, 'Salesorder', 'so_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'milestone_id' => Myclass::t('Milestone'),
			'milestone_amt' => Myclass::t('Amount'),
			'milestone_date' => Myclass::t('Milestone Date'),
			'on_completion_id' => Myclass::t('On Completion'),
			'raise_invoice' => Myclass::t('Raise Invoice'),
			'so_id' => Myclass::t('So'),
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

		$criteria->compare('milestone_id',$this->milestone_id);
		$criteria->compare('milestone_amt',$this->milestone_amt);
		$criteria->compare('milestone_date',$this->milestone_date,true);
		$criteria->compare('on_completion_id',$this->on_completion_id);
		$criteria->compare('raise_invoice',$this->raise_invoice,true);
		$criteria->compare('so_id',$this->so_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}