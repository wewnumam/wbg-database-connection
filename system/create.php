<?php
include('config.php');

$table_name = 'record';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $time = $_POST['time'];
    $score = $_POST['score'];
    $created_at = $_POST['created_at'];

    $sql = "INSERT INTO $table_name (id, username, time, score, created_at) VALUES (NULL, '$username', $time, $score, $created_at)";

    if ($conn->query($sql) === TRUE) {
        echo "Record created successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>