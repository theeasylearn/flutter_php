<?php 
    /*
        usage: used to remove product from cart.

        how to call : http://localhost/flutter_php/ws/delete_from_cart.php?cartid=1
        output :
        [{"error":"input is missing"}] 
        [{"error":"no"},{"message":"product removed from cart"}]
        input : cartid(required) 
    */
    require_once("../inc/connection.php");
    $response = array();
    //input validation 
    if(isset($input['cartid'])==false)
    {
        array_push($response,array("error"=>"input is missing"));
    }
    else 
    {
        $sql = "delete from cart where id={$input['cartid']}";
        $message = "product added into cart";
        mysqli_query($link,$sql) or ReturnError(null,__LINE__);
        array_push($response,array("error"=>"no"));
        array_push($response,array("message"=>"product removed from cart"));
    }    
    echo json_encode($response);
?>