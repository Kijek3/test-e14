<?php
session_start();
if (!isset($_SESSION["user"])) {
    header('Location: login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon">
    <title>Egzamin E14</title>
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
                <a class="nav-item nav-link active" href="test.php">Rozpocznij test</a>
            </div>
            <div class="navbar-nav ml-auto">
                <?php
                if (isset($_SESSION["user"])) {
                    echo ('<div class="nav-item dropdown">');
                    echo ('<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">');
                    echo ('Witaj ' . $_SESSION["user"]);
                    echo ('</a>');
                    echo ('<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">');
                    if ($_SESSION["isAdmin"] == true) {
                        echo ('<a class="dropdown-item" href="questionPanel.php">Zarządzaj pytaniami</a>');
                        echo ('<a class="dropdown-item" href="adminStats.php">Statystyki pytań</a>');
                        echo ('<a class="dropdown-item" href="userPanel.php">Zarządzaj użytkownikami</a>');
                        echo ('<a class="dropdown-item" href="adminUserStats.php">Statystyki użytkowników</a>');
                    }
                    echo ('<a class="dropdown-item" href="settings.php">Zmień hasło</a>');
                    echo ('<a class="dropdown-item" href="../scripts/logout.php">Wyloguj się</a>');
                    echo ('</div></div>');
                }
                ?>
            </div>
        </div>
    </nav>
    <div class="container-fluid text-center text-light pt-3 pb-3">
        <?php
        include("../scripts/generate_test.php");
        ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>