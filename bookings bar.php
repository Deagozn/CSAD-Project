<?php
// Connect to the database (replace with your actual database credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "userform";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT DATE(create_time) AS date, COUNT(*) AS count FROM userbooking GROUP BY DATE(create_time) DESC LIMIT 7";
$result = $conn->query($sql);

$data = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = array(
            "date" => $row["date"],
            "count" => $row["count"]
        );
    }
}

$conn->close();

header("Content-Type: application/json");
echo json_encode($data);
?>
