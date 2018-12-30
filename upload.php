<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" type="image/png" href="fav/favicon.ico"/>
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
    <!-- Other Stylesheets -->
    <link rel="stylesheet"
          href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css"
          integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M"
          crossorigin="anonymous">
    <link rel="stylesheet" href="css/tagsinput.css">


</head>

<body>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <?php

        //check if db exists
        if(!file_exists("db/clipDatabase.db")) {
            header("Location: db/createDatabase.php");
            die();
        }

        session_start();

        if (isset($_SESSION["username"]))
            echo '<a class="navbar-brand" style="color: white;">' . $_SESSION["username"] . '</a>';
        else {
            header("Location: login/login.php");
            die();
        }


        ?>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <?php

        echo '
        <div class="collapse navbar-collapse" id="navbarResponsive">';
        if ($_SESSION["rights"] != "GUEST") {
            echo '<ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Übersicht
                    </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="videolist.php">Videoliste 
                    <span class="sr-only">(current)</span></a>
                </li>';
        }
        echo '
            </ul>
        </div>';
        ?>
    </div>
    <button class="logout" onclick="window.location.href='php/logout.php';">Ausloggen</button>
</nav>

<!-- Page Content -->
<div class="container">

    <!-- Page Heading -->
    <h1 class="my-4">
        <small>Videoupload</small>
    </h1>

    <p>Wählen Sie zunächst ein Video aus.</p>

    <form action="php/videoUpload.php" method="post" id="uploadForm" onkeypress="return event.keyCode !== 13;">
        <div class="upload-btn-wrapper">
            <button class="knopf">Video auswählen</button>
            <input type="file" name="myfile[]" id="filesUpload" accept="video/*, video/mp4,video/x-m4v"
                   onchange="refreshTable()"/>
        </div>

        <div class="upload-btn-wrapper">
            <button class="knopf" type="button" id="removeAll" onclick="removeList();" disabled="disabled">Zurücksetzen
            </button>
        </div>
        <br><br>
        <div class="tags">
            <label>Videopfad</label>
            <input type="text" id="videoPath" disabled>

            <label>Fügen Sie dem Video Tags hinzug. Wenn Sie einen Tag angegeben haben, drücken Sie die Eingabetaste und
                der Tag wird hinzugefügt.</label>
            <input type="text" id="videotags" data-role="tagsinput" placeholder="Optional...">
        </div>

        <div id="extraText" style="display: none">
            <hr>
            <p>Klicken Sie auf "Speichern" und der Upload wird beginnen.</p>
            <progress id="progressBar" value="0" max="100" style="width:50%; float: left"></progress>
            <h3 id="status"></h3>
            <p id="loaded_n_total"></p>
            <br>
        </div>

        <button class="btn uploadBtn btn-light" type="button" id="btnAbort" onclick="abort()">Fertig</button>
        <button class="btn uploadBtn btn-success" type="submit" id="btnSave" disabled="disabled">Speichern</button>
    </form>

    <p class="successT" id="successT"></p>
    <p class="error" id="errorT"></p>
</div>


<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Other JavaScript -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
<script src="js/tagsinput.js"></script>
<script src="js/upload.js"></script>

</body>

</html>
