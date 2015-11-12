<?php
session_start();

/*
		4U2Do!... add database connectivity code here...
*/


/*
 * 	INITIALIZE CART (only done first time here)
 *	The cart is actually just an array storing the product codes and cumulative quantities.
 *  We also have 2 variables to keep track of total number of items in the cart,
 *  and number of products.
 */

if (!isset($_SESSION['cart'])) {
	$_SESSION['cart'] = array();	//  create empty array
	$_SESSION['num_items'] = 0;
	$_SESSION['num_products'] = 0;
}


/*
 *	ADD ITEM TO CART (via URL parameters product and quantity... requires both)
 */

if (isset($_GET['product']) and isset($_GET['quantity'])) {

	// Check whether the item is already in the cart
	for ($i=0; $i<$_SESSION['num_products']; $i++) {
		if ($_SESSION['cart'][$i]['name'] == $_GET['product']) {
			$_SESSION['cart'][$i]['qty']+=$_GET['quantity'];
			$in_cart = true;
		}
	}
	
	// If item is not in cart, add it
	if (!isset($in_cart)) {
		$_SESSION['cart'][$_SESSION['num_products']]['name'] = $_GET['product'];
		$_SESSION['cart'][$_SESSION['num_products']]['qty'] = $_GET['quantity'];
		$_SESSION['num_products']++;
	}
	
	// Increment the number of cart items
	$_SESSION['num_items']+=$_GET['quantity'];
} 

?>


<html>
<head>
	<title>Shopping Cart Demo</title>
	<LINK HREF="../Include/Generic.css" TYPE="text/css" REL="STYLESHEET">
</head>

<body>



<TABLE WIDTH="100%" HEIGHT="100%" BGCOLOR="#FFFFFF">
<TR>
<TD><img src="../Images/50sShopping.jpg" width="168" height="170" border="0" align="right"></TD>
<TD ALIGN="LEFT" VALIGN="MIDDLE"> 
						 
<?php

/*
 *	DISPLAY CART CONTENTS
 */

for ($i=0; $i<$_SESSION['num_products']; $i++) {
	
	// Simple quantity modification mechanism
	echo '( <a href=index.php?product=' . $_SESSION['cart'][$i]['name'] . '&quantity=1>+</a> )  ';
	
	// Since these items are stored in a database,
	// we only need to store the product code (primary key?) in the session.
	echo $_SESSION['cart'][$i]['name'] . ' - ' . $_SESSION['cart'][$i]['qty'] . '<br />';
	
	/*
		4U2Do!... Do some database lookups and stuff to display product details...
	*/
}



/*
 *	CART FOOTER
 */

echo '<br /><hr width=60% /><br />';
echo 'Number of Items in Cart: ' . $_SESSION['num_items'] . '<br />';
echo 'Number of Products in Cart: ' . $_SESSION['num_products'] . '<br />';

if ($_SESSION['num_items'] != 0) {
   echo '<br /><br /><a href="javascript: history.go(-1)">Continue Shopping</a>';
   echo '<br /><a href="Checkout.php">Checkout</a>';
}
else {
   echo '<br /><br /><a href="../index.php">Visit our home page</a>';
}


?>

</TD>
</TR>
</TABLE>

<?php
// "Behind the scenes"
// Activate this code if you want to see all your session variables in readable format
// Useful for debugging!

	echo '<pre>';
		print_r($_SESSION);
	echo '</pre>';

?>
  
</body>
</html>
