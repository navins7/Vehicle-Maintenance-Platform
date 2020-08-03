<?php
  class Dbh
  {
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "ea";
	protected $conn;
	protected function Connect()
	{
		$this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
		if($this->conn->connect_errno)
		{
			die('Cannot connect to database' . $conn->connect_error);
		}
		return $this->conn;
	}
	protected function closeConnect()
	{
		$this->conn->close();
	}
  }
?>