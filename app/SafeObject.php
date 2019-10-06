<?php

namespace App;

class SafeObject
{
	public function __construct(array $form = [])
	{
		foreach($form as $prop=>$value){
			$this->{$prop} = $value;
		}
	}

	public function __get($propertyName)
	{
		
		if(!isset($this->{$propertyName})){
			return "";
		}
		return parent::_get($propertyName);
	}
}