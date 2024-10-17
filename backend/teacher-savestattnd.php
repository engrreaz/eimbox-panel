<?php

	include ('inc2.php');;
	$adate= $_POST['adate'];;
    $cn = $_POST['cls'];
	$sn = $_POST['sec'];
	$opt = $_POST['opt'];
    
    if($opt == 2){  // save attandance
        $iii = $_POST['stid'];
    	$roll = $_POST['roll'];
    	$yn = $_POST['val'];
    	$per = $_POST['per'];
    	if($yn=='true'){$yn=1;} else {$yn=0;}
    	
    	
        $sql0 = "SELECT * FROM stattnd where stid='$iii' and adate='$adate' and sessionyear='$sy'"; 
        $result0 = $conn->query($sql0);
        if ($result0->num_rows > 0) {
            if($per<2){
                $query33 = "UPDATE stattnd SET yn = '$yn', period1 = '$yn', period2 = '$yn', period3 = '$yn', period4 = '$yn', period5 = '$yn', period6 = '$yn', period7 = '$yn', period8 = '$yn', entryby = '$usr' WHERE stid='$iii' and adate='$adate' and sessionyear='$sy' and sccode='$sccode'";
            } else {
                $cd = '';
                for($i=$per;$i<=8; $i++){
                    $cd .= 'period' .  $i . '=' . $yn . ', ';
                }
                $cd .= 'period1=1 ';
                $query33 = "UPDATE stattnd SET $cd  WHERE stid='$iii' and adate='$adate' and sessionyear='$sy' and sccode='$sccode'";
            }
            $conn->query($query33) ;
        } else {
        
            $query33 ="insert into stattnd (id, sccode, sessionyear, stid, adate, yn, entryby, classname, sectionname, rollno, period1) values 	(NULL, '$sccode', '$sy', '$iii','$adate','$yn','$usr','$cn','$sn', '$roll', '$yn')"; 
            $conn->query($query33);
        }
        // echo $query33;
        
        if($yn==1){
            echo '<span class="chk green"><i class="bi bi-check2-circle"></i></span>';
        } else {
            echo '<span class="chk red"><i class="bi bi-x-circle"></i></span>';
        }
        
    } else if($opt == 5){ // save final submition
        $cnt = $_POST['cnt'];
        $fnd = $_POST['fnd'];
        $rate = $fnd*100/$cnt;
        $query33 ="insert into stattndsummery (id, sccode, sessionyear, date, classname, sectionname, totalstudent, attndstudent, attndrate, submitby, submittime) 
                                            values 	(NULL, '$sccode', '$sy', '$adate','$cn','$sn','$cnt','$fnd','$rate', '$usr', '$cur')"; 
        $conn->query($query33);echo $query33;
        echo 'Submit Successfully.';
    }