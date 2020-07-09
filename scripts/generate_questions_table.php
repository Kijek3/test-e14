<?php
echo ('<div class="table-responsive"><table class="table table-striped table-dark table-hover">');

echo ('<thead><tr>');
echo ('<th scope="col">ID</th>');
echo ('<th scope="col">Pytanie</th>');
echo ('<th scope="col">Poprawna odpowiedź</th>');
echo ('<th scope="col">A</th>');
echo ('<th scope="col">B</th>');
echo ('<th scope="col">C</th>');
echo ('<th scope="col">D</th>');
echo ('<th scope="col"></th>');
echo ('<th scope="col"></th>');
echo ('<th scope="col"></th>');
echo ('</thead></tr>');

echo ("<tbody>");
$conn = include("database_con.php");
$stmt = $conn->prepare("SELECT * FROM pytania");
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    echo ('<tr>');
    echo ('<td>' . $row["id"] . '</td>');
    echo ('<td>' . $row["pytanie"] . '</td>');
    echo ('<td>' . $row["odpowiedz"] . '</td>');
    if ($row["odpowiedz"] == "A")
        echo ('<td class="text-success">' . $row["odpowiedz_a"] . '</td>');
    else
        echo ('<td class="text-danger">' . $row["odpowiedz_a"] . '</td>');
    if ($row["odpowiedz"] == "B")
        echo ('<td class="text-success">' . $row["odpowiedz_b"] . '</td>');
    else
        echo ('<td class="text-danger">' . $row["odpowiedz_b"] . '</td>');
    if ($row["odpowiedz"] == "C")
        echo ('<td class="text-success">' . $row["odpowiedz_c"] . '</td>');
    else
        echo ('<td class="text-danger">' . $row["odpowiedz_c"] . '</td>');
    if ($row["odpowiedz"] == "D")
        echo ('<td class="text-success">' . $row["odpowiedz_d"] . '</td>');
    else
        echo ('<td class="text-danger">' . $row["odpowiedz_d"] . '</td>');
    if ($row["obrazek"] != null)
        echo ('<td style="width: 150px;"><form action="../scripts/delete_image.php" method="POST"><input type="hidden" id="questionId" name="questionId" value="' . $row["id"] . '"><button type="submit" class="btn btn-warning">Usuń obrazek</button></form></td>');
    else
        echo ('<td></td>');
    echo ('<td><form action="editQuestion.php" method="POST"><input type="hidden" id="questionId" name="questionId" value="' . $row["id"] . '"><button type="submit" class="btn btn-info">Edytuj</button></form></td>');
    echo ('<td><form action="../scripts/delete_question.php" method="POST"><input type="hidden" id="questionId" name="questionId" value="' . $row["id"] . '"><button type="submit" class="btn btn-danger">Usuń</button></form></td>');
    echo ('</tr>');
}
$stmt->close();
$conn->close();

echo ('</tbody></table></div>');
