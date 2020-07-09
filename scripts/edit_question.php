<?php
session_start();
if ($_SESSION["isAdmin"] == false) {
    header('Location: ../pages/login.php');
} else {
    if ($_POST["inputQuestion"] == "" || $_POST["inputAnswerA"] == "" || $_POST["inputAnswerB"] == "" || $_POST["inputAnswerC"] == "" || $_POST["inputAnswerD"] == "") {
        header('Location: ../pages/addQuestion.php?status=emptyForm');
    } else {
        $conn = include("database_con.php");
        if ($_FILES["inputPhoto"]["name"] == "") {
            $stmt = $conn->prepare("UPDATE pytania SET pytanie=?,odpowiedz=?,odpowiedz_a=?,odpowiedz_b=?,odpowiedz_c=?,odpowiedz_d=? WHERE id=?");
            $stmt->bind_param("ssssssi", htmlspecialchars($_POST["inputQuestion"]), $_POST["inputAnswer"], htmlspecialchars($_POST["inputAnswerA"]), htmlspecialchars($_POST["inputAnswerB"]), htmlspecialchars($_POST["inputAnswerC"]), htmlspecialchars($_POST["inputAnswerD"]), $_POST["questionId"]);
        } else {
            $stmt = $conn->prepare("UPDATE pytania SET pytanie=?,odpowiedz=?,obrazek=?,odpowiedz_a=?,odpowiedz_b=?,odpowiedz_c=?,odpowiedz_d=? WHERE id=?");
            $stmt->bind_param("sssssssi", htmlspecialchars($_POST["inputQuestion"]), $_POST["inputAnswer"], basename($_FILES["inputPhoto"]["name"]), htmlspecialchars($_POST["inputAnswerA"]), htmlspecialchars($_POST["inputAnswerB"]), htmlspecialchars($_POST["inputAnswerC"]), htmlspecialchars($_POST["inputAnswerD"]), $_POST["questionId"]);
        }
        $stmt->execute();
        $stmt->close();
        if ($_FILES["inputPhoto"]["name"] != "") {
            mkdir("../images/questions/" . $_POST["questionId"]);
            $target_dir = "../images/questions/" . $_POST["questionId"] . "/";
            $target_file = $target_dir . basename($_FILES["inputPhoto"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            move_uploaded_file($_FILES["inputPhoto"]["tmp_name"], $target_file);
        }
        $conn->close();
        header('Location: ../pages/questionPanel.php');
    }
}
