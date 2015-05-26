<?php

/**
 * This is the model class for table "request".
 *
 * The followings are the available columns in table 'request':
 * @property integer $id
 * @property string $subj
 * @property string $desc
 * @property string $reqdate
 * @property integer $requestedby
 * @property integer $statusid
 *
 * The followings are the available model relations:
 * @property Status $status
 * @property Profiles $requestedby0
 */
class Request extends CActiveRecord
{
	public $requestedby_search;
	public $status_search;
	public $uploaded_img;
	public $category_search;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'request';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('subj, desc, requestedby, recipient, rsourceid, neededon, catid', 'required'),
			array('requestedby, recipient, statusid, catid, rsourceid', 'numerical', 'integerOnly'=>true),
			array('subj', 'length', 'max'=>50),
			array('remark', 'length', 'max'=>254),
			array('neededon','compare','operator'=>'!=','compareValue'=>'0000-00-00 00:00:00'),				
			array('neededon','type', 'type'=>'date', 'dateFormat'=>'yyyy-MM-dd hh:mm:ss', 'message'=>'{attribute} have wrong format'),				
			//array('subj','unique', 'className' => 'Request'),
				
			//array('rsourceid', 'default', 'setOnEmpty' => true, 'value' => '2'),
			//array('neededon', 'type', 'type' => 'datetime', 'message' => '{attribute}: is not a datetime!', 'dateFormat' => 'yy-MM-dd H:i:s'),
			//array('attach1', 'file', 'allowEmpty'=>true,'types'=>'doc','maxSize'=>1024*1024*1, 'tooLarge'=>'File must be less than 1MB'),
			//array('attach1', 'validateImage'),

			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, subj, desc, reqdate, requestedby, statusid, neededon, catid, rsourceid, requestedby_search, status_search, category_search', 'safe', 'on'=>'search'),
			array('attach1,remark','safe')	
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
			'status' => array(self::BELONGS_TO, 'Status', 'statusid'),
			'requestedby0' => array(self::BELONGS_TO, 'Profile', 'requestedby'),
			'recipient0'=> array(self::BELONGS_TO, 'Profile', 'recipient'),
			'rsource' => array(self::BELONGS_TO, 'Reqsource', 'rsourceid'),
			'request' => array(self::HAS_MANY, 'Ticket', 'requestid'),
			'category'=> array(self::BELONGS_TO, 'Reqcategory', 'catid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'subj' => 'Subject',
			'desc' => 'Description',
			'reqdate' => 'Date Requested',
			'requestedby' => 'Requested By',
			'statusid' => 'Status',
			'attach1' => 'Attachment',	
			'neededon'=>'Date Needed',
			'recipient'=>'To',
			'rsourceid'	=> 'Source',
			'catid' => 'Category',
			'remark'=>"Remarks",
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

		$criteria->compare('t.id',$this->id);
		$criteria->compare('subj',$this->subj,true);
		$criteria->compare('t.desc',$this->desc,true);
		$criteria->compare('reqdate',$this->reqdate,true);
		$criteria->with = array('requestedby0','status','category');
		
		$criteria->compare('requestedby0.firstname',$this->requestedby_search,true);
		//$criteria->compare('recipient',$this->recipient);
		$criteria->compare('status.sname',$this->status_search,true);
		$criteria->compare('neededon',$this->neededon);
		$criteria->compare('category.ctitle', $this->category_search,true);
		//$criteria->compare('rsourceid',$this->rsourceid);
		
		if(Yii::app()->session['isAdmin']!=1){
			$criteria2 = new CDbCriteria;
			$criteria2->compare('t.recipient',Yii::app()->user->id);
			$criteria2->compare('t.requestedby',Yii::app()->user->id,false,'OR');
			$criteria->mergeWith($criteria2, 'AND');
		}
				
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
				'sort'=>array(
						'defaultOrder'=>'reqdate DESC',
						'attributes'=>array(
								'requestedby_search'=>array(
										'asc'=>'requestedby0.firstname',
										'desc'=>'requestedby0.firstname DESC',
								),
								'status_search'=>array(
										'asc'=>'status.sname',
										'desc'=>'status.sname DESC',
								),
								'category_search'=>array(
										'asc'=>'category.ctitle',
										'desc'=>'category.ctitle DESC',
								),								
								'*',
						),
				)));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Request the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function validateImage($attribute,$params){
		if($file = CUploadedFile::getInstance($this,'attach1')){
			$size = $file->size;
			if($size>1000000){
				$this->addError($attribute, 'File size is too big!');
			}
		}
		
	}
	
	public function getRequestStat($year,$user){
	
		$sql = "SELECT  month(reqdate) as mon,statusid,count(id) as tally
		FROM `request` where year(reqdate)='$year' and recipient='$user' group by month(reqdate),statusid order by mon";
	
		$result = Yii::app()->db->createCommand($sql)->queryAll();
		return $result;
	}

}
