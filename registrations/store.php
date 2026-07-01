<?php
include '../config/database.php';
if (empty($_POST['partID']) || empty($_POST['evCode']) || empty($_POST['regDate']) || empty($_POST['regMode'])) {
    die("Required fields missing.");
}
$partID = intval($_POST['partID']);
$evCode = trim($_POST['evCode']);
$regDate = $_POST['regDate'];
$regMode = trim($_POST['regMode']);

$sql = "INSERT INTO booking (partID, evCode, regDate, regMode) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
if (!$stmt) die("Prepare failed: " . $conn->error);
$stmt->bind_param("isss", $partID, $evCode, $regDate, $regMode);
if ($stmt->execute()) {
    header("Location: index.php");
    exit;
} else {
    echo "Error: " . $stmt->error;
}
?>