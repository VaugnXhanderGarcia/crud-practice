<!DOCTYPE html>
<html>
<head>
    <title>Add Participant</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<?php include '../includes/nav.php'; ?>

<div class="container">

    <h1>Add Participant</h1>

    <form action="store.php" method="POST">

        <input type="text" name="partFName" placeholder="Participant First Name" required>

        <input type="text" name="partLName" placeholder="Participant Last Name" required>

        <input type="text" name="partCourse" placeholder="Course" required>

        <input type="number" name="partYearLevel" placeholder="Year Level" required>

        <button type="submit" class="btn btn-add">Save Participant</button>

    </form>

</div>

</body>
</html>