<?php
$serverName = "LAPTOP-O7F4B0NM"; //LAPTOP-O7F4B0NM , DESKTOP-R0ETL6G , PLUEMMER\SQLEXPRESS
$serverName2 = "DESKTOP-R0ETL6G";
$serverName3 = "DESKTOP-2ML5VOK";
$user = "";
$pass = "";


$connectionInfo = array( "Database"=>"Project5", "UID"=>$user, "PWD"=>$pass , "characterSet" => "UTF-8");
$conn = sqlsrv_connect( $serverName, $connectionInfo);


if( $conn ) {
     // echo "GOOD!!"; 
}else{
     echo "BAD!!"; 
     die( print_r( sqlsrv_errors(), true)); //test
     }


?>




