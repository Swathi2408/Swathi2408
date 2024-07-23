<?php
session_start();
require_once('db_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $candidate_id = $_POST['candidate_id'];

    // Check if the user has already voted
    $query = "SELECT * FROM votes WHERE user_id = :user_id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    $existing_vote = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$existing_vote) {
        $query = "INSERT INTO votes (user_id, candidate_id) VALUES (:user_id, :candidate_id)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':candidate_id', $candidate_id);
        $stmt->execute();
        header('Location: index.php');
        exit;
    } else {
        $error_message = "You have already voted.";
    }
}
?>
<!-- Your HTML form for voting -->

