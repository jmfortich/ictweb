<?php

/**
 * This is the model class for table "statusmsg".
 *
 * The followings are the available columns in table 'statusmsg':
 * @property integer $id
 * @property integer $userid
 * @property string $msg
 * @property string $dateadded
 *
 * The followings are the available model relations:
 * @property Profiles $user
 */
class Statusmsg extends CActiveRecord
{
	public $user_search;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'statusmsg';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userid, msg, dateadded', 'required'),
			array('userid', 'numerical', 'integerOnly'=>true),
			array('msg', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, userid, msg, dateadded,user_search', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'Profile', 'userid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'userid' => 'User',
			'msg' => 'Message',
			'dateadded' => 'Date Added',
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
		$criteria->compare('msg',$this->msg,true);
		$criteria->with=array('user');
		$criteria->compare('user.firstname',$this->user_search,true);
		$criteria->compare('dateadded',$this->dateadded,true);
		
		/*
		if(Yii::app()->session['isAdmin']==0){
			$criteria->compare('userid',Yii::app()->session['userid']);
		}*/

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
				'sort'=>array(
						'defaultOrder'=>'dateadded DESC',
						'attributes'=>array(
								'user_search'=>array(
										'asc'=>'user.firstname',
										'desc'=>'user.firstname DESC',
								),
						'*'),
						),		
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Statusmsg the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
