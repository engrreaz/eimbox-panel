
<tr>
    <td valign="top" class="backpic" background="assets/admit/sample_02.png" style="width:210mm; height:147.5mm; padding:3mm">
      
    <table style="font-size:10px; width:100%; border:0;">
                               <tr>
                                   <td height="1px"></td><td></td>
                               </tr>
                                <tr >
                                    <td  width="195px" style="padding-right:0px; text-align:right;"   vlign="top">
                                        
                                        <img src="logo/<?php echo $sccode;?>.png" width="100px" />
                                    </td>
                                    <td   style="color:black; padding-left:20px;  font-family:'Segoe UI'; font-size:20px;"   vlign="top">
                                        <b><?php echo $scname;?></b>
                                     
                                        
                      
                                        <div style="font-size:12px;">
                                        <?php echo $scadd1 .  ', ' . $ps . ', ' . $dist;?>
                                        </div>
                                        <div style="font-size:12px;">
                                        <?php echo 'Contact : ' . $mobile;?>
                                        </div>
                                 <div style="text-align:center;">
                               <img src="assets/admit/admit.png" width="200px" style="margin-left:0; " />
                             </div>       

                        
                                        <div style=" padding:0; margin-top:0px; font-family:Segoe UI; font-size:12px; font-weight: bold; ">
                                        <?php echo $exam2 . ' Examination - ' . $sy;?>
</div>
                                        
                                    </td>
                                </tr>
            
                            </table>
                            
                            <table style="font-size:12px; width:100%; border:0;" >
                                <tr>
                                    
                                   
                                    <td  valign="top" style="padding: 8px 0 8px 50px;">
                                        Name of Student<br><span style="font-size:18px;  font-weight:bold;"><?php echo $stnameeng . $domain;?></span>
                                        <br>
                                        Class : <b><?php echo $classname;?></b> 
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                       <?php echo $secgr;?> : <b><?php echo $sectionname;?></b> 
                                         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        Roll : <b><?php echo $rollno;?></b> 
                                        <br>
                                        Student's ID : <?php echo $stid;?> 
                                    </td>
                                    
                                    <td style="padding-right:1px;" width="105px">
                                        <?php
                                        $file_pointer ="../students/" .  $stid . ".jpg";
                                        if (file_exists($file_pointer)===TRUE) {
                                        ?>
                                        <img src="../students/<?php echo $stid;?>.jpg" alt=""  height="90px" style="border-radius:0%; border : 1px solid black; padding:3px; "/>
                                        <?php } else {?>
                                        <img src="http://www.eimbox.com/admit/noimg.jpg" alt=""  height="90px" style="border-radius:0%; border : 1px solid black; padding:3px; right:10px;"/>
                                        
                                        <?php } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="padding-left:30px;">
                                       <table width="100%">
                                           <tr>
                                               <td width="65%" style="padding-right:10px;" >
                                                   <table width="100%" border="1" style="border-collapse:collapse; font-size:10px;">
                                                       <tr>
                                                           <td align="center"><b>Date</b></td>
                                                           <td align="center"><b>Time</b></td>
                                                           <td align="center"><b>Subject</b></td>
                                                       </tr>
                                                       
                                                       	<?php
								$sqlww = "SELECT * FROM examroutine WHERE sccode='$sccode' and clsname = '$classname' and secname='$sectionname' and examname='$exam2' and sessionyear='$sy' order by date, time";

								$resultww = $conn->query($sqlww);
								if ($resultww->num_rows > 0) {
								while($rowww = $resultww->fetch_assoc()) {
								    
												$edate=$rowww["date"];
												$etime=$rowww["time"];
												$subj=$rowww["subj"];
											
												?>
											    <tr>
											        <td style="text-align:center"><?php echo date('l, d/m/Y',strtotime($edate));?></td>
											        <td style="text-align:center"><?php echo $etime ;?></td>
											        <td style="text-align:center"><?php echo $subj;?></td>
											    </tr>
												
												<?php  	}} ?>
					            
                                                       
                                                       
                                                   </table>
                                               </td>


                                               <td style="font-size:11px; padding-bottom:10px; text-align:center;" valign="bottom">
                                                       <img src="<?php echo $domain . '/sign/' . $sccode;?>.png" width="120px" /><br>
                                                       Principal<br>
                                                       <?php echo $scname;?><br>
                                                       <?php echo $scadd1 .  ', ' . $ps . ', ' . $dist  ;?>
                                               </td>
                                           </tr>
                                       </table> 
                                    </td>
                                   
                                </tr>
                                <tr>
                                    <td valign="top">
                                      
                                        
                                        
                                    </td>
                                </tr>
                            </table>
                         
                </td></tr>