    <?php
    $sql0 = "SELECT * from salarysummery where sccode='$sccode' and month='$month' and year='$year' and  (category='govt' or particulareng LIKE '%govt%') and status = 1";  //ORDER BY , ID
    $result0qt1 = $conn->query($sql0);if ($result0qt1->num_rows > 0) {while($row0 = $result0qt1->fetch_assoc()) {  
        $refno=$row0["refno"]; $slotname=$row0["slot"]; $chqamt=$row0["amount"];  $refdate=$row0["issuedate"];  $cat=$row0["category"]; 

    ?>
    
    <div style="border:0px dashed gray; padding:7mm 15mm; page-break-before:always; ">
    <?php include 'assets/pad/temp-01.php';?>
    
    
    <div style="padding:5px; margin: 50px auto 0px;5width: 100%; text-align:center; font-size:14px; font-weight:500;">
        The official salary (M.P.O.) bill of the teachers and staff of the school is as follows
    </div>
    <div style="padding:5px; margin: 10px auto; border-bottom: 1px solid gray; width: 40%; text-align:center; font-size:16px; font-weight:700;">
        Month : &nbsp;&nbsp;&nbsp; <?php echo $mtxt;?>
    </div>
    
    
    <div style="height:30px;"></div>
    <table style="width:100%;" class="table table-striped">
        <thead>
            <tr>
                <th>SL</th>
                <th>Name of Teacher's/Staff's</th>
                <th>Index No</th>
                <th>Account No.</th>
                <th>Amount (BDT)</th>
            </tr>
        </thead>
    <?php
    $sl = 1; $taka = 0;
    $sql0 = "SELECT * from salarydetails where refnogovt='$refno' and slots = '$slotname' and govt>0 order by ranks, joindate "; 
    $result0qt2 = $conn->query($sql0);if ($result0qt2->num_rows > 0) {while($row0 = $result0qt2->fetch_assoc()) {  
    $tid=$row0["tid"]; $govt=$row0["govt"];$ex1=$row0["govtcol1"];$ex2=$row0["govtcol2"];  $accno=$row0["accno"]; 
    
    $sql0 = "SELECT * from teacher where tid='$tid' and sccode = '$sccode'  "; 
    $result0qt3 = $conn->query($sql0);if ($result0qt3->num_rows > 0) {while($row0 = $result0qt3->fetch_assoc()) {  
    $tname=$row0["tname"];  $mpoindex=$row0["mpoindex"];
    }}
    
    if($cat == 'govt'){$amount = $govt;} else if($cat == 'Eid'){$amount = $ex1;} else if($cat == 'Boishakhi'){$amount = $ex2;}
    
    
    ?>
        <tr>
            <td style="; padding:1px 5px;"><?php echo $sl;?></td>
            <td style="; padding:1px 5px;"><?php echo $tname;?></td>
            <td style="text-align:center; padding:1px 5px;"><?php echo $mpoindex;?></td>
            <td style="text-align:center; padding:1px 5px;"><?php echo $accno;?></td>
            <td style="text-align:right; padding:1px 5px;"><?php echo number_format($amount,2);?></td>
        </tr>
    <?php
    $sl++; $taka += $amount;
    }}
    

    ?>
       <thead>
            <tr>
                <th colspan="4">Grand Total :</th>
                <th><?php echo $taka;?></th>
            </tr>
        </thead>
               
    </table>             
    
    <div style="font-size:13px;">
        Amount in word : <b><?php echo taka($taka);?></b>
    </div>
    
    
    <?php include 'assets/pad/seal.php';?>
                    
    </div>
    
    
    <?php     }} ?>