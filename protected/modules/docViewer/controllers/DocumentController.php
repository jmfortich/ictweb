<?php

class DocumentController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
	public $docID=0;

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
		$this->docID = $_GET['id']; 
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('view'),
				'expression'=> array($this,"allowOnlyAuthorize"),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
					'actions'=>array('admin'),
					'users'=>array('@'),
			),				
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
					'actions'=>array('create','update','admin'),
					'expression'=>'Yii::app()->session["role"]==3',
			),	
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('delete'),
				'expression'=>'Yii::app()->session["isAdmin"]==1',
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function allowOnlyAuthorize(){
		$model = Document::model()->findByPk($this->docID);
		$sql = "select count(userid) from usergroup where groupid = ".$model->groupid." and userid=".Yii::app()->session['userid'];
		$result = Yii::app()->db->createCommand($sql)->queryScalar();
	
		return $result>0 ? true : false;
	}
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->docID = $id;
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
		$model=new Document;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);
		$model->dtadded = new CDbExpression("NOW()");
		if(isset($_POST['Document']))
		{
			$model->attributes=$_POST['Document'];
			if($model->save()){
				if (@!empty($_FILES['Document']['name']['attach1'])){
					$model->uploaded_img = CUploadedFile::getInstance($model, 'attach1');
					$model->attach1 = $model->uploaded_img->getName()."{dv1_".$model->id."_".date('Ymdhis', strtotime(date("Y-m-d H:i:s"))).'}.'.$model->uploaded_img->getExtensionName();
					$model->uploaded_img->saveAs(Yii::getPathOfAlias('webroot')."\\docViewer\\".$model->attach1);
					$model->save(false);
				}
			
				Yii::app()->user->setFlash('info','New document was successfully added!');
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
		$this->performAjaxValidation($model);

		if(isset($_POST['Document']))
		{
			$model->attributes=$_POST['Document'];
			if($model->save()){
				if (@!empty($_FILES['Document']['name']['attach1'])){
					$model->uploaded_img = CUploadedFile::getInstance($model, 'attach1');
					$model->attach1 = $model->uploaded_img->getName()."{dv1_".$model->id."_".date('Ymdhis', strtotime(date("Y-m-d H:i:s"))).'}.'.$model->uploaded_img->getExtensionName();
					$model->uploaded_img->saveAs(Yii::getPathOfAlias('webroot')."\\docViewer\\".$model->attach1);
					$model->save(false);
				}
				
				Yii::app()->user->setFlash('info','Request was successfully updated!');				
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
		$dataProvider=new CActiveDataProvider('Document');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Document('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Document']))
			$model->attributes=$_GET['Document'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Document the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Document::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Document $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='document-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
