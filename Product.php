<?php
session_start();
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
header("Pragma: no-cache");
?> 

<?php
//getting connection
$db_connection = mysqli_connect("localhost", "root", "", "devinvanwart")or die("Not connected: " . mysql_error());

$PageID = empty($_GET['PageID']) ? "" : $_GET['PageID'];
if (!$PageID) {
    $PageID = 100;
}

$pageSQL = $sql = "SELECT `PageID`, `Department`, `Category`, `Meta` FROM `pageids` WHERE PageID = " . $PageID . ";";
$pageRS = mysqli_query($db_connection, $pageSQL) or die($pageSQL . " : " . mysql_error());


//getting recordset

$pageRow = mysqli_fetch_array($pageRS);
if (!$pageRow['Department'] || !$pageRow['Category']) {
    $PageID = 100;
    $pageSQL = $sql = "SELECT `PageID`, `Department`, `Category`, `Meta` FROM `pageids` WHERE PageID = " . $PageID . ";";
    $pageRS = mysqli_query($db_connection, $pageSQL) or die($pageSQL . " : " . mysql_error());
    $pageRow = mysqli_fetch_array($pageRS);
}
$department = $pageRow['Department'];
$category = $pageRow['Category'];
$sql = "SELECT `ProductCode`, `AltImageRef`, `ProductName`, `ProductDescription`, `Category`, `Department`, `ThumbHeight`, `Price`, `SalePrice`, `SaleStart`, `SaleEnd`, `Feature1`, `Feature2`, `Feature3`, `Feature4`, `NumInStock` FROM `products` WHERE `Category`= '" . $category . "' AND `Department` = '" . $department . "'";
$prodRS = mysqli_query($db_connection, $sql) or die($sql . " : " . mysql_error());
?>

