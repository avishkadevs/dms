<?php
// delete.php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

$conn = new mysqli("localhost", "root", "", "dms");
if ($conn->connect_error) {
    http_response_code(500);
    die("Database connection failed");
}

$data = json_decode(file_get_contents("php://input"), true);
$id = $data['id'] ?? null;

if (!$id) {
    http_response_code(400);
    echo "Missing ID";
    exit;
}

// Get file name
$res = $conn->query("SELECT file_name FROM papers WHERE id = $id");
if ($res && $row = $res->fetch_assoc()) {
    $filePath = "uploads/" . $row['file_name'];
    if (file_exists($filePath)) {
        unlink($filePath); // delete file
    }
}

$conn->query("DELETE FROM papers WHERE id = $id");
$conn->close();
echo "Deleted successfully";
