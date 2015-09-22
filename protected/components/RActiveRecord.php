<?php
class RActiveRecord extends CActiveRecord {
    
    protected function beforeValidate() {
        if($this->isNewRecord){
            $this->created_at = new CDbExpression('NOW()');
            $this->created_by = Yii::app()->user->id;
        }else{
            $this->modified_by = Yii::app()->user->id;
            $this->modified_at = new CDbExpression('NOW()');
        }
        return parent::beforeValidate();
    }
    
    protected function afterFind() {
        if($this->modified_at == '0000-00-00 00:00:00')
            $this->modified_at = '';
        parent::afterFind();
    }
}
