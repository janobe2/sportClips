<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!--===============================================================================================-->

</head>
<body>

<div class="limiter">
    <div class="container-login100" style="background-image: url('images/bg-01.jpg');">
        <div class="wrap-login100">
            <form name="registerForm" class="login100-form validate-form" action="../php/registerHandling.php" method="post"
                  onsubmit="return validationRegister()">
					<span class="login100-form-logo">
						<i class="zmdi zmdi-landscape"></i>
					</span>

                <span class="login100-form-title p-b-34 p-t-27">
						SportClips
					</span>

                <?php

                function receiver($input){
                    if(isset($_SESSION[$input]))
                        return $_SESSION[$input];
                    else
                        return "";
                }

                session_start();

                if(isset($_SESSION["errorMessage"])){
                 echo "<p id='loginError' class='error'>". $_SESSION["errorMessage"]."</p>";
                }

                ?>

                <div class="wrap-input100 validate-input" data-validate="Name eingeben">
                    <input class="input100" id="name" type="text" name="name" placeholder="Vollständiger Name" value="<?php echo receiver("name")?>">
                    <span class="focus-input100" data-placeholder="&#xf207;"></span>
                </div>

                <div class="wrap-input100 validate-input" data-validate="Benutzername eingeben">
                    <input class="input100" id="username" type="text" name="username" placeholder="Anmeldename" value="<?php echo receiver("username")?>">
                    <span class="focus-input100" data-placeholder="&#xf207;"></span>
                </div>

                <div class="wrap-input100 validate-input" data-validate="Email eingeben">
                    <input class="input100" id="email" type="email" name="email" placeholder="Email" value="<?php echo receiver("email")?>">
                    <span class="focus-input100" data-placeholder="&#xf207;"></span>
                </div>

                <div class="wrap-input100 validate-input" data-validate="Passwort eingeben">
                    <input class="input100" id="password" type="password" name="password"
                           placeholder="Passwort eingeben">
                    <span class="focus-input100" data-placeholder="&#xf191;"></span>
                </div>

                <div class="wrap-input100 validate-input" data-validate="Passwort wiederholen">
                    <input class="input100" id="passwordRepeat" type="password" name="passwordRepeat"
                           placeholder="Passwort wiederholen">
                    <span class="focus-input100" data-placeholder="&#xf191;"></span>
                </div>

                <div class="container-login100-form-btn">
                    <button class="login100-form-btn">
                        Registrieren
                    </button>
                </div>
            </form>
            <hr class="loginAddition">
            <p class="loginAddition">Du hast schon ein Login?</p>
            <div class="container-login100-form-btn">
                <button class="login100-form-btn" onclick="window.location.href='login.php'">
                    Jetzt Einloggen
                </button>
            </div>
            <br>
            <a href="../php/guestLogin.php"><p class="information">Als Gast anmelden</p></a>
        </div>
    </div>
</div>


<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script src="https://unpkg.com/popper.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/daterangepicker/moment.min.js"></script>
<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
<script src="js/main.js"></script>

<?php
//delete session
session_destroy();
?>


</body>
</html>