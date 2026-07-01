
<?php
require_once 'config/auth.php';
requireLogin();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Management</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<div class="container">
    <div class="dashboard-header">
        <h1>Welcome to the Student Management System</h1>
        <a href="logout.php" class="btn btn-delete">Logout</a>
    </div>
    <p>Select a module to manage:</p>

    <div class="home-grid">
        <div class="home-card">
            <h3>Participants</h3>
            <p>Store and manage participant information.</p>
            <a href="participants/index.php" class="btn btn-view">Manage Participants</a>
        </div>

        <div class="home-card">
            <h3>Events</h3>
            <p>Manage event information and details.</p>
            <a href="events/index.php" class="btn btn-add">Manage Events</a>
        </div>

        <div class="home-card">
            <h3>Registrations</h3>
            <p>Manage registration records and details.</p>
            <a href="registrations/index.php" class="btn btn-edit">Manage Registrations</a>
        </div>
    </div>
</div>

</body>
</html>