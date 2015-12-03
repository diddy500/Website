<?php
session_start();
if(!isset($_SESSION['user']) || $_SESSION['user'] != "admin@yoursite.com")
{
    die();
}


$db_connection = mysqli_connect("localhost", "root", "", "devinvanwart");

$deptSQL = "SELECT DISTINCT Department FROM pageids";
$deptRS = mysqli_query($db_connection, $deptSQL);

if ( isset($_FILES["uploadedfile"]) ) {
	
    $prodSQL = "SELECT ProductCode FROM products WHERE department ='" . $_POST['prodDepartment'] . "'";
    $prodRS = mysqli_query($db_connection, $prodSQL);
    
    $prodNum = 0;
    while($prodRow = mysqli_fetch_array($prodRS))
    {
        if($prodNum < intval(substr($prodRow[0], 4), 10))
        {
            $prodNum = intval(substr($prodRow[0], 4), 10);
            $prodCode = substr($prodRow[0], 0, 4);
        }
        
        
    }
    
    $prodNum++;
    $prodCode = $prodCode . str_pad($prodNum, 3, "0", STR_PAD_LEFT);    
    
    // Note the appearance of this message, showing you when this block of code is executed.
    // It is included for debug purposes only.												
    //echo 'I detect you are attempting to upload a Product.  Here are the results...<br/><br/>';

    // I'm just proving other form controls come along with the uploaded file.			
    //echo ( isset($_POST['txtProdID']) ? 'Product ID : ' . $_POST['txtProdID'] . '<br>' : " " );

    // Where our fullsized image is going (in this case, the Demos Images directory).	
    // Try $target_path = "../LanguageTrans/Images/"; 									
    $target_path = "../" . $_POST['prodDepartment'] . "/Images/";

    // Where our thumbnail is going (in this case, the Demos Images directory).			
    // Try $thumbnail_path = "../LanguageTrans/Images/";							 	
    $thumbnail_path = "../" . $_POST['prodDepartment'] . "/Images/";

    // The name of our file, extracted from the original filename of the image you uploaded.   	
    // If you want to call it anything else, this is the place to do it!						
    $filename = basename($prodCode . substr($_FILES["uploadedfile"]["name"], strrpos($_FILES["uploadedfile"]["name"], ".")));


    // Try to upload the file.			
    if( move_uploaded_file($_FILES["uploadedfile"]["tmp_name"], $target_path . $filename) ) {
        //echo 'File uploaded successfully.<br />';

        // Check filetype to determine if uploaded file is an image.							
        // The site we have been developing only uses JPEGS (if you're been following specs).	
        // The PNG code is provided for your information only.									
        $acceptable_filetypes = array(".jpeg", ".jpg", ".png");
        $filetype = strtolower( substr($filename, strrpos($filename, ".")) );		
        if ( in_array($filetype, $acceptable_filetypes) ) {			
            // Try to create the thumbnail by calling the function provided below.		
            if ( CreateThumbnail($thumbnail_path , $target_path . $filename , $filetype) ) {
                //echo 'Thumbnail created successfully.<br />';
                $prodSQL = "INSERT INTO products(ProductCode, Department, Category, ProductName, ProductDescription, Price, NumInStock) VALUES ('"
                        . $prodCode
                        . "', '"
                        . $_POST['prodDepartment']
                        . "', '"
                        . $_POST['prodCategory']
                        . "', '"
                        . $_POST['prodName']
                        . "', '"
                        . $_POST['prodDescription']
                        . "', '"
                        . $_POST['prodPrice']
                        . "', '"
                        . $_POST['prodStock']
                        . "')";
                $prodRS = mysqli_query($db_connection, $prodSQL);
                
            } 
            else {
                //echo 'There was an error creating the thumbnail.<br />';
            }
        } 
        else {
            //echo 'File must be jpeg, jpg, or png to create a thumbnail.<br />';
        }

    } 
    else {
       //echo 'There was an error uploading the file.<br />';
    }
}

?>




<?php
// This function is only executed by the logic above.  The PHP engine does not "automatically" drop into it.


