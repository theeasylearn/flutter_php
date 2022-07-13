<?php 
    /*
        usage: used to get all live categories  
        how to call : http://localhost/flutter_php/ws/category.php 
        output : [{"error":"no"},{"total":6},{"id":"1","title":"laptop","photo":"laptop.jpg"},{"id":"2","title":"mobile","photo":"mobile.jpg"},{"id":"3","title":"book","photo":"books.jpg"},{"id":"4","title":"Cookies & waffers","photo":"Cookies.jpg"},{"id":"5","title":"Washing Powders","photo":"washing_powders.jpg"},{"id":"6","title":"shampoo","photo":"shampoo.jpg"}]
        input : nothing 
    */
    require_once("../inc/connection.php");
    $response = array();
    $sql = "select id,title,photo from category where isdeleted=0 and islive=1";
    $category = mysqli_query($link,$sql) or ReturnError(null,__LINE__);
    while($row = mysqli_fetch_assoc($category))
    {
        array_push($response,$row);
    }
    array_unshift($response,array("total"=>mysqli_num_rows($category)));
    array_unshift($response,array("error"=>"no"));
    echo json_encode($response);
?>