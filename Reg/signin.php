<?php
session_start();
?>

<!DOCTYPE html>
<html>

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="UTF-8">

        <title>
            Sign In : Elon's World
        </title>



        <meta name="description"  		content="Sign in to your Elon's World account!" />
        <meta name="author"       		content="Devin Vanwart, Devin.Vanwart@gmail.com" />
        <meta name="designer"       	content="Nick Taggart, nick.taggart@nbcc.ca" />

        <link href="/Include/bootstrap-3.3.5-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>

        <link rel="shortcut icon" href="/favicon.ico">

        <script language="javascript" src="/Include/menuitems.js" type="text/javascript"></script>
        <script language="javascript" src="/Include/menu.js" type="text/javascript"></script>
        <script language="javascript" src="/Include/caricafoto.js" type="text/javascript"></script>


        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="/Include/bootstrap-3.3.5-dist/js/bootstrap.min.js" type="text/javascript"></script>

        <link href="/Include/ProductPage.css" type="text/css" rel="stylesheet" />

    </head>

    <body>

        <!-- navbar content -->
        <?php include('../include/Navbar.php'); ?>
        <!-- end of navbar content -->


        <!-- Main -->
        <div class="wrap">-

            <div class='container'>


                <div class="row">

                    <div class="col-md-2">
                        <?php include ('../Include/LeftAds.php'); ?>
                    </div>

                    <div class="col-md-10">




                        <?php
                        //check if already signed in
                        if (isset($_SESSION["user"])) {

                            echo ("<h2>You are currently signed in</h2>");
                        }
                        //check if form was submitted
                        else if (isset($_POST["email"])) {
                            $email = $_POST["email"];

                            $db_connection = mysqli_connect("localhost", "root", "", "devinvanwart");
                            $sql = "SELECT Email, Password FROM customers WHERE Email = '$email'";
                            $rs = mysqli_query($db_connection, $sql);
                            $results = mysqli_fetch_array($rs);

                            //check passwords
                            if (password_verify($_POST["password"], $results[1])) {
                                echo('<h2>Successfully logged in as ' . $results[0] . '.</h2><p>Use the menu to start shopping!</p>');
                                $_SESSION["user"] = $results[0];
                            }
                            //show failed login and form
                            else {
                                echo('<h2>Incorrect username or password.</h2>
                                    <form action="" method="POST">
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email">
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                            <button type="submit" class="btn btn-dafault">Sign In</button>                         
                        </form>');
                            }
                        }
                        //show form
                        else {
                            echo('
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email">
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                            <button type="submit" class="btn btn-dafault">Sign In</button>                         
                        </form>');
                        }
                        ?>


                    </div>
                </div>

                <div class="row">
                    <?php include("../include/Footer.php"); ?>
                </div>

            </div>

        </div>

    </body>


</html>

