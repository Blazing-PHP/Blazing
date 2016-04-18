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

	public function all($i)
	{
		$query = "SELECT * FROM " . $i . " WHERE 1";
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

	function all()
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
}


// add as much as db as you want to be called.
class db extends database
{

}