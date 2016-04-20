<?php

/**************************************************************************
| @author : Yash Kumar Verma
| @name : Quora Extension
| @documentation : embeded
| @features : last 30 day views
| @feature : total views 
***************************************************************************/

// change it as you want to call it as.
class quora
{
	// variable to store user operation 
	static $operation;

	// to initialize the user object 
	static function user($username)
	{
		self::$operation = new quora_views_helper_class($username);  
		return self::$operation;
	}
}


// helper class for operation
class quora_views_helper_class
{
	// store username
	var $username;
	var $viewss_30;
	var $view_total;

	function __construct($username)
	{
		$this->username = $username;

		$data = simplexml_load_file('http://yashverma.tk/quora-api/?user=' . $this->username);
		$this->views_30 = $data->last_30;
		$this->views_total = $data->total;
	}

}

// to display last 30 day views of Jimmy-Wales
echo quora::user('Jimmy-Wales')->views_30;

// to display total views of Jimmy-Wales
echo quora::user('Jimmy-Wales')->views_total;
