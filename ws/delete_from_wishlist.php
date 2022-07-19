<?php 
    /*
        usage: used to remove product from wishlist.
        how to call : http://localhost/flutter_php/ws/delete_from_wishlist.php?wishlistid=1
        output :
        [{"error":"input is missing"}] 
        [{"error":"no"},{"message":"product removed from wishlist"}]
        input : wishlistid(required) 
    */
    require_once("../inc/connection.php");
    $response = array();
    //input validation 
    if(isset($input['wishlistid'])==false)
    {
        array_push($response,array("error"=>"input is missing"));
    }
    else 
    {
        $sql = "delete from wishlist where id={$input['wishlistid']}";
        mysqli_query($link,$sql) or ReturnError(null,__LINE__);
        array_push($response,array("error"=>"no"));
        array_push($response,array("message"=>"product removed from wishlist"));
    }    
    echo json_encode($response);
?>