<?php 
    header('Access-Control-Allow-Origin: *');
    //foreach ($query as $item){
    $json = json_encode($query);
    echo $json;


