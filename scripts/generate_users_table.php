<?php
echo ('<div class="table-responsive"><table class="table table-striped table-dark table-hover">');

echo ('<thead><tr>');
echo ('<th scope="col">ID</th>');
echo ('<th scope="col">Login</th>');
echo ('<th scope="col">Administrator</th>');
echo ('<th scope="col"></th>');
echo ('<th scope="col"></th>');
echo ('<th scope="col"></th>');
echo ('</thead></tr>');

echo ("<tbody>");
$conn = include("database_con.php");
$stmt = $conn->prepare("SELECT id, login, isAdmin FROM uzytkownicy");
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    echo ('<tr>');
    echo ('<td>' . $row["id"] . '</td>');
    echo ('<td>' . $row["login"] . '</td>');
    if ($row["isAdmin"] == 0) {
        echo ('<td class="text-danger">NIE</td>');
    } else {
        echo ('<td class="text-success">TAK</td>');
    }
    echo ('<td><form action="" method="POST"><input type="hidden" id="userId" name="userId" value="' . $row["id"] . '"><button type="submit" class="btn btn-info">Zmień hasło</button></form></td>');
    if ($row["isAdmin"] == 0) {
        echo ('<td><form action="../scripts/admin_add.php" method="POST"><input type="hidden" id="userId" name="userId" value="' . $row["id"] . '"><button type="submit" class="btn btn-success">Przyznaj uprawnienia administratora</button></form></td>');
    } else {
        echo ('<td><form action="../scripts/admin_remove.php" method="POST"><input type="hidden" id="userId" name="userId" value="' . $row["id"] . '"><button type="submit" class="btn btn-warning">Odbierz uprawnienia administratora</button></form></td>');
    }
    echo ('<td><form action="../scripts/delete_user.php" method="POST"><input type="hidden" id="userId" name="userId" value="' . $row["id"] . '"><button type="submit" class="btn btn-danger">Usuń</button></form></td>');
    echo ('</tr>');
}
$stmt->close();
$conn->close();

echo ('</tbody></table></div>');
