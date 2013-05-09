<?php

class Searchengine extends CFormModel
{
	public $searchtext;

	public function rules()
	{
		return array(
			array('searchtext', 'required'),
			array('searchtext', 'match', 'pattern'=>'/^[\w\s,]+$/', 'message'=>'Search text can only contain word characters.'),
			array('searchtext', 'normalizeTags'),
		);
	}
	
	/*
	 * Normalizes the user-entered tags.
	 */
	public function normalizeTags($attribute,$params)
	{
		$this->searchtext=Tag::array2string(array_unique(Tag::string2array($this->tags)));
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'searchtext'=>'Enter the text you want to search',
		);
	}
}