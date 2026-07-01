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
    <title>Edit Event</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<?php include '../includes/nav.php'; ?>

<div class="container">

    <h1>Edit Event</h1>

    <form action="update.php" method="POST">

        <input type="hidden" name="evCode" value="<?= htmlspecialchars($event['evCode']); ?>">

        <input type="text"
               name="evName"
               value="<?= htmlspecialchars($event['evName']); ?>"
               required>

        <input type="date"
               name="evDate"
               value="<?= htmlspecialchars($event['evDate']); ?>"
               required>

        <input type="text"
               name="evVenue"
               value="<?= htmlspecialchars($event['evVenue']); ?>"
               required>

        <input type="number"
               step="0.01"
               name="evFee"
               value="<?= htmlspecialchars($event['evFee']); ?>"
               required>

        <button type="submit" class="btn btn-edit">Update Event</button>

    </form>

</div>

</body>
</html>
