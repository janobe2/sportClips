<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sport Clips</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/3-col-portfolio.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/upload.css" rel="stylesheet">

</head>

<body>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <?php

        session_start();
        $isNotGuest = ($_SESSION["rights"] != "GUEST");

        if (isset($_SESSION["username"]) && $isNotGuest)
            echo '<a class="navbar-brand" href="account.php">' . $_SESSION["username"] . '</a>';
        else {
            header("Location: login/login.php");
            die();
        }


        ?>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Übersicht</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="">Videoliste
                        <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="account.php">Account</a>
                </li>
            </ul>
        </div>
    </div>
    <button class="logout" onclick="window.location.href='php/logout.php';">Ausloggen</button>
</nav>

<!-- Page Content -->
<div class="container">

    <!-- Page Heading -->
    <h1 class="my-4">
        <small>Videoupload</small>
    </h1>

    <p>Sie sind kurz davor ein neues Video hochzuladen. Dies geschieht in wenigen Schritten.<br>
        Klicken Sie in einem ersten Schritt auf "Videos auswählen". Markieren Sie alle Videos, die hochgeladen werden
        soll.<br>
        Danach werden alle Videos aufgelistet. Überprüfen Sie, ob alle dabei sind. Anschliessend müssen Sie nur noch auf
        "Speichern" klicken und voilà.<br>
        Nachdem die Videos hochgeladen sind, werden Sie auf die Videoliste Seite weitergeleitet.</p>


    <div class="upload-btn-wrapper">
        <button class="knopf">Upload a file</button>
        <input type="file" multiple name="myfile[]" accept="video/mp4,video/x-m4v,video/*"/>
    </div>
    <br><br>
    <p>Klicken Sie auf "Speichern" und der Upload wird beginnen.</p>
    <progress id="progressBar" value="0" max="100" style="width:50%; float: left"></progress>
    <h3 id="status"></h3>
    <p id="loaded_n_total"></p>œ
    <br>

    <button class="btn uploadBtn btn-light" onclick="window.location.href='videolist.php'">Abbrechen</button>
    <button class="btn uploadBtn btn-success">Speichern</button>

</div>
<!-- /.container -->

<!-- Footer -->
<footer class="py-5 bg-dark">
    <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy;Jan Oberhänsli www.sportclips.ch 2018</p>
    </div>
    <!-- /.container -->
</footer>

<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="js/upload.js"></script>

</body>

</html>
