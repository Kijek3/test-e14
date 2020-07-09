<?php
if (!isset($_SESSION["user"])) {
    header('Location: login.php');
}
echo ('<form action="testResults.php" method="POST">');
$conn = include("database_con.php");
$stmt = $conn->prepare("SELECT * FROM pytania ORDER BY RAND() LIMIT 10");
$stmt->execute();
$result = $stmt->get_result();
$questionIndex = 1;
while ($row = $result->fetch_assoc()) {
    echo ('<div class="container bg-secondary text-left rounded-lg mb-3 p-3">');
    echo ('<h4>' . $row["pytanie"] . '</h4>');
    if ($row["obrazek"] != null) {
        echo ('<img src="../images/questions/' . $row["id"] . '/' . $row["obrazek"] . '" alt="" class="rounded mb-3 mt-3 mx-auto d-block img-fluid">');
    }

    echo ('<input type="hidden" name="questionId' . $questionIndex . '" id="questionId' . $questionIndex . '" value="' . $row["id"] . '">');

    //Odpowiedzi
    echo ('<div class="form-check mb-1">');
    echo ('<input class="form-check-input" type="radio" name="question' . $questionIndex . '" id="answerA' . $questionIndex . '" value="A">');
    echo ('<label class="form-check-label" for="answerA' . $questionIndex . '">' . $row["odpowiedz_a"] . '</label>');
    echo ('</div>');

    echo ('<div class="form-check mb-1">');
    echo ('<input class="form-check-input" type="radio" name="question' . $questionIndex . '" id="answerB' . $questionIndex . '" value="B">');
    echo ('<label class="form-check-label" for="answerB' . $questionIndex . '">' . $row["odpowiedz_b"] . '</label>');
    echo ('</div>');

    echo ('<div class="form-check mb-1">');
    echo ('<input class="form-check-input" type="radio" name="question' . $questionIndex . '" id="answerC' . $questionIndex . '" value="C">');
    echo ('<label class="form-check-label" for="answerC' . $questionIndex . '">' . $row["odpowiedz_c"] . '</label>');
    echo ('</div>');

    echo ('<div class="form-check mb-1">');
    echo ('<input class="form-check-input" type="radio" name="question' . $questionIndex . '" id="answerD' . $questionIndex . '" value="D">');
    echo ('<label class="form-check-label" for="answerD' . $questionIndex . '">' . $row["odpowiedz_d"] . '</label>');
    echo ('</div>');

    echo ('</div>');
    $questionIndex++;
}
echo ('<div class="form-group row"><div class="container p-0"><button type="submit" class="btn btn-primary btn-block">Zakończ rozwiązywanie testu</button></div></div>');
echo ('</form>');
$stmt->close();
$conn->close();
