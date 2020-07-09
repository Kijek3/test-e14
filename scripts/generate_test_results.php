<?php
if (!isset($_SESSION["user"])) {
    header('Location: login.php');
}
echo ('<form action="test.php" method="POST">');
$goodAnswers = 0;
$conn = include("database_con.php");
for ($i = 1; $i <= 10; $i++) {
    $stmt = $conn->prepare("SELECT * FROM pytania WHERE id=?");
    $stmt->bind_param("i", $_POST["questionId" . $i]);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        if ($row["odpowiedz"] == $_POST["question" . $i])
            echo ('<div class="container bg-secondary text-left rounded-lg mb-3 p-3 border border-success">');
        else
            echo ('<div class="container bg-secondary text-left rounded-lg mb-3 p-3 border border-danger">');
        echo ('<h4>' . $row["pytanie"] . '</h4>');
        if ($row["obrazek"] != null) {
            echo ('<img src="../images/questions/' . $row["id"] . '/' . $row["obrazek"] . '" alt="" class="rounded mb-3 mt-3 mx-auto d-block img-fluid">');
        }

        //Odpowiedzi
        $answers = array("A", "B", "C", "D");
        foreach ($answers as $answer) {
            echo ('<div class="form-check mb-1">');
            if ($_POST["question" . $i] == $answer) {
                echo ('<input class="form-check-input" type="radio" disabled checked>');
                if ($row["odpowiedz"] == $answer) {
                    echo ('<label class="form-check-label text-success">' . $row["odpowiedz_" . strtolower($answer)] . '</label>');
                    $goodAnswers++;
                    $stmt2 = $conn->prepare("UPDATE pytania SET good_answers = good_answers + 1 WHERE id=?");
                    $stmt2->bind_param("i", $_POST["questionId" . $i]);
                    $stmt2->execute();
                    $stmt2->close();
                    $stmt2 = $conn->prepare("UPDATE uzytkownicy SET good_answers = good_answers + 1 WHERE login=?");
                    $stmt2->bind_param("s", $_SESSION["user"]);
                    $stmt2->execute();
                    $stmt2->close();
                } else {
                    echo ('<label class="form-check-label text-danger">' . $row["odpowiedz_" . strtolower($answer)] . '</label>');
                }
            } else {
                echo ('<input class="form-check-input" type="radio" disabled>');
                if ($row["odpowiedz"] == $answer) {
                    echo ('<label class="form-check-label text-warning">' . $row["odpowiedz_" . strtolower($answer)] . '</label>');
                } else {
                    echo ('<label class="form-check-label text-light">' . $row["odpowiedz_" . strtolower($answer)] . '</label>');
                }
            }
            echo ('</div>');
        }
        echo ('</div>');
    }
    $stmt->close();
    $stmt = $conn->prepare("UPDATE pytania SET all_answers = all_answers + 1 WHERE id=?");
    $stmt->bind_param("i", $_POST["questionId" . $i]);
    $stmt->execute();
    $stmt->close();
    $stmt = $conn->prepare("UPDATE uzytkownicy SET all_answers = all_answers + 1 WHERE login=?");
    $stmt->bind_param("s", $_SESSION["user"]);
    $stmt->execute();
    $stmt->close();
}
$conn->close();
echo ('<div class="form-group row"><div class="container p-0"><button type="submit" class="btn btn-info btn-block">Rozwiąż następny test</button></div></div>');
echo ('</form>');
$goodPercent = $goodAnswers * 10;
echo ('<h3>Twój wynik to ' . $goodAnswers . '/10 (' . $goodPercent . '%)</h3>');
