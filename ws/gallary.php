<?php 
    /*
        usage: used to get images of product  
        how to call: 1) http://localhost/flutter_php/ws/gallary.php?productid=1 
        output : 
        1) [{"error":"input is missing"}]
        2) [{"error":"no"},{"total":0}]
        3) [{"error":"no"},{"total":2},{"id":"4","photo":"dell1.jpg"},{"id":"5","photo":"dell2.jpg"}]        
        input : productid(required) 
    */
    require_once("../inc/connection.php");
    $response = array();
    //input validation 
    if(isset($input['productid'])==false)
    {
        array_push($response,array("error"=>"input is missing"));
    }
    else 
    {
        $sql = "select id,photo from gallary where productid={$input['productid']}";
        $product = mysqli_query($link,$sql) or ReturnError(null,__LINE__);
        while($row = mysqli_fetch_assoc($product))
        {
            array_push($response,$row);
        }
        array_unshift($response,array("total"=>mysqli_num_rows($product)));
        array_unshift($response,array("error"=>"no"));
    }
    echo json_encode($response);
?>