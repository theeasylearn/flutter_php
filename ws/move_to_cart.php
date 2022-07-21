<?php 
    /*
        usage: used to get move product from wishlist to card
        how to call : http://localhost/flutter_php/ws/move_to_cart.php?usersid=3&productid=1
        output : 
        1) [{"error":"input is missing"}]
        2) [{"error":"no"},{"message":"product moved to cart"}]
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

        $sql = "delete from wishlist where usersid={$input['usersid']} and productid={$input['productid']}";
        mysqli_query($link,$sql) or ReturnError(null,__LINE__);

        $sql = "select id from cart where billid=0 and productid={$input['productid']} and usersid={$input['usersid']}";
        $cart = mysqli_query($link,$sql) or ReturnError(null,__LINE__);
        $count = mysqli_num_rows($cart);
        if($count==0)
        {
            $sql = "insert into cart (productid,usersid) values ({$input['productid']},{$input['usersid']})";
            mysqli_query($link,$sql) or ReturnError(null,__LINE__);
        }
        array_push($response,array("error"=>"no"));
        array_push($response,array("message"=>"product moved to cart"));
    }
    echo json_encode($response);
?>