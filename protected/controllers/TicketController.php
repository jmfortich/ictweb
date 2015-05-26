<?php

class TicketController extends Controller
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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('submit','admin','view','update','downloadfile'),
				'users'=>array('@'),
			),
				
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('delete','create','approve','unapprove'),
				'expression'=>'Yii::app()->session["role"]==3',
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
		if (Yii::app()->request->isAjaxRequest) {			
			Yii::app()->clientScript->scriptMap['jquery.js'] = false;
			
			//Yii::app()->clientscript->scriptMap['jquery-ui.min.js'] = false;
			$this->renderPartial('view', array(
					'model' => $this->loadModel($id),
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
			));
		}
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($id,$dt)
	{
		$model=new Ticket;
		
		$model->requestid = $id; //$_GET['id'];
		$model->startdt = date("Y-m-d H:i:s");
		$model->finishdt = $dt; // $_GET['dt'];
		$model->progress = 0; 
		$model->actualstart= date("Y-m-d H:i:s");
		$model->assignedby= Yii::app()->session['userid'];
		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);
		
		if(isset($_POST['Ticket']))
		{
			$transaction = Yii::app()->db->beginTransaction();
			try{
				$model->attributes=$_POST['Ticket'];			
				if($model->save()){
					$rmodel = Request::model()->findByPk($model->requestid);
					if($rmodel->statusid==1){
						$rmodel->statusid = 2; 		
						$rmodel->save(false);
					}	
					$transaction->commit();
					Yii::app()->user->setFlash('info','New ticket was successfully added!');
					$this->redirect(array('request/'.$model->requestid));
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

		if(isset($_POST['Ticket']))
		{
			$transaction = Yii::app()->db->beginTransaction();
			try{
				$model->attributes=$_POST['Ticket'];
				$model->attach1 = $temp;
				if($model->progress<100){
					$model->verified=0;
					$model->actualfinish='0000-00-00 00:00:00';
				}
				if($model->save()){
					
					$model->uploaded_img = CUploadedFile::getInstance($model, 'attach1');
					if (is_object($model->uploaded_img) && get_class($model->uploaded_img)==='CUploadedFile'){
					//if (@!empty($_FILES['Ticket']['name']['attach1'])){				
						$model->attach1 = $model->uploaded_img->getName()."{d1_".$model->id."_".date('Ymdhis', strtotime(date("Y-m-d H:i:s"))).'}.'.$model->uploaded_img->getExtensionName();
						$model->uploaded_img->saveAs(Yii::app()->basePath."\\files\\".$model->attach1);
						$model->save(false);
					}
					$transaction->commit();		
					Yii::app()->user->setFlash('info','Ticket was successfully updated!');				
					$this->redirect(array('request/'.$model->requestid));			
				
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
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	public function actionSubmit($id)
	{
		$model = $this->loadModel($id);
		$transaction = Yii::app()->db->beginTransaction();
		try{		
			if($model->wdeliverable!=1 or ($model->wdeliverable==1 and $model->attach1!='')){
				$model->progress = 100;
				$model->actualfinish = new CDbExpression("NOW()");		
				$model->save(false);
				$rmodel = Request::model()->findByPk($model->requestid);
				if($rmodel->statusid==2 and $model->getCnt100($model->requestid)==0){
					$rmodel->statusid=3; //for verification
					$rmodel->save(false);

				}
			}
			$transaction->commit();
		}
		catch (Exception $e){
				echo $e;
				$transaction->rollback();
		}
		
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}	
	
	public function actionApprove($id)
	{
		$model = $this->loadModel($id);
		$transaction = Yii::app()->db->beginTransaction();
		try{
			$model->verified=1;
			$model->save(false);
			$rmodel = Request::model()->findByPk($model->requestid);
	 
			if($rmodel->statusid==3 and $model->getUnverified($model->requestid)==0){
				$rmodel->statusid=4; //Completed
				$rmodel->save(false);
			}
			$transaction->commit();
		}
		catch (Exception $e){
			echo $e;
			$transaction->rollback();
		}	
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		/*
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));*/
	}	
	
	public function actionUnapprove($id)
	{
		$model = $this->loadModel($id);
		$transaction = Yii::app()->db->beginTransaction();
		try{
			$model->verified=0;
			$model->progress=0;
			$model->actualfinish='0000-00-00 00:00:00';
			$model->attach1='';
			$model->save(false);
			$rmodel = Request::model()->findByPk($model->requestid);
		
			if($rmodel->statusid==3 or $rmodel->statusid==4){ // and $model->getUnverified($model->requestid)>0
				$rmodel->statusid=2; //Assigned
				$rmodel->save(false);
			}
			$transaction->commit();
		}
		catch (Exception $e){
			echo $e;
			$transaction->rollback();
		}
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		/*
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));*/
	}
		
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Ticket');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Ticket('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['filter']) and $_GET['filter']=='t'){
			$pmodel = Profile::model()->findByPk(Yii::app()->session['userid']);
			$model->progress = 0;
			$model->resource_search = $pmodel->firstname;  
		}
		if(isset($_GET['Ticket']))
			$model->attributes=$_GET['Ticket'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Ticket the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Ticket::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Ticket $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='ticket-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
