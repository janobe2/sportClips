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

</head>

<body>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <?php

        //check if db exists
        if(!file_exists("db/clipsDatabase.php"))
            header("Location: db/createDatabase.php");

        session_start();

        $isNotGuest = ($_SESSION["rights"] != "GUEST");

        if (isset($_SESSION["username"]) && $isNotGuest)
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
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Übersicht</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="">Videoliste
                        <span class="sr-only">(current)</span></a>
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
        <small>Videoliste</small>
    </h1>

    <p>Hier ist die Liste mit den hochgeladenen Videos. Sie können mit dem Button "Hinzufügen" ein weiteres
        Video hochladen oder eines links auswählen und dann unten auf "Löschen" klicken.</p>

    <form action="php/deleteVideos.php" method="post">
        <button type="button" class="btn btn-success uploadBtn" onclick="window.location.href='upload.php'">Video
            hinzufügen
        </button>
        <button type="submit" class="btn btn-danger deleteBtn">Ausgewählte Videos löschen</button>

        <?php
        if (isset($_SESSION["deleteCounter"])) {
            if ($_SESSION["deleteCounter"] == 1)
                echo "<p style='color: red; font-weight: bold;'>Es wurde " . $_SESSION["deleteCounter"] . " Video gelöscht</p>";
            else
                echo "<p style='color: red; font-weight: bold;'>Es wurden " . $_SESSION["deleteCounter"] . " Videos gelöscht</p>";

            unset($_SESSION["deleteCounter"]);
        }

        ?>

        <div class="table_outer">
            <table class="table table-striped" id="list">
                <thead class="thead-dark">
                <tr>
                    <th scope="col"><button type="button" class="checkAll" onclick="checkAll()">Auswählen</button></th>
                    <th scope="col">Name</th>
                    <th scope="col">Von welchem Benutzer</th>
                    <th scope="col">Grösse (MB)</th>
                </tr>
                </thead>
                <tbody>

                <?php
                //Creating list of videos
                $db = new SQLite3("db/clipDatabase.db");
                $oneCreated = false;

                //If admin show every video
                //If user, show only videos, who user uploaded
                if ($_SESSION['rights'] == 'ADMIN')
                    $res = $db->query("SELECT * FROM TVideos");
                else
                    $res = $db->query("SELECT * FROM TVideos where UsName='" . $_SESSION["username"] . "';");

                while ($dsatz = $res->fetchArray(SQLITE3_ASSOC)) {
                    echo "<tr>";
                    echo "<th scope='row'><input id='checks' type='checkbox' name='" . $dsatz['id'] . "'/></th>";
                    echo "<td class='dsc'>" . $dsatz['title'] . "</td>";
                    echo "<td>" . $dsatz['UsName'] . "</td>";
                    echo "<td>" . $dsatz['size'] . "</td>";
                    echo "</tr>";

                    $oneCreated = true;
                }
                //add line when there is no data
                if (!$oneCreated) {
                    echo "<tr>";
                    echo "<th colspan='4' style='text-align: center'>Es gibt noch keine Videos</th>";
                    echo "</tr>";
                }


                ?>

                </tbody>
            </table>
        </div>
    </form>
</div>


<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="js/checkAll.js"></script>

</body>

</html>
