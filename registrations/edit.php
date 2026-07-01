<?php
include '../config/database.php';
if (!isset($_GET['id'])) die("Registration ID missing.");
$id = intval($_GET['id']);
$stmt = $conn->prepare("SELECT * FROM booking WHERE regCode = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$res = $stmt->get_result();
$reg = $res->fetch_assoc();
if (!$reg) die("Registration not found.");
$participants = $conn->query("SELECT * FROM participant ORDER BY partFullName");
$events = $conn->query("SELECT * FROM events ORDER BY evName");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Registration</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<?php include '../includes/nav.php'; ?>
<div class="container">
    <h1>Edit Registration</h1>
    <form action="update.php" method="POST">
        <input type="hidden" name="regCode" value="<?= $reg['regCode']; ?>">

        <label>Participant</label>
        <select name="partID" required>
            <option value="">-- Select Participant --</option>
            <?php while ($p = $participants->fetch_assoc()) : ?>
                <option value="<?= $p['partID']; ?>" <?= $p['partID'] == $reg['partID'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($p['partFullName']); ?>
                </option>
            <?php endwhile; ?>
        </select>

        <label>Event</label>
        <select name="evCode" required>
            <option value="">-- Select Event --</option>
            <?php while ($e = $events->fetch_assoc()) : ?>
                <option value="<?= htmlspecialchars($e['evCode']); ?>" <?= $e['evCode'] == $reg['evCode'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($e['evName']); ?>
                </option>
            <?php endwhile; ?>
        </select>

        <label>Registration Date</label>
        <input type="date" name="regDate" value="<?= htmlspecialchars($reg['regDate']); ?>" required>

        <label>Payment Mode</label>
        <input type="text" name="regMode" value="<?= htmlspecialchars($reg['regMode']); ?>" required>

        <button type="submit" class="btn btn-edit">Update Registration</button>
    </form>
</div>
</body>
</html>