<?php
    class Signup extends Dbh
	{
		private $salt = "#pS0G7*z!v";
		public function checkRegister($username, $emailid, $password)
		{
			$db = $this->Connect();
	            $mquery = $db->prepare("SELECT emailid FROM user WHERE emailid = ?;");
	            $mquery->bind_param("s", $emailid);
	            $mquery->execute();
	            $mquery->store_result();
		        if($mquery->num_rows < 1)
		        {
			        $query = $db->prepare("INSERT INTO user(username, emailid, password) VALUES(?, ?, ?);");	
				    $password_encrypted = sha1(str_repeat($password,2).$this->salt);
	                $query->bind_param("sss", $username, $emailid, $password_encrypted);
	                if($query->execute() == TRUE)
	                {
				        $this->closeConnect();
		                return '1';
	                }
			        else
			        {
				        $this->closeConnect();
				        return "error";
			        }
		        }
		        else
		        {
			        $this->closeConnect();
			        return '0';
		        }
		}
		public function login($emailid, $password)
	    {
		    $db = $this->Connect();
		    $query = $db->prepare("SELECT username,emailid FROM user WHERE emailid = ? AND password = ?;");
		    $password_encrypted = sha1(str_repeat($password,2).$this->salt);
	        $query->bind_param("ss", $emailid, $password_encrypted);
	        $query->execute();
	        $query->store_result();
	        $query->bind_result($username, $emailid);
			$this->closeConnect();
	        if($query->num_rows ==  1)
		    {
			    return $username;
		    }
		    else
		    {
			    return '0';
		    }
	    }
	}
?>