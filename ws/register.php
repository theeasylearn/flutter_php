<?php 
    /*
        usage: used to register user 
        how to call : http://localhost/flutter_php/ws/register.php?email=ankit3385@gmail.com&password=123123&mobile=1234567890
        output : 
        input : email,password,mobile(required) 
    */
    require_once("../inc/connection.php");
    $response = array();
    //input validation 
    if(isset($input['email'],$input['password'],$input['mobile'])==false)
    {
        array_push($response,array("error"=>"input is missing"));
    }
    else 
    {
        
    }
    echo json_encode($response);
?>