<?php

class StatusmsgController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','admin'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','index','view'),
				'expression'=>'Yii::app()->session["isAdmin"]==1',
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Statusmsg;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);
		$model->dateadded = new CDbExpression("NOW()");
		$model->userid = Yii::app()->session['userid'];
		
		if(isset($_POST['Statusmsg']))
		{
			$model->attributes=$_POST['Statusmsg'];
			if($model->save()){
				Yii::app()->user->setFlash('info','New status msg was successfully added!');
				$this->redirect(array('admin'));
			}
		}

		if (Yii::app()->request->isAjaxRequest) {
			Yii::app()->clientScript->scriptMap['jquery.js'] = false;
				
			$this->renderPartial('create', array(
					'model' => $model,
			), false, true);
				
			if (!empty($_GET['asDialog'])){
				echo CHtml::script('$("#dlg-detail").dialog("open");');
				echo CHtml::script('$(".ui-dialog-titlebar").hide();');
			}
			Yii::app()->end();
		}
		else{
			$this->render('create',array(
					'model'=>$model,
			));
		}
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Statusmsg']))
		{
			$model->attributes=$_POST['Statusmsg'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Statusmsg');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Statusmsg('search');
		$model->unsetAttributes();  // clear any default values

		if(isset($_GET['Statusmsg']))
			$model->attributes=$_GET['Statusmsg'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Statusmsg the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Statusmsg::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Statusmsg $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='statusmsg-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
