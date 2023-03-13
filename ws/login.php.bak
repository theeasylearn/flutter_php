<?php 
    /*
        usage: used to login as user 
        how to call : http://localhost/flutter_php/ws/login.php?email=ankit3385@gmail.com&password=123123
        output :
        [{"error":"input is missing"}] 
        [{"error":"no"},{"success":"no"},{"message":"invalid login attempt"}]
        [{"error":"no"},{"success":"yes"},{"message":"login successful"},{"id":"3"}]
        input : email,password(required) 
    */
    require_once("../inc/connection.php");
    $response = array();
    //input validation 
    if(isset($input['email'],$input['password'])==false)
    {
        array_push($response,array("error"=>"input is missing"));
    }
    else 
    {
        //if all input are given 
        $sql = "select id,password from users where email='{$input['email']}'";
        $users = mysqli_query($link,$sql) or ReturnError(null,__LINE__);
        $count = mysqli_num_rows($users);
        if($count==0)
        {
            array_push($response,array("success"=>"no"));
            array_push($response,array("message"=>"invalid login attempt"));
        }
        else 
        {
            $row = mysqli_fetch_assoc($users);
            if(MatchPassword($row['password'],$input['password'])==false)
            {
                array_push($response,array("success"=>"no"));
                array_push($response,array("message"=>"invalid login attempt"));
            }
            else 
            {
                array_push($response,array("success"=>"yes"));
                array_push($response,array("message"=>"login successful"));
                array_push($response,array("id"=>$row['id']));
            }
        }
        array_unshift($response,array("error"=>"no"));
    }
    echo json_encode($response);
?>