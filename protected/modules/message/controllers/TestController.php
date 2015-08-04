<?php

class TestController extends Controller
{

	public $defaultAction = 'view';

	public function actionView() {
		echo $messageId = (int)Yii::app()->request->getParam('message_id');


		$this->render(Yii::app()->getModule('message')->viewPath . '/test');
	}
}
