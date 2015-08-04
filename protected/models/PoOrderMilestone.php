<?php

/**
 * This is the model class for table "{{po_order_milestone}}".
 *
 * The followings are the available columns in table '{{po_order_milestone}}':
 * @property integer $milestone_id
 * @property double $milestone_amt
 * @property string $milestone_date
 * @property integer $po_ord_id
 * @property string $raise_invoice
 * @property integer $is_deleted
 *
 * The followings are the available model relations:
 * @property PoOrder $poOrd
 */
class PoOrderMilestone extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PoOrderMilestone the static model class
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
		return '{{po_order_milestone}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('milestone_amt, milestone_date, po_ord_id, raise_invoice', 'required'),
			array('po_ord_id, is_deleted', 'numerical', 'integerOnly'=>true),
			array('milestone_amt', 'numerical'),
			array('raise_invoice', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('milestone_id, milestone_amt, milestone_date, po_ord_id, raise_invoice, is_deleted', 'safe', 'on'=>'search'),
		);
	}
	
	public function valid_po_mile($milestone,$order_val)
	{
	    if(!empty($milestone))
	    {
	    $count_prod = count($milestone['milestone_amt']);
		for($i = 0; $i < $count_prod; $i++)
		{
		if(is_numeric($milestone['milestone_amt'][$i])):
		    $total_value += $milestone['milestone_amt'][$i];
		    if(!empty($milestone['milestone_amt'][$i]) && empty($milestone['milestone_date'][$i])):
			$this->addError('milestone_date', Myclass::t('Milestone date cannot be empty'));
		    endif;
		    if(!empty($milestone['milestone_amt'][$i]) && empty($milestone['raise_invoice'][$i])):
			$this->addError('milestone_date', Myclass::t('Select a milestone'));
		    endif;
		elseif(!empty($milestone['raise_invoice'][$i]) || !empty($milestone['milestone_date'][$i])):
		    $this->addError ('milestone_amt', Myclass::t('Milestone amount not valid.'));
		endif;
		}
		
		if($total_value == 0) $this->addError('milestone_amt', Myclass::t('Please Add Milestones'));
		elseif($total_value != $order_val) $this->addError('milestone_amt', Myclass::t('Milestone Amount Not Equal Order Value'));
	    }
	    else
	    {
		$this->addError('milestone_amt', Myclass::t('Please Add Milestones'));
	    }
	    
	    if($this->hasErrors()):
		return false;
	    endif;

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
			'poOrd' => array(self::BELONGS_TO, 'PoOrder', 'po_ord_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'milestone_id' => Myclass::t('Milestone'),
			'milestone_amt' => Myclass::t('Milestone Amt'),
			'milestone_date' => Myclass::t('Milestone Date'),
			'po_ord_id' => Myclass::t('Po Ord'),
			'raise_invoice' => Myclass::t('Raise Invoice'),
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

		$criteria->compare('milestone_id',$this->milestone_id);
		$criteria->compare('milestone_amt',$this->milestone_amt);
		$criteria->compare('milestone_date',$this->milestone_date,true);
		$criteria->compare('po_ord_id',$this->po_ord_id);
		$criteria->compare('raise_invoice',$this->raise_invoice,true);
		$criteria->compare('is_deleted',$this->is_deleted);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}