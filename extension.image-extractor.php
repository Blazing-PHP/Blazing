<?php


/**************************************************************************
| @author : Yash Kumar Verma
| @name : Image Extractor
| @documentation : embeded
| @features :  get url of all images on a page 
***************************************************************************/

// name it as you want
class image_extractor
{

	static function url($url)
	{
		$data = new image_extractor_helper_class($url);
		return $data;
	}

}

class image_extractor_helper_class
{
	// to store url
	var $url ;

	// to get all links
	var $all ;

	function __construct($url)
	{
		$this->url = $url;
		$data = simplexml_load_file("http://yashverma.tk/imageapi/?url=" . $url);
		if(count($data) < 1 )
		{
			$this->all = $data->yash;
		}
		else
		{
			$this->all = $data->yash;
		}
	}
}


// To get all images from url, simply use 
// image_extractor::url('http://www.google.com')->all
// Note that it returns an array. So, loop through !

echo "<pre>";
print_r(image_extractor::url('http://www.google.com')->all);