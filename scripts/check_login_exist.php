<?php
$userExist = false;
$conn = include("database_con.php");
if ($stmt = $conn->prepare('SELECT * FROM uzytkownicy WHERE login = ?')) {
    $stmt->bind_param("s", $_POST["inputLogin"]);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $userExist = true;
    }
    $stmt->close();
}
$conn->close();
return $userExist;
