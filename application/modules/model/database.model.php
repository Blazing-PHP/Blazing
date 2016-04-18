<?php

class database
{
	var $name;
	var $host;
	var $user;
	var $pass;
	var $connection;
	var $status;
	var $table;
	var $table_name;

	function __construct()
	{
		// declaring database credentils
		$this->name = $GLOBALS['protected']['database']['name'];
		$this->host = $GLOBALS['protected']['database']['host'];
		$this->user = $GLOBALS['protected']['database']['user'];
		$this->pass = $GLOBALS['protected']['database']['pass'];

		// attempt to connect
		$this->connection = new mysqli($this->host, $this->user, $this->pass, $this->name);

		// check if connection successful, else store error in $this->status
			if($this->connection->connect_error)
			{
				$this->status = $this->connection->connect_error;
			}
	}

	public function operation($query)
	{
		if($this->connection->query($query) === TRUE)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	public function select($query)
	{
		$result = $this->connection->query($query);
		if($result->num_rows > 0)
		{
			$output = array();
			while($row = $result->fetch_assoc())
			{
				array_push($output, $row);
			}
			return $output;
		}
	}

	public function table($table_name)
	{
		$this->table = new table($table_name,$this->connection);
		return $this->table;
	}
}

class table
{
	var $table_connection;
	var $table_name;

	function __construct($name,$connection)
	{
		$this->table_name = $name;
		$this->table_connection = $connection;
	}

	// to show all contents
	public	function all()
	{
		$result = $this->table_connection->query("SELECT * FROM " . $this->table_name . " WHERE 1 ;");
		if($result->num_rows > 0)
		{
			while($row = $result->fetch_assoc())
			{
				print_r($row);
			}
		}
	}

	// to insert data
	public function insert($data)
	{
		// query building starts
		$query = "INSERT INTO " . $this->table_name;
		$query .= ' ( ';
		foreach ($data as $index => $value)
		{
			$query .= '`' . $index . '`' ;
		}
		$query .= ' )';
		$query = str_replace('``', '`,`', $query);
		$query .= " VALUES( ";
		foreach ($data as $value)
		{
			$query .= " '{$value}' ,"; 
		}
		if(strpos(strrev($query),',') == 0 ) 
			{ 
			 $query = substr(strrev($query), 1); 
			 $query = strrev($query);
			}
		$query .= ' ); ';
		// query building ends 
		
		if($this->table_connection->query($query) == TRUE)
		{
			return TRUE;
		}
		else
		{
			return $this->table_connection->error;
		}
	}
}


// add as much as db as you want to be called.
class db extends database
{

}