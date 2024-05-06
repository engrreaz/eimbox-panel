<?php
	include ('db.php');;

	$qr= $_POST['qr'];; 
	

        $sql0 = "SELECT * FROM qrcodelogin where token='$qr' and status=1"; 
        $result0 = $conn->query($sql0); if ($result0->num_rows > 0) {while($row0 = $result0->fetch_assoc()) {   $email=$row0["email"];}}
        else {$email = '';}
                                        
    
        echo $email;

