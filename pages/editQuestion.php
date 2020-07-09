<?php
session_start();
if (!isset($_SESSION["isAdmin"])) {
    header('Location: login.php');
}
if (!isset($_POST["questionId"])) {
    header('Location: questionPanel.php');
}
$conn = include("../scripts/database_con.php");
$stmt = $conn->prepare("SELECT * FROM pytania WHERE id=?");
$stmt->bind_param("i", $_POST["questionId"]);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $id = $row["id"];
    $pytanie = $row["pytanie"];
    $odpowiedz = $row["odpowiedz"];
    $odpowiedz_a = $row["odpowiedz_a"];
    $odpowiedz_b = $row["odpowiedz_b"];
    $odpowiedz_c = $row["odpowiedz_c"];
    $odpowiedz_d = $row["odpowiedz_d"];
}
$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon">
    <title>Edytuj pytanie</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="fill-height bg-dark">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-lg">
        <a class="navbar-brand" href="../index.php">
            <img src="../images/logo.png" width="50" height="50" alt=""> Egzamin E14</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav mr-auto">
                <a class="nav-item nav-link" href="../index.php">Strona główna</a>
                <a class="nav-item nav-link" href="test.php">Rozpocznij test</a>
            </div>
            <div class="navbar-nav ml-auto">
                <?php
                if (isset($_SESSION["user"])) {
                    echo ('<div class="nav-item dropdown">');
                    echo ('<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">');
                    echo ('Witaj ' . $_SESSION["user"]);
                    echo ('</a>');
                    echo ('<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">');
                    echo ('<a class="dropdown-item" href="questionPanel.php">Zarządzaj pytaniami</a>');
                    echo ('<a class="dropdown-item" href="adminStats.php">Statystyki pytań</a>');
                    echo ('<a class="dropdown-item" href="userPanel.php">Zarządzaj użytkownikami</a>');
                    echo ('<a class="dropdown-item" href="adminUserStats.php">Statystyki użytkowników</a>');
                    echo ('<a class="dropdown-item" href="settings.php">Zmień hasło</a>');
                    echo ('<a class="dropdown-item" href="../scripts/logout.php">Wyloguj się</a>');
                    echo ('</div></div>');
                }
                ?>
            </div>
        </div>
    </nav>
    <div class="container text text-light pt-3 pb-3">
        <h2 class="text-center p-3">Edytuj pytanie</h2>
        <div class="text-danger text-center mb-3
                    <?php if ($_GET["status"] != "emptyForm") {
                        echo ("d-none");
                    } ?>" id="userExist">Musisz uzupełnić wszystkie pola</div>
        <form action="../scripts/edit_question.php" method="post" enctype="multipart/form-data">
            <input type="hidden" id="questionId" name="questionId" value="<?php echo ($id); ?>">
            <div class="form-group">
                <label for="inputQuestion">Pytanie</label>
                <textarea class="form-control" id="inputQuestion" name="inputQuestion" rows="3" placeholder="Wprowadź treść pytania"><?php echo ($pytanie); ?></textarea>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputPhoto">Grafika do pytania</label>
                    <input type="file" accept="image/*" class="form-control-file" id="inputPhoto" name="inputPhoto">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputAnswer">Poprawna odpowiedź</label>
                    <select class="form-control" id="inputAnswer" name="inputAnswer">
                        <option value="A" <?php if ($odpowiedz == "A") {
                                                echo ("selected");
                                            } ?>>A</option>
                        <option value="B" <?php if ($odpowiedz == "B") {
                                                echo ("selected");
                                            } ?>>B</option>
                        <option value="C" <?php if ($odpowiedz == "C") {
                                                echo ("selected");
                                            } ?>>C</option>
                        <option value="D" <?php if ($odpowiedz == "D") {
                                                echo ("selected");
                                            } ?>>D</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputAnswerA">Odpowiedź A</label>
                    <textarea class="form-control" id="inputAnswerA" name="inputAnswerA" rows="3" placeholder="Wprowadź odpowiedź A"><?php echo ($odpowiedz_a); ?></textarea>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputAnswerB">Odpowiedź B</label>
                    <textarea class="form-control" id="inputAnswerB" name="inputAnswerB" rows="3" placeholder="Wprowadź odpowiedź B"><?php echo ($odpowiedz_b); ?></textarea>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputAnswerC">Odpowiedź C</label>
                    <textarea class="form-control" id="inputAnswerC" name="inputAnswerC" rows="3" placeholder="Wprowadź odpowiedź C"><?php echo ($odpowiedz_c); ?></textarea>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputAnswerD">Odpowiedź D</label>
                    <textarea class="form-control" id="inputAnswerD" name="inputAnswerD" rows="3" placeholder="Wprowadź odpowiedź D"><?php echo ($odpowiedz_d); ?></textarea>
                </div>
            </div>
            <div class="form-row">
                <div class="col-sm-12 text-right">
                    <a href="questionPanel.php"><button type="button" class="btn btn-danger">Anuluj</button></a>
                    <button type="submit" class="btn btn-info">Edytuj pytanie</button>
                </div>
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>