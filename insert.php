
<?php
require_once 'database.php';  // Include the database connection

if(isset($_POST["submit"])) {
    // Get and sanitize form data
    $team_a = mysqli_real_escape_string($conn, $_POST["team-a"]);
    $team_a_score = mysqli_real_escape_string($conn, $_POST["team-a-scores"]);
    $team_b = mysqli_real_escape_string($conn, $_POST["team-b"]);
    $team_b_score = mysqli_real_escape_string($conn, $_POST["team-b-scores"]);

    // Prepare SQL statement
    $sql = "INSERT INTO matches (team_a, team_a_score, team_b, team_b_score) 
            VALUES (?, ?, ?, ?)";
    
    // Create prepared statement
    $stmt = mysqli_prepare($conn, $sql);
    
    if ($stmt) {
        // Bind parameters
        mysqli_stmt_bind_param($stmt, "ssss", $team_a, $team_a_score, $team_b, $team_b_score);
        
        // Execute statement
        if(mysqli_stmt_execute($stmt)) {
            echo "<script>
                    alert('Match result added successfully!');
                    window.location.href = 'index.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Error: Could not insert data.');
                    window.location.href = 'index.php';
                  </script>";
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
    } else {
        echo "<script>
                alert('Error: Could not prepare statement.');
                window.location.href = 'index.php';
              </script>";
    }
    
    // Close connection
    mysqli_close($conn);
}
?>