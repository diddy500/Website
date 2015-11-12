<?php
session_start();
?>
<!DOCTYPE html>
<html>

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>
            Registration : Elon's World
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

        <script language="javascript">

            function EditFields(frm)
            {

                var success = true;
                var message = "";
                var firstError = "";

                //setting all fields to ok
                var elements = frm.elements;
                for (var i = 0; i < elements.length; i++)
                {
                    elements[i].parentNode.className = "form-group";
                }

                //validation start
                if (elements["FName"].value === "")
                {
                    // Remember the first field that trips an edit so I can set focus later
                    if (firstError === "")
                        firstError = elements["FName"];
                    elements["FName"].parentNode.className = "form-group has-error";
                    message += "First name is required\n";
                }

                if (elements["LName"].value === "")
                {
                    // Remember the first field that trips an edit so I can set focus later
                    if (firstError === "")
                        firstError = elements["LName"];
                    elements["LName"].parentNode.className = "form-group has-error";
                    message += "Last name is required\n";
                }

                if (elements["Title"].value === "")
                {
                    // Remember the first field that trips an edit so I can set focus later
                    if (firstError === "")
                        firstError = elements["Title"];
                    elements["Title"].parentNode.className = "form-group has-error";
                    message += "Title is required\n";
                }

                var regEx = /[^\s@]+@[^\s@]+\.[^\s@]+/;
                if (elements["Email"].value === "")
                {
                    
                    // Remember the first field that trips an edit so I can set focus later
                    if (firstError === "")
                        firstError = elements["Email"];
                    elements["Email"].parentNode.className = "form-group has-error";
                    message += "Email is required\n";


                }
                else if (!regEx.test(elements["Email"].value))
                {
                    if (firstError === "")
                        firstError = elements["Email"];
                    elements["Email"].parentNode.className = "form-group has-error";
                    message += "Please enter a valid email\n";
                }

                if (elements["Pass"].value === "")
                {
                    // Remember the first field that trips an edit so I can set focus later
                    if (firstError === "")
                        firstError = elements["Pass"];
                    elements["Pass"].parentNode.className = "form-group has-error";
                    message += "Password is required\n";
                }

                if (elements["ConfPass"].value === "")
                {
                    // Remember the first field that trips an edit so I can set focus later
                    if (firstError === "")
                        firstError = elements["ConfPass"];
                    elements["ConfPass"].parentNode.className = "form-group has-error";
                    message += "Password confirmation is required\n";

                }

                if (elements["ConfPass"].value !== elements["ConfPass"].value)
                {
                    if (firstError === "")
                        firstError = elements["Pass"];
                    elements["ConfPass"].parentNode.className = "form-group has-error";
                    elements["Pass"].parentNode.className = "form-group has-error";
                    message += "Passwords must match\n";
                }

                if (elements["HTele"].value === "")
                {
                    // Remember the first field that trips an edit so I can set focus later
                    if (firstError === "")
                        firstError = elements["HTele"];
                    elements["HTele"].parentNode.className = "form-group has-error";
                    message += "Home telephone is required\n";
                }

                if (elements["Address1"].value === "")
                {
                    // Remember the first field that trips an edit so I can set focus later
                    if (firstError === "")
                        firstError = elements["Address1"];
                    elements["Address1"].parentNode.className = "form-group has-error";
                    message += "Address 1 is required\n";
                }

                if (elements["Prov"].value === "")
                {
                    // Remember the first field that trips an edit so I can set focus later
                    if (firstError === "")
                        firstError = elements["Prov"];
                    elements["Prov"].parentNode.className = "form-group has-error";
                    message += "Province is required\n";
                }

                if (elements["ccType"].value === "")
                {
                    // Remember the first field that trips an edit so I can set focus later
                    if (firstError === "")
                        firstError = elements["ccType"];
                    elements["ccType"].parentNode.className = "form-group has-error";
                    message += "Credit card type is required\n";
                }

                if (elements["ccNum"].value === "")
                {
                    // Remember the first field that trips an edit so I can set focus later
                    if (firstError === "")
                        firstError = elements["ccNum"];
                    elements["ccNum"].parentNode.className = "form-group has-error";
                    message += "Credit card number is required\n";
                }

                if (elements["ccName"].value === "")
                {
                    // Remember the first field that trips an edit so I can set focus later
                    if (firstError === "")
                        firstError = elements["ccName"];
                    elements["ccName"].parentNode.className = "form-group has-error";
                    message += "Cardholder name is required\n";
                }

                if (elements["ccMonth"].value === "")
                {
                    // Remember the first field that trips an edit so I can set focus later
                    if (firstError === "")
                        firstError = elements["ccMonth"];
                    elements["ccMonth"].parentNode.className = "form-group has-error";
                    message += "Expiry month is required\n";
                }

                if (elements["ccYear"].value === "")
                {
                    // Remember the first field that trips an edit so I can set focus later
                    if (firstError === "")
                        firstError = elements["ccYear"];
                    elements["ccYear"].parentNode.className = "form-group has-error";
                    message += "Expiry year is required\n";
                }

                if (!(elements["optLang"].value))
                {
                    // Remember the first field that trips an edit so I can set focus later
                    if (firstError === "")
                        firstError = elements["optLang"][1];
                    elements["optLang"][1].parentNode.className = "form-group has-error";
                    message += "Language preference is required\n";
                }

                //end of validation checking for failed validation 
                if (message !== "")
                {
                    success = false;
                    alert(message);
                }
                return success;
            }
            
            function WriteCookies(frm)
            {
                var success = true;
                
                if(EditFields(frm))
                {
                    var strExpDate = " path=/; expires=Monday, 31-Dec-2016 12:00:00 GMT;";
                    
                    document.cookie = "FirstName=" + frm.elements["FName"].value + ";" + strExpDate;
                    document.cookie = "LastName=" + frm.elements["LName"].value + ";" + strExpDate;
                    document.cookie = "Title=" + frm.elements["Title"].value + ";" + strExpDate;
                    document.cookie = "Email=" + frm.elements["Email"].value + ";" + strExpDate;
                    document.cookie = "Pass=" + frm.elements["Pass"].value + ";" + strExpDate;
                    document.cookie = "HomeTele=" + frm.elements["HTele"].value + ";" + strExpDate;
                    document.cookie = "WorkTele=" + frm.elements["WTele"].value + ";" + strExpDate;
                    document.cookie = "Address1=" + frm.elements["Address1"].value + ";" + strExpDate;
                    document.cookie = "Address2=" + frm.elements["Address2"].value + ";" + strExpDate;
                    document.cookie = "Province=" + frm.elements["Prov"].value + ";" + strExpDate;
                    document.cookie = "CreditCardType=" + frm.elements["ccType"].value + ";" + strExpDate;
                    document.cookie = "CreditCardNumber=" + frm.elements["ccNum"].value + ";" + strExpDate;
                    document.cookie = "CardholderName=" + frm.elements["ccName"].value + ";" + strExpDate;
                    document.cookie = "ExpMonth=" + frm.elements["ccMonth"].value + ";" + strExpDate;
                    document.cookie = "ExpYear=" + frm.elements["ccYear"].value + ";" + strExpDate;
                    document.cookie = "LanguagePref=" + frm.elements["optLang"].value + ";" + strExpDate;
                    document.cookie = "InterestSpaceX=" + frm.elements["chkSpcX"].checked + ";" + strExpDate;
                    document.cookie = "InterestTesla=" + frm.elements["chkTesl"].checked + ";" + strExpDate;
                    document.cookie = "InterestHyper=" + frm.elements["chkHprl"].checked + ";" + strExpDate;
                    
                    success = true;
                }
                else
                {
                    success = false;
                }
                return success;
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

                        <!-- Input form -->  
                        <form name="regForm" action="Register.php" onsubmit="return WriteCookies(document.regForm)" method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label"  for="fName">First Name:</label>
                                        <input type='text' name="FName" id="fName" class="form-control" tabindex="1">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label"  for="title">Title:</label>
                                        <select name="Title" id="title" class="form-control" tabindex="3">
                                            <option></option>
                                            <option>Mr</option>
                                            <option>Mrs</option>
                                            <option>Miss</option>
                                            <option>Ms</option>
                                            <option>Dr</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label"  for="pass">Password:</label>
                                        <input type='password' name="Pass" id="pass" class="form-control" tabindex="5">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label"  for="hTele">Home Telephone:</label>
                                        <input type='text' name="HTele" id="hTele" class="form-control" tabindex="7">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label"  for="adr1">Address Line 1:</label>
                                        <input type='text' name="Address1" id="adr1" class="form-control" tabindex="9">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label"  for="prov">Province:</label>
                                        <select name="Prov" id="prov" class="form-control" tabindex="11">
                                            <option></option>
                                            <option>Alberta</option>
                                            <option>British Columbia</option>
                                            <option>Manitoba</option>
                                            <option>New Brunswick</option>
                                            <option>Newfoundland and Labrador</option>
                                            <option>Nova Scotia</option>
                                            <option>Ontario</option>
                                            <option>Prince Edward Island</option>
                                            <option>Quebec</option>
                                            <option>Saskatchewan</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label"  for="ccNum">Credit Card Number:</label>
                                        <input type='text' name="ccNum" id="ccNum" class="form-control" tabindex="13">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label"  for="ccMonth">Expiry Month:</label>
                                        <select name="ccMonth" id="ccMonth" class="form-control" tabindex="15">
                                            <option></option>
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                            <option>6</option>
                                            <option>7</option>
                                            <option>8</option>
                                            <option>9</option>
                                            <option>10</option>
                                            <option>11</option>
                                            <option>12</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="optLang" >Language Preference:</label>
                                        <label class="radio-inline" for="opt1">English</label>
                                        <input type='radio' id="opt1" name="optLang" id="lang"  tabindex="17" value="English">
                                        <label class="radio-inline" for="opt2">French</label>
                                        <input type='radio' id="opt2" name="optLang" value="French">
                                        <label class="radio-inline" for="opt3">Spanish</label>
                                        <input type='radio' id="opt3" name="optLang" value="Spanish">
                                    </div>
                                </div>

                                <!-- Start of col 2 -->

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label"  for="lName">Last Name:</label>
                                        <input type='text' name="LName" id="lName" class="form-control" tabindex="2">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label"  for="email">Email:</label>
                                        <input type='email' name="Email" id="email" class="form-control" tabindex="4">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label"  for="confPass">Confirm Password:</label>
                                        <input type='password' name="ConfPass" id="confPass" class="form-control" tabindex="6">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label"  for="wTele">Work Telephone:</label>
                                        <input type='text' name="WTele" id="wTele" class="form-control" tabindex="8">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label"  for="adr2">Address Line 2:</label>
                                        <input type='text' name="Address2" id="adr2" class="form-control" tabindex="10">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label"  for="ccType">Credit Card Type:</label>
                                        <select name="ccType" id="ccType" class="form-control" tabindex="12">
                                            <option></option>
                                            <option>American Express</option>
                                            <option>Master Card</option>
                                            <option>Visa</option>            
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label"  for="ccName">Cardholder Name:</label>
                                        <input type='text' name="ccName" id="ccName" class="form-control" tabindex="14">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label"  for="ccYear">Expiry Year:</label>
                                        <select name="ccYear" id="ccYear" class="form-control" tabindex="16">
                                            <option></option>
                                            <option>2015</option>
                                            <option>2016</option>
                                            <option>2017</option>
                                            <option>2018</option>
                                            <option>2019</option>
                                            <option>2020</option>
                                            <option>2021</option>
                                            <option>2022</option>
                                            <option>2023</option>
                                            <option>2024</option>
                                            <option>2025</option>
                                        </select>                        </div>
                                    <div class="form-group">
                                        <label class="control-label" >Which Department(s) Interest You?</label><br>
                                        <label class="checkbox-inline" for="chkSpcX">SpaceX</label>
                                        <input type='checkbox' name="chkSpcX" tabindex="18">
                                        <label class="checkbox-inline" for="chkTesl">Tesla</label>
                                        <input type='checkbox' name="chkTesl" tabindex="19">
                                        <label class="checkbox-inline" for="chkHprl">Hyperloop</label>
                                        <input type='checkbox' name="chkHprl" tabindex="20">
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-default">Submit</button>
                                        <button type="reset" class="btn btn-default">Reset</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>

                <div class="row">
                    <?php include("../include/Footer.php"); ?>
                </div>

            </div>

        </div>

    </body>


</html>

