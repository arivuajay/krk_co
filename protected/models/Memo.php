<?php

/**
 * This is the model class for table "{{memo}}".
 *
 * The followings are the available columns in table '{{memo}}':
 * @property integer $memo_id
 * @property string $memo_scenario
 * @property string $cli_name
 * @property integer $rel_id
 * @property string $description
 * @property double $amount
 * @property string $pay_mode
 * @property string $pay_date
 * @property string $remarks
 * @property string $memo_date
 * @property integer $is_deleted
 *
 * The followings are the available model relations:
 * @property Salesorder $sodet
 * @property Poorder $podet
 */
class Memo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Memo the static model class
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
		return '{{memo}}';
	}
	
	public function scopes() 
	{
	    $alias = $this->getTableAlias(false, false);
	    return array(
		'active'=>array('condition'=>$alias.'.is_deleted = 0'),
		'credit'=>array('condition'=>$alias.'.memo_scenario = "sales_order"'),
		'debit'=>array('condition'=>$alias.'.memo_scenario = "po_order"'),
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
			array('memo_scenario, cli_name, description, amount, pay_mode, pay_date', 'required'),
			array('is_deleted', 'numerical', 'integerOnly'=>true),
			array('amount', 'numerical'),
			array('memo_scenario, cli_name, pay_mode', 'length', 'max'=>255),
			array('remarks,rel_id,inv_id', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('memo_id, memo_scenario, cli_name, rel_id, description, amount, pay_mode, pay_date, remarks, memo_date, is_deleted', 'safe', 'on'=>'search'),
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
			'sodet' => array(self::BELONGS_TO, 'Salesorder', 'rel_id'),
			'podet' => array(self::BELONGS_TO, 'PoOrder', 'rel_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'memo_id' => Myclass::t('Memo'),
			'memo_scenario' => Myclass::t('Memo Scenario'),
			'cli_name' => Myclass::t('Vendor Name'),
			'rel_id' => Myclass::t('SO ID').' #',
			'inv_id' => Myclass::t('INV ID').' #',
			'description' => Myclass::t('Description'),
			'amount' => Myclass::t('Amount'),
			'pay_mode' => Myclass::t('Payment Mode'),
			'pay_date' => Myclass::t('Payment Date'),
			'remarks' => Myclass::t('Remarks'),
			'memo_date' => Myclass::t('Memo Date'),
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

		$criteria->compare('memo_id',$this->memo_id);
		$criteria->compare('memo_scenario',$this->memo_scenario,true);
		$criteria->compare('cli_name',$this->cli_name,true);
		$criteria->compare('rel_id',$this->rel_id);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('pay_mode',$this->pay_mode,true);
		$criteria->compare('pay_date',$this->pay_date,true);
		$criteria->compare('remarks',$this->remarks,true);
		$criteria->compare('memo_date',$this->memo_date,true);
		$criteria->compare('is_deleted',$this->is_deleted);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}