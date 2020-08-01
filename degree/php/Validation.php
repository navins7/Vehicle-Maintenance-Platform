<?php
    session_start();
    include 'include/Dbh.php';
	include 'include/Signup.php';
    $sign = new Signup();
    $emailid =  $_POST['email'];
    $password = $_POST['password'];
    if(!empty($_POST['name']) && isset($_POST['name']))
	{
	    $username = $_POST['name'];
		$data = $sign->checkRegister($username, $emailid, $password);
		if($data == '1')
		{
			echo "register";
		}
		elseif($data == '0')
		{
			echo "email invalid";
		}
		else
		{
			echo "error";
		}
	}
	else
	{
		$data = $sign->login($emailid, $password);
		if($data == '0')
		{
			echo "invalid";
		}
		else
		{
			$_SESSION['islogged'] = 1;
			$_SESSION['name'] = $data;
			$_SESSION['emailid'] = $emailid;
			echo "success";
		}
	}
?>