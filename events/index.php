<?php
require_once '../config/auth.php';
requireLogin();
include '../config/database.php';

$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$searchSql = '';
if ($search !== '') {
    $keyword = $conn->real_escape_string($search);
    $searchSql = "WHERE evCode LIKE '%$keyword%' OR evName LIKE '%$keyword%' OR evVenue LIKE '%$keyword%'";
}

$result = $conn->query("SELECT * FROM events $searchSql ORDER BY evDate ASC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Event List</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<?php include '../includes/nav.php'; ?>

<div class="container">

    <h1>Event List</h1>

    <form method="get" class="search-form">
        <input type="text" name="search" placeholder="Search events..." value="<?= htmlspecialchars($search); ?>">
        <button type="submit" class="btn btn-view">Search</button>
        <?php if ($search !== ''): ?>
            <a href="index.php" class="btn btn-delete search-reset">Clear</a>
        <?php endif; ?>
    </form>

    <div class="nav-links">
        <a href="../index.php" class="btn btn-view">Back Home</a>
        <a href="create.php" class="btn btn-add">Add Event</a>
    </div>

    <table>
        <tr>
            <th>Code</th>
            <th>Name</th>
            <th>Date</th>
            <th>Venue</th>
            <th>Fee</th>
            <th>Actions</th>
        </tr>

        <?php if ($result && $result->num_rows > 0) : ?>
            <?php while ($row = $result->fetch_assoc()) : ?>

            <tr>
                <td><?= htmlspecialchars($row['evCode']); ?></td>
                <td><?= htmlspecialchars($row['evName']); ?></td>
                <td><?= htmlspecialchars($row['evDate']); ?></td>
                <td><?= htmlspecialchars($row['evVenue']); ?></td>
                <td><?= htmlspecialchars($row['evFee']); ?></td>
                <td>
                    <a href="view.php?id=<?= urlencode($row['evCode']); ?>" class="btn btn-view">View</a>
                    <a href="edit.php?id=<?= urlencode($row['evCode']); ?>" class="btn btn-edit">Edit</a>
                    <a href="delete.php?id=<?= urlencode($row['evCode']); ?>"
                       class="btn btn-delete"
                       onclick="return confirm('Are you sure you want to delete this event?')">
                       Delete
                    </a>
                </td>
            </tr>

            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" class="no-results">No events match your search.</td>
            </tr>
        <?php endif; ?>

    </table>

</div>

</body>
</html>