<html>

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>
            <?php echo($pageRow['Category'] . " : " . $pageRow['Department'] . " : Elon's World") ?> 
        </title>

        <?php echo("<meta name='description'  		content='" . $pageRow['Meta'] . "' />") ?>
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

        <script type="text/javascript">

            $(document).ready(function () {
                $(".open-review").click(function () {
                    $('#prodCode').val($(this).data('code'));
                    $.get("ajaxServer.php", {"code": $(this).data('code')}, updateModal);
                });
            });

            function updateModal(data)
            {
                $("#previously_submitted_comments").empty();
                $("#reviewForm").show();

                var commentDiv;
                if (data == "")
                {
                    commentDiv = '<div class="user_comment" id="thefirst">'
                            + '<p>Customer reviews are submitted by consumers like you everyday! '
                            + 'These perspectives are a series of views of the product in different settings '
                            + 'that may help you in your purchasing decisions. '
                            + 'We do not filter reviews based on positive or negative content.</p>'
                            + '</div>';

                    $("#previously_submitted_comments").prepend(commentDiv);
                    return;
                }

                var data = $.parseJSON(data);
                $.each(data, function (key, value)
                {
                    commentDiv = '<div class="user_comment">'
                            + '<h5><span class="user_comment_name">'
                            + 'Commented by: ' + value[0]
                            + '</span></h5>'
                            + '<p>Rating: <img src="Images/stars_rating_0' + value[2] + '.gif" alt=""></p>'
                            + '<p class="user_comment_text">'
                            + value[1]
                            + '</p></div>';

                    $("#previously_submitted_comments").prepend(commentDiv);
                });


            }

            function frmComment_submit() {



                // The $.get function is one utilization of JQuery's ajax capability
                $.get("ajaxServer.php", $("#reviewForm").serializeArray(),
                        // Parameter 3: the callback function
                                function (data) {

                                    // Build a comment element to be added to the page
                                    var commentDiv = '<div class="user_comment">'
                                            + '<h5><span class="user_comment_name">'
                                            + 'You commented:'
                                            + '</span></h5>'
                                            + '<p>Rating: <img src="Images/stars_rating_0' + data.Rating + '.gif" alt=""></p>'
                                            + '<p class="user_comment_text">'
                                            + data.Review
                                            + '</p></div>';

                                    // Change #4 - effects added
                                    // Prepend the comment to the appropriate element
                                    $("#previously_submitted_comments").prepend(commentDiv).slideDown("slow");
                                    // Comment was submitted, so hide "the first" message
                                    $("#thefirst").hide();
                                    $("#reviewForm").hide();

                                },
                                "json"
                                );
                        return false;
                    }



        </script>

    </head>

    <body>

        <!-- navbar content -->
        <?php include('/include/Navbar.php'); ?>
        <!-- end of navbar content -->


        <!-- Main -->
        <div class="wrap">

            <div class='container'>



                <?php include ('Reviews.php'); ?>


                <div class="row">
                    <!-- left ads -->
                    <div class="col-md-2">
                        <?php include ('Include/LeftAds.php'); ?>
                    </div>
                    <!-- left ads end -->
                    <!-- Display a product -->  
                    <div class="col-md-10">
                        <?php
                        while ($row = mysqli_fetch_array($prodRS)) {

                            $ratingRS = mysqli_query($db_connection, "Select Rating FROM reviews WHERE ProductCode='" . $row['ProductCode'] . "'");
                            $rating = 0;
                            $ratingNum = 0;
                            $isRated = true;
                            while ($ratingRow = mysqli_fetch_row($ratingRS)) {
                                $rating += $ratingRow[0];
                                $ratingNum++;
                            }
                            if ($ratingNum > 0) {
                                $rating /= $ratingNum;
                                $rating = round($rating);
                            } else {
                                $rating = 0;
                                $isRated = false;
                            }

                            $image;
                            if ($row['AltImageRef']) {
                                $image = $row['AltImageRef'];
                            } else {
                                $image = $row['ProductCode'];
                            }
                            echo("
                <div class='row'>
                    <div class='col-sm-2'>
                        <!-- Note Product Code in 2 spots... internal label for linking to, and link for large image -->
                        <a name='" . $row['ProductCode'] . "'></a> <a href=javascript:CaricaFoto('/" . $pageRow['Department'] . "/Images/" . $image . ".jpg')>
                            <!-- Note Product Code in thumbnail -->
                            <img src='/" . $pageRow['Department'] . "/Images/" . $image . "_sm.jpg' border='0' height='" . $row['ThumbHeight'] . "' width='100' /> </a>
                    </div>
                    <div class='col-sm-10'>
                        <!-- Note Product Code in link for large image -->
                        <b><a href=javascript:CaricaFoto('/" . $pageRow['Department'] . "/Images/" . $row['ProductCode'] . ".jpg')>" . $row['ProductName'] . "</a></b>
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
                        <!-- Note Product Code in URL parameter for shopping cart -->");
                            if($isRated)
                            {
                                echo ("<p>Overall rating: <img src='Images/stars_rating_0" . $rating . ".gif' alt=''></p>");
                            }
                            else
                            {
                                echo ("<p>Overall rating: Product is not yet rated</p>");
                            }
                                    
                            if (isset($_SESSION['user'])) {
                                echo("<div class='col-md-6'>
                                        <button type='button' class='btn btn-info open-review' data-toggle='modal' data-code='" . $row['ProductCode'] . "' data-target='#reviewModal'>View Comments</button>
                                        <button type='button' class='btn btn-info open-review' data-toggle='modal' data-code='" . $row['ProductCode'] . "' data-target='#reviewModal'>Write Comment</button>
                                    </div>");
                            } 
                            else 
                            {
                                echo("<div class='col-md-6'>
                                        <button type='button' class='btn btn-info open-review' data-toggle='modal' data-code='" . $row['ProductCode'] . "' data-target='#reviewModal'>View Comments</button>
                                    </div>");
                            }
                            echo ("
                        
                        <div class='col-md-6'>
                        <form action='/Cart/index.php' method='GET' class='form-inline'>
                            <input type='hidden' name='product' value='" . $row['ProductCode'] . "'>
                            <input type='text' class='form-control' name='quantity' value='1'>
                            <input type='submit' class='btn btn-dafault' value='Add to cart'>
                        </form>
                        </div>
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
                    <?php include("include/Footer.php"); ?>
                </div>
                <!-- End of Footer -->	

            </div>
        </div>
        <!-- End of Main -->







    </body>


</html>