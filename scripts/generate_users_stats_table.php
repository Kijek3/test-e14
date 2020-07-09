<?php
echo ('<div class="table-responsive"><table class="table table-striped table-dark table-hover">');

echo ('<thead><tr>');
echo ('<th scope="col">Login</th>');
echo ('<th scope="col">Dobre odpowiedzi</th>');
echo ('<th scope="col">Złe odpowiedzi</th>');
echo ('<th scope="col">Wszystkie odpowiedzi</th>');
echo ('</thead></tr>');

echo ("<tbody>");
$conn = include("database_con.php");
$stmt = $conn->prepare("SELECT * FROM uzytkownicy");
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    echo ('<tr>');
    echo ('<td>' . $row["login"] . '</td>');
    echo ('<td class="text-success">' . $row["good_answers"] . '</td>');
    echo ('<td class="text-danger">' . strval(intval($row["all_answers"]) - intval($row["good_answers"])) . '</td>');
    echo ('<td class="text-info">' . $row["all_answers"] . '</td>');
    echo ('</tr>');
}
$stmt->close();
$conn->close();

echo ('</tbody></table></div>');
