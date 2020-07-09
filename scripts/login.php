<?php
session_start();
if ($_POST["inputLogin"] == "") {
    header('Location: ../pages/login.php?status=emptyForm');
} else {
    $conn = include("database_con.php");
    $stmt = $conn->prepare("SELECT password, isAdmin FROM uzytkownicy WHERE login=?");
    $stmt->bind_param("s", $_POST["inputLogin"]);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 0) {
        $stmt->close();
        $conn->close();
        header('Location: ../pages/login.php?status=badCredentials');
    } else {
        while ($row = $result->fetch_assoc()) {
            $hashDatabase = $row["password"];
            $isAdmin = $row["isAdmin"];
        }
        $stmt->close();
        $conn->close();
        if (password_verify($_POST["inputPassword"], $hashDatabase)) {
            $_SESSION["user"] = $_POST["inputLogin"];
            $_SESSION["isAdmin"] = $isAdmin;
            header('Location: ../index.php');
        } else {
            header('Location: ../pages/login.php?status=badCredentials');
        }
    }
}
