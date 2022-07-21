<?php 
    /*
        usage: used to get move product from cart to wishlist  
        how to call : http://localhost/flutter_php/ws/move_to_wishlist.php?usersid=3&productid=1
        output : 
        1) [{"error":"input is missing"}]
        2) [{"error":"no"},{"message":"product moved to wishlist"}]
        input : usersid,productid (required)
    */
    require_once("../inc/connection.php");
    $response = array();
    //input validation 
    if(isset($input['usersid'],$input['productid'])==false)
    {
        array_push($response,array("error"=>"input is missing"));
    }
    else 
    {
        $sql = "delete from cart where billid=0 and usersid={$input['usersid']} and productid={$input['productid']}";
        mysqli_query($link,$sql) or ReturnError(null,__LINE__);

        $sql = "select id from wishlist where productid={$input['productid']} and usersid={$input['usersid']}";
        $wishlist = mysqli_query($link,$sql) or ReturnError(null,__LINE__);
        $count = mysqli_num_rows($wishlist);
        if($count==0)
        {
            $sql = "insert into wishlist (productid,usersid) values ({$input['productid']},{$input['usersid']})";
            mysqli_query($link,$sql) or ReturnError(null,__LINE__);
        }
        array_push($response,array("error"=>"no"));
        array_push($response,array("message"=>"product moved to wishlist"));
    }
    echo json_encode($response);
?>