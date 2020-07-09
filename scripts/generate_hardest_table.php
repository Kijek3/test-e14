<?php
echo ('<div class="table-responsive"><table class="table table-striped table-dark table-hover">');

echo ('<thead><tr>');
echo ('<th scope="col">ID</th>');
echo ('<th scope="col">Pytanie</th>');
echo ('<th scope="col">Procent niepoprawnych odpowiedzi</th>');
echo ('<th scope="col">Wszystkie odpowiedzi</th>');
echo ('</thead></tr>');

echo ("<tbody>");
$conn = include("database_con.php");
$stmt = $conn->prepare("SELECT * FROM pytania ORDER BY (all_answers - good_answers) / all_answers DESC, all_answers DESC LIMIT 10");
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    echo ('<tr>');
    echo ('<td>' . $row["id"] . '</td>');
    echo ('<td>' . $row["pytanie"] . '</td>');
    echo ('<td class="text-danger">' . strval(floor((intval($row["all_answers"]) - intval($row["good_answers"])) / intval($row["all_answers"]) * 100)) . '%</td>');
    echo ('<td class="text-info">' . $row["all_answers"] . '</td>');
    echo ('</tr>');
}
$stmt->close();
$conn->close();

echo ('</tbody></table></div>');
