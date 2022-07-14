<?php 
    /*
        usage: used to change as user's password
        how to call : http://localhost/flutter_php/ws/change_password.php?id=1&password=123123&newpassword=112233
        output :
        [{"error":"input is missing"}] 
        input : id,password,newpassword(required) 
    */
    require_once("../inc/connection.php");
    $response = array();
    //input validation 
    if(isset($input['id'],$input['password'],$input['newpassword'])==false)
    {
        array_push($response,array("error"=>"input is missing"));
    }
    else 
    {
        // //if all input are given 
        // $sql = "select id,password from users where email='{$input['email']}'";
        // $users = mysqli_query($link,$sql) or ReturnError(null,__LINE__);
        // $count = mysqli_num_rows($users);
        // if($count==0)
        // {
        //     array_push($response,array("success"=>"no"));
        //     array_push($response,array("message"=>"invalid login attempt"));
        // }
        // else 
        // {
        //     $row = mysqli_fetch_assoc($users);
        //     if(MatchPassword($row['password'],$input['password'])==false)
        //     {
        //         array_push($response,array("success"=>"no"));
        //         array_push($response,array("message"=>"invalid login attempt"));
        //     }
        //     else 
        //     {
        //         array_push($response,array("success"=>"yes"));
        //         array_push($response,array("message"=>"login successful"));
        //         array_push($response,array("id"=>$row['id']));
        //     }
        // }
        // array_unshift($response,array("error"=>"no"));
    }
    echo json_encode($response);
?>