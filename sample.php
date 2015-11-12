<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"    
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">   
 <html xmlns="http://www.w3.org/1999/xhtml"  xml:lang="en" lang="en"> 
 <head> 
 <meta http-equiv="content-type" content="text/html;charset=iso-8859-1" /> 
 <title>Hello, World!</title> 
 </head>   
 <?php
 function Ternary($x) {
	$output = $x >30 ?"It's really hot" : ($x == 30 ? "It's hot" : "It's cool");
	return $output;
 }
 function DoStuff($x) {
	echo $x . "<BR>";
 }
 function SquareMe($x) {
	return $x * $x;
 }
 ?>
 <body>
 <?php 
 //this is a comment
 /* this is a multiline comment
 
 */
 $myString = "hello world";
 echo $myString . "<BR>";
 $x = 20;
 $y = 30;
 $z = "20";
 
 //echo $x + $y;
 $answer = $x + $y;
 $answer = $x - $y;
 $answer = $x * $y; //multiplication
 $answer = $x / $y; //division
 $answer == $x % $y; //mod operator
 $answer = $z . $x . $y;
 
 echo "the answer is " . $answer;
 if ($x ===  $z) {
	echo "they are equal<BR>";
}
else if ($x == $z) {
	echo "they are equal but different data types";
}
else {
	echo "NOT equal<BR>";
}
var_dump($z);//display the details of a variable

echo 'the file path \v \\n \\a is c:\\my documents<BR>';
echo 'the guy said "Hello" to me';
DoStuff("PHP is awesome");
$returnVal = SquareMe("asdf");
echo $returnVal;

//**** Exercises ******
// ** 1 **
echo "<table border='1'>";
//generate the table data showing number 1-7 multiplied by each other
//starting within the rows
for ($row = 1; $row<=7;  $row++) {
	echo "<TR>\n";
	//generate each entry in the row to create the columns
	for ($col = 1; $col <= 7; $col++) {
		//first, do the math
		$x = $col * $row;
		//then send the value to the table with the table data tags
		echo "<TD>$x</TD>\n";
	}
	echo "</TR>"; //close the table row
}
echo "</table>";

// ** 2 **
echo ternary(30);

// ** 3 **
$a = 4.2;
$b = 3.7;
$c = 2.1;
echo "<table border=1 cellspacing=0 cellpadding=0>
<TR><TD><font color=blue>Jimmy's GPA</td><TD>$$a</TD></font></tr>
<TR><TD><font color=blue>Susie's GPA</td><TD>$$b</TD></font></tr>
<TR><TD><font color=blue>Johnny's GPA</td><TD>$$c</TD></font></tr>
</table>";
// **** END Exercises *****

$DBconnection = mysqli_connect("localhost","root","");
$sql = "SELECT `ProductCode`, `AltImageRef`, `ProductName`, `ProductDescription`, `Category`, `Department`, `ThumbHeight`, `Price`, `SalePrice`, `SaleStart`, `SaleEnd`, `Feature1`, `Feature2`, `Feature3`, `Feature4`, `NumInStock` FROM `devinvanwart`.`products` LIMIT 0, 1000;";
$productsRS = mysqli_query($DBconnection, $sql) OR die(mysql_error());
echo "<table>";
while ($prodRow = mysqli_fetch_array($productsRS))
{
    echo "<tr>";
    echo "<td>" . $prodRow["ProductCode"] . "</td>";
    echo "<td>" . $prodRow["AltImageRef"] . "</td>";
    echo "<td>" . $prodRow["ProductName"] . "</td>";
    echo "<td>" . $prodRow["ProductDescription"] . "</td>";
    echo "<td>" . $prodRow["Category"] . "</td>";
    echo "<td>" . $prodRow["Department"] . "</td>";
    echo "<td>" . $prodRow["ThumbHeight"] . "</td>";
    echo "<td>" . $prodRow["Price"] . "</td>";
    echo "</tr>";
}
echo "</table>";
 ?>
 

 </body> 
 </html>
 
 
 
 
 
 
 
 
 
 
 
 