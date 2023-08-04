<?php
// api.php

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'chatbot');

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if (mysqli_connect_errno()) {
    echo json_encode(array("error" => "Failed to connect to MySQL: " . mysqli_connect_error()));
    die();
}

header('Content-Type: application/json'); // Set the Content-Type header to indicate JSON response

if (isset($_GET['userInput'])) {
    $userInput = filter_input(INPUT_GET, 'userInput', FILTER_SANITIZE_STRING);

    if ($userInput !== null) {
        $userInput = trim($userInput);
        $userInput = preg_replace("/[^\w\s]/", "", $userInput);

        $stmt = $conn->prepare("SELECT response FROM responses WHERE TRIM(prompt) = ?");
        $stmt->bind_param("s", $userInput);
        $stmt->execute();

        $stmt->bind_result($response);
        $stmt->fetch();

        if ($response) {
            echo json_encode(array("response" => $response));
        } else {
            echo json_encode(array("response" => null));
        }

        $stmt->close();
    } else {
        echo json_encode(array("error" => "Invalid request"));
    }
} else {
    echo json_encode(array("error" => "Database query error: " . $stmt->error));
}

$conn->close();
?>
