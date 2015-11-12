<!-- based off http://www.w3schools.com/bootstrap/bootstrap_navbar.asp -->
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="pull-left" href="#"><IMG src="/Images/logo.jpg" alt="Elon's World"></a>
        </div>
        <div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="/index.php">Home</a></li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="/Product.php?PageID=300">Tesla<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/Product.php?PageID=300">Model S</a></li>
                        <li><a href="/Product.php?PageID=301">Model X</a></li>
                        <li><a href="/Product.php?PageID=302">Merch</a></li> 
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="/Product.php?PageID=100">SpaceX<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/Product.php?PageID=100">Manned</a></li>
                        <li><a href="/Product.php?PageID=101">Shared Cargo</a></li>
                        <li><a href="/Product.php?PageID=102">Heavy Cargo</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="/Product.php?PageID=200">Hyperloop<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/Product.php?PageID=200">Passenger</a></li>
                        <li><a href="/Product.php?PageID=201">Cargo</a></li>
                        <li><a href="/Product.php?PageID=202">Merch</a></li> 
                    </ul>
                </li>
                <li><a href="/ContactUs.php">Contact Us</a></li>
                <li>
                    <form class="navbar-form" action="../search/index.php" method="get">
                        <div class="input-group">
                            <input class="form-control" type="text" name="txtsearch" placeholder="Search" size="15" />
                            <div class="input-group-btn">
                                <input type="image" src="../images/go.gif" border="0" width="26" height="21"  align="middle" /> 
                            </div>
                        </div>
                    </form>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="/Reg/signin.php"><span class="glyphicon glyphicon-user"></span> You are not signed in<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/Reg/signin.php">Sign in</a></li>
                        <li><a href="/Reg/index.php">Register</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="/Cart/index.php"><span class="glyphicon glyphicon-shopping-cart"></span> Cart<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/Cart/index.php">0 Items</a></li>
                        <li><a href="/Cart/checkout.php">Checkout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>