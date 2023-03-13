<?php 
    /*
        usage: used to update specific category
        how to call : http://localhost/flutter_php/ws/update_category.php?id=8&title=soap&photo=mynewphoto.jpg&islive=0
        output :
        [{"error":"input is missing"}] 
        [{"error":"no"},{"success":"yes"},{"message":"category updated"}]
        input : id,title,photo,islive (required) 
    */
    require_once("../inc/connection.php");
    $response = array();
    //input validation 
    if(isset($input['id'],$input['title'],$input['photo'],$input['islive'])==false)
    {
        array_push($response,array("error"=>"input is missing"));
    }
    else 
    {
        //if all input are given 
        $sql = "update category set title='{$input['title']}',photo='{$input['photo']}',islive='{$input['islive']}' where id={$input['id']}";
        mysqli_query($link,$sql) or ReturnError(null,__LINE__);
        array_push($response,array("success"=>"yes"));
        array_push($response,array("message"=>"category updated"));
        array_unshift($response,array("error"=>"no"));
    }
    echo json_encode($response);
?>