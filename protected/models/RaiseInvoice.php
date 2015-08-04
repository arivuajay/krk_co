<?php

/**
 * This is the model class for table "{{raise_invoice}}".
 *
 * The followings are the available columns in table '{{raise_invoice}}':
 * @property integer $r_id
 * @property string $raise_invoice
 */
class RaiseInvoice extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return RaiseInvoice the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
        public function scopes()
	{
	    $alias = $this->getTableAlias(false, false);
//	    return array(
//		 'active'=>array('condition'=>$alias.'.is_active=1')
//	    );
	}


	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{raise_invoice}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('raise_invoice', 'required'),
			array('raise_invoice', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('r_id, raise_invoice', 'safe', 'on'=>'search'),
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
			'r_id' => 'R',
			'raise_invoice' => Myclass::t('Raise Invoice'),
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

		$criteria->compare('r_id',$this->r_id);
		$criteria->compare('raise_invoice',$this->raise_invoice,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}