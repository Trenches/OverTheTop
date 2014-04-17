<?php
include 'DBConnection.php';

$Name = $_GET['Name'];
$Email = $_GET['Email'];
$PWD = $_GET['PWD'];

$userCreationSucceded = true;
/* Prepared statement, stage 1: prepare */
if ($stmt = $mysqli->prepare("INSERT INTO User(ID, Name, Email, PasswordValidation, CreationDate) VALUES (UUID(), ?, ?, ?, NOW())"))
{
	/* Prepared statement, stage 2: bind and execute */
	if (!$stmt->bind_param("sss", $Name, $Email, md5($PWD))) {
		echo "Binding parameters failed: (" . $stmt->errno . ") " . $Name;
		$userCreationSucceded = false;
	}

	if(!$stmt->execute()){
		echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
		$userCreationSucceded = false;
	}

	/* explicit close recommended */
	$stmt->close();
}
else
{
	$userCreationSucceded = false;
}

include 'DBClose.php';

if($userCreationSucceded)
	echo "Ok";

?>