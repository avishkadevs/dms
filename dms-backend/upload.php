<?php
// C:\xampp\htdocs\dms\dms-backend\upload.php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

$targetDir = "uploads/";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $conn = new mysqli("localhost", "root", "", "dms");
    if ($conn->connect_error) {
        http_response_code(500);
        die("DB connection failed: " . $conn->connect_error);
    }

    $title = $_POST['title'] ?? '';
    $file = $_FILES['file'] ?? null;

    if (!$title || !$file) {
        http_response_code(400);
        echo "Missing title or file";
        exit;
    }

    $fileName = basename($file["name"]);
    $targetFile = $targetDir . time() . "_" . $fileName;

    if (move_uploaded_file($file["tmp_name"], $targetFile)) {
        $stmt = $conn->prepare("INSERT INTO papers (title, file_name) VALUES (?, ?)");
        $stmt->bind_param("ss", $title, basename($targetFile));
        $stmt->execute();
        $stmt->close();
        $conn->close();
        echo "Upload successful";
    } else {
        http_response_code(500);
        echo "Failed to move uploaded file";
    }
} else {
    http_response_code(405);
    echo "Only POST allowed";
}
