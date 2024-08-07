    <?php
    $sql0 = "SELECT * from salarysummery where sccode='$sccode' and month='$month' and year='$year' and category='school' and status = 1";  //ORDER BY , ID
    $result0qt1 = $conn->query($sql0);if ($result0qt1->num_rows > 0) {while($row0 = $result0qt1->fetch_assoc()) {  
        $refno=$row0["refno"]; $slotname=$row0["slot"]; $chqamt=$row0["amount"];  $refdate=$row0["issuedate"]; 

    ?>
    
    <div style="border:0px dashed gray; padding:8mm 15mm;  page-break-before:always;  ">
    <?php include 'assets/pad/temp-01.php';?>
    
    
    <div style="padding:5px; margin: 50px auto 0px;5width: 100%; text-align:center; font-size:18px; font-weight:500;">
        Salary & Allowance provided by the Institute
    </div>
    <div style="padding:5px; margin: 10px auto; border-bottom: 1px solid gray; width: 40%; text-align:center; font-size:16px; font-weight:700;">
        Month : &nbsp;&nbsp;&nbsp; <?php echo $mtxt;?>
    </div>
    
    
    <div style="height:30px;"></div>
    <table style="width:100%; font-size:14px;" class="table table-striped">
        <thead>
            <tr>
                <th style="padding:1px 5px;">SL</th>
                <th style="padding:1px 5px;">Name of Teacher's/Staff's</th>
                <th style="padding:1px 5px;">Designation</th>
                <th style="text-align:right; padding:1px 5px;">Salary</th><th style="text-align:right; padding:1px 5px;">Mobile Bill</th>
                <th style="text-align:right; padding:1px 5px;">Exam</th><th style="text-align:right; padding:1px 5px;">Fest</th>
                <th style="text-align:right; padding:1px 5px;">Total</th><th style="text-align:right; padding:1px 5px;">PF</th><th style="text-align:right;">Net</th>
            </tr>
        </thead>
    <?php
    $sl = 1; $taka3 = 0;  
    $a1 = $b1 = $c1 = $d1 = $e1 = $f1 = $g1 = 0;
    $sql0 = "SELECT * from salarydetails where refnosch='$refno' and slots = '$slotname' order by ranks, joindate, tid ";  //echo $sql0;
    $result0qt2 = $conn->query($sql0);if ($result0qt2->num_rows > 0) {while($row0 = $result0qt2->fetch_assoc()) {  
    $tid=$row0["tid"]; $salary=$row0["salary"];  $mpa=$row0["mpa"];   $pf=$row0["pf"];   $arrears=$row0["arrear2"]; 
      $ex1=$row0["festival"];   $ex2=$row0["exam"];       $ex1=$row0["schoolcol1"];   $ex2=$row0["schoolcol2"];   
    $mott = $salary + $mpa  +  $ex1 + $ex2 - $pf;
    
    $sql0 = "SELECT * from teacher where tid='$tid' and sccode = '$sccode'  "; 
    $result0qt3 = $conn->query($sql0);if ($result0qt3->num_rows > 0) {while($row0 = $result0qt3->fetch_assoc()) {  
    $tname=$row0["tname"];  $posi=$row0["position"];  $mpoindex=$row0["mpoindex"];
    }}
    
    ?>
        <tr>
            <td><?php echo $sl;?></td>
            <td><?php echo $tname;?></td>
            <td><?php echo $posi;?></td>
            <td style="text-align:right;"><?php echo $salary;?></td>
            <td style="text-align:right;"><?php echo $mpa;?></td>
            <td style="text-align:right;"><?php echo $ex1;?></td>
            <td style="text-align:right;"><?php echo $ex2;?></td>
            <td style="text-align:right;"><?php echo $salary + $mpa + $ex1 + $ex2;?></td>
            <td style="text-align:right;"><?php echo $pf;?></td>
            <td style="text-align:right;"><?php echo $mott;?></td>
        </tr>
    <?php
    $sl++; $taka3 += $mott;
    $a1 += $salary; $b1 += $mpa; $c1 += $ex1; $d1 += $ex2; $e1 += $salary + $mpa + $ex1 + $ex2; $f1 += $pf; $g1 += $mott;
    }}
    

    ?>
       <thead>
            <tr>
                <th colspan="3">Grand Total :</th>
                <th style="text-align:right;"><?php echo $a1;?></th>
                <th style="text-align:right;"><?php echo $b1;?></th>
                <th style="text-align:right;"><?php echo $c1;?></th>
                <th style="text-align:right;"><?php echo $d1;?></th>
                <th style="text-align:right;"><?php echo $e1;?></th>
                <th style="text-align:right;"><?php echo $f1;?></th>
                
                
                
                
                <th style="text-align:right; text-decoration:double; font-size:16px;"><?php echo $taka3;?></th>
            </tr>
        </thead>
               
    </table>             
    
    <div style="font-size:13px;">
        Amount in word : <b>Taka <?php echo taka($taka3);?> Only.</b>
    </div>
    
    
    <?php include 'assets/pad/seal-both.php';?>
                    
    </div>
    
    
    <?php     }} ?>