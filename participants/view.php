<?php

include '../config/database.php';

// Accept 'id' parameter for consistency with other modules
if (!isset($_GET['id'])) {
    die("Participant ID is missing.");
}

$partID = intval($_GET['id']);

$sql = "SELECT * FROM participant WHERE partID = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param("i", $partID);

$stmt->execute();

$result = $stmt->get_result();

$participant = $result->fetch_assoc();

if (!$participant) {
    die("Participant not found.");
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>View Participant</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<div class="container">

    <h1>Participant Details</h1>

    <div class="card">
        <p><strong>ID:</strong> <?= $participant['partID']; ?></p>
        <p><strong>Full Name:</strong> <?= htmlspecialchars($participant['partFullName']); ?></p>
        <p><strong>Course:</strong> <?= htmlspecialchars($participant['partCourse']); ?></p>
        <p><strong>Year Level:</strong> <?= htmlspecialchars($participant['partYearLevel']); ?></p> 
    </div>

    <br>

    <a href="index.php" class="btn btn-view">Back</a>

</div>

</body>
</html>