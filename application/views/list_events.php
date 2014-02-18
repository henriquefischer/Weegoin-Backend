<?php 
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    //foreach ($query as $item){
    $json = json_encode($query);
    echo $json;


