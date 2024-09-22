<?php
include 'header.php';


if (isset($_GET['cashbook-refno'])) {
    $accno = $_GET['accno'];


    $sql0x = "SELECT * FROM banktrans where sccode='$sccode' and verified = 1 order by id;";
    $result0xddx = $conn->query($sql0x);
    if ($result0xddx->num_rows > 0) {
        while ($row0x = $result0xddx->fetch_assoc()) {
            $id = $row0x["id"];
            $etime = $row0x["entrytime"];
            $type = $row0x["transtype"];
            $date = $row0x["date"];
            $amount = $row0x["amount"];
            $partpart = $row0x["partid"];

            $refno = $sccode . date('YmdHis', strtotime($etime));
            $query20 = "update banktrans set refno='$refno' where id='$id' ;";
            $conn->query($query20);

            $mx = date('m', strtotime($date));
            $yx = date('Y', strtotime($date));
            $slot = 'School';
            if ($type == 'Deposit') {
                $category = 'Deposit';
                $tipe = 'Expenditure';
                $partidx = '1';
                $income = 0;
                $expenditure = $amount;
            } else if ($type == 'Deduction') {
                $category = 'Deduction';
                $tipe = 'Expenditure';
                $partidx = '4';
                $income = 0;
                $expenditure = $amount;
            } else if ($type == 'Interest') {
                $category = 'Interest';
                $tipe = 'Income';
                $partidx = '3';
                $income = $amount;
                $expenditure = 0;
            } else {
                $category = 'Withdrawal';
                $tipe = 'Income';
                $partidx = '2';
                $income = $amount;
                $expenditure = 0;
                if ($partpart != 5) {
                    $partidx2 = $partpart;
                    $income2 = 0;
                    $expenditure2 = $amount;
                }
            }

            $particularx = $particularx2 = 'from Bank Transaction';


            $sql0x = "SELECT * FROM cashbook where sccode='$sccode' and refno='$refno';";
            $result0xddxx = $conn->query($sql0x);
            if ($result0xddxx->num_rows > 0) {
                while ($row0x = $result0xddxx->fetch_assoc()) {
                    $refid = $row0x["id"];

                    echo 'update code : ' . $type . '/' . $partpart . '<br>';
                    
                    if (($type == 'Withdraw' || $type == 'Withdrawal') && $partpart != 5) {
                        $cash2 = "INSERT INTO cashbook (id, sccode, sessionyear, month, year, slots, date, type, refno, partid, category, memono, particulars, income, expenditure, amount, entryby, entrytime, module, status) 
                        VALUES (NULL, '$sccode', '$yx', '$mx', '$yx', '$slot', '$date', '$tipe', '$refno', '$partidx2', '$category', '0', '$particularx2', '$income2', '$expenditure2', '$amount', 'System-Auto', '$cur', 'BANK', '1' );";
                        // $conn->query($cash2);
                        // echo $cash2 . '<br>';
                    }
                }
            } else {
                $cash = "INSERT INTO cashbook (id, sccode, sessionyear, month, year, slots, date, type, refno, partid, category, memono, particulars, income, expenditure, amount, entryby, entrytime, module, status) 
        VALUES (NULL, '$sccode', '$yx', '$mx', '$yx', '$slot', '$date', '$tipe', '$refno', '$partidx', '$category', '0', '$particularx', '$income', '$expenditure', '$amount', 'System-Auto', '$cur', 'BANK', '1' );";
                $conn->query($cash);
                echo $cash . '<br>';
                echo $type . '/' . $partpart;
                if (($type == 'Withdraw' || $type == 'Withdrawal') && $partpart != 5) {
                    $cash2 = "INSERT INTO cashbook (id, sccode, sessionyear, month, year, slots, date, type, refno, partid, category, memono, particulars, income, expenditure, amount, entryby, entrytime, module, status) 
                    VALUES (NULL, '$sccode', '$yx', '$mx', '$yx', '$slot', '$date', '$tipe', '$refno', '$partidx2', '$category', '0', '$particularx2', '$income2', '$expenditure2', '$amount', 'System-Auto', '$cur', 'BANK', '1' );";
                    $conn->query($cash);
                    echo $cash2 . '<br>';
                }
            }
        }
    }


    // echo 'donessss';


}









?>
<button type="button" id="modalbox" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal" hidden>
    Launch demo modal
