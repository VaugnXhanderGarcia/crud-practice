<?php

include '../config/database.php';

if (!isset($_GET['id'])) {
    die("Participant ID is missing.");
}

$id = $_GET['id'];

$sql = "SELECT * FROM participant WHERE partID = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
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
    <title>Edit Participant</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<?php include '../includes/nav.php'; ?>

<div class="container">

    <h1>Edit Participant</h1>

    <form action="update.php" method="POST">

        <input type="hidden" name="partID" value="<?= $participant['partID']; ?>">

        <input type="text"
               name="partFName"
               value="<?= htmlspecialchars($participant['partFName']); ?>"
               required>

        <input type="text"
               name="partLName"
               value="<?= htmlspecialchars($participant['partLName']); ?>"
               required>

        <input type="text"
               name="partCourse"
               value="<?= htmlspecialchars($participant['partCourse']); ?>"
               required>

        <input type="number"
               name="partYearLevel"
               value="<?= htmlspecialchars($participant['partYearLevel']); ?>"
               required>

        <button type="submit" class="btn btn-edit">Update Participant</button>

    </form>

</div>

</body>
</html>