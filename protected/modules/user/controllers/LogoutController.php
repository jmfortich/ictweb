<?php

class LogoutController extends Controller
{
	public $defaultAction = 'logout';
	public $modelid = 0;
	/**
	 * Logout the current user and redirect to returnLogoutUrl.
	 */
	public function actionLogout()
	{
		//Yii::app()->session->clear();
		//Yii::app()->session->destroy();
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->controller->module->returnLogoutUrl);
	}

}