</button>
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Bank List</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div id="" class="input-control select full-size error">
                    <select id="modaldata" name="modaldata" class="form-control" onchange="modal();">
                        <option value="">Select a Bank Account to Show Transaction</option>
                        <?php
                        $sql000 = "SELECT * FROM bankinfo where sccode='$sccode'  order by id";
                        $resultix = $conn->query($sql000);
                        // $conn -> close();
                        if ($resultix->num_rows > 0) {
                            while ($row000 = $resultix->fetch_assoc()) {
                                $accno = $row000["accno"];
                                $acctype = $row000["acctype"];
                                $bankname = $row000["bankname"];
                                echo '<option value="' . $accno . '"  >' . $accno . '/' . $acctype . '</option>';
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
$accno = 0;

if (isset($_GET['accno'])) {
    $accno = $_GET['accno'];
} else {
    $accno = '0';
}


if (isset($_GET['addnew'])) {
    $newblock = 'block';
    $exid = $_GET['addnew'];
    if ($exid == '') {
        $exid = 0;
    }
} else {
    $newblock = 'none';
    $exid = 0;
}

if ($exid == 0) {
    $oneto = 0;
} else {
    $oneto = 1;
}

// echo $exid;


$sql0 = "SELECT * FROM bankinfo where sccode='$sccode' and accno='$accno' ;";
$result0 = $conn->query($sql0);
if ($result0->num_rows > 0) {
    while ($row5 = $result0->fetch_assoc()) {
        $acctype = $row5["acctype"];
        $bankname = $row5["bankname"];
        $branch = $row5["branch"];
    }
} else {
    $acctype = $bankname = $branch = '';
}

$sql0 = "SELECT * FROM banktrans where sccode='$sccode' and accno='$accno' and id='$exid' ;";
// echo $sql0;
$result01 = $conn->query($sql0);
if ($result01->num_rows > 0) {
    while ($row5 = $result01->fetch_assoc()) {
        $date10 = $row5["date"];
        $type10 = $row5["transtype"];
        $chq10 = $row5["chqno"];
        $amount10 = $row5["amount"];
    }
} else {
    $date10 = $td;
    $type10 = 'Withdraw';
    $chq10 = '';
    $amount10 = '';
}





?>
<div class="float-right">
    <button type="button" style="" title="Add New Expenditure" class="btn btn-inverse-success" style=""
        onclick="addnew();">
        <i class="mdi mdi-library-plus"> Add a Transaction </i></button>
</div>
<h3>Account Details</h3>


<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="table-responsive">
                        <table class="">
                            <tr>
                                <td>Acoount # </td>
                                <td class="pl-3"></td>
                                <td><code><?php echo $accno; ?></code></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="pl-3"></td>
                                <td><small><b><?php echo $acctype; ?></b> Account</small></td>
                            </tr>
                            <tr>
                                <td>Bank : </td>
                                <td class="pl-3"></td>
                                <td><?php echo $bankname; ?></td>
                            </tr>
                            <tr>
                                <td><small></small></td>
                                <td class="pl-3"></td>
                                <td><small><?php echo $branch; ?></small></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row" style="display:<?php echo $newblock; ?>;">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 p-2 pl-3">
                        Date :
                    </div>
                    <div class="col-md-3">
                        <input class="input form-control" type="date" id="date" value="<?php echo $date10; ?>" />
                    </div>
                    <div class="col-md-3 p-2 pl-3">
                        Transaction Type :
                    </div>
                    <div class="col-md-3">
                        <select id="type" class="form-control ">
                            <option value="Deposit" <?php if ($type10 == 'Deposit') {
                                echo ' selected ';
                            } ?>>Deposit</option>
                            <option value="Withdraw" <?php if ($type10 == 'Withdraw') {
                                echo ' selected ';
                            } ?>>Withdraw
                            </option>
                            <option value="Interest" <?php if ($type10 == 'Interest') {
                                echo ' selected ';
                            } ?>>Interest
                            </option>
                            <option value="Deduction" <?php if ($type10 == 'Deduction') {
                                echo ' selected ';
                            } ?>>Deduction
                            </option>
                        </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-3 p-2 pl-3">
                        Receipt / Cheque No. :
                    </div>
                    <div class="col-md-3">
                        <input class="input form-control" id="chq" type="text" value="<?php echo $chq10; ?>" />
                    </div>
                    <div class="col-md-3 p-2 pl-3">
                        Amount :
                    </div>
                    <div class="col-md-3">
                        <input class="input form-control" id="amt" type="text" value="<?php echo $amount10; ?>" />
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-3 p-2 pl-3">

                    </div>

                    <div class="col-md-2">
                        <button class="btn btn-primary btn-block p-2"
                            onclick="save(<?php echo $exid; ?>, <?php echo $oneto; ?>);">Save</button>
                    </div>
                    <?php if ($exid > 0) { ?>
                        <div class="col-md-2  ">
                            <button class="btn btn-success btn-block p-2" onclick="save(<?php echo $exid; ?>, 2);">Update &
                                Verify</button>
                        </div>
                        <div class="col-md-2 ">
                            <button class="btn btn-danger btn-block p-2"
                                onclick="save(<?php echo $exid; ?>, 3);">Delete</button>
                        </div>
                    <?php } ?>
                    <div class="col-md-3 p-2 pl-3">
                        <div id="gex"></div>
                        <div id="sspd"></div>
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



                <div class="row">
                    <div class="table-responsive">
                        <table id="main-table-search" class="table table-bordered "
                            style="border:1px solid gray;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Opening</th>
                                    <th>Type</th>
                                    <th>Cheque</th>
                                    <th>Cr</th>
                                    <th>Dr</th>
                                    <th>Balance</th>
                                    <th style="text-align:right;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $slx = 1;
                                $ooo = 0;
                                $sql0x = "SELECT * FROM banktrans where sccode='$sccode'  and accno='$accno' order by  date desc, verifytime desc;";
                                $result0xd = $conn->query($sql0x);
                                if ($result0xd->num_rows > 0) {
                                    while ($row0x = $result0xd->fetch_assoc()) {
                                        $id = $row0x["id"];
                                        $date = $row0x["date"];
                                        $obal = $row0x["transopening"];
                                        $ttype = $row0x["transtype"];
                                        $chqno = $row0x["chqno"];
                                        $amt = $row0x["amount"];
                                        $cbal = $row0x["balance"];
                                        $etime = $row0x["entrytime"];
                                        $verified = $row0x["verified"];
                                        if ($ttype == 'Deposit' || $ttype == 'Interest') {
                                            $dr = $amt;
                                            $cr = '';
                                            $trclr = 'text-success';
                                        } else {
                                            $dr = '';
                                            $cr = $amt;
                                            $trclr = 'text-danger';
                                        }

                                        $txt = $cbal - $ooo;
                                        $ooo = $obal;
                                        if ($txt != 0) {
                                            // $trclr = 'text-warning';
                                        }
                                        ?>
                                        <tr class="<?php echo $trclr; ?>">
                                            <td><?php echo $slx; ?></td>
                                            <td><?php echo $date; ?></td>
                                            <td><?php echo $obal; ?></td>
                                            <td><?php echo $ttype; ?></td>
                                            <td><?php echo $chqno; ?></td>
                                            <td><?php echo $dr; ?></td>
                                            <td><?php echo $cr; ?></td>
                                            <td><?php echo $cbal; ?></td>
                                            <td>
                                                <?php
                                                if ($verified == 0) {
                                                    ?>
                                                    <div id="ssp<?php echo $id; ?>" class="btn-groupx" role="groupx"
                                                        aria-label="Basic example">
                                                        <button onclick="edit(<?php echo $id; ?>,1);"
                                                            class="btn btn-inverse-primary pt-2"><i
                                                                class="mdi mdi-grease-pencil"></i></button>

                                                        <button onclick="save(<?php echo $id; ?>,3);" class="btn btn-inverse-danger"
                                                            hidden><i class="mdi mdi-delete"></i></button>
                                                    </div>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <i onclick="edit(<?php echo $id; ?>,1);"
                                                        class="mdi mdi-check-circle mdi-24px text-success"></i>
                                                    <?php
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                        <?php
                                        $slx++;
                                    }
                                } else { ?>

                                <?php } ?>
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
    var uri = window.location.href;
    // function go() {
    //     var m = document.getElementById('month').value;
    //     var y = document.getElementById('year').value;
    //     window.location.href = 'expenditure.php?&m=' + m + '&y=' + y;
    // }
    // function go2() {
    //     var m = document.getElementById('ref').value;
    //     window.location.href = 'expenditure.php?&ref=' + m;
    // }
    // function go3() {
    //     var m = document.getElementById('ref').value;
    //     window.location.href = 'expenditure.php?&undef';
    // }
    // function go4() {
    //     document.getElementById('search').style.display = 'block';
    // }
    function addnew() {
        var tail = '';
        window.location.href = 'bank-account.php?accno=<?php echo $accno; ?>&addnew' + tail;
    }

    function edit(id, taill) {
        window.location.href = 'bank-account.php?accno=<?php echo $accno; ?>&addnew=' + id;
    }

</script>

<script>
    function save(ids, ont) {
        // alert(ids + '/' + ont);
        // var ids = document.getElementById('id').value;

        var accno = '<?php echo $accno; ?>';
        var date = document.getElementById('date').value;
        var type = document.getElementById('type').value;
        var chq = document.getElementById('chq').value;
        var amt = document.getElementById('amt').value;

        var infor = "id=" + ids + '&date=' + date + '&accno=' + accno + '&type=' + type + '&chq=' + chq + '&amt=' + amt + '&ont=' + ont;
        // alert(infor);
        $("#sspd").html("");

        $.ajax({
            type: "POST",
            url: "backend/save-bank-trans.php",
            data: infor,
            cache: false,
            beforeSend: function () {
                $('#sspd').html('<span class="">Saving Data....');
            },
            success: function (html) {
                $("#sspd").html(html);
                // window.location.href = 'bank-account.php?accno=<?php echo $accno; ?>';
            }
        });
    }
</script>

<script>
    function sl(id, tail) {
        var infor = "id=" + id + '&tail=' + tail;
        // alert(infor);
        $("#sspd").html("");

        $.ajax({
            type: "POST",
            url: "backend/adjclssl.php",
            data: infor,
            cache: false,
            beforeSend: function () {
                $('#sspd').html('<span class=""><center>Saving....</center></span>');
            },
            success: function (html) {
                $("#sspd").html(html);
                window.location.href = 'classes.php';
            }
        });
    }

</script>

<script>
    var accno = '<?php echo $accno; ?>';
    if (accno == 0) {
        $("#modalbox").click();
    }

    function modal() {
        var x = document.getElementById("modaldata").value;
        window.location.href = 'bank-account.php?accno=' + x;
    }





    $(document).ready(function () {
        $('#main-table-search').DataTable();
    });


</script>