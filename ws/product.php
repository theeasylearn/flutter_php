<?php 
    /*
        usage: used to get all live products  
        how to call : 1) http://localhost/flutter_php/ws/product.php?categoryid=1 
                      1) http://localhost/flutter_php/ws/product.php?productid=1 
        output : 
        1) [{"error":"input is missing"}]
        2) [{"error":"no"},{"total":0}]
        3) [{"error":"no"},{"total":2},{"id":"1","title":"Acer Laptop","price":"50000","photo":"acer.jpg","detail":"WINDOWS 10 4 GB DDR3 RAM 128 gb ssd hard disk"},{"id":"2","title":"dell laptop","price":"65000","photo":"dell.jpg","detail":"WINDOWS 10 8 GB DDR3 RAM 512 gb ssd hard disk"}]
        
        input : categoryid(required) 
        input : productid(required) 
    */
    require_once("../inc/connection.php");
    $response = array();
    //input validation 
    if(isset($input['categoryid'])==false && isset($input['productid'])==false)
    {
        array_push($response,array("error"=>"input is missing"));
    }
    
    else if (isset($input['categoryid'])==true)
    {
        $sql = "select id,title,price,photo,detail from product where isdeleted=0 and islive=1 and categoryid={$input['categoryid']}";
    }
    else if (isset($input['productid'])==true)
    {
        $sql = "select * from product where isdeleted=0 and islive=1 and id={$input['productid']}";
    }
    if(isset($sql)==true)
    {
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