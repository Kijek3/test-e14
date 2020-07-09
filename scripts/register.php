<?php
session_start();
if ($_POST["inputLogin"] == "") {
    header('Location: ../pages/register.php?status=emptyForm');
} else {
    if (strlen($_POST["inputLogin"]) < 6) {
        header('Location: ../pages/register.php?status=badLogin');
    } else {
        if (strlen($_POST["inputPassword"]) < 6) {
            header('Location: ../pages/register.php?status=badPassword');
        } else {
            $loginExist = include("check_login_exist.php");
            if ($loginExist) {
                header('Location: ../pages/register.php?status=userExist');
            } else {
                $hash = password_hash($_POST["inputPassword"], PASSWORD_DEFAULT);
                $conn = include("database_con.php");
                $stmt = $conn->prepare("INSERT INTO uzytkownicy (login,password) VALUES (?,?)");
                $stmt->bind_param("ss", $_POST["inputLogin"], $hash);
                $stmt->execute();
                $stmt->close();
                $conn->close();
                $_SESSION["user"] = $_POST["inputLogin"];
                $_SESSION["isAdmin"] = false;
                header('Location: ../index.php');
            }
        }
    }
}
