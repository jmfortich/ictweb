<?php

/**
 * This is the model class for table "ticket".
 *
 * The followings are the available columns in table 'ticket':
 * @property integer $id
 * @property integer $requestid
 * @property integer $resourceid
 * @property integer $priorityid
 * @property integer $rsourceid
 * @property string $resolution
 * @property string $startdt
 * @property string $finishdt
 * @property string $actualstart
 * @property string $actualfinish
 * @property integer $assignedby
 * @property integer $progress
 * @property integer $statusid
 * @property string $remark
 *
 * The followings are the available model relations:
 * @property Reqsource $rsource
 * @property Profiles $request
 * @property Profiles $resource
 * @property Profiles $assignedby0
 * @property Status $status
 * @property Priority $priority
 */
class Ticket extends CActiveRecord
{
	public $uploaded_img;
	public $resource_search;
	public $priority_search;
	public $score;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ticket';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('requestid, resourceid, priorityid, startdt, finishdt, actualstart, assignedby, progress, wdeliverable', 'required'),
			array('requestid, resourceid, priorityid, assignedby', 'numerical', 'integerOnly'=>true),
			array('progress', 'numerical', 'min' => 0, 'max' => 100),
			array('remark', 'length', 'max'=>254),
			array('wdeliverable,verified', 'boolean'),
			array('startdt,finishdt','compare','operator'=>'!=','compareValue'=>'0000-00-00 00:00:00'),
				
			array('startdt,finishdt','type', 'type'=>'date', 'dateFormat'=>'yyyy-MM-dd hh:mm:ss', 'message'=>'{attribute} have wrong format'),
			array('finishdt','checkfinishdt'),
			//array('finishdt','compare','operator'=>'>','compareValue'=>'startdt'),
				
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, requestid, resourceid, priorityid, resolution, startdt, finishdt, actualstart, actualfinish, assignedby, progress, remark, priority_search, resource_search', 'safe', 'on'=>'search'),
			array('attach1, resolution, actualfinish,verified,remark','safe')
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
			//'rsource' => array(self::BELONGS_TO, 'Reqsource', 'rsourceid'),
			'request' => array(self::BELONGS_TO, 'Profile', 'requestid'),
			'resource' => array(self::BELONGS_TO, 'Profile', 'resourceid'),
			'assignedby0' => array(self::BELONGS_TO, 'Profile', 'assignedby'),
			//'status' => array(self::BELONGS_TO, 'Status', 'statusid'),
			'priority' => array(self::BELONGS_TO, 'Priority', 'priorityid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'requestid' => 'Request ID',
			'resourceid' => 'Resource',
			'priorityid' => 'Priority',
			'resolution' => 'Resolution',
			'startdt' => 'Start',
			'finishdt' => 'Finish',
			'actualstart' => 'Actual Start',
			'actualfinish' => 'Actual Finish',
			'assignedby' => 'Assigned By',
			'progress' => 'Progress',
			'wdeliverable'=> 'w Deliverable',
			'attach1'=>'Attachment',
			'remark' => 'Remark',
			'verified'=>'Verified',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('requestid',$this->requestid);
		$criteria->with = array('resource','priority');
		$criteria->compare('resource.firstname',$this->resource_search);		
		$criteria->compare('priority.pname',$this->priority_search,true);
		$criteria->compare('resolution',$this->resolution,true);
		$criteria->compare('startdt',$this->startdt,true);
		$criteria->compare('finishdt',$this->finishdt,true);
		$criteria->compare('actualstart',$this->actualstart,true);
		$criteria->compare('actualfinish',$this->actualfinish,true);
		$criteria->compare('assignedby',$this->assignedby);
		$criteria->compare('progress',$this->progress);
		$criteria->compare('remark',$this->remark,true);
		
		/*
		if(Yii::app()->session['isAdmin']!=1){
			$criteria->condition = "t.resourceid='".Yii::app()->user->id."'";
		}*/

		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
				'sort'=>array(
						'defaultOrder'=>'actualstart DESC',
						'attributes'=>array(
								'resource_search'=>array(
										'asc'=>'resource.firstname',
										'desc'=>'resource.firstname DESC',
								),
								'priority_search'=>array(
										'asc'=>'priority.pname',
										'desc'=>'priority.pname DESC',
								),
								'*',
						),
				)
		));			
	
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Ticket the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function getUnverified($id){
		$count = Yii::app()->db->createCommand("SELECT count(*) FROM ticket WHERE verified = 0 and requestid=$id")->queryScalar();
		return $count;
	}
	
	public function getCnt100($id){
		$count = Yii::app()->db->createCommand("SELECT count(*) FROM ticket WHERE progress < 100 and `verified` = 0 and requestid=$id")->queryScalar();
		return $count;
	}
	
	protected function afterSave()
	{
		$rmodel = Request::model()->findByPk($this->requestid);
		if($this->getCnt100($this->requestid)!=0){
			$rmodel->statusid = 2;
			$rmodel->save();
		}
		parent::afterSave();
		
	}
	
	public function computeScore($id)
	{
		$this->score = 0;
		
		$actual = abs(strtotime($this->actualfinish) - strtotime($this->actualstart))/(60*60);
		$entry = abs(strtotime($this->finishdt) - strtotime($this->startdt))/(60*60);

		$tmp = ($actual/$entry)*50+50;
		
		switch ($tmp)
		{
			case $tmp>750:
				$this->score=1.0;
				break;
			case $tmp>700 and $tmp<=750:
				$this->score=1.25;
				break;
			case $tmp>650 and $tmp<=700:
				$this->score=1.5;
				break;
			case $tmp>600 and $tmp<=650:
				$this->score=1.75;
				break;
			case $tmp>550 and $tmp<=600:
				$this->score=2.0;
				break;			
			case $tmp>500 and $tmp<=550:
				$this->score=2.25;
				break;
			case $tmp>450 and $tmp<=500:
				$this->score=2.5;
				break;
			case $tmp>400 and $tmp<=450:
				$this->score=2.75;
				break;
			case $tmp>350 and $tmp<=400:
				$this->score=3.0;
				break;
			case $tmp>300 and $tmp<=350:
				$this->score=3.25;
				break;
			case $tmp>250 and $tmp<=300:
				$this->score=3.50;
				break;
			case $tmp>200 and $tmp<=250:
				$this->score=3.75;
				break;
			case $tmp>150 and $tmp<=200:
				$this->score=4.0;
				break;
			case $tmp>=100 and $tmp<=150: 
				$this->score=4.25;
				break;
			case $tmp<100 and $tmp>=75:
				$this->score=4.5;
				break;
			case $tmp<75and $tmp>=51:
				$this->score=4.75;
				break;
			case $tmp<=50:
				$this->score=5.0;
				break;				
		}	
		//date('m/d/Y',strtotime($this->actualfinish))=="01/01/1970" ? 0 : $this->score;
		return date('m/d/Y',strtotime($this->actualfinish))=="01/01/1970" ? 0 : number_format($this->score,2);
		//return $actual/$entry;
	}
	
	public function getTicketStatus($year,$user){
		$sql = "SELECT  month(finishdt) as mon,progress,count(id) as tally
		FROM `ticket` where year(finishdt)='$year' and resourceid='$user' group by month(finishdt),progress order by mon";
		
		$result = Yii::app()->db->createCommand($sql)->queryAll();
		return $result;
	}
	
	public function checkfinishdt($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			if(strtotime($this->{$attribute})<=strtotime($this->startdt))
			{
				$this->addError($attribute,"The finish must be greater than start.");
			}
		}
	}

}
