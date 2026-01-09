<?php
header('Content-Type: application/json');

// Database Credentials
$host = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "atom_negoce_db";

// 1. Try Connection
$conn = new mysqli($host, $username, $password, $dbname);

// 2. Check for Connection Error
if ($conn->connect_error) {
    echo json_encode(["status" => "error", "message" => "DB Connection Failed: " . $conn->connect_error]);
    exit;
}

// 3. Process Form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = $_POST['name']    ?? 'N/A';
    $email   = $_POST['email']   ?? 'N/A';
    $project = $_POST['project'] ?? 'N/A';
    $message = $_POST['message'] ?? 'N/A';

    $sql = "INSERT INTO website_inquiries (full_name, email, project_type, message) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    if($stmt) {
        $stmt->bind_param("ssss", $name, $email, $project, $message);
        if ($stmt->execute()) {
            echo json_encode(["status" => "success"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Insert Failed: " . $stmt->error]);
        }
        $stmt->close();
    } else {
        echo json_encode(["status" => "error", "message" => "SQL Prepare Failed: " . $conn->error]);
    }
}
$conn->close();
?>