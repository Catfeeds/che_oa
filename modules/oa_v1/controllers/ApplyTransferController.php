<?php
namespace app\modules\oa_v1\controllers;

use yii;
use app\modules\oa_v1\models\ApplyTransferForm;

class ApplyTransferController extends BaseController
{
	public function actionAddApply()
	{
		$post = yii::$app->request->post();
		$data['ApplyTransferForm'] = $post;
		$model = new ApplyTransferForm();
		$model->load($data);
		if(!$model->validate()){
			return $this->_returnError(403,current($model->getFirstErrors()),'参数错误');
		}
		$res = $model->save($this->arrPersonInfo);
		if($res['status']){
			return $this->_return('成功');
		}else{
			return $this->_returnError(400,$res['msg']);
		}
	}
}