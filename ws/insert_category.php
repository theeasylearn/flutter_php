<?php 
    /*
        usage: used to update specific category
        how to call : http://localhost/flutter_php/ws/insert_category.php?title=test&photo=testphoto.jpg&islive=0
        output :
        [{"error":"input is missing"}] 
        [{"error":"no"},{"success":"yes"},{"message":"category inserted"}]
        input : title,photo,islive (required) 

    */
    require_once("../inc/connection.php");
    $response = array();
    //input validation 
    if(isset($input['title'],$input['photo'],$input['islive'])==false)
    {
        array_push($response,array("error"=>"input is missing"));
    }
    else 
    {
        //if all input are given 
        $sql = "insert category (title,photo,islive) values ('{$input['title']}','{$input['photo']}','{$input['islive']}')";
        mysqli_query($link,$sql) or ReturnError(null,__LINE__);
        array_push($response,array("success"=>"yes"));
        array_push($response,array("message"=>"category inserted"));
        array_unshift($response,array("error"=>"no"));
    }
    echo json_encode($response);
?>