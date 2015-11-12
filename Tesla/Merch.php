<?php
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
header("Pragma: no-cache");
?> 

<?php
//getting connection
$db_connection = mysqli_connect("localhost", "root", "", "devinvanwart")or die("Not connected: " . mysql_error());

//getting recordset
$department = "Tesla";
$category = "Merch";
$sql = "SELECT `ProductCode`, `AltImageRef`, `ProductName`, `ProductDescription`, `Category`, `Department`, `ThumbHeight`, `Price`, `SalePrice`, `SaleStart`, `SaleEnd`, `Feature1`, `Feature2`, `Feature3`, `Feature4`, `NumInStock` FROM `products` WHERE `Category`= '" . $category . "' AND `Department` = '" . $department . "'";
$rs = mysqli_query($db_connection, $sql) or die($sql . " : " . mysql_error());
?>

<html>

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>
            Merch : Tesla : Elon's World
        </title>

        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
        <meta name="description"  		content="Shop for Tesla's merchandise and gifts" />
        <meta name="author"       		content="Devin Vanwart, Devin.Vanwart@gmail.com" />
        <meta name="designer"       	content="Nick Taggart, nick.taggart@nbcc.ca" />

        <link href="../Include/bootstrap-3.3.5-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>




        <link rel="shortcut icon" href="/favicon.ico">

        <script language="javascript" src="../Include/menuitems.js" type="text/javascript"></script>
        <script language="javascript" src="../Include/menu.js" type="text/javascript"></script>
        <script language="javascript" src="../Include/caricafoto.js" type="text/javascript"></script>


        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="../Include/bootstrap-3.3.5-dist/js/bootstrap.min.js" type="text/javascript"></script>

        <link href="/Include/ProductPage.css" type="text/css" rel="stylesheet" />
    </head>

    <body>

        <!-- navbar content -->
        <?php include('../include/Navbar.php'); ?>
        <!-- end of navbar content -->

        <!-- Main -->
        <div class="wrap">

            <div class='container'>

                <div class="row">
                    <!-- left ads -->
                    <div class="col-md-2">
                        <?php include ('../Include/LeftAds.php'); ?>
                    </div>
                    <!-- left ads end -->
                    <!-- Display a product -->  
                    <div class="col-md-10">
                        <?php
                        while ($row = mysqli_fetch_array($rs)) {
                            echo("
                <div class='row'>
                    <div class='col-sm-2'>
                        <!-- Note Product Code in 2 spots... internal label for linking to, and link for large image -->
                        <a name='" . $row['ProductCode'] . "'></a> <a href=javascript:CaricaFoto('Images/" . $row['ProductCode'] . ".jpg')>
                            <!-- Note Product Code in thumbnail -->
                            <img src='Images/" . $row['ProductCode'] . "_sm.jpg' border='0' height='" . $row['ThumbHeight'] . "' width='100' /> </a>
                    </div>
                    <div class='col-sm-10'>
                        <!-- Note Product Code in link for large image -->
                        <b><a href=javascript:CaricaFoto('Images/" . $row['ProductCode'] . ".jpg')>" . $row['ProductName'] . "</a></b>
                        <br />
                        <font class='small'>Product :: &nbsp; " . $row['ProductCode'] . "</font>
                        <br />
                        <font class='price'>$" . number_format($row['Price'], 2, ".", ",") . "</font>
                        <br />
                        <p>" . $row['ProductDescription'] . "</p>
                        ");
                            if ($row['Feature1'] != "") {

                                echo("<br /><br /><ul><li>" . $row['Feature1'] . "</li>");
                                if ($row['Feature2'] != "") {
                                    echo("<li>" . $row['Feature2'] . "</li>");
                                }
                                if ($row['Feature3'] != "") {
                                    echo("<li>" . $row['Feature3'] . "</li>");
                                }
                                if ($row['Feature4'] != "") {
                                    echo("<li>" . $row['Feature4'] . "</li>");
                                }
                                echo("</ul>");
                            }

                            echo("<br />
                        <!-- Note Product Code in URL parameter for shopping cart -->
                        <a href='../Cart/index.php?product=" . $row['ProductCode'] . "&quantity=1'>
                            <img alt='Add to Cart' src='../Images/addtocart.gif' border='0' align='right' width='74' height='21' /> </a>
                        <br clear='ALL' /><br /><br />
                        <p  align='right'><a href='#Top'>Back to Top</a></p>
                        <hr width='80%' color='#3366cc' />
                        <br /><br />				 				 
                    </div>
                </div>");
                        }
                        ?>

                        <!-- End of Display a product -->	   
                    </div>
                </div>
                <!-- Footer -->
                <div class="row">
                    <?php include("../include/Footer.php"); ?>
                </div>
                <!-- End of Footer -->	

            </div>
        </div>
        <!-- End of Main -->







    </body>


</html>