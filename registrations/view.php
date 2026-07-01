<?php
include '../config/database.php';
if (!isset($_GET['id'])) die("Registration ID missing.");
$id = intval($_GET['id']);
$sql = "SELECT r.*, p.partFullName, e.evName
        FROM booking r
        JOIN participant p ON r.partID = p.partID
        JOIN events e ON r.evCode = e.evCode
        WHERE r.regCode = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$res = $stmt->get_result();
$r = $res->fetch_assoc();
if (!$r) die("Registration not found.");
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Registration</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<?php include '../includes/nav.php'; ?>
<div class="container">
    <h1>Registration Details</h1>
    <div class="card">
        <p><strong>ID:</strong> <?= $r['regCode']; ?></p>
        <p><strong>Participant:</strong> <?= htmlspecialchars($r['partFullName']); ?></p>
        <p><strong>Event:</strong> <?= htmlspecialchars($r['evName']); ?></p>
        <p><strong>Registration Date:</strong> <?= htmlspecialchars($r['regDate']); ?></p>
        <p><strong>Mode:</strong> <?= htmlspecialchars($r['regMode']); ?></p>
    </div>
    <br>
    <a href="index.php" class="btn btn-view">Back</a>
</div>
</body>
</html>