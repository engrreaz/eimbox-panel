<?php
include 'header.php';

// $month = $_GET['m'] ?? 0;
// $year = $_GET['y'] ?? 0;

if (isset($_GET['user'])) {
    $user = $_GET['user'];
} else {
    $user = '';
}

$tname = '-';
$sql0x1 = "SELECT * FROM usersapp where sccode='$sccode' and email='$user'";
$result0xn1 = $conn->query($sql0x1);
if ($result0xn1->num_rows > 0) {
    while ($row0x1 = $result0xn1->fetch_assoc()) {
        $userid = $row0x1["userid"];
    }
}
$sql0x2 = "SELECT * FROM teacher where sccode='$sccode' and tid='$userid'";
$result0xn2 = $conn->query($sql0x2);
if ($result0xn2->num_rows > 0) {
    while ($row0x2 = $result0xn2->fetch_assoc()) {
        $tname = $row0x2["tname"];
    }
}


// DELETE PREVIOUS RECORD
$setp3upd = "DELETE FROM transaction_details where sccode='$sccode' and user = '$user'; ";
$conn->query($setp3upd);

$sql0x = "SELECT  date, receivedby, sum(amount) as taka FROM transaction where sccode='$sccode' and (receivedby='$user') group by receivedby, date order by date  ASC";
$result0xn = $conn->query($sql0x);
if ($result0xn->num_rows > 0) {
    while ($row0x = $result0xn->fetch_assoc()) {
        $date = $row0x["date"];

        $by = $row0x["receivedby"];
        $taka = $row0x["taka"];
        $trans_in = $taka;
        $trans_out = 0;


        $setp4upd = "INSERT INTO transaction_details (id, sccode, user, date, income, stpr, withdrawal, deposit, expenditure, trans_in, trans_out, balance, entrytime) 
                                VALUES (NULL, '$sccode', '$user', '$date', 0, 0, 0, 0, 0, '$trans_in', '$trans_out', 0, NULL); ";
        // echo $setp4upd;
        $conn->query($setp4upd);
    }
}

$sql0x = "SELECT  date, receivedfrom, sum(amount) as taka FROM transaction where sccode='$sccode' and (receivedfrom='$user') group by receivedfrom, date order by date  ASC";
$result0xn2 = $conn->query($sql0x);
if ($result0xn2->num_rows > 0) {
    while ($row0x = $result0xn2->fetch_assoc()) {
        $date = $row0x["date"];

        $by = $row0x["receivedfrom"];
        $taka = $row0x["taka"];
        $trans_in = 0;
        $trans_out = $taka;


        $setp44upd = "INSERT INTO transaction_details (id, sccode, user, date, income, stpr, withdrawal, deposit, expenditure, trans_in, trans_out, balance, entrytime) 
                                VALUES (NULL, '$sccode', '$user', '$date', 0, 0, 0, 0, 0, '$trans_in', '$trans_out', 0, NULL); ";
        // echo $setp4upd;
        $conn->query($setp44upd);
    }
}



$transarray = array();
$sql0x = "SELECT date FROM transaction_details where sccode='$sccode' and user = '$user' order by date";
$result0xn0rr = $conn->query($sql0x);
if ($result0xn0rr->num_rows > 0) {
    while ($row0x = $result0xn0rr->fetch_assoc()) {
        $transarray[] = $row0x;
    }
}

// GET banktrasn deposit

///////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////
$sql0x = "SELECT date, sum(amount) as collec FROM banktrans where sccode='$sccode' and entryby = '$user' and transtype = 'Deposit' group by date order by date";
$result0xn01 = $conn->query($sql0x);
if ($result0xn01->num_rows > 0) {
    while ($row0x = $result0xn01->fetch_assoc()) {
        $date = $row0x["date"];
        $depo = $row0x["collec"];
        // echo $user . ' --- ' . $dispuch;

        $ind = array_search($date, array_column($transarray, 'date'));
        if ($ind == '' || $ind == NULL) {
            $setp5upd = "INSERT INTO transaction_details (id, sccode, user, date, income, stpr, withdrawal, deposit, expenditure, trans_in, trans_out, balance, entrytime) 
            VALUES (NULL, '$sccode', '$user', '$date', 0, '0', 0, '$depo', 0, '0', '0', 0, NULL); ";
            // echo $setp4upd;
            $conn->query($setp5upd);
        } else {
            $setp7upd = "UPDATE transaction_details SET deposit = '$depo' where sccode='$sccode' and date='$date' and user='$user'  ; ";
            $conn->query($setp7upd);
        }
    }
}

