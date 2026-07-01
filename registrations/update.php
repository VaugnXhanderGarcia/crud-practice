<?php
include '../config/database.php';
if (empty($_POST['regCode']) || empty($_POST['partID']) || empty($_POST['evCode']) || empty($_POST['regDate']) || empty($_POST['regMode'])) {
    die("Required fields missing.");
}
$regCode = intval($_POST['regCode']);
$partID = intval($_POST['partID']);
$evCode = trim($_POST['evCode']);
$regDate = $_POST['regDate'];
$regMode = trim($_POST['regMode']);

$sql = "UPDATE booking SET partID = ?, evCode = ?, regDate = ?, regMode = ? WHERE regCode = ?";
$stmt = $conn->prepare($sql);
if (!$stmt) die("Prepare failed: " . $conn->error);
$stmt->bind_param("isssi", $partID, $evCode, $regDate, $regMode, $regCode);
if ($stmt->execute()) {
    header("Location: index.php");
    exit;
} else {
    echo "Update failed: " . $stmt->error;
}
?>