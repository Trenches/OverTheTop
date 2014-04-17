<?php
include 'DBConnection.php';

$Email = $_GET['Email'];
$PWD = $_GET['PWD'];

$id = "Invalid";

/* create a prepared statement */
if ($stmt = $mysqli->prepare("SELECT ID FROM User WHERE Email=? AND PasswordValidation=?"))
{
    /* bind parameters for markers */
    $stmt->bind_param("ss", $Email, md5($PWD));

    /* execute query */
    $stmt->execute();

    /* bind result variables */
    $stmt->bind_result($id);

    /* fetch value */
    $stmt->fetch();

    /* close statement */
    $stmt->close();
}

include 'DBClose.php';

echo $id;

?>