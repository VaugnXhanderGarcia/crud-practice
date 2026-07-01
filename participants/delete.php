<?php

include '../config/database.php';


if (isset($_GET['partID'])) {
    $partID = intval($_GET['partID']);
} elseif (isset($_GET['id'])) {
    $partID   = intval($_GET['id']);
} else {
    die("Participant ID missing.");
}

$sql = "DELETE FROM participant WHERE partID = ?";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("i", $partID);

if ($stmt->execute()) {
    header("Location: index.php");
    exit;
} else {
    echo "Delete failed: " . $stmt->error;
}

?>