<?php
// C:\xampp\htdocs\dms\dms-backend\list.php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$conn = new mysqli("localhost", "root", "", "dms");
if ($conn->connect_error) {
    http_response_code(500);
    die(json_encode(["error" => "DB connection failed"]));
}

$result = $conn->query("SELECT id, title, file_name FROM papers ORDER BY id DESC");
$papers = [];

while ($row = $result->fetch_assoc()) {
    $papers[] = $row;
}

echo json_encode($papers);
$conn->close();
