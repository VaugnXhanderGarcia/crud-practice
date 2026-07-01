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

$sql = "INSERT INTO events (evCode, evName, evDate, evVenue, evFee)
        VALUES (?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("sssds", $evCode, $evName, $evDate, $evVenue, $evFee);

if ($stmt->execute()) {
    header("Location: index.php");
    exit;
} else {
    echo "Error: " . $stmt->error;
}

?>
