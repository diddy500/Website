<?php
session_start();
$firstName = isset($_COOKIE['FirstName']) ? $_COOKIE['FirstName'] : "no";
$lastName = isset($_COOKIE['LastName']) ? $_COOKIE['LastName'] : "no";
$title = isset($_COOKIE['Title']) ? $_COOKIE['Title'] : "no";
$email = isset($_COOKIE['Email']) ? $_COOKIE['Email'] : "no";
$Password = isset($_COOKIE['Pass']) ? $_COOKIE['Pass'] : "no";
$HomeTele = isset($_COOKIE['HomeTele']) ? $_COOKIE['HomeTele'] : "no";
$WorkTele = isset($_COOKIE['WorkTele']) ? $_COOKIE['WorkTele'] : "no";
$Address1 = isset($_COOKIE['Address1']) ? $_COOKIE['Address1'] : "no";
$Address2 = isset($_COOKIE['Address2']) ? $_COOKIE['Address2'] : "no";
$Province = isset($_COOKIE['Province']) ? $_COOKIE['Province'] : "no";
$CreditCardType = isset($_COOKIE['CreditCardType']) ? $_COOKIE['CreditCardType'] : "no";
$CreditCardNumber = isset($_COOKIE['CreditCardNumber']) ? $_COOKIE['CreditCardNumber'] : "no";
$CardholderName = isset($_COOKIE['CardholderName']) ? $_COOKIE['CardholderName'] : "no";
$ExpMonth = isset($_COOKIE['ExpMonth']) ? $_COOKIE['ExpMonth'] : "no";
$ExpYear = isset($_COOKIE['ExpYear']) ? $_COOKIE['ExpYear'] : "no";
$LanguagePref = isset($_COOKIE['LanguagePref']) ? $_COOKIE['LanguagePref'] : "no";
$InterestSpaceX = isset($_COOKIE['InterestSpaceX']) ? $_COOKIE['InterestSpaceX'] : "false";
$InterestTesla = isset($_COOKIE['InterestTesla']) ? $_COOKIE['InterestTesla'] : "false";
$InterestHyper = isset($_COOKIE['InterestHyper']) ? $_COOKIE['InterestHyper'] : "false";

//hashing pass
$hashedPassword = password_hash($Password, PASSWORD_DEFAULT);


$db_connection = mysqli_connect("localhost", "root", "", "devinvanwart");

//seeing if email is already registered
$checkSQL = "SELECT Email FROM customers WHERE Email = '$email'";
$wasSuccess;
if(mysqli_num_rows(mysqli_query($db_connection, $checkSQL)) < 1)
{
    $sql = "INSERT INTO `customers`(`Email`, `FName`, `LName`, `Title`, `Password`, `HomeTele`, `WorkTele`, `Address1`, `Address2`, `Province`, `ccType`, `ccNumber`, `ccName`, `ccMonth`, `ccYear`, `LanguagePref`, `InterestSpaceX`, `InterestTesla`, `InterestHyper`) VALUES ('" . $email . "','" . $firstName . "','" . $lastName . "','" . $title . "','" . $hashedPassword . "','" . $HomeTele . "','" . $WorkTele . "','" . $Address1 . "','" . $Address2 . "','" . $Province . "','" . $CreditCardType . "','" . $CreditCardNumber . "','" . $CardholderName . "','" . $ExpMonth . "','" . $ExpYear . "','" . $LanguagePref . "'," . $InterestSpaceX . "," . $InterestTesla . "," . $InterestHyper . ")";
    mysqli_query($db_connection, $sql);
    $wasSuccess = TRUE;
}
else
{
    $wasSuccess = FALSE;
}
?>

<!DOCTYPE html>
<html>

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>
            Register : Elon's World
        </title>



        <meta name="description"  		content="Register an account on Elon's World!" />
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
                        
                        if($wasSuccess)
                        {
                            echo ('<h3>' . $firstName . ' ' . $lastName . '</h3>');
                            echo ('<p>Thank you for registering! You can now sign in.</p>');
                        }
                        else
                        {
                            echo ('<h3>Error</h3>');
                            echo ('<p>This email is already associated with an account.</p>');
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

