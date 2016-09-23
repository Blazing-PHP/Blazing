<?php 

class core
{
	
}

/*************************************************************************** 
| Small error handler
| other data will be linked as xml
****************************************************************************/
class err
{
	static function fatal($code,$message)
	{
		echo "<b>Fatal Error : </b>" . $message;
	}
}


/*************************************************************************** 
| Tiny Controller Class
****************************************************************************/
class controller
{
	static function exist($name)
	{
		if(file_exists("application/modules/controller/".$name.'.controller.php'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	static function extract($controller_method)
	{
		// the return[0] -> is controller
		// the return[1] -> is method
		return explode('@', $controller_method);
	}
}

/*************************************************************************** 
| Views Class
****************************************************************************/
class render
 {
 	static function view($file,$data=NULL)
 	{
 		if(file_exists("application/public/".$file.".php"))
 		{
 			if(is_array($data))
 			{
 				foreach ($data as $name => $value) 
	 			{
	 				$$name = $value;
	 			}
 			}
 			include "application/public/".$file.".php";
 		}
 		else
 		{
 			err::fatal('3','Undefined View Called !');
 		}
 	}
 }

/* ************************ USER FUNCTIONS *******************************/
//  integrated to blazer files


/*************************************************************************** 
| Load models
****************************************************************************/
class model
{
	static function load($i)
	{
		if(file_exists("application/modules/model/".$i.".model.php")  )
		{
			if(!class_exists($i))
			{
				include "application/modules/model/".$i.".model.php";
			}
				
		}
		else
		{
			err::fatal('Model : 1 ','Undefined Model Called !');
		}
	}
}

/*************************************************************************** 
| Native Code
****************************************************************************/
include "application/core/core.routes.php";
