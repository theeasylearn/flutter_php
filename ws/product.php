<?php 
    /*
        usage: used to get all live products  
        how to call : http://localhost/flutter_php/ws/product.php?categoryid=1 
        output : 
        1) [{"error":"input is missing"}]
        2) [{"error":"no"},{"total":0}]
        3) [{"error":"no"},{"total":2},{"id":"1","title":"Acer Laptop","price":"100","stock":"100","weight":"3000","size":"15 inch","photo":"acer.jpg","detail":"WINDOWS 10 4 GB DDR3 RAM 128 gb ssd hard disk"},{"id":"2","title":"dell laptop","price":"200","stock":"100","weight":"3500","size":"15 inch","photo":"dell.jpg","detail":"WINDOWS 10 8 GB DDR3 RAM 512 gb ssd hard disk"}]
        
        input : categoryid(required) 
    */
    require_once("../inc/connection.php");
    $response = array();
    //input validation 
    if(isset($input['categoryid'])==false)
    {
        array_push($response,array("error"=>"input is missing"));
    }
    else 
    {
        $sql = "select id,title,price,stock,weight,size,photo,detail from product where isdeleted=0 and islive=1 and categoryid={$input['categoryid']}";
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