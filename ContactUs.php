<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<?php
session_start();
?>
<HTML>

    <HEAD>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <TITLE>Contact Us : Elon's World</TITLE>

        <meta name="description"  	content="Unoffical homepage to the Tesla, SpaceX and Hyperloop shopping center!" />
        <meta name="author"       	content="Devin Vanwart, Devin.Vanwart@gmail.com" />
        <meta name="designer"       	content="Nick Taggart, nick.taggart@nbcc.ca" />

        <!-- Boopstrap CSS -->
        <link href="/Include/bootstrap-3.3.5-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="/Include/bootstrap-3.3.5-dist/js/bootstrap.min.js" type="text/javascript"></script>

        <META HTTP-EQUIV="Page-Enter" CONTENT="revealTrans(Duration=2.0,Transition=2)">
        <!--  Hello, eager student.  Why are you looking at the source code of this page??? -->
        <!--  I bet you are looking for this transition code because you think it's cool -->
        <!--  and you want to put it on lots of your pages!  Well, use with discretion. -->
        <!-- It's neat the first dozen times you see it, but gets annoying after that. -->
        <LINK HREF="Include/Generic.css" TYPE="text/css" REL="STYLESHEET">
        <link href="Include/ProductPage.css" type="text/css" rel="stylesheet" />
        <STYLE>
            #LeftAds{
                position: static;
            }
        </STYLE>
    </HEAD>

    <BODY>
        <div class="wrap">
            <!-- navbar content -->
            <?php include('/include/Navbar.php'); ?>
            <!-- end of navbar content -->

            <div class="container">
                <div class="row">
                    <!-- Left Ads -->
                    <div class="col-md-2">
                        <?php include ('/Include/LeftAds.php'); ?>
                    </div>
                    <!-- End of Left Ads -->
                    <div class="col-md-10 well">
                        <div class="row">
                            <div class="col-md-6">
                                <h1>Contact Information</h1>
                                <h2>Telephone:</h2>
                                <ul class="list-group">
                                    <li class="list-group-item">Office: 1(506)555-5555</li>
                                    <li class="list-group-item">Toll-free: 1(506)555-5555</li>
                                </ul>
                                <h2>Email:</h2>
                                <ul class="list-group">
                                    <li class="list-group-item">Site Admin: <a href="mailto:Devin.Vanwart@gmail.com">Devin.Vanwart@gmail.com</a></li>
                                    <li class="list-group-item">Customer Support: <a href="mailto:#">good@luck.net</a></li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d11093.951008198223!2d-66.65128481730207!3d45.96151678193602!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4ca418a1ed8947b7%3A0xa78e5c32d0c03fed!2sDowntown%2C+Fredericton%2C+NB!5e0!3m2!1sen!2sca!4v1443119120279" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <?PHP include ('/include/footer.php'); ?>
                </div>
            </div>
        </div>
    </BODY>
</HTML>

