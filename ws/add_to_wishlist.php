<?php 
    /*
        usage: used to add product into wishlist. if same user has already added product into wishlist then we will ignore such product 
        how to call : http://localhost/flutter_php/ws/add_to_wishlist.php?productid=1&usersid=3
        output :
        [{"error":"input is missing"}] 
        [{"error":"no"},{"message":"product added into cart"}]
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
        $sql = "select id from wishlist where productid={$input['productid']} and usersid={$input['usersid']}";
        $wishlist = mysqli_query($link,$sql) or ReturnError(null,__LINE__);
        $count = mysqli_num_rows($wishlist);
        if($count==0)
        {
            $sql = "insert into wishlist (productid,usersid) values ({$input['productid']},{$input['usersid']})";
            mysqli_query($link,$sql) or ReturnError(null,__LINE__);
        }
        array_push($response,array("error"=>"no"));
        array_push($response,array("message"=>"product added into wishlist"));
    }    
    echo json_encode($response);
?>