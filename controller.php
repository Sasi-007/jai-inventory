<?php
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'jai';
$conn = new mysqli($host, $username, $password, $dbname);
$data = '';

if ($conn->connect_error) {
    die("Connect Failed" . $conn->connect_error);
}

$type = $_REQUEST["type"];

if ($type == 'add') {
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
    $timestamp = time();
    $sql = "INSERT INTO `paddy`(`type`, `issuer`, `location`, `net_weight`, `empty_weight`, `quantity`, `load_quan`, `amount_bag`, `total_amount`, `vehicle_no`, `date`) VALUES ('$paddyType','$issuer','$location','$loadQuant','$emptyWeight','$netWeight','$perBag','$amountPerBag','$totalAmount','$vehicleNo','$timestamp')";
    if ($conn->query($sql) === TRUE) {
        $data = 1;
        echo json_encode($data);
    } else {
        $data = "Error: " . $sql . "<br>" . $conn->error;
        echo $data;
    }
} else if ($type == 'invoice') {
    $query=$_REQUEST["query"];
    $sql = "SELECT issuer,sum(total_amount) as total_amount,upper(location) as locate FROM paddy where issuer like '%$query%' GROUP BY issuer";
    $result = $conn->query($sql);

    $data = array();
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        echo json_encode($data);
    } else {
        $data = "0 results";
        echo $data;
    }
}
?>