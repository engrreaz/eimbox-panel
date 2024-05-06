

<h3 style="text-align:center; padding:10px;">
            <i class="material-icons" style="font-size:70px;">key</i>
            <br>
            
            Login to Web Portal</h3>
 
<div class="row">
    <div class="col-md-4"  style="text-align:center;">
        <div id="pack" style="padding:15px 10px;"> 
        <div style="font-size:13px; font-weight:bold;">Login with User ID</div>
        <div style="font-size:10px; font-style:italic; margin-bottom:10px;">Signin with your social accounts</div>
    
    <form id="loginform" onsubmit="eiin(this);"  autocomplete="on">
        <div class="input-group">
            <span class="input-group-text"><i class="material-icons">person</i></span>
            <input type="email" class="form-control" id="username" name="username" placeholder="Enter Your Email/UserID"  autocomplete="username" />
        </div>
        
        <br>
        
        <div class="input-group">
            <span class="input-group-text"><i class="material-icons">key</i></span>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter Token/OTP/Password"  autocomplete="password" />
        </div>
        <br>
  
        
        <div id="btn">
            <!--<button type="submit" id="btn" class="btn btn-dark" >Submit</button>-->
            <input type="submit" id="btn" class="btn btn-dark" value="Login" />
            
            <br><br>
        </div>
      
        <div id="status" class="status"></div>
        
              </form>  
      </div>
    </div>
    <div class="col-md-4" style="text-align:center;">
        <div style="font-size:13px; font-weight:bold;">Login with Social Media</div>
        <div style="font-size:10px; font-style:italic; margin-bottom:10px;">Signin with your social accounts</div>
        
        <img src="imgs/btn.png" style="width:200px;" />
        <div style="height:20px;"></div>
    </div>

    <div class="col-md-4" style="text-align:center;">
        <div style="font-size:13px; font-weight:bold;">Login with QR Code</div>
        <div style="font-size:10px; font-style:italic; margin-bottom:10px;">Scan this QRCode by your Android Phone.</div>
        <?php 
                 // $key = 'sfdgsht5yryfyfhfgjgjtrfhfhfhfhf1234567890';
                    $keys = array_merge(range(0, 9), range('a', 'z'));
                    for ($i = 0; $i < 30; $i++) {
                        $qrtoken .= $keys[array_rand($keys)];
                    }      
                //echo $qrtoken ;
                include ('../db.php');;
                $cur = date('Y-m-d H:i:s');
                $query35 ="INSERT INTO qrcodelogin (id, token, email, generatetime, logintime, status) VALUES (NULL, '$qrtoken', NULL, '$cur', NULL, 0)";//echo $query35;
        		$conn->query($query35);
                
                
                $lnk = 'http://android.eimbox.com/qrlogin.php?qr=' . $qrtoken;
        ?>
        
				    <img style="padding: 5px; background:var(--lighter);" src="https://chart.googleapis.com/chart?chs=170x170&cht=qr&chl=<?php echo $lnk;?>&choe=UTF-8&chld=L|0" />
				    <div id="japa"></div>
				    
    </div>
    
</div>

      <div style="height:20px;"></div>
      <div style="text-align:center;">
          <table style="margin:auto;">
               <tr>
                   <td><img src="https://android.eimbox.com/iimg/logo.png" style="width:20px;"> </td>
                   <td><span style="font-size:14px; font-weight:500; margin-top:8px; color:var(--darker); padding:5px;">We work for paperless institute</span></td>
               </tr>
           </table>
      </div>





    <script>
    

          const myInterval =   setInterval(qrcodecheck, 500);
    
    function qrcodecheck() {
        var qr = '<?php echo $qrtoken;?>';
            var infor="qr="  + qr;
    	    $("#japa").html( "" );
    
    	    $.ajax({
    			type: "POST",
    			url: "checkqr.php",
    			data: infor,
    			cache: false,
    			beforeSend: function () {
    				$('#japa').html('');
    			},
    			success: function(html) {
    				$("#japa").html( html );
    				var japa = document.getElementById("japa").innerHTML;
    				if(japa.length >10){
    				    clearInterval(myInterval);
    				    login(japa, qr);
    				}
    				
    			}
    		});
        }
        
        function login(email, qr) {
            // alert(qr+email);
            window.location.href = 'cchlogin.php?token='+qr+qr+qr+"&em="+email;
        }
    
        function eiin() {
    		var eiin=document.getElementById("username").value;
    		var key=document.getElementById("password").value;
            var infor="user=" + eiin + "&otp=" + key; //alert(infor);
    	    $("#status").html( "" );
    
    	    $.ajax({
    			type: "POST",
    			url: "checkeiin.php",
    			data: infor,
    			cache: false,
    			beforeSend: function () {
    				$('#status').html('<span class=""><center>Processing....</center></span>');
    			},
    			success: function(html) {
    				$("#status").html( html );
    				
    			}
    		});
        }
        
        function proceed(){
            window.location.href = 'index.php?email=<?php echo $usr;?>';
        }
    </script>