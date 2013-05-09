<?php

/**
 * This is the model class for table "{{jobs}}".
 *
 * The followings are the available columns in table '{{jobs}}':
 * @property integer $jid
 * @property string $headline
 * @property string $type
 * @property string $category
 * @property string $location
 * @property integer $relocation
 * @property string $job_description
 * @property string $job_perks_description
 * @property string $how_to_apply
 * @property string $name
 * @property string $logo
 * @property string $url
 * @property string $email
 * @property integer $privacy
 * @property integer $created_on
 * @property integer $status
 */
class Jobs extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Jobs the static model class
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
		return '{{jobs}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('headline, type, category, location, job_description, how_to_apply, name, email, privacy, created_on, status', 'required'),
			array('headline, type, category, location, relocation, job_description, job_perks_description, how_to_apply, name, logo, url, email, privacy, created_on, status', 'safe'),
			array('relocation, status', 'numerical', 'integerOnly'=>true),
			array('headline, type, category, location, name, logo, url, email, privacy', 'length', 'max'=>222),
			array('email','email'),
			array('url', 'url', 'defaultScheme' => 'http'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('jid, headline, type, category, location, relocation, job_description, job_perks_description, how_to_apply, name, logo, url, email, privacy, created_on, status', 'safe', 'on'=>'search'),
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
			'images' => array(self::HAS_MANY, 'Images', 'jid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'jid' => 'Jid',
			'headline' => 'Headline',
			'type' => 'Type',
			'category' => 'Category',
			'location' => 'Location',
			'relocation' => 'Relocation assistance available',
			'job_description' => 'Job Description',
			'job_perks_description' => 'Job Perks',
			'how_to_apply' => 'How To Apply',
			'name' => 'Name',
			'logo' => 'Logo',
			'url' => 'URL',
			'email' => 'Email',
			'privacy' => 'Is it okay for recruiters and other intermediaries to contact you about this listing?',
			'created_on' => 'Created On',
			'status' => 'Status',
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

		$criteria->compare('jid',$this->jid);
		$criteria->compare('headline',$this->headline,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('category',$this->category,true);
		$criteria->compare('location',$this->location,true);
		$criteria->compare('relocation',$this->relocation);
		$criteria->compare('job_description',$this->job_description,true);
		$criteria->compare('job_perks_description',$this->job_perks_description,true);
		$criteria->compare('how_to_apply',$this->how_to_apply,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('logo',$this->logo,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('privacy',$this->privacy);
		$criteria->compare('created_on',$this->created_on);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}