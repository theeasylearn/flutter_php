<?php 
    //how to create array 
    //syntax
    //$array-name = array(['values'])
    $person = array('PHP',7.13,2022,true); //numeric array
    //display 
    print_r($person);
    echo "<br/> $person[0]";
    echo "<br/> $person[1]";
    echo "<br/> $person[2]";
    //echo "<br/> $person[5]";
    $course = array(); //empty array //numeric array
    $course[] = "Flutter";
    $course[] = 12000;
    $course[] = true;

    print_r($course);
?>