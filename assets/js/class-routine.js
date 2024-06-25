
        // document.getElementById("knot2").innerHTML = document.getElementById("knot").innerHTML;
        // function refresh_handler() {function refresh(){$.get('savelog.php?u=<?php echo $usr;?>&pg=Home-Page', function(result) {console.log(result);});}setInterval(refresh, 5000);} $(document).ready(refresh_handler);
        function secc() {
            function refr() {
                var t = new Date();
                var h = t.getHours();
                var m = t.getMinutes(); 
                var s = t.getSeconds();
                if(h<=9){h='0'+h;}if(m<=9){m='0'+m;}if(s<=9){s='0'+s;}
                var k = h + ":" + m + ":" + s;
                document.getElementById("time").innerHTML = k; 
                var te = document.getElementById("main-31").innerHTML;
                var a = new Date(2023,1,1,h,m,s);
                var b = new Date(2023,1,1,te.substring(1,2), te.substring(2,2), te.substring(4,2));
                alert(te.substring(4,2));
                var dk = b.getTime() - a.getTime();
                var ela = dk/1000;
                var elas = ela % 60;
                
                var elam = (ela - elas)/60;
                if(elas<10){elas = '0' + elas;} else if(elas == 0) {elas = '00';}
                if(elam<10){elam = '0' + elam;} else if(elam == 0) {elam = '00';}
                document.getElementById("onoff").innerHTML = elam + ":" + elas; 
                
                d = (dk/1000) * (360/<?php echo $dur;?>);
                if(d<=0){window.location.href='index_teacher.php';}
                
                
                document.getElementById("sec").innerHTML = '<?php echo $n;?>'; 
                var yy = t.getFullYear();
                var mm = t.getMonth()+1;
                var dd = t.getDate();
                var m = new Date(yy,mm,dd,h,m,s);
                var n = new Date(<?php echo $cy;?>,<?php echo $cm;?>,<?php echo $cd;?>,<?php echo $ch;?>,<?php echo $ci;?>,<?php echo $cs;?>);
                
                var dk2 = n.getTime() - m.getTime();;
                dk2 = (dk2/1000);
                
                if(dk2<0){dk2 = 0-dk2;}
                if(dd != parseInt(<?php echo $cd;?>,10)){
                    //dk2 = 3600*24 - dk2;
                }
                
                if(dk2%5==0){
                //    alert(dd + " ** " + parseInt(<?php echo $cd;?>,10) + " / " + dk2);
                }
                
                if(dd === parseInt(<?php echo $cd;?>,10)){
                //    dk2 = dk2 - 3600*24;
                }
                dk2 = Math.abs(dk2);
                //alert(dk2);
                var durr = <?php echo $flen;?>*60;
                //d2 = (dk2/1000) * (360/<?php echo $dur;?>);
                var dks = dk2 % 60;
                var dkm = (dk2-dks)/60;
                dkm = dkm % 60;
                var dkh = (dk2 - dkm*60 - dks)/3600;
                if(dkh>0 && dkh<10) dkh = '0' + dkh;
                if(dkm>0 && dkm<10) dkm = '0' + dkm;
                if(dks>0 && dks<10) dks = '0' + dks;
                
                //document.getElementById("fastrest").innerHTML = dkh + ':' + dkm + ':' + dks;//+"**" +dk2 + '/' + durr;
                //var fastrate = dk2*100/durr;
                //document.getElementById("lef").style.width = fastrate+'%';
                
                var dd = document.getElementById("grad");
                //alert(d);
                dd.style.background = "conic-gradient(deeppink 0deg, deeppink "+d+"deg, white "+d+"deg)";
                
            }
            setInterval(refr, 1000);
        }
        $(document).ready(secc);