function CreateThumbnail($thumb_dir, $file, $filetype, $thumb_width = 100, $thumb_height = 6000 ) {
// Incoming parameters : 	Thumbnail Directory Path														
//							Name of fullsize image															
//							Type of image ( .jpg, .jpeg, .png )												
//							Desired thumbnail width (defaults to maximum 100 if nothing is passed)			
//							Desired thumbnail height (defaults to maximum 6000 if nothing is passed)		
//
// Responsibilities :		Creates a thumbnail of size 100x? in format FullsizeName_sm.??? , 				
//							where ??? is the original extension , and places into the specified directory	
//
// Return Value :			TRUE if thumbnail sucessfully created, FALSE otherwise.							


	// Create image handle using GD functions.																		
	// ImageCreateFromPNG() returns an image identifier representing the image obtained from the given filename. 	
	// Ref http://ca.php.net/manual/en/function.imagecreatefrompng.php												
	// ImageCreateFromJPEG() returns an image identifier representing the image obtained from the given filename.	
	// Ref http://ca.php.net/manual/en/function.imagecreatefromjpeg.php												
    if( $filetype == ".png" ) {
        $base_img = ImageCreateFromPNG($file);
    }
    else if( ($filetype == ".jpeg") || ($filetype == ".jpg") ) {
        $base_img = ImageCreateFromJPEG($file);
    } 

    // If the image is broken, cancel the operation.								
    if ( !$base_img ) return false;

    // Get image sizes (width/height) from the image object we just created.		
    $img_width = imagesx($base_img);
    $img_height = imagesy($base_img);


    //  Resize the image, maintaining aspect ratio.																	
	
	//	Question - What's the ideal percentage to get to our preferred thumbnail width or height? 					
	//																												
	//  Because we want thumbnails of width 100, we forced the situation											
	//  by making $thumb_height ridiculously large above (6000).  For most circumstances, your thumbnails should	
	//  generate at 100 wide.   If you encounter odd situations which do not work, you may want to resize			
	//  the fullsized image before using this.																		
    $img_width_per  = $thumb_width / $img_width;
    $img_height_per = $thumb_height / $img_height;	

    if ($img_width_per <= $img_height_per)  {
		// Resize per the desired width (100) , and the appropriate height.									
        $thumb_width = $thumb_width;
        $thumb_height = intval($img_height * $img_width_per);
    }
    else {
		// Resize per the desired height.  This code should not be executed, but has been provided FYI.		
        $thumb_width = intval($img_width * $img_height_per);
        $thumb_height = $thumb_height;
    }

	// Create a new true color image using GD function.														
	// ImageCreateTrueColor() returns an image identifier representing a black image of the specified size. 
	// Ref http://php.net/manual/en/function.imagecreatetruecolor.php										
    $thumb_img = ImageCreateTrueColor($thumb_width, $thumb_height);

	// Copy our original image into our new thumbnail-sized image using GD function.						
	// ImageCopyResampled() copies a rectangular portion of one image to another image, smoothly 			
	// interpolating pixel values so that, in particular, reducing the size of an image still retains		
	// a great deal of clarity.																				
	// Ref http://ca.php.net/manual/en/function.imagecopyresampled.php										
    ImageCopyResampled($thumb_img, $base_img, 0, 0, 0, 0, $thumb_width, $thumb_height, $img_width, $img_height);

	// Put the newly created thumbnail in the specified directory from the incoming parameter list.			
	// The site we have been developing only uses JPEGS (if you're been following specs).	
	// The PNG code is provided for your information only.									
    if ( $filetype == ".png" )   {
        // Inject "_sm" into the filename to adhere to our thumbnail naming convention.						
		// str_replace() replaces all occurrences of the search string with the replacement string,			
		// and returns the newly constructed string.														
		// Ref http://php.net/manual/en/function.str-replace.php											
		// We're saying " in the filename xyz.png, replace '.png' with '_sm.png' , resulting in xyz_sm.png "
		$tmb = "_sm";	
		$ext = ".png";
		$file = str_replace($ext , $tmb.$ext , $file);
		
		// ImagePNG() - Output a PNG image to either the browser or a file.									
		// Ref http://php.net/manual/en/function.imagepng.php												
		ImagePNG($thumb_img, $thumb_dir . basename($file));
    }
    else if ( ($filetype == ".jpeg") || ($filetype == ".jpg") )   {        
		// Inject "_sm" into the filename to adhere to our thumbnail naming convention.						
		// See above for further explanation.																
		$tmb = "_sm";
		$ext = ($filetype==".jpg")? ".jpg" : ".jpeg";
		$file = str_replace($ext , $tmb.$ext , $file);
			
		// ImageJPEG() - Output a JPEG image to either the browser or a file.								
		// Ref http://php.net/manual/en/function.imagejpeg.php												
		ImageJPEG($thumb_img, $thumb_dir . basename($file));		
    }
	
	// And a little housekeeping...																			
	// ImageDestroy() frees any memory associated with image.												
	// Ref http://php.net/manual/en/function.imagedestroy.php												
    ImageDestroy($base_img);
    ImageDestroy($thumb_img);

    return true;
}

// function CreateThumbnail() ends here.																	
?>

<!DOCTYPE html>
<html>

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="UTF-8">

        <title>
            Admin : Elon's World
        </title>



        <meta name="description"  		content="Admin page" />
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
        function getCategorys(dept) 
        {
            
            xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() 
            {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
                {
                    document.getElementById("prodCategory").innerHTML = xmlhttp.responseText;
                }			
            }
            xmlhttp.open("GET", "/ajaxServer.php?department=" + dept, true);
            xmlhttp.send();
            
        }
        $(function() 
        {
        getCategorys(document.getElementById("prodDepartment").value);
        });
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
                        
                        <h1>Create Product</h1>
                        <form enctype="multipart/form-data" action="#" method="POST">

                                <input type="hidden" name="MAX_FILE_SIZE" value="10000000" >
                                <div class="form-group">
                                    <select name="prodDepartment" id="prodDepartment" class="form-control" onchange="getCategorys(this.value)">
                                        <?php
                                        while ($deptRow = mysqli_fetch_array($deptRS))
                                        {
                                            echo('<option value=' . $deptRow["Department"] . '>' . $deptRow["Department"] . '</option>');
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select name="prodCategory" id="prodCategory" class="form-control">
                                        <option>Category</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="prodName">Name:</label>
                                    <input type="text" name="prodName" id="prodName" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="prodDescription">Description:</label>
                                    <textarea name="prodDescription" id="prodDescription" class="form-control" rows="4" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="prodPrice">Price:</label>
                                    <input type="number" name="prodPrice" id="prodPrice" min="0" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="prodStock">Starting Stock Amount:</label>
                                    <input type="number" name="prodStock" id="prodStock" min="0" class="form-control" required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="uploadedfile">Choose an image to upload:</label>
                                    <input name="uploadedfile" id="uploadedfile" type="file" accept="image/jpeg" required>
                                </div>
                                
                                <div class="form-group">
                                    <input type="submit" value="Upload File" class="btn btn-default">
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