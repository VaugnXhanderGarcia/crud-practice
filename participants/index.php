<?php
require_once '../config/auth.php';
requireLogin();
include '../config/database.php';

$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$searchSql = '';
if ($search !== '') {
    $keyword = $conn->real_escape_string($search);
    $searchSql = "WHERE partID LIKE '%$keyword%' OR partFName LIKE '%$keyword%' OR partLName LIKE '%$keyword%' OR partFullName LIKE '%$keyword%' OR partCourse LIKE '%$keyword%' OR partYearLevel LIKE '%$keyword%'";
}

$result = $conn->query("SELECT * FROM participant $searchSql ORDER BY partID ASC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Participant List</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<?php include '../includes/nav.php'; ?>

<div class="container">

    <h1>Participant List</h1>

    <form method="get" class="search-form">
        <input type="text" name="search" placeholder="Search participants..." value="<?= htmlspecialchars($search); ?>">
        <button type="submit" class="btn btn-view">Search</button>
        <?php if ($search !== ''): ?>
            <a href="index.php" class="btn btn-delete search-reset">Clear</a>
        <?php endif; ?>
    </form>

    <div class="nav-links">
        <a href="create.php" class="btn btn-add">Add Participant</a>
        <a href="../index.php" class="btn btn-view">Back Home</a>
    </div>

    <table>
        <tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Course</th>
            <th>Year Level</th>
            <th>Actions</th>
        </tr>

        <?php if ($result && $result->num_rows > 0) : ?>
            <?php while($row = $result->fetch_assoc()) : ?>

            <tr>
                <td><?= $row['partID']; ?></td>
                <td><?= htmlspecialchars($row['partFullName']); ?></td>
                <td><?= htmlspecialchars($row['partCourse']); ?></td>
                <td><?= htmlspecialchars($row['partYearLevel']); ?></td>
                <td>
                    <a href="view.php?id=<?= $row['partID']; ?>" class="btn btn-view">View</a>
                    <a href="edit.php?id=<?= $row['partID']; ?>" class="btn btn-edit">Edit</a>
                    <a href="delete.php?id=<?= $row['partID']; ?>"
                       class="btn btn-delete"
                       onclick="return confirm('Are you sure you want to delete this participant?')">
                       Delete
                    </a>
                </td>
            </tr>

            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="5" class="no-results">No participants match your search.</td>
            </tr>
        <?php endif; ?>

    </table>

</div>

</body>
</html>