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

$partFName = trim($_POST['partFName']);
$partLName = trim($_POST['partLName']);
$partCourse = trim($_POST['partCourse']);
$partYearLevel = intval($_POST['partYearLevel']);
$partFullName = $partFName . ' ' . $partLName;

$sql = "INSERT INTO participant (partFName, partLName, partFullName, partCourse, partYearLevel)
        VALUES (?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("sssii", $partFName, $partLName, $partFullName, $partCourse, $partYearLevel);

if ($stmt->execute()) {
    header("Location: index.php");
    exit;
} else {
    echo "Error: " . $stmt->error;
}

?>