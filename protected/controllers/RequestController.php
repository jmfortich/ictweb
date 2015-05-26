<?php

class RequestController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
	public $reqid;

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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('downloadfile','view','checkrequests','rdetail'),
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
					'actions'=>array('create','update','admin'),
					'expression'=>'Yii::app()->session["role"]==3 or Yii::app()->session["dept"]==1',
			),				
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('delete','approve','disapprove'),
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
		$dataProvider=new Ticket('search');
		$dataProvider->unsetAttributes();  // clear any default values
		if(isset($_GET['Ticket']))
			$dataProvider->attributes=$_GET['Ticket'];
		$dataProvider->requestid=$id;
		//$this->reqid = $id;
					
		if (Yii::app()->request->isAjaxRequest) {			
			Yii::app()->clientScript->scriptMap['jquery.js'] = false;
			
			//Yii::app()->clientscript->scriptMap['jquery-ui.min.js'] = false;
			$this->renderPartial('view', array(
					'model' => $this->loadModel($id),
					'dataProvider'=>$dataProvider					
			), false, true);
			
			if (!empty($_GET['asDialog'])){
				echo CHtml::script('$("#dlg-detail").dialog("open");');
				echo CHtml::script('$(".ui-dialog-titlebar").hide();');
			}	
			Yii::app()->end();
		}
		else{
		
			$this->render('view',array(
				'model'=>$this->loadModel($id),
				'dataProvider'=>$dataProvider	
			));
		}
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Request;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Request']))
		{
			$transaction = Yii::app()->db->beginTransaction();
			try{
				$model->attributes= $_POST['Request'];
				$model->reqdate = new CDbExpression("NOW()");
				$model->statusid = 1;
				if($model->save()){
					if (@!empty($_FILES['Request']['name']['attach1'])){
						$model->uploaded_img = CUploadedFile::getInstance($model, 'attach1');
						$model->attach1 = $model->uploaded_img->getName()."{r1_".$model->id."_".date('Ymdhis', strtotime(date("Y-m-d H:i:s"))).'}.'.$model->uploaded_img->getExtensionName();	
						$model->uploaded_img->saveAs(Yii::app()->basePath."\\files\\".$model->attach1);
						$model->save(false);	
					}
					$transaction->commit();
					Yii::app()->user->setFlash('info','New request was successfully added!');
					$this->redirect(array('admin'));
				}
			}
			catch (Exception $e){
				echo $e;
				$transaction->rollback();
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
		$temp = $model->attach1;
		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Request']))
		{
			$transaction = Yii::app()->db->beginTransaction();
			try{
				$model->attributes=$_POST['Request'];
				$model->attach1 = $temp;
				if($model->save()){
					if (@!empty($_FILES['Request']['name']['attach1'])){
						$model->uploaded_img = CUploadedFile::getInstance($model, 'attach1');
						$model->attach1 = $model->uploaded_img->getName()."{r1_".$model->id."_".date('Ymdhis', strtotime(date("Y-m-d H:i:s"))).'}.'.$model->uploaded_img->getExtensionName();
						$model->uploaded_img->saveAs(Yii::app()->basePath."\\files\\".$model->attach1);
						$model->save(false);
					}
					$transaction->commit();
					Yii::app()->user->setFlash('info','Request was successfully updated!');				
					$this->redirect(array('admin'));
				}
			}
			catch (Exception $e){
				echo $e;
				$transaction->rollback();
			}
			
		}

		if (Yii::app()->request->isAjaxRequest) {
			Yii::app()->clientScript->scriptMap['jquery.js'] = false;
			
			$this->renderPartial('update', array(
					'model' => $model,
			), false, true);
			
			if (!empty($_GET['asDialog'])){				
				echo CHtml::script('$("#dlg-detail").dialog("open");');
				echo CHtml::script('$(".ui-dialog-titlebar").hide();');
			}
			Yii::app()->end();
		}
		else{	
			$this->render('update',array(
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
		try{
			$this->loadModel($id)->delete();
		
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		catch(CDbException $e){
			//throw $e;
			if($e->getCode()===23000){
				header("HTTP/1.0 400 Relation Restriction");
			}
			else{
				throw $e;
			}
		}
		
	}
	
	public function actionApprove($id){
		$model = $this->loadModel($id);
		$transaction = Yii::app()->db->beginTransaction();
		try{
			if($model->statusid==1  or $model->statusid==5){
				$model->statusid=4;
				$model->save(false);
				$transaction->commit();
				echo "Success";
			}
		}
		catch (Exception $e){
			echo $e;
			$transaction->rollback();
		}
	}

	public function actionDisapprove($id){
		$model = $this->loadModel($id);
		$transaction = Yii::app()->db->beginTransaction();
		try{
			if($model->statusid==1 or $model->statusid==4){
				$model->statusid=5;
				$model->save(false);
				$transaction->commit();
				echo "Success";
			}
		}
		catch (Exception $e){
			echo $e;
			$transaction->rollback();
		}
	}	
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Request');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Request('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['filter']) and $_GET['filter']=='t'){
			$model->status_search = "New";
			$model->recipient = Yii::app()->session['userid'];
		}
		if(isset($_GET['filter']) and $_GET['filter']=='t2'){
			$model->status_search = "For Verification";
			$model->recipient = Yii::app()->session['userid'];
		}		
		if(isset($_GET['Request']))
			$model->attributes=$_GET['Request'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Request the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Request::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Request $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='request-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionDownloadFile()
	{
		$file = !empty($_GET["file"]) ? Yii::app()->baseUrl.'/files/'.$_GET["file"] : '';
		$filepath= Yii::app()->params->filepath.$file;
		
		$this->render('downloadfile',array(
				'file'=>$file,'$filepath'=>$filepath,
		));
	}
		
	public function actionCheckRequests(){
		$user= Yii::app()->session['userid'];
		$sql = "SELECT count(*) FROM request r where r.recipient =".$user." AND  r.statusid=1";
		$sql2 = "SELECT count(*) FROM request r where r.requestedby=$user AND r.statusid=3";
		$request = Yii::app()->db->createCommand($sql)->queryScalar();
		$request2 = Yii::app()->db->createCommand($sql2)->queryScalar();
		
		$ticket = Yii::app()->db->createCommand("SELECT count(*) FROM ticket  where resourceid=$user and progress=0")->queryScalar();
		$total = $request.$request2.$ticket;
		
		echo $total;
	}	
	
	public function actionRdetail($id){

		$this->renderPartial('rdetail',array(
				'model'=>$this->loadModel($id),				
			));
	}
}
