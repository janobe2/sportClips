<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sport Clips</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/3-col-portfolio.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.plyr.io/3.4.7/plyr.css">
    <link rel="stylesheet" href="css/search.css">

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
        //initialize variable
        var content = [];
        var count = 0;
    </script>

</head>

<body>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <?php

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
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Übersicht
                    <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="videolist.php">Videoliste</a>
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
    <h1 class="my-4">Videos
    </h1>

    <div class="col-12">
        <select id="searchPreference">
            <option value="title">Titelsuche</option>
            <option selected value="tag">Tagsuche</option>
            <option value="both">Suche in Titel und Tags</option>
        </select>
        <div id="custom-search-input">
            <div class="input-group">
                <input type="text" class="search-query form-control" onkeyup="search(this.value)" placeholder="Video suche"/>
                <span class="input-group-btn">
                        <button type="button" disabled>
                            <span class="fa fa-search"></span>
                        </button>
                    </span>
            </div>
        </div>
    </div>

    <div class="row">
        <?php

        //Creating list of videos
        $db = new SQLite3("db/clipDatabase.db");
        $oneCreated = false;

        //If admin show every video
        //If user, show only videos, who user uploaded
        $res = $db->query("SELECT * FROM TVideos");

        while ($dsatz = $res->fetchArray(SQLITE3_ASSOC)) {
            $path = $db->querySingle("SELECT path FROM TVideos WHERE id=" . $dsatz['id']);
            $owner = $db->querySingle("SELECT UsName FROM TVideos WHERE id=" . $dsatz['id']);
            $title = $db->querySingle("SELECT title FROM TVideos WHERE id=" . $dsatz['id']);
            $oneCreated = true;
            //split tag string
            $tags = explode(',', $dsatz['tags']);


            echo '<div class="col-lg-6 portfolio-item tagTitle">';
            echo '<div class="card h-100">';
            echo '<video class="js-player" style="width: 100%; height: auto" controls preload="metadata">';
            echo "<source src='" . $path . "#t=0.1' type='video/mp4'>";
            echo 'Ihr Browser unterstützt kein Videoplayback!';
            echo '</video>';
            echo '<div class="card-body">';
            echo '<h4 class="card-title">';
            echo "<p class='title'>" . $title . "</p>";
            echo '</h4>';
            echo "Video wurde hochgeladen von: ";
            echo "<br>";
            echo "<b>" . $owner . "</b>";
            echo "<br>";
            if ($tags[0] !== "") {
                for ($i = 0; $i < count($tags); $i++) {
                    echo '<div class="tagLabel">';
                    echo $tags[$i];
                    echo '</div>';
                }
            }
            echo '</div>';
            echo '</div>';
            echo '</div>';

            echo '<script type="text/javascript">
                    content[count] = "'. $dsatz['tags'] .'";
                    count++;
                    
                  </script>';

        }

        //add line when there is no data
        if (!$oneCreated) {
            echo '<div class="row">';
            echo '<div class="col-lg-4 col-sm-6 portfolio-item">';
            echo '<div class="card h-100">';
            echo '<img class="card-img-top" src="http://placehold.it/700x400?text=Error" alt="">';
            echo '<div class="card-body">';
            echo '<h4 class="card-title">';
            echo '<p>Keine Videos gefunden</p>';
            echo '</h4>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }


        ?>
    </div>
</div>
<!-- /.container -->


<!-- Bootstrap core JavaScript -->
<script src="https://cdn.plyr.io/3.4.7/plyr.js"></script>
<script src="js/video.js"></script>
</body>

</html>
