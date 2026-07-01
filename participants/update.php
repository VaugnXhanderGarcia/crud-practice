<?php

include '../config/database.php';

if (
    empty($_POST['partID']) ||
    empty($_POST['partFName']) ||
    empty($_POST['partLName']) ||
    empty($_POST['partCourse']) ||
    !isset($_POST['partYearLevel'])
) {
    die("Required fields are missing.");
}

$partID = intval($_POST['partID']);
$partFName = trim($_POST['partFName']);
$partLName = trim($_POST['partLName']);
$partCourse = trim($_POST['partCourse']);
$partYearLevel = intval($_POST['partYearLevel']);

$sql = "UPDATE participant
        SET partFName = ?, partLName = ?, partCourse = ?, partYearLevel = ?
        WHERE partID = ?";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param(
    "sssii",
    $partFName,
    $partLName,
    $partCourse,
    $partYearLevelYear,
    $partID
);

if ($stmt->execute()) {
    header("Location: index.php");
    exit;
} else {
    echo "Update failed: " . $stmt->error;
}

?>