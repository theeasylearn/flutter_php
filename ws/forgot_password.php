<?php 
    /*
        usage: used to change as user's password
        how to call : http://localhost/flutter_php/ws/forgot_password.php?email=ankit3385@gmail.com
        output :
        [{"error":"input is missing"}] 
        input : email(required) 
    */
    require_once("../inc/connection.php");
    $response = array();
    //input validation 
    if(isset($input['email'])==false)
    {
        array_push($response,array("error"=>"input is missing"));
    }
    else 
    {
        //if all input are given 
        $sql = "select id from users where email='{$input['email']}'";
        $users = mysqli_query($link,$sql) or ReturnError(null,__LINE__);
        $count = mysqli_num_rows($users);
        if($count==0)
        {
            array_push($response,array("success"=>"no"));
            array_push($response,array("message"=>"invalid email address"));
        }
        else 
        {
            $OriginalNewPassword = rand(10,99) . rand(10,99) . rand(10,99);
            $NewHashedPassword = HashPassword($OriginalNewPassword);
            $sql = "update users set password='$NewHashedPassword' where email='{$input['email']}'";
            mysqli_query($link,$sql) or ReturnError(null,__LINE__);
            array_push($response,array("success"=>"yes"));
            array_push($response,array("message"=>"please check email for password"));
            require_once("../inc/function.php");
            $subject = "Password recorvery email";
            $content = "your new password is $OriginalNewPassword";
            SendMail($input['email'],$subject,$content);
        }
        array_unshift($response,array("error"=>"no"));
    }
    echo json_encode($response);
?>