// GET banktrasn deposit

///////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////
$sql0x = "SELECT date, sum(amount) as collec FROM banktrans where sccode='$sccode' and entryby = '$user' and (transtype = 'Withdraw' || transtype='Withdrawal') group by date order by date";
$result0xn02 = $conn->query($sql0x);
if ($result0xn02->num_rows > 0) {
    while ($row0x = $result0xn02->fetch_assoc()) {
        $date = $row0x["date"];
        $depo = $row0x["collec"];
        // echo $user . ' --- ' . $dispuch;

        $ind = array_search($date, array_column($transarray, 'date'));
        if ($ind == '' || $ind == NULL) {
            $setpfupd = "INSERT INTO transaction_details (id, sccode, user, date, income, stpr, withdrawal, deposit, expenditure, trans_in, trans_out, balance, entrytime) 
            VALUES (NULL, '$sccode', '$user', '$date', 0, '0', '$depo', '0', '0', '0', '0', 0, NULL); ";
            // echo $setp4upd;
            $conn->query($setpfupd);
        } else {
            $setpfupd = "UPDATE transaction_details SET withdrawal = '$depo' where sccode='$sccode' and date='$date' and user='$user'  ; ";
            $conn->query($setpfupd);
        }
    }
}


// GET STUDENT STPR Records
///////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////
$sql0x = "SELECT prdate, sum(amount) as collec FROM stpr where sccode='$sccode' and entryby = '$user' group by prdate order by prdate";
$result0xn0 = $conn->query($sql0x);
if ($result0xn0->num_rows > 0) {
    while ($row0x = $result0xn0->fetch_assoc()) {
        $prdate = $row0x["prdate"];
        $stpr = $row0x["collec"];
        // echo $user . ' --- ' . $dispuch;

        $ind = array_search($prdate, array_column($transarray, 'date'));
        if ($ind == '' || $ind == NULL) {
            $setp5upd = "INSERT INTO transaction_details (id, sccode, user, date, income, stpr, withdrawal, deposit, expenditure, trans_in, trans_out, balance, entrytime) 
            VALUES (NULL, '$sccode', '$user', '$prdate', 0, '$stpr', 0, 0, 0, '0', '0', 0, NULL); ";
            // echo $setp4upd;
            $conn->query($setp5upd);
        } else {
            $setp7upd = "UPDATE transaction_details SET stpr = '$stpr' where sccode='$sccode' and date='$prdate' and user='$user'  ; ";
            $conn->query($setp7upd);
        }
    }
}


// GET Cashbook income

///////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////
$sql0x = "SELECT date, sum(amount) as collec FROM cashbook where sccode='$sccode' and entryby = '$user' and type = 'Income'  group by date order by date";
$result0xn02 = $conn->query($sql0x);
if ($result0xn02->num_rows > 0) {
    while ($row0x = $result0xn02->fetch_assoc()) {
        $date = $row0x["date"];
        $depo = $row0x["collec"];
        // echo $user . ' --- ' . $dispuch;

        $ind = array_search($date, array_column($transarray, 'date'));
        if ($ind == '' || $ind == NULL) {
            $setpfupd = "INSERT INTO transaction_details (id, sccode, user, date, income, stpr, withdrawal, deposit, expenditure, trans_in, trans_out, balance, entrytime) 
            VALUES (NULL, '$sccode', '$user', '$date', '$depo', '0', 0, '0', '0', '0', '0', 0, NULL); ";
            // echo $setp4upd;
            $conn->query($setpfupd);
        } else {
            $setpfupd = "UPDATE transaction_details SET Income = '$depo' where sccode='$sccode' and date='$date' and user='$user'  ; ";
            $conn->query($setpfupd);
        }
    }
}



// GET Cashbook ex

