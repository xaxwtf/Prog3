<?php

    session_start();
    if (!isset($_SESSION['count'])) {
      $_SESSION['count'] = 0;
    } else {
      $_SESSION['count']++;
    }

    
    if( $_SERVER['REQUEST_METHOD'] == 'GET' ){
        echo "\nsoy get\n";
        echo $_SESSION['count'];
        include 'HeladoConsultar.php';
        http_response_code(200);
    }
    else if($_SERVER['REQUEST_METHOD'] =='POST'){
        echo " soy post";
        include 'HeladeriaAlta.php';
        http_response_code(200);   
        
    }
    else{
        http_response_code(405);
    }
    