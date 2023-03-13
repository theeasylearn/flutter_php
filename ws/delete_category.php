<?php 
    /*
        usage: used to delete specific category.

        how to call : http://localhost/flutter_php/ws/delete_category.php?id=1
        input : cartid(required) 
        output :
        [{"error":"input is missing"}] 
        [{"error":"no"},{"message":"product removed from cart"}]
    */
    require_once("../inc/connection.php");
    $response = array();
    //input validation 
    if(isset($input['id'])==false)
    {
        array_push($response,array("error"=>"input is missing"));
    }
    else 
    {
        $sql = "delete from category where id={$input['id']}";
        $message = "category deleted";
        mysqli_query($link,$sql) or ReturnError(null,__LINE__);
        array_push($response,array("error"=>"no"));
        array_push($response,array("message"=>$message));
    }    
    echo json_encode($response);
?>