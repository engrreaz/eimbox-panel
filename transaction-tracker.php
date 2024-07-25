<?php
include 'header.php';

// $month = $_GET['m'] ?? 0;
// $year = $_GET['y'] ?? 0;

if (isset($_GET['m'])) {
    $month = $_GET['m'];
} else {
    $month = 0;
}
if (isset($_GET['y'])) {
    $year = $_GET['y'];
} else {
    $year = 0;
}
if (isset($_GET['disx'])) {
    $disx = $_GET['disx'];
} else {
    $disx = 1;
}



$track_date = $td;
$setp3upd = "DELETE FROM transaction_tracker where sccode='$sccode' and date = '$track_date'; ";
$conn->query($setp3upd);

$sql0x = "SELECT receivedby, sum(amount) as deposit FROM transaction where sccode='$sccode' and date <= '$track_date' group by receivedby order by receivedby";
$result0xn = $conn->query($sql0x);
if ($result0xn->num_rows > 0) {
    while ($row0x = $result0xn->fetch_assoc()) {
        $user = $row0x["receivedby"];
        $deposit = $row0x["deposit"];

        $setp4upd = "INSERT INTO transaction_tracker (id, sccode, date, user, deposit, dispuch, balance, entrytime) 
                                VALUES (NULL, '$sccode', '$track_date', '$user', '$deposit', 0, 0, NULL); ";
        // echo $setp4upd;
        $conn->query($setp4upd);
    }
}
//////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


$sql0x = "SELECT receivedfrom, sum(amount) as dispuch FROM transaction where sccode='$sccode' and date <= '$track_date' group by receivedfrom order by receivedfrom";
$result0xn0 = $conn->query($sql0x);
if ($result0xn0->num_rows > 0) {
    while ($row0x = $result0xn0->fetch_assoc()) {
        $user = $row0x["receivedfrom"];
        $dispuch = $row0x["dispuch"];
        // echo $user . ' --- ' . $dispuch;


        $sql0x = "SELECT * FROM transaction_tracker where sccode='$sccode' and date = '$track_date' and user='$user' LIMIT 1";
        //   echo $sql0x;
        $result0xn1 = $conn->query($sql0x);
        if ($result0xn1->num_rows > 0) {
            while ($row0x = $result0xn1->fetch_assoc()) {
                $id = $row0x["id"];

                $setp6upd = "UPDATE transaction_tracker SET dispuch = '$dispuch' where sccode='$sccode' and id='$id' and user='$user' and date='$track_date' ; ";
                $conn->query($setp6upd);
            }
        } else {
            $setp6upd = "INSERT INTO transaction_tracker (id, sccode, date, user, deposit, dispuch, balance, entrytime) 
                                VALUES (NULL, '$sccode', '$track_date', '$user', '0', '$dispuch', 0, NULL); ";
            $conn->query($setp6upd);
        }
        /*
         */



    }
}

///////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////


$sql0x = "SELECT entryby, sum(amount) as collec FROM stpr where sccode='$sccode' and prdate <= '$track_date' group by entryby order by entryby";
$result0xn0 = $conn->query($sql0x);
if ($result0xn0->num_rows > 0) {
    while ($row0x = $result0xn0->fetch_assoc()) {
        $user = $row0x["entryby"];
        $stpr = $row0x["collec"];
        // echo $user . ' --- ' . $dispuch;


        $sql0x = "SELECT * FROM transaction_tracker where sccode='$sccode' and date = '$track_date' and user='$user' LIMIT 1";
        //   echo $sql0x;
        $result0xn1 = $conn->query($sql0x);
        if ($result0xn1->num_rows > 0) {
            while ($row0x = $result0xn1->fetch_assoc()) {
                $id = $row0x["id"];

                $setp6upd = "UPDATE transaction_tracker SET stpr = '$stpr' where sccode='$sccode' and id='$id' and user='$user' and date='$track_date' ; ";
                $conn->query($setp6upd);
            }
        } else {
            $setp6upd = "INSERT INTO transaction_tracker (id, sccode, date, user, deposit, stpr, balance, entrytime) 
                                VALUES (NULL, '$sccode', '$track_date', '$user', '0', '$stpr', 0, NULL); ";
            $conn->query($setp6upd);
        }
        /*
         */



    }
}

///////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////



$setp7upd = "UPDATE transaction_tracker SET balance = deposit-dispuch+stpr, entrytime='$cur' where sccode='$sccode'  and date='$track_date' ; ";
$conn->query($setp7upd);

?>

<h3>Transactions Summery by Users</h3>

