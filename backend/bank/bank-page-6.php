    <?php
    $sql0 = "SELECT * from salarysummery where sccode='$sccode' and month='$month' and year='$year' and category='pf' and status=1";  //ORDER BY , ID
    $result0qt1 = $conn->query($sql0);if ($result0qt1->num_rows > 0) {while($row0 = $result0qt1->fetch_assoc()) {  
        $refno=$row0["refno"]; $slotname=$row0["slot"]; $chqamt=$row0["amount"];  $refdate=$row0["issuedate"];  $chqno=$row0["chequeno"]; 

    ?>
    
    <div style="border:0px dashed gray; padding:8mm 10mm;   page-break-before:always;  ">
    <?php include 'assets/pad/temp-01.php';?>
    
    
    <div style="">
        To,<br>
        The Manager,<br>
        <?php echo $pfbankname;?>Janata Bank Limited<br>
        <?php echo $pfbrname;?>Ramkrishnopur Branch, Homna, Cumilla.<br>
        
        <br>
        Subject : <b>Regarding depositing a total of <?php echo $chqamt;?> taka in the following bank accounts.</b>
        <br><br>Sir,
        <br>
        It is requested to deposit a total of taka =<?php echo $chqamt;?>/- (<?php echo taka($chqamt);?>)   of the provident fund of <span id="cnt"></span> teachers / staffs  in the institute in the following bank accounts.
        <br>
        Cheque No. <?php echo $chqno;?>
    </div>
    
    <div style="padding:5px; margin: 10px auto; border-bottom: 1px solid gray; width: 40%; text-align:center; font-size:16px; font-weight:700;">
        Month : &nbsp;&nbsp;&nbsp; <?php echo $mtxt;?>
    </div>
    
    <div style="height:30px;"></div>
    <table style="width:100%; font-size:14px;" class="table table-striped">
        <thead>
            <tr>
                <th>SL</th>
                <th>Name of Teacher's/Staff's</th>
                <th>Designation</th>
                <th>Account No.</th>
                <th>Amount (BDT)</th>
            </tr>
        </thead>
    <?php
    $sl = 1; $taka6 = 0;
    $sql0 = "SELECT * from salarydetails where refnopf='$refno' and slots = '$slotname' and pf>0 order by ranks, joindate "; 
    $result0qt2 = $conn->query($sql0);if ($result0qt2->num_rows > 0) {while($row0 = $result0qt2->fetch_assoc()) {  
    $tid=$row0["tid"]; $amount=$row0["pf"];  $accno=$row0["accnopf"];   $bname=$row0["banknamepf"];   $bbr=$row0["bankbrpf"]; 
    
    $sql0 = "SELECT * from teacher where tid='$tid' and sccode = '$sccode'  "; 
    $result0qt3 = $conn->query($sql0);if ($result0qt3->num_rows > 0) {while($row0 = $result0qt3->fetch_assoc()) {  
    $tname=$row0["tname"];  $posi=$row0["position"];  $mpoindex=$row0["mpoindex"];
    }}
    
    ?>
        <tr>
            <td style="padding:1px 5px;"><?php echo $sl;?></td>
            <td style=" padding:1px 5px;"><?php echo $tname;?></td>
            <td style=" padding:1px 5px;"><?php echo $posi;?></td>
            <!--<td><?php echo $bname;?></td>-->
            <!--<td><?php echo $bbr;?></td>-->
            <td style=" padding:1px 5px;"><?php echo $accno;?></td>
            <td style="text-align:right; padding:1px 5px;"><?php echo number_format($amount*2);?></td>
        </tr>
    <?php
    $sl++; $taka6 += $amount*2;
    }}
    

    ?>
       <thead>
            <tr>
                <th colspan="4">Grand Total :</th>
                <th><?php echo $taka6;?></th>
            </tr>
        </thead>
               
    </table>             
    
    <div style="font-size:13px;">
        Amount in word : <b><?php echo taka($taka6);?></b>
    </div>
    
    
    <?php include 'assets/pad/seal.php';?>
                    
    </div>
    
    
    <?php     }} ?>