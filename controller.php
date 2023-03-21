<?php
$host='localhost';
$username='root';
$password='';
$dbname='jai';
$conn = new mysqli($host,$username,$password,$dbname);

if($conn->connect_error) {
    die("Connect Failed".$conn->connect_error);
}



?>