<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Salary Month</label>
                            <div class="col-12">
                                <select class="form-control text-white" id="month">
                                    <option value="0"></option>
                                    <?php
                                    for ($x = 1; $x <= 12; $x++) {
                                        $flt = '';
                                        $xx = strtotime(date('Y') . '-' . $x . '-01');
                                        if ($month == $x) {
                                            $flt = 'selected';
                                        }
                                        echo '<option value="' . $x . '"' . $flt . '>' . date('F', $xx) . '</option>';
                                    }
                                    ?>

                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-2">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Salary Year</label>
                            <div class="col-12">
                                <select class="form-control text-white" id="year">
                                    <option value="0"></option>
                                    <?php
                                    for ($y = date('Y'); $y >= 2024; $y--) {
                                        $flt2 = '';
                                        if ($year == $y) {
                                            $flt2 = 'selected';
                                        }
                                        echo '<option value="' . $y . '"' . $flt2 . '>' . $y . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Dispuch Period</label>
                            <div class="col-12">
                                <select class="form-control text-white" id="dispuch">

                                    <?php
                                    for ($dis = 1; $dis <= 1; $dis++) {
                                        $flt22 = '';
                                        if ($disx == $dis) {
                                            $flt22 = 'selected';
                                        }
                                        echo '<option value="' . $dis . '"' . $flt22 . '>' . $dis . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">&nbsp;</label>
                            <div class="col-12">
                                <button type="button" class="btn btn-inverse-primary btn-block pb-2 pt-2"
                                    onclick="go();">View Progress</button>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">&nbsp;</label>
                            <div class="col-12">

                                <div class="btn-group btn-block" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-inverse-info">
                                        <i class="mdi mdi-file-document mdi-18px"></i> View
                                    </button>
                                    <button type="button" class="btn btn-inverse-primary">
                                        <i class="mdi mdi-printer mdi-18px"></i> Print
                                    </button>
                                    <button type="button" class="btn btn-inverse-danger">
                                        <i class="mdi mdi-file-pdf mdi-18px"></i> PDF
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="text-muted font-weight-normal">
                    Record found for the month of
                    <b><?php $xx = strtotime($year . '-' . $month . '-01');
                    echo date('F, Y', $xx) ?></b>
                </h6>
                <div class="row">

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th> #</th>
                                    <th> User</th>
                                    <th class="text-right"> Balance</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sl = 1; $ttt = 0;
                                // $sql0x = "SELECT * FROM salarysummery where sccode='$sccode' and sessionyear = '$sy' and month='$month' and year='$year' order by refno;";
                                $sql0x = "SELECT * FROM transaction_tracker where sccode='$sccode' and date='$track_date' order by balance desc";
                                $result0xn = $conn->query($sql0x);
                                if ($result0xn->num_rows > 0) {
                                    while ($row0x = $result0xn->fetch_assoc()) {
                                        $id = $row0x["id"];
                                        $user = $row0x["user"];
                                        $balance = $row0x["balance"];
                                        $ttt += $balance;
                                        ?>
                                        <tr>
                                            <td><?php echo $sl; ?></td>
                                            <td><?php echo $user; ?></td>
                                            <td class="text-right"><?php echo number_format($balance, 2); ?></td>
                             
                                            <td>

                                                <div id="ssp<?php echo $id; ?>">
                                                    <button class="btn btn-inverse-warning p-1 pl-2 pr-2 text-small" onclick="trans('<?php echo $user; ?>');"> <small>Details</small></button>

                                                </div>

                                            </td>
                                        </tr>
                                    <?php $sl++; }
                                } else { ?>
                                    <tr>
                                        <td colspan="7">No Data / Records Found.</td>

                                    </tr>
                                <?php }  echo $ttt;?>
                            </tbody>
                        </table>
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
    function go() {
        var m = document.getElementById('month').value;
        var y = document.getElementById('year').value;
        var p = document.getElementById('dispuch').value;
        window.location.href = 'payroll-statement.php?m=' + m + '&y=' + y + '&p=' + p;
    }
    function go2() {
        var m = document.getElementById('month').value;
        var y = document.getElementById('year').value;
        window.location.href = 'detail-salary.php?m=' + m + '&y=' + y;
    }
    function trans(user) {
       window.location.href = 'trans-details.php?user=' + user;
    }
</script>


<script>
    function issue(id, tail) {
        var infor = "year=0&month=0&a=0&b=0&c=0&d=0&e=0&f=0&g=0&tail=" + id + "&ttt=" + tail;

        // alert(infor);
        $("#ssp" + id).html("");

        $.ajax({
            type: "POST",
            url: "backend/issuepay.php",
            data: infor,
            cache: false,
            beforeSend: function () {
                $('#ssp' + id).html('<span class=""><center>Check Issue....</center></span>');
            },
            success: function (html) {
                $("#ssp" + id).html(html);

                // document.location.href = 'report.php';
            }
        });
    }
</script>