<?php

/**
 * This is the model class for table "document".
 *
 * The followings are the available columns in table 'document':
 * @property integer $id
 * @property string $subject
 * @property integer $issuedby
 * @property string $effectivitydt
 * @property string $lstreviewdt
 * @property string $dtadded
 * @property integer $isapprove
 * @property string $attach1
 *
 * The followings are the available model relations:
 * @property Profiles $issuedby0
 */
class Document extends CActiveRecord
{
	public $uploaded_img;
	public $group_search;
	public $issuedby_search;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'document';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('subject, issuedby, effectivitydt, lstreviewdt, dtadded, isapprove,groupid', 'required'),
			array('issuedby, isapprove', 'numerical', 'integerOnly'=>true),
			array('subject', 'length', 'max'=>255),
			array('subject','unique', 'className' => 'Document'),
			//array('attach1', 'file', 'allowEmpty'=>true,'types'=>'pdf','maxSize'=>1024*1024*1, 'tooLarge'=>'Image must be less than 1MB'),
				
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, subject, issuedby, effectivitydt, lstreviewdt, dtadded, isapprove, attach1,issuedby_search, group_search', 'safe', 'on'=>'search'),
			array('attach1','safe'),	
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
			'issuedby0' => array(self::BELONGS_TO, 'Profile', 'issuedby'),
			'group' => array(self::BELONGS_TO, 'Group', 'groupid'),
				
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'subject' => 'Subject',
			'issuedby' => 'Issued by',
			'effectivitydt' => 'Effectivity',
			'lstreviewdt' => 'Last Reviewed',
			'dtadded' => 'Date Added',
			'isapprove' => 'Approved?',
			'attach1' => 'Attachment',
			'groupid'=>'Group',
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
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('effectivitydt',$this->effectivitydt,true);
		$criteria->compare('lstreviewdt',$this->lstreviewdt,true);
		$criteria->compare('dtadded',$this->dtadded,true);
		$criteria->compare('isapprove',$this->isapprove);
		$criteria->compare('attach1',$this->attach1,true);
		$criteria->with=array('group','issuedby0');
		$criteria->compare('issuedby0.firstname',$this->issuedby_search);
		$criteria->compare('group.gname',$this->group_search);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Document the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	

}
