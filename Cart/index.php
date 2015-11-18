<?php
session_start();

/*
  4U2Do!... add database connectivity code here...
 */
$db_connection = mysqli_connect("localhost", "root", "", "devinvanwart");

/*
 * 	INITIALIZE CART (only done first time here)
 * 	The cart is actually just an array storing the product codes and cumulative quantities.
 *  We also have 2 variables to keep track of total number of items in the cart,
 *  and number of products.
 */

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array(); //  create empty array
    $_SESSION['num_items'] = 0;
    $_SESSION['num_products'] = 0;
}


/*
 * 	ADD ITEM TO CART (via URL parameters product and quantity... requires both)
 */

if (isset($_GET['product']) and isset($_GET['quantity'])) {

    // Check whether the item is already in the cart
    for ($i = 0; $i < $_SESSION['num_products']; $i++) {
        if ($_SESSION['cart'][$i]['name'] == $_GET['product']) {
            $_SESSION['cart'][$i]['qty']+=$_GET['quantity'];
            $in_cart = true;
        }
    }

    // If item is not in cart, add it
    if (!isset($in_cart)) {
        $_SESSION['cart'][$_SESSION['num_products']]['name'] = $_GET['product'];
        $_SESSION['cart'][$_SESSION['num_products']]['qty'] = $_GET['quantity'];
        $_SESSION['num_products'] ++;
    }

    // Increment the number of cart items
    $_SESSION['num_items']+=$_GET['quantity'];
    
}
?>

<!DOCTYPE html>
<html>

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="UTF-8">

        <title>
            Cart : Elon's World
        </title>



        <meta name="description"  		content="View your cart!" />
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
        
        <script>
            function PopUp(url, w, h)
            {
                window.open(url, 'PopUp', 'width=' + w + ', height=' + h +', toolbar=no, directories=no, status=no, scrollbars=no, resizable=no, menubar=no, location=no, copyhistory=no');
            }
        </script>

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
                        <table class="table table-hover">
                            
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Availability</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            
                            $grandTotal = 0;
                            
                            for ($i=0; $i<$_SESSION['num_products']; $i++)
                            {
                                
                                $cartSQL = "SELECT ProductName, NumInStock, Price FROM products WHERE ProductCode = '" . $_SESSION['cart'][$i]['name'] . "'";
                                $cartRS = mysqli_query($db_connection, $cartSQL);
                                $cartResult = mysqli_fetch_row($cartRS);
                                
                                $inStockText = ($cartResult[1] > 0) ? "In stock" : "Out of stock";
                                
                                $_SESSION['cart'][$i]['qty'] = ($_SESSION['cart'][$i]['qty'] < 0) ? 0 : $_SESSION['cart'][$i]['qty'];
                                if($_SESSION['cart'][$i]['qty'] > 0)
                                {
                                    echo('<tr>');
                                        echo('<th><a href=javascript:PopUp("PopUpProdDesc.php?ProdID=' . $_SESSION['cart'][$i]['name'] . '",300,300)>' . $cartResult[0] . '</a></th>');
                                        echo('<th>' . $inStockText . '</th>');
                                        echo('<th><a href=index.php?product=' . $_SESSION['cart'][$i]['name'] . '&quantity=-1>- </a>' . $_SESSION['cart'][$i]['qty'] . '<a href=index.php?product=' . $_SESSION['cart'][$i]['name'] . '&quantity=1> +</a></th>');
                                        echo('<th>' . $cartResult[2] . '</th>');
                                        echo('<th>' . ($_SESSION['cart'][$i]['qty'] * $cartResult[2]) . '</th>');
                                    echo('<tr>');
                                    
                                    $grandTotal += ($cartResult[0] * $cartResult[2]);
                                }
                                
                            }
                            
                            echo('<tr>');
                                echo('<th></th><th></th><th></th><th>Subtotal:</th>');
                                echo('<th>' . $grandTotal . '</th>');
                            echo('</tr>');
                            
                            ?>
                            </tbody>
                            
                        </table>
                    </div>
                </div>

                <div class="row">
                    <?php include("../include/Footer.php"); ?>
                </div>

            </div>

        </div>

    </body>


</html>

