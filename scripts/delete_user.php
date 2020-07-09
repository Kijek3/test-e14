<?php
session_start();
if ($_SESSION["isAdmin"] == false) {
    header('Location: ../pages/login.php');
} else {
    $conn = include("database_con.php");
    $stmt = $conn->prepare("DELETE FROM uzytkownicy WHERE id=?");
    $stmt->bind_param("i", $_POST["userId"]);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    header('Location: ../pages/userPanel.php?status=userDeleted');
}
