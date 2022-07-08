<?php 
    //associative array 
    $course = array("name"=>"Flutter","duration"=>150,"isCertified"=>true);
    print_r($course);
    echo $course['name'];
    //echo $course['email'];
    $course['time'] = "7:30"; //it will add new key value pair 
    print_r($course);

    //empty associative array 
    $country = array();
    $country['name'] = "India";
    $country['code'] = 91;
    $country['population'] = 135;
    $country['pm'] = "modi";
    var_dump($country);
?>  