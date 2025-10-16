<?php

require_once 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);

    $sql = "DELETE FROM matches WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Match deleted.'); window.location.href = 'index.php';</script>";
        } else {
            echo "<script>alert('Error deleting match.'); window.location.href = 'index.php';</script>";
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "<script>alert('Could not prepare delete.'); window.location.href = 'index.php';</script>";
    }
    mysqli_close($conn);
} else {
    header('Location: index.php');
    exit;
}
?>