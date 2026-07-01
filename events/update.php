<?php

include '../config/database.php';

if (
    empty($_POST['evCode']) ||
    empty($_POST['evName']) ||
    empty($_POST['evDate']) ||
    empty($_POST['evVenue']) ||
    !isset($_POST['evFee'])
) {
    die("All fields are required.");
}

$evCode = trim($_POST['evCode']);
$evName = trim($_POST['evName']);
$evDate = $_POST['evDate'];
$evVenue = trim($_POST['evVenue']);
$evFee = floatval($_POST['evFee']);

$sql = "UPDATE events
        SET evName = ?, evDate = ?, evVenue = ?, evFee = ?
        WHERE evCode = ?";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("ssds s", $evName, $evDate, $evVenue, $evFee, $evCode);

if ($stmt->execute()) {
    header("Location: index.php");
    exit;
} else {
    echo "Update failed: " . $stmt->error;
}

?>
    