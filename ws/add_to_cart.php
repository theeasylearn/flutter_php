<?php 
    /*
        usage: used to add product into cart. if same user has already added product into cart then we will update quantity
        how to call : http://localhost/flutter_php/ws/add_to_cart.php?productid=1&usersid=3
        output :
        [{"error":"input is missing"}] 
        [{"error":"no"},{"message":"cart updated"}]
        input : usersid,productid(required) 
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
        //if all input are given 
        //check if there is row with given productid and usersid or not
        $sql = "select id from cart where productid={$input['productid']} and usersid={$input['usersid']} and billid=0";
        $cart = mysqli_query($link,$sql) or ReturnError(null,__LINE__);
        $count = mysqli_num_rows($cart);
        if($count==0)
        {
            $sql = "insert into cart (productid,usersid) values ({$input['productid']},{$input['usersid']})";
            $message = "product added into cart";
        }
        else 
        {
            $sql = "update cart set quantity=quantity+1 where productid={$input['productid']} and usersid={$input['usersid']} and billid=0";
            $message = "cart updated";
        }
        mysqli_query($link,$sql) or ReturnError(null,__LINE__);
        array_push($response,array("error"=>"no"));
        array_push($response,array("message"=>$message));
    }    
    echo json_encode($response);
?>