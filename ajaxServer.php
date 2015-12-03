<?php

session_start();
$db = mysqli_connect("localhost", "root", "", "devinvanwart");

if (isset($_GET['code'])) 
{
    $rs = mysqli_query($db, "SELECT `DisplayName`, `Review`, `Rating` FROM `reviews` WHERE ProductCode = '" . $_GET['code'] . "'");
    while ($row = mysqli_fetch_all($rs)) 
    {
        $json_out = json_encode($row);
    }
    if(isset($json_out))
    {
        echo $json_out;
    }
} 
else if(isset($_GET['prodCode']))
{
    mysqli_query($db, "INSERT INTO reviews (ProductCode, Email, DisplayName, Review, Rating ) VALUES ('"
            . mysqli_real_escape_string($db, $_GET['prodCode']) .
            "', '"
            . mysqli_real_escape_string($db, $_SESSION['user']) .
            "', '"
            . mysqli_real_escape_string($db, $_GET['name']) .
            "', '"
            . mysqli_real_escape_string($db, $_GET['review']) .
            "', "
            . mysqli_real_escape_string($db, $_GET['optRating']) .
            ")"
    );


    $insert_id = mysqli_insert_id($db);

    $rs = mysqli_query($db, "SELECT DisplayName, Review, Rating FROM reviews WHERE ReviewID={$insert_id}");

    while ($row = mysqli_fetch_assoc($rs)) {
        $json_out = json_encode($row);
    }

    echo $json_out;
}
else if(isset($_GET['department']))
{
    $dept = $_GET['department'];

    $sql="SELECT DISTINCT category FROM products WHERE department = '" . mysqli_real_escape_string($db, $dept) . "'";
    $rs = mysqli_query($db,$sql);

    while($row = mysqli_fetch_array($rs)) {
        echo "<option value='" . $row["category"] . "'>" . $row["category"] . "</option>";
    }
}


mysqli_close($db);
?>