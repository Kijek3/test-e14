<?php
session_start();
if (isset($_SESSION["user"])) {
    header('Location: ../index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon">
    <title>Rejestracja</title>
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
                echo ('<a class="nav-item nav-link" href="register.php">Zarejestruj się</a>');
                echo ('<a class="nav-item nav-link" href="login.php">Zaloguj się</a>');
                ?>
            </div>
        </div>
    </nav>
    <div class="container text text-light pt-3 pb-3">
        <h2 class="text-center p-3">Rejestracja</h2>
        <div class="text-danger text-center mb-3
                    <?php if ($_GET["status"] != "emptyForm") {
                        echo ("d-none");
                    } ?>" id="userExist">Musisz uzupełnić wszystkie pola</div>
        <div class="text-danger text-center mb-3
                    <?php if ($_GET["status"] != "badLogin") {
                        echo ("d-none");
                    } ?>" id="userExist">Login musi mieć co najmniej 6 znaków</div>
        <div class="text-danger text-center mb-3
                    <?php if ($_GET["status"] != "badPassword") {
                        echo ("d-none");
                    } ?>" id="userExist">Hasło musi mieć co najmniej 6 znaków</div>
        <div class="text-danger text-center mb-3
                    <?php if ($_GET["status"] != "userExist") {
                        echo ("d-none");
                    } ?>" id="userExist">Ten użytkownik już istnieje</div>
        <form action="../scripts/register.php" method="post">
            <div class="form-group row">
                <label for="inputLogin" class="col-sm-1 col-form-label">Login</label>
                <div class="col-sm-11">
                    <input type="text" class="form-control" id="inputLogin" name="inputLogin" placeholder="Login">

                </div>
            </div>
            <div class="form-group row">
                <label for="inputPassword" class="col-sm-1 col-form-label">Hasło</label>
                <div class="col-sm-11">
                    <input type="password" class="form-control" id="inputPassword" name="inputPassword" placeholder="Hasło">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-12 text-right">
                    <button type="submit" class="btn btn-primary">Zarejestruj się</button>
                </div>
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>