///////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////
$sql0x = "SELECT date, sum(amount) as collec FROM cashbook where sccode='$sccode' and entryby = '$user' and type = 'Expenditure'  group by date order by date";
$result0xn02 = $conn->query($sql0x);
if ($result0xn02->num_rows > 0) {
    while ($row0x = $result0xn02->fetch_assoc()) {
        $date = $row0x["date"];
        $depo = $row0x["collec"];
        // echo $user . ' --- ' . $dispuch;

        $ind = array_search($date, array_column($transarray, 'date'));
        if ($ind == '' || $ind == NULL) {
            $setpfupd = "INSERT INTO transaction_details (id, sccode, user, date, income, stpr, withdrawal, deposit, expenditure, trans_in, trans_out, balance, entrytime) 
            VALUES (NULL, '$sccode', '$user', '$date', 0, '0', 0, '0', '$depo', '0', '0', 0, NULL); ";
            // echo $setp4upd;
            $conn->query($setpfupd);
        } else {
            $setpfupd = "UPDATE transaction_details SET expenditure = '$depo' where sccode='$sccode' and date='$date' and user='$user'  ; ";
            $conn->query($setpfupd);
        }
    }
}

//////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$setp77upd = "UPDATE transaction_details SET balance = income+stpr+withdrawal-expenditure+trans_in-trans_out-deposit, entrytime='$cur' where sccode='$sccode'  and user='$user' ; ";
$conn->query($setp77upd);
/*
 */

?>

<h3>User Transactions Detail</h3>

<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group row">
                            <div class="col-12">
                                <div class="m-0 p-0 pb-1">
                                     <?php echo $tname; ?>
                                </div>
                                <div class="p-0 m-0 text-small text-muted"><?php echo $user; ?></div>
                                
                               
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


                </h6>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th> Date </th>
                                        <th class="text-right"> Income </th>
                                        <th class="text-right"> Collection </th>
                                        <th class="text-right"> Withdrawal </th>
                                        <th class="text-right"> Cash-In </th>
                                        <th class="text-right"> Expense </th>
                                        <th class="text-right"> To Bank </th>
                                        <th class="text-right"> Cash-Out </th>
                                        <th class="text-right"> Balance </th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sl = 1;
                                    $balbal = 0;
                                    // $sql0x = "SELECT * FROM salarysummery where sccode='$sccode' and sessionyear = '$sy' and month='$month' and year='$year' order by refno;";
                                    $sql0x = "SELECT * FROM transaction_details where sccode='$sccode' and user='$user' order by date asc";
                                    $result0xn = $conn->query($sql0x);
                                    if ($result0xn->num_rows > 0) {
                                        while ($row0x = $result0xn->fetch_assoc()) {
                                            $date = $row0x["date"];

                                            $income = $row0x["income"];
                                            $stpr = $row0x["stpr"];
                                            $withdrawal = $row0x["withdrawal"];
                                            $trans_in = $row0x["trans_in"];

                                            $expenditure = $row0x["expenditure"];
                                            $deposit = $row0x["deposit"];
                                            // $date = $row0x["withdrawal"];
                                            $trans_out = $row0x["trans_out"];

                                            $balance = $row0x["balance"];
                                            $balbal += $balance;
                                            ?>
                                            <tr>
                                                <td><?php echo $date; ?></td>
                                                <td class="text-right"><?php echo $income; ?></td>
                                                <td class="text-right"><?php echo $stpr; ?></td>
                                                <td class="text-right"><?php echo $withdrawal; ?></td>
                                                <td class="text-right"><?php echo $trans_in; ?></td>
                                                <td class="text-right"><?php echo $expenditure; ?></td>
                                                <td class="text-right"><?php echo $deposit; ?></td>
                                                <td class="text-right"><?php echo $trans_out; ?></td>

                                                <td class="text-right"><?php echo number_format($balbal, 2); ?></td>

                                                <td>

                                                    <div id="ssp<?php echo $id; ?>">
                                                        <button class="btn btn-inverse-warning p-1 pl-2 pr-2 text-small" style="border: 1px solid orange;"
                                                            onclick="trans(<?php echo $user; ?>);"
                                                            class=""><small>Details</small></button>

                                                    </div>

                                                </td>
                                            </tr>
                                            <?php $sl++;
                                        }
                                    } else { ?>
                                        <tr>
                                            <td colspan="7">No Data / Records Found.</td>

                                        </tr>
                                    <?php }
                                    ?>
                                </tbody>
                            </table>
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