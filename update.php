<?php
<?php
require_once 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $team_a = isset($_POST['team-a']) ? $_POST['team-a'] : '';
    $team_a_score = isset($_POST['team-a-scores']) ? $_POST['team-a-scores'] : '';
    $team_b = isset($_POST['team-b']) ? $_POST['team-b'] : '';
    $team_b_score = isset($_POST['team-b-scores']) ? $_POST['team-b-scores'] : '';

    $sql = "UPDATE matches SET team_a = ?, team_a_score = ?, team_b = ?, team_b_score = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssssi", $team_a, $team_a_score, $team_b, $team_b_score, $id);
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Match updated.'); window.location.href = 'index.php';</script>";
        } else {
            echo "<script>alert('Error updating match.'); window.location.href = 'index.php';</script>";
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "<script>alert('Could not prepare update.'); window.location.href = 'index.php';</script>";
    }
    mysqli_close($conn);
} else {
    header('Location: index.php');
    exit;
}
?>