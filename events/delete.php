<?php

include '../config/database.php';

if (!isset($_GET['id'])) {
    die("Event code missing.");
}

$evCode = $_GET['id'];

$sql = "DELETE FROM events WHERE evCode = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $evCode);

if ($stmt->execute()) {
    header("Location: index.php");
    exit;
} else {
    echo "Delete failed: " . $stmt->error;
}

?>
