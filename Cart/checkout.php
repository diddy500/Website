<!DOCTYPE html>
<?php
session_start();

$db_connection = mysqli_connect("localhost", "root", "", "devinvanwart");
?>
<html>

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="UTF-8">

        <title>
            Checkout : Elon's World
        </title>



        <meta name="description"  		content="Checkout your cart!" />
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
                        if (isset($_SESSION['user'])) {
                            if (isset($_GET['checkout'])) {
                                
                                $itemTotal = 0;
                                
                                for($i = 0; $i < $_SESSION['num_products']; $i++)
                                {
                                    $itemTotal += $_SESSION['num_products'][$i]['qty'];
                                }
                                
                                if($itemTotal > 0){
                                    $checkoutSQL = "INSERT INTO orders(Email) VALUES ('" . $_SESSION['user'] . "')";
                                    mysqli_query($db_connection, $checkoutSQL);

                                    $orderID = mysqli_insert_id($db_connection);
                                    for($i = 0; $i < $_SESSION['num_products']; $i++)
                                    {
                                        $checkoutSQL = "INSERT INTO orderlines(OrderID, ProductCode, Quantity) VALUES ( '" . $orderID . "', '" . $_SESSION['cart'][$i]['name'] . "', " . $_SESSION['cart'][$i]['qty'] . ")";
                                        mysqli_query($db_connection, $checkoutSQL);

                                    }

                                    // unset variables
                                    $_SESSION['cart'] = array(); //  empty array
                                    unset($_SESSION['num_items']);
                                    unset($_SESSION['num_products']);
                                    // destroy the session
                                    session_destroy();

                                    echo '<h2>Checked out successfully.</h2>';
                                }
                                else
                                {
                                    echo '<h2>Cart is empty</h2><p>Please select some items before checking out.</p>';
                                }
                            } 
                            else {
                                echo '
                                <h2>Are you sure you want to check out?</h2>
                                <p><a href="Checkout.php?checkout=1" class="btn btn-default" role="button">Yes</a>  <a href="javascript: history.go(-1)" class="btn btn-default" role="button">No</a></p>
                                ';
                            }
                        }
                        else
                        {
                            echo('<h2>Please sign in to check out</h2>');
                            echo('<p><a href="/reg/signin.php" class="btn btn-default" role="button">Sign in</a></p>');
                        }
                        ?>
                        <a href="index.php" class="btn btn-default" role="button">Back to Cart</a><br />
                    </div>
                </div>

                <div class="row">
                    <?php include("../include/Footer.php"); ?>
                </div>

            </div>

        </div>

    </body>


</html>

