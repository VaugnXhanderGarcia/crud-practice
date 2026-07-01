<?php

include '../config/database.php';

if (!isset($_GET['id'])) {
    die("Event code is missing.");
}

$evCode = $_GET['id'];

$sql = "SELECT * FROM events WHERE evCode = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $evCode);
$stmt->execute();

$result = $stmt->get_result();
$event = $result->fetch_assoc();

if (!$event) {
    die("Event not found.");
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>View Event</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<div class="container">

    <h1>Event Details</h1>

    <div class="card">
        <p><strong>Code:</strong> <?= htmlspecialchars($event['evCode']); ?></p>
        <p><strong>Name:</strong> <?= htmlspecialchars($event['evName']); ?></p>
        <p><strong>Date:</strong> <?= htmlspecialchars($event['evDate']); ?></p>
        <p><strong>Venue:</strong> <?= htmlspecialchars($event['evVenue']); ?></p>
        <p><strong>Fee:</strong> <?= htmlspecialchars($event['evFee']); ?></p>
    </div>

    <br>

    <a href="index.php" class="btn btn-view">Back</a>

</div>

</body>
</html>
