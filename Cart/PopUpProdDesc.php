<?php

$_GET["ProdID"] = empty($_GET["ProdID"]) ? "TESL001" : $_GET["ProdID"];

$db_connection = mysqli_connect("localhost", "root", "", "devinvanwart");
$sql = $sql = "SELECT ProductDescription FROM products WHERE ProductCode = '" . $_GET["ProdID"] . "'";
$rs = mysqli_query($db_connection, $sql);
$result = mysqli_fetch_row($rs);
?>

<!DOCTYPE html>
<html>
    <head>
        <title><?php $_GET["ProdID"] ?></title>
    </head>
<?php

echo($result[0]);

?>
</html>