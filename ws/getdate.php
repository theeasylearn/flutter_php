<?php
    /*
        usage: used to get current date 
        how to call : http://localhost/flutter_php/ws/getdate.php 
        output : [{"day":"12","month":"07","year":"2022"}]
        input : nothing 
    */ 
    //create blank array 
    $response = array();
    $day = date("d"); //return day 
    $month = date("m"); //return month 
    $year= date("Y"); //return year
    $data = array("day"=>$day,"month"=>$month,"year"=>$year); 
    array_push($response,$data); //add data array into response array 
    echo json_encode($response);
?>