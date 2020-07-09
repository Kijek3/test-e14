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
            $stmt = $conn->prepare("INSERT INTO pytania (pytanie,odpowiedz,odpowiedz_a,odpowiedz_b,odpowiedz_c,odpowiedz_d) VALUES (?,?,?,?,?,?)");
            $stmt->bind_param("ssssss", htmlspecialchars($_POST["inputQuestion"]), $_POST["inputAnswer"], htmlspecialchars($_POST["inputAnswerA"]), htmlspecialchars($_POST["inputAnswerB"]), htmlspecialchars($_POST["inputAnswerC"]), htmlspecialchars($_POST["inputAnswerD"]));
        } else {
            $stmt = $conn->prepare("INSERT INTO pytania (pytanie,odpowiedz,obrazek,odpowiedz_a,odpowiedz_b,odpowiedz_c,odpowiedz_d) VALUES (?,?,?,?,?,?,?)");
            $stmt->bind_param("sssssss", htmlspecialchars($_POST["inputQuestion"]), $_POST["inputAnswer"], basename($_FILES["inputPhoto"]["name"]), htmlspecialchars($_POST["inputAnswerA"]), htmlspecialchars($_POST["inputAnswerB"]), htmlspecialchars($_POST["inputAnswerC"]), htmlspecialchars($_POST["inputAnswerD"]));
        }
        $stmt->execute();
        $stmt->close();
        if ($_FILES["inputPhoto"]["name"] != "") {
            $stmt = $conn->prepare("SELECT MAX(id) as id FROM pytania");
            $stmt->execute();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                $lastId = $row["id"];
            }
            $stmt->close();
            mkdir("../images/questions/" . $lastId);
            $target_dir = "../images/questions/" . $lastId . "/";
            $target_file = $target_dir . basename($_FILES["inputPhoto"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            move_uploaded_file($_FILES["inputPhoto"]["tmp_name"], $target_file);
        }
        $conn->close();
        header('Location: ../pages/questionPanel.php');
    }
}
