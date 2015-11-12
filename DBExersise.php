<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"    
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">   
<html xmlns="http://www.w3.org/1999/xhtml"  xml:lang="en" lang="en"> 
    <head> 
        <meta http-equiv="content-type" content="text/html;charset=iso-8859-1" /> 
        <title>DB Exercise</title> 
    </head> 
    <?php
    $conn = mysqli_connect("localhost","root","");
    $sqlStr = "SELECT `ID`, `Category`, `Description`, `Image`, `Price`, `Option1Desc`, `Option1a`, `Option1b`, `Option1c`, `Option1d`, `Option2Desc`, `Option2a`, `Option2b`, `Option2c`, `Option2d` FROM `productsdemo`.`products` LIMIT 0, 1000;";
    $demoRS = mysqli_query($conn, $sqlStr) OR die(mysqli_error());
    
    echo "<table border=1>";
    echo "<tr><td>ID</td><td>Category</td><td>Description</td><td>Image</td><td>Price</td><td>Option1Desc</td><td>Option1a</td><td>Option1b</td><td>Option1c</td><td>Option1d</td><td>Option2Desc</td><td>Option2a</td><td>Option2b</td><td>Option2c</td><td>Option2d</td></tr>";
    while ($demoRow = mysqli_fetch_array($demoRS))
    {
        echo "<tr>";
        echo "<td>" . $demoRow["ID"] . "</td>";
        echo "<td>" . $demoRow["Category"] . "</td>";
        echo "<td>" . $demoRow["Description"] . "</td>";
        echo "<td>" . $demoRow["Image"] . "</td>";
        echo "<td>" . $demoRow["Price"] . "</td>";
        echo "<td>" . $demoRow["Option1Desc"] . "</td>";
        echo "<td>" . $demoRow["Option1a"] . "</td>";
        echo "<td>" . $demoRow["Option1b"] . "</td>";
        echo "<td>" . $demoRow["Option1c"] . "</td>";
        echo "<td>" . $demoRow["Option1d"] . "</td>";
        echo "<td>" . $demoRow["Option2Desc"] . "</td>";
        echo "<td>" . $demoRow["Option2a"] . "</td>";
        echo "<td>" . $demoRow["Option2b"] . "</td>";
        echo "<td>" . $demoRow["Option2c"] . "</td>";
        echo "<td>" . $demoRow["Option2d"] . "</td>";
        echo "</tr>";
        
    }
    echo "</table>";
    ?>
</body> 
</html>
