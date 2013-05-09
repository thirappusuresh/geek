<?php

/**
 * This is the model class for table "{{user}}".
 *
 * The followings are the available columns in table '{{user}}':
 * @property string $uid
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $name
 * @property integer $verify_account
 * @property integer $status
 * @property string $joined_on
 */
class User extends CActiveRecord
{
	public $confirmpassword;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, email, password, name, confirmpassword', 'required'),
			array('uid, username, email, password, name, status, joined_on', 'safe'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('email', 'email'),
			array('uid','unique'),
			array('uid, username, email, password, name', 'length', 'max'=>222),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('uid, username, email, password, name, status, joined_on', 'safe', 'on'=>'search'),
			array('password', 'compare', 'compareAttribute'=>'confirmpassword'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'confirmpassword'=>'Confirm Password',
			'uid' => 'Uid',
			'username' => 'Username',
			'email' => 'Email',
			'password' => 'Password',
			'name' => 'Full Name',
			'verify_account' => 'Verify Account',
			'status' => 'Status',
			'joined_on' => 'Joined On',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('uid',$this->uid,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('joined_on',$this->joined_on,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}