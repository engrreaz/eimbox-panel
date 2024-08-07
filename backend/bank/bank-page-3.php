    <?php
    $sql0 = "SELECT * from salarysummery where sccode='$sccode' and month='$month' and year='$year' and (category='govt' or category='Eid' or category='Boishakhi') and status=1 ";  //ORDER BY , ID
    $result0qt1 = $conn->query($sql0);if ($result0qt1->num_rows > 0) {while($row0 = $result0qt1->fetch_assoc()) {  
        $refno=$row0["refno"]; $slotname=$row0["slot"]; $chqamt=$row0["amount"];  $refdate=$row0["issuedate"];  $cat=$row0["category"]; 

    ?>
    <!---->
    
   <div style=" page-break-before:always; width:110%; ">
<div style="border:0px dashed gray; padding:8mm;  ">
    
    <div style="padding:5px; margin:0;  text-align:center; font-size:14px; font-weight:500;">
        <table style="width:100%; font-size:11px; ">
            <tr>
                <td colspan="3" style="font-size:14px; font-weight:600; text-align:center;">
                    Statement regarding disbursement of government salary portion of teachers/employees of private educational institutions
                </td>
            </tr>
            <tr>
                <td style="width;200px;">
                    BANBEIS : <?php echo $sccode;?>
                    <br>Institute Name : <?php echo $scname;?>
                    <br>Upzila : Bancharampur, &nbsp;&nbsp;&nbsp;&nbsp;District : Brahmanbaria.
                </td>
                <td>
                    Institute No. 0602111202
                    <div style="width:150px; border:2px solid black; border-radius:8px; padding:5px; font-size:24px; font-weight:700; text-align:center;">
                        M.P.O
                    </div>
                </td>
                <td style="width;150px;">
                    <b>Janata Bank</b>
                    <br>Bancharampur Branch
                    <br>Month : <?php echo $mtxt;?>
                </td>
            </tr>
        </table>
        
    </div>

    <style>
        .mpo-tablex {
            font-size:11px;
        }
    </style>
    

    <div style="height:3px;"></div>
    <table style="width:100% " class="mpo-tables">
        <thead>
            <tr>
                <th>SL</th>
                <th>Index</th>
                <th>Name of Teacher's/Staff's</th>
                <th>Account No.</th>
                <th>Disignation</th>
                <th>Birth</th>
                <th>Joining</th>
                <th>Pay Scale</th>
                <th>basic</th>
                
                <?php if($cat=='govt'){ ?>
                
                    <th>House</th>
                    <th>Med</th>
                    <th>Incen</th>
                    <th>Arrear</th>
                    <th>Total</th>
                    <th>Welf</th>
                    <th>Retire</th>
                    <th>Deduct</th>
                
                <?php } else if($cat=='Eid'){ ?>
                    <th>Festival</th>
                    <th>-</th>
                    <th>-</th>
                    <th>-</th>
                    <th>Total</th>
                    <th>-</th>
                    <th>-</th>
                    <th>Deduct</th>
                
                <?php } else if($cat=='Boishakhi'){ ?>
                    <th>Boishakhi</th>
                    <th>-</th>
                    <th>-</th>
                    <th>-</th>
                    <th>Total</th>
                    <th>-</th>
                    <th>-</th>
                    <th>Deduct</th>
                
                <?php } ?>
                
                
                <th>Amount (BDT)</th>
                <th style="width:120px;">sign</th>
            </tr>
        </thead>
    <?php
    $sl = 1; $taka2 = 0;
    $sql0 = "SELECT * from salarydetails where refnogovt='$refno' and slots = '$slotname' and govt>0 order by ranks, joindate "; 
    $result0qt2 = $conn->query($sql0);if ($result0qt2->num_rows > 0) {while($row0 = $result0qt2->fetch_assoc()) {  
    $tid=$row0["tid"]; $amount=$row0["govt"];  $accno=$row0["accno"]; 
    $basicz = $row0["basic"];  $incenz = $row0["incentive"];  $housez = $row0["house"];  $medicalz = $row0["medical"];  $arrearz = $row0["arrear"];  
      $gex1 = $row0["govtcol1"];  $gex2 = $row0["govtcol2"];  
    $welz = $row0["welfare"];  $retirez = $row0["retire"];  $govtz = $row0["govt"];  //$ = $row0[""];  $ = $row0[""];  
    $tot = $basicz + $incenz + $housez + $medicalz + $arrearz;
    $ded = $welz + $retirez;
    
    
    $sql0 = "SELECT * from teacher where tid='$tid' and sccode = '$sccode'  "; 
    $result0qt3 = $conn->query($sql0);if ($result0qt3->num_rows > 0) {while($row0 = $result0qt3->fetch_assoc()) {  
    $tname=$row0["tname"];  $mpoindex=$row0["mpoindex"];  $dob=$row0["dob"];    $join=$row0["jdate"];    $pcode=$row0["paycode"];    $pscale=$row0["payscale"];    
    $posi=$row0["position"];   //$=$row0[""];    $=$row0[""];  
    }}
    
    ?>
        <tr>
            <td class="mpo-table"><?php echo $sl;?></td>
            <td class="mpo-table"><?php echo $mpoindex;?></td>
            <td class="mpo-table"><?php echo $tname;?></td>
            <td class="mpo-table"><?php echo $accno;?></td>
            <td class="mpo-table"><?php echo $posi;?></td>
            <td class="mpo-table"><?php echo date('d/m/y', strtotime($dob));?></td>
            <td class="mpo-table"><?php echo date('d/m/y', strtotime($join));?></td>
            <td class="mpo-table" style="font-size:9px;"><?php echo $pcode . '/' . $pscale;?></td>
            <td class="mpo-table"><?php echo $basicz;?></td>
            
            
            <?php if($cat=='govt'){ ?>
            
                <td class="mpo-table"><?php echo $housez;?></td>
                <td class="mpo-table"><?php echo $medicalz;?></td>
                <td class="mpo-table"><?php echo $incenz;?></td>
                <td class="mpo-table"><?php echo $arrearz;?></td>
                <td class="mpo-table"><?php echo $tot;?></td>
                <td class="mpo-table"><?php echo $welz;?></td>
                <td class="mpo-table"><?php echo $retirez;?></td>
                <td class="mpo-table"><?php echo $ded;?></td>
            <?php } else if($cat=='Eid'){ $govtz = $gex1; ?>
                <td class="mpo-table"><?php echo $gex1;?></td>
                <td class="mpo-table"></td>
                <td class="mpo-table"></td>
                <td class="mpo-table"></td>
                <td class="mpo-table"><?php echo $gex1;?></td>
                <td class="mpo-table"></td>
                <td class="mpo-table"></td>
                <td class="mpo-table">0</td>
            <?php } else if($cat=='Boishakhi'){ $govtz = $gex2; ?>
                <td class="mpo-table"><?php echo $gex2;?></td>
                <td class="mpo-table"></td>
                <td class="mpo-table"></td>
                <td class="mpo-table"></td>
                <td class="mpo-table"><?php echo $gex2;?></td>
                <td class="mpo-table"></td>
                <td class="mpo-table"></td>
                <td class="mpo-table">0</td>
            <?php } ?>
            
            
            
            
            <td class="mpo-table"><?php echo $govtz;?></td>
            <td class="mpo-table"></td>
        </tr>
    
    <?php
    $sl++; $taka2 += $govtz;
    }}
    

    ?>
       <thead>
            <tr>
                <th colspan="17">Grand Total :</th>
                <th><?php echo $taka2;?></th>
                <th></th>
            </tr>
        </thead>
               
    </table>             
    
    <div style="font-size:13px;">
        Amount in word : <b><?php echo taka($taka2);?></b>
    </div>
    
    <div style="font-size:12px;  margin-top:12px;">
        <b>It is hereby certified that,</b>
        <br>
        &bull; The said teaching staff are full time salaried employees of this educational institution.
        &nbsp; &bull; None of the above teaching staff has taken more than ____ months leave.
        &nbsp; &bull; The educational institution is being properly managed as per the laws provided by the government.
        &nbsp; &bull; The amount paid for the uplifted pay scale of the employees of the educational institutions has been properly distributed.
        &nbsp; &bull; Teachers and students of educational institutions regularly participate in national programs.
    
        
    </div>


        
   <?php 
    include 'pad/seal-both-small.php';
 ?>  
    </div> 
                    
</div>
           
    
    <?php     }} ?>