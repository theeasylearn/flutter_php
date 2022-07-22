<?php 
    /*
        usage: used to get place order of items added into cart
        how to call : http://localhost/flutter_php/ws/checkout.php?usersid=3&fullname=ankit_patel&address1=eva_surbhi&address2=opp_akshwarwadi_temple&mobile=9662512857&city=bhavnagar&pincode=364001&remarks=gif_pack
        output : 
        1) [{"error":"input is missing"}]
        2) [{"error":"no"},{"success":"no"},{"message":"cart is empty"}]
        3) [{"error":"no"},{"success":"no"},{"message":"following items are out of stock \ndell laptop"}]
        4) [{"error":"no"},{"success":"yes"},{"message":"order placed successfully with orderid 4"}]
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
        // fetch product detail and cart detail from database
        $sql = "select p.id 'productid',title,p.price,stock,c.id 'cartid',quantity from product p,cart c where p.id=productid and billid=0 and usersid={$input['usersid']}";
        $productcart = mysqli_query($link,$sql) or ReturnError(null,__LINE__);
        $ordercount = mysqli_num_rows($productcart);
        if($ordercount==0)
        {
            array_push($response,array("error"=>"no"));
            array_push($response,array("success"=>"no"));
            array_push($response,array("message"=>"cart is empty"));
        }
        else 
        {
            $data = array(); //empty array 
            while($row = mysqli_fetch_assoc($productcart))
            {
                array_push($data,$row);
            }
            //check if all the items added into cart is in stock or not 
            $index=0;
            $outofstock = array(); //empty
            while($index<$ordercount)
            {
                if($data[$index]['quantity']>$data[$index]['stock'])
                {
                    $outofstock[] = $data[$index]['title'];
                }
                $index++;
            }
            if(sizeof($outofstock)>=1)
            {
                array_push($response,array("error"=>"no"));
                array_push($response,array("success"=>"no"));
                array_push($response,array("message"=>"following items are out of stock \n" . implode(" ",$outofstock)));
            }
            else 
            {
                //reduce stock of the product added into cart & also make total
                $index=0;
                $GrandTotal=0;
                while($index<$ordercount)
                {
                    $sql = "update product set stock=stock-{$data[$index]['quantity']} where id={$data[$index]['productid']}";
                    mysqli_query($link,$sql) or ReturnError(null,__LINE__);
                    $GrandTotal += $data[$index]['quantity'] * $data[$index]['price'];
                    $index++;
                }
                //insert new row into bill table 
                extract($input);
                $billdate = date("Y-m-d");
                $sql = "INSERT INTO bill(usersid, billdate, fullname, address1, address2, mobile, city, pincode, amount, remarks) VALUES ($usersid,'$billdate','$fullname','$address1','$address2','$mobile','$city','$pincode',$GrandTotal,'$remarks')";
                mysqli_query($link,$sql) or ReturnError(null,__LINE__);
                $billid = mysqli_insert_id($link);
                $index=0;
                while($index<$ordercount)
                {
                    $sql = "update cart set billid=$billid,price={$data[$index]['price']} where id={$data[$index]['cartid']}";
                    mysqli_query($link,$sql) or ReturnError(null,__LINE__);
                    $index++;
                }
                array_push($response,array("error"=>"no"));
                array_push($response,array("success"=>"yes"));
                array_push($response,array("message"=>"order placed successfully with orderid $billid"));
            }
        }
    }
    echo json_encode($response);
?>