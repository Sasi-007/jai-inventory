<?php
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'jai';
$conn = new mysqli($host, $username, $password, $dbname);
$data='';

if ($conn->connect_error) {
    die("Connect Failed" . $conn->connect_error);
}

$type = $_REQUEST["type"];
$paddyType = $_REQUEST["paddyType"];
$issuer = $_REQUEST["issuer"];
$location = $_REQUEST["location"];
$loadQuant = $_REQUEST["loadQuant"];
$emptyWeight = $_REQUEST["emptyWeight"];
$netWeight = $_REQUEST["netWeight"];
$perBag = $_REQUEST["perBag"];
$amountPerBag = $_REQUEST["amountPerBag"];
$totalAmount = $_REQUEST["totalAmount"];
$vehicleNo = $_REQUEST["vehicleNo"];

if ($type == 'add') {
    $timestamp = time();
    $sql = "INSERT INTO `paddy`(`type`, `issuer`, `location`, `net_weight`, `empty_weight`, `quantity`, `load_quan`, `amount_bag`, `total_amount`, `vehicle_no`, `date`) VALUES ('$paddyType','$issuer','$location','$loadQuant','$emptyWeight','$netWeight','$perBag','$amountPerBag','$totalAmount','$vehicleNo','$timestamp')";
    if ($conn->query($sql) === TRUE) {
        $data=1;
        return $data;
    } else {
        $data="Error: " . $sql . "<br>" . $conn->error;
        return $data;
    }
}
return $data;
?>