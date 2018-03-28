<?php
$servername = "mysql-zeusi.193b.starter-ca-central-1.openshiftapps.com";
$username = "zeusi";
$password = "zeusi";
$dbname = "zeusi";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT id, title FROM test";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo $row["id"] . " - " . $row["title"] . "<br>";
    }
} else {
    echo "Nessun risultato";
}
$conn->close();
?>