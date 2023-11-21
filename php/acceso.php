<?php
 $server="localhost"; //:3307 "sí da"
 $username="root";
 $password="";
 $bdname="medicatec_2023";
 $dp=new mysqli($server,$username,$password,$bdname);
 // Establece la codificación de caracteres a UTF-8
$dp->set_charset("utf8");
if ($dp->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>