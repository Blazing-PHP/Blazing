<?php

/**************************************************************************
| @author : Yash Kumar Verma
| @name : form
| @documentation : embeded 
***************************************************************************/

// simple function. Shall be ignored. Used inside class form
function form_show($data)
	{
		echo $data;
	}

// the main form class.
class form
{
	// open a form with form::open('paremeters')
	//  see bottom for usage
	static function open($data)
	{
		echo "<form action='";
		isset($data['method']) ? form_show($data['method']) : form_show('post') ;
		echo "'";
		if(isset($data['class'])) { echo " class='".$data['class']."' "; }
		if(isset($data['id'])) { echo "id='".$data['id']."' "; }
		if(isset($data['attributes'])) { echo $data['attributes']; }
		echo " > \n";
	}

	// setting a new input
	static function input($data)
	{
		echo "<input ";
		foreach ($data as $index => $value) {
			echo ' '.$index . '="' . $value . '" ';
		}
		echo " />";
	}

	// close a form with form::close()
	static function close()
	{
		echo "</form>";
	}
}

form::open(['method'=> 'post' , 'class'=>'form-group' , 'id'=>'main-form', 'attributes'=>'some-other-attribute' ]);
form::input(['type'=>'text' , 'class'=> 'form-control' , 'onclick'=> 'ops()' ]);
form::close();

// OPENING FORM
/*
* form::open(['method'=> 'post' , 'class'=>'form-group' , 'id'=>'main-form', 'attributes'=>'some-other-attribute' ]);
* the above statement renders this
* <form action='post' class='form-group' id='main-form'some-other-attribute >
*/


// INPUT FIELD
/*
* form::input(['type'=>'text','class'=> 'form-control' , 'onclick'=> 'ops()' ]);
* the above code renders it
* <input  type="text"  class="form-control"  onclick="ops()"  />
*/


// CLOSING FORM
/*
* form::close();
* the above statement renders this
* </form>
*/