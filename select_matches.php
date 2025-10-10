<?php
require_once 'database.php';
function getMatches(){
    global $conn;
    $matches = array();
    $stmt = "SELECT * FROM matches ORDER BY id DESC";
    $results = mysqli_query($conn, $stmt);
    if(mysqli_num_rows($results) > 0){
        while($match = mysqli_fetch_assoc($results)){
            $matches[] = $match;
        }
    }
    return $matches;
}
?>