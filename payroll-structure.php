<?php
include 'header.php';

$dismsg = 0;
$cls2 = $sec2 = $roll2 = $rollno = '';
$new = 0; // check new entry or not
?>
<button type="button" id="modalbox" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal" hidden>
    Launch demo modal
</button>
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Payroll Structure</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div id="" class="input-control select full-size error">
                    <select id="modaldata" name="modaldata" class="form-control text-white" onchange="modal();">
                        <option value="">Select a Teacher/Staff to Edit</option>
                        <?php
                        $sql000 = "SELECT * FROM teacher where sccode='$sccode'  order by ranks";
                        $resultix = $conn->query($sql000);
                        // $conn -> close();
                        if ($resultix->num_rows > 0) {
                            while ($row000 = $resultix->fetch_assoc()) {
                                $tid = $row000["tid"];
                                $tname = $row000["tname"];
                                echo '<option value="' . $tid . '"  >' . $tname . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
<?php
if (isset($_GET['tid'])) {
    $tid = $_GET['tid'];
} else {
    $tid = 0;
}




$tinfo = array();
$sql5 = "SELECT * FROM teacher where sccode='$sccode' and tid = '$tid' ;";
$result6 = $conn->query($sql5);
if ($result6->num_rows > 0) {
    while ($row5 = $result6->fetch_assoc()) {
        $tinfo[] = $row5;
    }
}


$sql0 = "SELECT applydate FROM teacher_salary_structure  where tid='$tid' and sccode='$sccode' order by applydate desc limit 1;";
$result0a = $conn->query($sql0);
if ($result0a->num_rows > 0) {
    while ($row0 = $result0a->fetch_assoc()) {
        $applydate = $row0["applydate"];
    }
} else {
    $applydate = $tinfo[0]["jdate"];
}

if ($new == 1) {
    $btntext = 'Save the Teacher/Staff';
} else {
    $btntext = 'Update Info';
}

?>
<style>
    .col-form-label {
        color: slategray;
    }
</style>
<h3>Payroll Structure</h3>

<div class="row" style="display:<?php if ($dismsg == 0) {
    $dismsg = 'hide';
} else {
    $dismsg = 'block';
}
echo $dismsg; ?>">

</div>

<style>
    h4 {
        font-weight: bold;
    }
</style>
<div class="row"> <!--   Class/Roll Block -->
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="text-muted font-weight-normal">
                    Teacher's Information
                </h4>
                <div class="row">




                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Teacher's / Staff's ID.</label>
                            <div class="col-12">
                                <input type="text" class="form-control bg-dark" id="tid" value="<?php echo $tid; ?>"
                                    disabled />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-1">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">&nbsp;</label>
                            <div class="col-12">
                                <button type="submit" style="padding:4px 10px 3px; border-radius:5px;" name="srchst"
                                    id="srchst" class="btn btn-inverse-success btn-block text-center p-2" style=""
                                    title="Get Student Information" onclick="fetchstudentx();"><i
                                        class="mdi mdi-arrow-right"></i></button>
                                <div id="stinfo" style="display:none;"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <?php echo $tinfo[0]['tname'];?>
                        <br>
                        <?php echo $tinfo[0]['tnameb'];?>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Salary Applying From</label>
                            <div class="col-12">
                                <input type="date" class="form-control bg-dark" id="applydate"
                                    value="<?php echo $applydate; ?>" />
                            </div>
                        </div>
                    </div>




                </div>
            </div>
        </div>
    </div>
</div>




<div class="row"> <!--   Class/Roll Block -->
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row pl-3">
                    <h4 class="font-weight-bold text-small">MPO Related Account</h4>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Account Number</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="mpoaccno"
                                    value="<?php echo $tinfo[0]['accno'] ?? ''; ?>" />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Bank Name</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="mpobankname"
                                    value="<?php echo $tinfo[0]['bankname'] ?? ''; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Branch Name</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="mpobranch"
                                    value="<?php echo $tinfo[0]['branch']; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Routing Number</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="mporouting"
                                    value="<?php echo $tinfo[0]['routing']; ?>" />
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row pl-3">
                    <h4 class="font-weight-bold text-small">Institute Allowance Related Account</h4>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Account Number</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="schaccno"
                                    value="<?php echo $tinfo[0]['accnosch'] ?? ''; ?>" />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Bank Name</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="schbankname"
                                    value="<?php echo $tinfo[0]['bnamesch'] ?? ''; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Branch Name</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="schbranch"
                                    value="<?php echo $tinfo[0]['bbrsch']; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Routing Number</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="schrouting"
                                    value="<?php echo $tinfo[0]['routesch']; ?>" />
                            </div>
                        </div>
                    </div>
                </div>



                <div class="row pl-3">
                    <h4 class="font-weight-bold text-small">PF Related Account</h4>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Account Number</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="pfaccno"
                                    value="<?php echo $tinfo[0]['accnopf'] ?? ''; ?>" />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Bank Name</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="pfbankname"
                                    value="<?php echo $tinfo[0]['bnamepf'] ?? ''; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Branch Name</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="pfbranch"
                                    value="<?php echo $tinfo[0]['bbrpf']; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Routing Number</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="pfrouting"
                                    value="<?php echo $tinfo[0]['routepf']; ?>" />
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<div class="row"> <!--   Class/Roll Block -->
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row pl-3">
                    <h4 class="font-weight-bold text-small">MPO Information</h4>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Pay Code</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="paycode"
                                    value="<?php echo $tinfo[0]['paycode'] ?? ''; ?>" />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Pay Scale</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="payscale"
                                    value="<?php echo $tinfo[0]['payscale'] ?? ''; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Basic Salary</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="basic"
                                    value="<?php echo $tinfo[0]['basic']; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">............</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id=""
                                    value="<?php echo $tinfo[0]['routing']; ?>" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Incentive</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="incentive"
                                    value="<?php echo $tinfo[0]['incentive'] ?? ''; ?>" />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">House Rent</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="houserent"
                                    value="<?php echo $tinfo[0]['house'] ?? ''; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Medical Allowance</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="medical"
                                    value="<?php echo $tinfo[0]['medical']; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">........</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id=""
                                    value="<?php echo $tinfo[0]['routesch']; ?>" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Welfare</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="welfare"
                                    value="<?php echo $tinfo[0]['welfare'] ?? ''; ?>" />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Retirement</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="retire"
                                    value="<?php echo $tinfo[0]['retire'] ?? ''; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">-----</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id=""
                                    value="<?php echo $tinfo[0]['bbrpf']; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">MPO Net Salary</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="mpototal"
                                    value="<?php echo $tinfo[0]['netamtgovt']; ?>" />
                            </div>
                        </div>
                    </div>
                </div>

            </div>



            <div class="card-body">
                <div class="row pl-3">
                    <h4 class="font-weight-bold text-small">School Provided Salary</h4>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Salary</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="salary"
                                    value="<?php echo $tinfo[0]['salary'] ?? ''; ?>" />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Mobile Allowance</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="mobilevata"
                                    value="<?php echo $tinfo[0]['mobilevata'] ?? ''; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Travel allowance</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="travel"
                                    value="<?php echo $tinfo[0]['travel']; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Medical Allowance</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="medical2"
                                    value="<?php echo $tinfo[0]['medical2']; ?>" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">PF by Institute</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="pf"
                                    value="<?php echo $tinfo[0]['pf'] ?? ''; ?>" />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">...</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="" value="" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">....</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="" value="" />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Net Salary</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="net2"
                                    value="<?php echo $tinfo[0]['net2']; ?>" />
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>




















<div class="row"> <!--   Class/Roll Block -->
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">

                    <div class="col-md-3">
                        <div class="form-group row">
                            <div class="col-12">
                                <?php if ($tid > 0) { ?>
                                    <button type="submit" id="savest" name="savest"
                                        class="btn btn-inverse-success btn-block pt-2"
                                        onclick="upd();"><?php echo $btntext; ?></button>
                                    <div id="px"></div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>









<?php
include 'footer.php';
?>
<script>
    var tidd = '<?php echo $tid; ?>';
    if (tidd == 0) {
        $("#modalbox").click();
    }

    function modal() {
        var x = document.getElementById("modaldata").value;
        window.location.href = 'payroll-structure.php?tid=' + x;
    }
</script>


<script>
    document.getElementById('stnameeng').focus();
    $(function () {
        $(".js-select").select2({
            placeholder: "Select a state",
            allowClear: true
        });
    });

</script>

<script>
    document.getElementById('defbtn').innerHTML = '<?php echo $btntext; ?>';
    document.getElementById('defmenu').innerHTML = '';
    function defbtn() {
        upd();
    }

    function sameadd() {//*********************************************** */
        document.getElementById("pervill").value = document.getElementById("previll").value;
        document.getElementById("perpo").value = document.getElementById("prepo").value;
        document.getElementById("perps").value = document.getElementById("preps").value;
        document.getElementById("perdist").value = document.getElementById("predist").value;
    }




</script>


<script>
    function fetchstudent() {
        var classname = document.getElementById("classname").value;
        var sectionname = document.getElementById("sectionname").value;
        var rollno = document.getElementById("rollno").value;
        var infor = "classname=" + classname + "&sectionname=" + sectionname + "&rollno=" + rollno;
        //alert(infor);
        $("#stinfo").html("");

        $.ajax({
            type: "POST",
            url: "backend/fetch-stid.php",
            data: infor,
            cache: false,
            beforeSend: function () {
                $('#stinfo').html('<span class="mif-spinner4 mif-ani-pulse"></span>');
            },
            success: function (html) {
                $("#stinfo").html(html);
                var stid = document.getElementById("stinfo").innerHTML;
                if (stid == '0') {
                    window.location.href = 'students-edit.php?cls=' + classname + '&sec=' + sectionname + '&roll=' + rollno;
                } else {
                    window.location.href = 'students-edit.php?stid=' + stid;
                }
            }
        });
    }

    function lastadd() {
        document.getElementById("previll").value = document.getElementById("vill").innerHTML;
        document.getElementById("prepo").value = document.getElementById("po").innerHTML;
        document.getElementById("preps").value = document.getElementById("ps").innerHTML;
        document.getElementById("predist").value = document.getElementById("dist").innerHTML;
    }

    function ucword(iid) {
        var str = document.getElementById(iid).value;
        let titleCase = "";
        str.split(" ").forEach(word => {
            const capitalizedWord = word.charAt(0).toUpperCase() + word.slice(1).toLowerCase();
            titleCase += capitalizedWord + " ";
        });
        document.getElementById(iid).value = titleCase.trim();
    }
</script>


<script>
    function upd() {


        // 		var = document.getElementById("").value;
        var tid = document.getElementById("tid").value;
        var applydate = document.getElementById("applydate").value;
    //   alert(applydate);
        // var mpoindex = document.getElementById("mpoindex").value;
        // var tin = document.getElementById("tin").value;//
        // var thisjoin = document.getElementById("thisjoin").value;
        // var firstjoin = document.getElementById("firstjoin").value;






        var accno = document.getElementById("mpoaccno").value;
        var bname = document.getElementById("mpobankname").value;
        var bbr = document.getElementById("mpobranch").value;
        var rno = document.getElementById("mporouting").value;

        var accno2 = document.getElementById("schaccno").value;
        var bname2 = document.getElementById("schbankname").value;
        var bbr2 = document.getElementById("schbranch").value;
        var rno2 = document.getElementById("schrouting").value;

        var accno3 = document.getElementById("pfaccno").value;
        var bname3 = document.getElementById("pfbankname").value;
        var bbr3 = document.getElementById("pfbranch").value;
        var rno3 = document.getElementById("pfrouting").value;


        var paycode = document.getElementById("paycode").value;
        var pscale = document.getElementById("payscale").value;
        var basic = document.getElementById("basic").value;
        var inten = document.getElementById("incentive").value;
        var hra = document.getElementById("houserent").value;
        var ma = document.getElementById("medical").value;
        // var arrea = document.getElementById("arrea").value;////////////////////////////
        var welfare = document.getElementById("welfare").value;
        var retire = document.getElementById("retire").value;
        var net = document.getElementById("mpototal").value;
        var salary = document.getElementById("salary").value;
        var mpa = document.getElementById("mobilevata").value;
        var travel = document.getElementById("travel").value;
        var ma2 = document.getElementById("medical2").value;
        // var exam = document.getElementById("exam").value;//////////////////////////////////
        // var fest = document.getElementById("fest").value;////////////////////////////

        var pf = document.getElementById("pf").value;
        var net2 = document.getElementById("net2").value;
        // alert("tin");



        var infor = "tid=" + tid
            + "&applydate=" + applydate
            // + "&mpoindex=" + mpoindex + "&tin=" + tin + "&thisjoin=" + thisjoin + "&firstjoin=" + firstjoin

            + "&paycode=" + paycode + "&pscale=" + pscale + "&basic=" + basic + "&inten=" + inten + "&hra=" + hra + "&ma=" + ma + "&welfare=" + welfare + "&retire=" + retire + "&net=" + net
            + "&salary=" + salary + "&mpa=" + mpa + "&travel=" + travel + "&ma2=" + ma2 + "&pf=" + pf + "&net2=" + net2

            + "&accno=" + accno + "&bname=" + bname + "&bbr=" + bbr + "&rno=" + rno
            + "&accno2=" + accno2 + "&bname2=" + bname2 + "&bbr2=" + bbr2 + "&rno2=" + rno2
            + "&accno3=" + accno3 + "&bname3=" + bname3 + "&bbr3=" + bbr3 + "&rno3=" + rno3




            ;
        // alert(infor);
        $("#px").html("");

        $.ajax({
            type: "POST",
            url: "backend/update-payroll-structure.php",
            data: infor,
            cache: false,
            beforeSend: function () {
                $('#px').html('<span class="">Updating...</span>');
            },
            success: function (html) {
                $("#px").html(html);
                window.location.href = 'payroll-structure.php?tid='+ tid;
            }
        });
    }
</script>


<script>
    function calc() {
        var paycode = parseInt(document.getElementById("paycode").value);
        var pscale = parseInt(document.getElementById("pscale").value) * 1;

        var basic = parseInt(document.getElementById("basic").value);
        var inten = parseInt(document.getElementById("inten").value);
        var hra = parseInt(document.getElementById("hra").value);
        var ma = parseInt(document.getElementById("ma").value);
        var arrea = parseInt(document.getElementById("arrea").value);

        var wel = basic * 0.04;
        var ret = basic * 0.06;
        document.getElementById("welfare").value = wel;
        document.getElementById("retire").value = ret;

        var welfare = parseInt(document.getElementById("welfare").value);
        var retire = parseInt(document.getElementById("retire").value);

        var mot = basic + inten + hra + ma + arrea - wel - ret;
        document.getElementById("net").value = Math.round(mot);

        var net = parseInt(document.getElementById("net").value);


        var salary = parseInt(document.getElementById("salary").value);
        var mpa = parseInt(document.getElementById("mpa").value);
        var travel = parseInt(document.getElementById("travel").value);
        var ma2 = parseInt(document.getElementById("ma2").value);
        var exam = parseInt(document.getElementById("exam").value);
        var fest = parseInt(document.getElementById("fest").value);

        var thisjoin = document.getElementById("thisjoin").value;
        thisjoin = new Date(thisjoin);
        const aj = new Date();
        var year1 = aj.getFullYear();
        var month1 = aj.getMonth();

        var year2 = thisjoin.getFullYear();

        var month2 = thisjoin.getMonth();
        var mon = (year2 - year1) * 12 + (month2 - month1) + 1;
        mon = mon * -1;
        var ppf = 0;
        if (mon >= 24) {
            var ppf = pscale * 0.05;
        }
        // 		alert(mon);
        document.getElementById("pf").value = ppf;
        var pf = parseInt(document.getElementById("pf").value);

        var scmot = parseInt(salary + mpa + travel + ma2 + exam + fest - pf);
        document.getElementById("net2").value = scmot;
        // 		var net2 = document.getElementById("net2").value;
    }

    function calc2() {
        var ppp = document.getElementById("paycode").value;
        var tk = document.getElementById("pcs" + ppp).innerHTML;
        document.getElementById("pscale").value = tk;
        calc();
    }
</script>