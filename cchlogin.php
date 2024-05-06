<?php
session_start();
include 'db.php';

$user = $_GET['em'];

$myStr = $_GET['token'];
$tkn = substr($myStr, 0, 30);

$sql0 = "SELECT * FROM qrcodelogin where email='$user' and token='$tkn'";
//  echo $sql0;
$result0 = $conn->query($sql0);
if ($result0->num_rows > 0) {
    while ($row0 = $result0->fetch_assoc()) {
        $_SESSION["user"] = $user;

        ?>
        <meta http-equiv="Refresh" content="0; url='index.php'" />
        <?php
    }
} else {
    echo 'invalid try';
}
