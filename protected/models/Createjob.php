<?php

class Createjob extends CFormModel
{
	public $headline;

	public function rules()
	{
		return array(
			array('headline', 'required'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'headline'=>'POST A JOB:',
		);
	}
}