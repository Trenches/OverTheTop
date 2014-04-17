<?php
include 'DBConnection.php';

$Email = $_GET['Email'];

$id = "Invalid";

/* create a prepared statement */
if ($stmt = $mysqli->prepare("SELECT ID FROM User WHERE Email=?"))
{
    /* bind parameters for markers */
    $stmt->bind_param("s", $Email);

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

if($id != "Invalid")
	mail($Email, "Forgotten password for Over The Top", "Set a new password by following this link: http://192.168.2.117/ForgottenPassword.php?Email=" . $Email . "&ID=" . $id);

?>