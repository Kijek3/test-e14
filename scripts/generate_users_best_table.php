<?php
echo ('<div class="table-responsive"><table class="table table-striped table-dark table-hover">');

echo ('<thead><tr>');
echo ('<th scope="col">Login</th>');
echo ('<th scope="col">Procent dobrych rozwiązań</th>');
echo ('<th scope="col">Liczba rozwiązanych testów</th>');
echo ('</thead></tr>');

echo ("<tbody>");
$conn = include("database_con.php");
$stmt = $conn->prepare("SELECT * FROM uzytkownicy ORDER BY (all_answers - good_answers) / all_answers ASC, all_answers DESC LIMIT 10");
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    if ($row["all_answers"] != 0) {
        echo ('<tr>');
        echo ('<td>' . $row["login"] . '</td>');
        echo ('<td class="text-success">' . strval(floor(intval($row["good_answers"]) / intval($row["all_answers"]) * 100)) . '%</td>');
        echo ('<td class="text-info">' . strval((intval($row["all_answers"]) / 10)) . '</td>');
        echo ('</tr>');
    }
}
$stmt->close();
$conn->close();

echo ('</tbody></table></div>');
