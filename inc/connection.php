<?php 
	$FileName = basename($_SERVER['SCRIPT_NAME']);
	error_reporting(E_ERROR); //only display error 
	date_default_timezone_set("asia/kolkata"); //for india 
	//error_reporting(0);
	$response = array();
	
	//constant in php (variable whose value can not be changed)
	define("SERVER","localhost:3308");
	define("USERNAME","root");
	define("PASSWORD","");
	define("DEBUG",true);  //it will display error detail in JSON ARRAY format
	define("DATABASE","flutter");
	define("METHOD","GET"); //METHOD can be get or post 
	if(METHOD=="GET")
		$input = $_REQUEST;
	else 
		$input = $_POST;
	$link = mysqli_connect(SERVER,USERNAME,PASSWORD) or (ReturnError("invalid username/password/servername"));
	mysqli_select_db($link,DATABASE) or (ReturnError());
	function ReturnError($msg=null,$line=0) //default argument
	{
		$CurrentDateTime = date("D d-m-Y h:i:s A");
		if(DEBUG==false) //application is live and we dont want to show error to the user 
			echo json_encode(array(array("error"=>"oops something went wrong")));
		else 
		{
			if($msg==null)
				array_push($GLOBALS['response'],array("error"=>mysqli_error($GLOBALS['link']) . " in " . $GLOBALS['sql'] . " at line no " .  $line));
			else 
				array_push($GLOBALS['response'],array("error"=>$msg));
			echo json_encode($GLOBALS['response']);
		} 
		
		$sql2 = "insert into error (filename,error,query,datetime,line) values ('{$GLOBALS['FileName']}','" . mysqli_real_escape_string($GLOBALS['link'],mysqli_error($GLOBALS['link'])) . "','" . mysqli_real_escape_string($GLOBALS['link'],$GLOBALS['sql']) ."','$CurrentDateTime',$line)";
        //echo $sql2;
		mysqli_query($GLOBALS['link'],$sql2);
		exit; //stop php script immediately
	}
	function HashPassword($OriginalPassword)
	{
		$options = ['cost' => 12];
		return password_hash($OriginalPassword,PASSWORD_DEFAULT, $options);
	}
	function MatchPassword($ExistingPassword /* already hashed password */,$OriginalPassword)
	{
		 return password_verify ($OriginalPassword,$ExistingPassword);
	}
?>