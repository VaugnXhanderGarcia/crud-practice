<?php
require_once '../config/auth.php';
requireLogin();
include '../config/database.php';

$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$searchSql = '';
if ($search !== '') {
    $keyword = $conn->real_escape_string($search);
    $searchSql = "WHERE r.regCode LIKE '%$keyword%' OR p.partFullName LIKE '%$keyword%' OR e.evName LIKE '%$keyword%' OR r.regMode LIKE '%$keyword%'";
}

$sql = "SELECT r.*, p.partFullName, e.evName
        FROM booking r
        JOIN participant p ON r.partID = p.partID
        JOIN events e ON r.evCode = e.evCode
        $searchSql
        ORDER BY r.regCode ASC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Registrations</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<?php include '../includes/nav.php'; ?>
<div class="container">
    <h1>Registrations</h1>
    <form method="get" class="search-form">
        <input type="text" name="search" placeholder="Search registrations..." value="<?= htmlspecialchars($search); ?>">
        <button type="submit" class="btn btn-view">Search</button>
        <?php if ($search !== ''): ?>
            <a href="index.php" class="btn btn-delete search-reset">Clear</a>
        <?php endif; ?>
    </form>
    <div class="nav-links">
        <a href="../index.php" class="btn btn-view">Back Home</a>
        <a href="create.php" class="btn btn-add">Add Registration</a>
    </div>
    <table>
        <tr>
            <th>ID</th><th>Participant</th><th>Event</th><th>Registration Date</th><th>Mode</th><th>Actions</th>
        </tr>
        <?php if ($result && $result->num_rows > 0) : ?>
            <?php while ($row = $result->fetch_assoc()) : ?>
            <tr>
                <td><?= $row['regCode']; ?></td>
                <td><?= htmlspecialchars($row['partFullName']); ?></td>
                <td><?= htmlspecialchars($row['evName']); ?></td>
                <td><?= htmlspecialchars($row['regDate']); ?></td>
                <td><?= htmlspecialchars($row['regMode']); ?></td>
                <td>
                    <a href="view.php?id=<?= $row['regCode']; ?>" class="btn btn-view">View</a>
                    <a href="edit.php?id=<?= $row['regCode']; ?>" class="btn btn-edit">Edit</a>
                    <a href="delete.php?id=<?= $row['regCode']; ?>" class="btn btn-delete" onclick="return confirm('Delete this registration?')">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" class="no-results">No registrations match your search.</td>
            </tr>
        <?php endif; ?>
    </table>
</div>
</body>
</html>