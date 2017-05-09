<?php
namespace app\modules\oa_v1\controllers;


use Yii;
use app\modules\oa_v1\models\BaoxiaoForm;
use yii\web\UploadedFile;


class BaoxiaoController extends BaseController
{
	/**
	 * 报效申请
	 */
	public function actionAdd()
	{
		$file_config = [
			'fujian'=>'/upload/files/baoxiao/'.date('Ymd'),
			'pic'=>'/upload/images/baoxiao/'.date('Ymd'),
			'pdf'=>'/upload/account/baoxiao/'.date('Ymd'),
		];
		
		$request = Yii::$app -> request;
		$post['BaoxiaoForm'] = Yii::$app->request->post();
		if($request->isPost)
		{
			$model = new BaoxiaoForm();
			$model -> load($post);
			$model -> title = $this->arrPersonInfo['person_name'].'的报销单';
			$model -> create_time = time();
			$model -> user = array('id'=>$this->arrPersonInfo['person_id'],'name'=>$this->arrPersonInfo['person_name']);;
			$model -> fujian  = $model -> saveFile(UploadedFile::getInstancesByName('fujian'),$file_config['fujian']);
			$model -> pic  = $model -> saveFile(UploadedFile::getInstancesByName('pic'),$file_config['pic']);
			
			if($model -> validate()){
				if($apply_id = $model -> saveBaoxiao() ){
					$model -> saveAccount($file_config['pdf']);
					return $this -> _return($apply_id,200);
				}else{
					return $this -> _return(null,404);
				}
			}else{
				return $this -> _return(current($model -> getErrors())[0],403);
			}
		}
	}
	
	
}