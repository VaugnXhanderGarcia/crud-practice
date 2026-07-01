<?php
include '../config/database.php';
$participants = $conn->query("SELECT * FROM participant ORDER BY partFullName");
$events = $conn->query("SELECT * FROM events ORDER BY evName");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Registration</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<?php include '../includes/nav.php'; ?>
<div class="container">
    <h1>Add Registration</h1>
    <form action="store.php" method="POST">
        <label>Participant</label>
        <select name="partID" required>
            <option value="">-- Select Participant --</option>
            <?php while ($p = $participants->fetch_assoc()) : ?>
                <option value="<?= $p['partID']; ?>"><?= htmlspecialchars($p['partFullName']); ?></option>
            <?php endwhile; ?>
        </select>

        <label>Event</label>
        <select name="evCode" required>
            <option value="">-- Select Event --</option>
            <?php while ($e = $events->fetch_assoc()) : ?>
                <option value="<?= htmlspecialchars($e['evCode']); ?>"><?= htmlspecialchars($e['evName']); ?></option>
            <?php endwhile; ?>
        </select>

        <label>Registration Date</label>
        <input type="date" name="regDate" required>

        <label>Payment Mode</label>
        <input type="text" name="regMode" placeholder="Cash / Card / Online" required>

        <button type="submit" class="btn btn-add">Save Registration</button>
    </form>
</div>
</body>
</html>