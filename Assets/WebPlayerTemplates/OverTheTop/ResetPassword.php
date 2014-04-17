<?php
include 'DBConnection.php';

$Email = $_GET['Email'];
$ID = $_GET['ID'];

$id = "Invalid";

/* create a prepared statement */
if ($stmt = $mysqli->prepare("UPDATE User SET PasswordValidation=? WHERE Email=? AND ID=?"))
{
    /* bind parameters for markers */
    $stmt->bind_param("sss", md5("Blast"), $Email, $ID);

    /* execute query */
    $stmt->execute();

    /* close statement */
    $stmt->close();
}

include 'DBClose.php';

echo "Password Updated";

?>