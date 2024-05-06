<?php 
    session_start(); 
    date_default_timezone_set('Asia/Dhaka');;
    
    $usr = $_SESSION["user"];
     $userlevel = 'Guest';
    
    $pxx = '';
    
    include 'db.php'; 
    
    //*****************************************************************
    $sy = date('Y');
    $td = date('Y-m-d');
    $cur = date('Y-m-d H:i:s');
    
    //********************************************************************
    
 $exam = 'Test';
    
    $sql0 = "SELECT * FROM usersapp where email='$usr' LIMIT 1";
 //   echo $sql0;
        $result0 = $conn->query($sql0);
        if ($result0->num_rows > 0) 
        {while($row0 = $result0->fetch_assoc()) { 
            $token = $row0["token"]; $sccode = $row0["sccode"];  $fullname = $row0["profilename"];  $mobile = $row0["mobile"];  
            $userlevel = $row0["userlevel"];  $userid = $row0["userid"];   $pth = $row0["photourl"]; $exam = $row0["curexam"]; $sy = $row0["session"];
               $otp = $row0["otp"];    $otptime = $row0["otptime"]; 
        }} else {
            $_SESSION["user"] = '';  $sccode = 99; $userlevel = 'Guest'; 
        }
//        echo $usr . $token;
        if($sccode > 100) {
            $sql0x = "SELECT * FROM scinfo where sccode='$sccode' LIMIT 1"; //echo $sql0x;
            $result0x = $conn->query($sql0x);
            if ($result0x->num_rows > 0) 
            {while($row0x = $result0x->fetch_assoc()) { 
            $scname = $row0x["scname"]; $scadd1 = $row0x["scadd1"];  $scadd2 = $row0x["scadd2"];  $ps = $row0x["ps"];  $dist = $row0x["dist"];    $logo = $row0x["logo"];  
            $mobile = $row0x["mobile"];   $rootuser = $row0x["rootuser"];    $pack = $row0x["pack"];   $short = $row0x["short"]; 
            
            $scmail = $row0x["scmail"];    $scweb = $row0x["scweb"]; 
            
            $progressguar = $row0x["progressguar"]; 
            
                    $scaddress = $scadd1 . ', ' . $ps . ', ' . $dist;
                    $contact = $mobile;
            }}
            
            if($userlevel == 'Administrator' || $userlevel == 'Head Teacher'){
                if($scname == '' || $scadd1 == '' || $scadd2 = '' || $ps == '' || $dist == '' || $contact == '' || $logo == '' ){
                    header("Location: settingsinstituteinfo.php");
                } else if($pack == 0){
                    header("Location: accountbuypack.php");
                }
            }
            
            if($userlevel == 'Guest'){
                //
                //session_start();
                    
                    //header("Location: index.php");
                $pxx = "We noticed that,<br>You're in under review by you Head Teacher / any Administrator.<br> Contact with your authority. <br><br> <b>OR</b><br>You may change your EIIN information.";
            }
        }
        
        
        $l = strlen($pth);
        if($l<5){
            $pth = "https://eimbox.com/images/no-image.png";
        }

     
        if($usr==''){
            $scname = ''; $scaddress = '';
            ?>
            <div class="card  noprint" style="background:var(--dark); color:white;  padding:5px; border-radius:0;"  >
             <div class="container">
                    <div class="container noprint" style="padding:8px; position:absolute; right:10px;">
                
                    </div>
                   <div style="text-align:center;">
                       <table style="margin:auto;">
                           <tr>
                               <td><img src="https://android.eimbox.com/iimg/logo.png" style="width:70px;"> </td>
                               <td><span style="font-size:36px; font-weight:bold; margin-top:8px; color:white;">EIMBox</span></td>
                           </tr>
                       </table>
                       
                       
                   </div>
                    
             </div>
        </div>
            
            
            <?php
            
            if($_SERVER['REQUEST_URI'] != "/index.php"){
                //header('location:https://web.eimbox.com');
                header("Location: index.php");
            }
            
            
        } else {
        
        ?>
         <div class="card  noprint" style="background:var(--dark); color:white;  padding:20px 0 10px 0; border-radius:0;"  >
             <div class="container">
                    <div class="container noprint" style="padding:8px; position:absolute; right:10px;">
                    <?php include 'nav.php'; ?>
                    </div>
                    <div style="float:right; text-align:right;">
                        <img src="<?php echo $pth;?>" class="picx" style="width:50px; height:50px; border-radius:50%;" /><br>
                                    <div class="b"><?php echo $fullname;?></div>
                                     <div class="c"><?php echo $userlevel;?></div>
                                     <div class="" style="font-size:14px; font-weight:bold;"><?php echo $scname;?></div>
                                     <div class="c"><?php echo $scaddress;?></div>
                    </div>
                    
             </div>
        </div>
            
            
            
            <?php
        }
        
         include 'footer.php';
         
         
           
         

 
?>