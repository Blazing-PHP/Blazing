<?php 

class core
{
	
}

/*************************************************************************** 
| Small error handler
| other data will be linked as xml
****************************************************************************/
class error
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
//  use blazer()

/*************************************************************************** 
| Load models
****************************************************************************/
class model
{
	static function load($i)
	{
		if(file_exists("application/modules/model/".$i.".model.php"))
		{
			include "application/modules/model/".$i.".model.php";
		}
		else
		{
			error::fatal('Model : 1 ','Undefined Model Called !');
		}
	}
}

/*************************************************************************** 
| Native Code
****************************************************************************/
include "application/core/core.routes.php";