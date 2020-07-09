<?php
session_start();
if ($_SESSION["isAdmin"] == false) {
    header('Location: ../pages/login.php');
} else {
    $conn = include("database_con.php");
    $stmt = $conn->prepare("DELETE FROM pytania WHERE id=?");
    $stmt->bind_param("i", $_POST["questionId"]);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    header('Location: ../pages/questionPanel.php?status=questionDeleted');
}
