<!DOCTYPE html>
<html>
<head>
    <title>Add Event</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<?php include '../includes/nav.php'; ?>

<div class="container">

    <h1>Add Event</h1>

    <form action="store.php" method="POST">

        <input type="text" name="evCode" placeholder="Event Code" required>

        <input type="text" name="evName" placeholder="Event Name" required>

        <input type="date" name="evDate" required>

        <input type="text" name="evVenue" placeholder="Venue" required>

        <input type="number" step="0.01" name="evFee" placeholder="Fee" required>

        <button type="submit" class="btn btn-add">Save Event</button>

    </form>

</div>

</body>
</html>
