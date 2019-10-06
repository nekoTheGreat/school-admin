<?php

namespace App;

class DT
{
	public static function utc($format = 'Y-m-d H:i:s')
	{
		try{
			$timezone = new \DateTimeZone('UTC');
			$datetime = new \DateTime('now', $timezone);
			return $datetime->format($format);
		}catch(\Exception $e){
			return "Date/Time format invalid";
		}
	}
}