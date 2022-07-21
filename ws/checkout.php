<?php 
    /*
        usage: used to get place order of items added into cart
        how to call : http://localhost/flutter_php/ws/checkout.php?usersid=3&fullname=ankit_patel&address1=eva_surbhi&address2=opp_akshwarwadi_temple&mobile=9662512857&city=bhavnagar&pincode=364001&remarks=gif_pack
        output : 
        1) [{"error":"input is missing"}]
        2)
        input : usersid,fullname,address1,address2,mobile,city,pincode,remarks (required)
    */
    require_once("../inc/connection.php");
    $response = array();
    //input validation 
    if(isset($input['usersid'],$input['fullname'],$input['address1'],$input['address2'],$input['mobile'],$input['city'],$input['pincode'],$input['remarks'])==false)
    {
        array_push($response,array("error"=>"input is missing"));
    }
    else 
    {

        
    }
    echo json_encode($response);
?>