<?php

include '../config/database.php';

if (
    empty($_POST['partFName']) ||
    empty($_POST['partLName']) ||
    empty($_POST['partCourse']) ||
    !isset($_POST['partYearLevel'])
) {
    die("Required fields are missing.");
}

$stuFName = trim($_POST['partFName']);
$stuLName = trim($_POST['partLName']);
$stuCourse = trim($_POST['partCourse']);
$stuYear = intval($_POST['partYearLevel']);

$sql = "INSERT INTO student (partFName, partLName, partCourse, partYearLevel)
        VALUES (?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("sssi", $partFName, $partLName, $partCourse, $partYearLevel);

if ($stmt->execute()) {
    header("Location: index.php");
    exit;
} else {
    echo "Error: " . $stmt->error;
}

?>