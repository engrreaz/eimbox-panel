<?php
include 'header.php';
$role = array("headteacher", "clsteacher", "teacher", "accountants", "officeasstt", "labasstt", "librarian", "guardian", "student", "smcchairman", "smcmember", "staff");
$role2 = array("Head Teacher", "Class Teacher", "Teacher", "Accountants", "Office Asstissant", "Lab Assisstant", "Librarian", "Guardian", "Student", "SMC Chairman", "SMC Member", "Staff");

$c1 = $c2 = 0;
$sql0x = "SELECT sccode, count(*) as cnt FROM permissions_role where sccode='$sccode' or sccode = '999999'  group by sccode order by sccode;";
$result0x3ny = $conn->query($sql0x);
if ($result0x3ny->num_rows > 0) {
    while ($row0x = $result0x3ny->fetch_assoc()) {
        if ($c1 == 0) {
            $c1 = $row0x["cnt"];
        } else {
            $c2 = $row0x["cnt"];
        }
    }
}




if ($c1 != $c2) {


    $talika = array();
    $sql0x = "SELECT * FROM permissions_role where sccode = '$sccode'  order by id;";
    $result0x3nyd = $conn->query($sql0x);
    if ($result0x3nyd->num_rows > 0) {
        while ($row0x = $result0x3nyd->fetch_assoc()) {
            $talika[] = $row0x;
        }
    }
    $sql0x = "SELECT * FROM permissions_role where sccode = '999999'  order by id;";
    $result0x3nydd = $conn->query($sql0x);
    if ($result0x3nydd->num_rows > 0) {
        while ($row0x = $result0x3nydd->fetch_assoc()) {
            $filename0 = $row0x['filename'];
            $ind0 = array_search($filename0, array_column($talika, 'filename'));
            if ($ind0 == '') {
                $id0 = $row0x['id'];
                echo $filename0 . 'id # ' . $id0 . ' need insert.';

                $jakkas = "INSERT INTO permissions_role (sl, pagetitle, pagedescrip, filename, sadmin, admin, headteacher, clsteacher, teacher, accountants, officeasstt, labasstt, librarian, student, guardian, guest, smcchairman, smcmember, staff, sccode) 
                                        SELECT sl, pagetitle, pagedescrip, filename, sadmin, admin, headteacher, clsteacher, teacher, accountants, officeasstt, labasstt, librarian, student, guardian, guest, smcchairman, smcmember, staff, '$sccode' FROM permissions_role WHERE id = '$id0';";

                $conn->query($jakkas);
            }
        }
    }

    ?>
    <script>window.location.href = 'users-privileges.php';</script>
    <?php
}

?>
<h3>Users Permission / Restriction Management</h3>
<code>Page Under Contruction</code>
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group row">
                            <div class="col-12">
                                .....
                            </div>
                        </div>
                    </div>


                    <div class="col-md-3">
                        <div class="form-group row">
                            <div class="col-12">
                                ...........
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group row">
                            <div class="col-12">
                                <div class="form-check form-check-success">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="test" id="" value="3">
                                        Read/Write/Modify

                                    </label>
                                    <span class="text-small ml-2">User can Read/Write/Nodify Data Instant.</span>
                                </div>
                                <div class="form-check form-check-primary">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="test" id="" value="3">
                                        Read/Write/Modify

                                    </label>
                                    <span class="text-small ml-2">User can Read. But Modified data will live after
                                        admin's approval.</span>
                                </div>
                                <div class="form-check form-check-warning">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="test" id="" value="3"> Read
                                        Only

                                    </label>
                                    <span class="text-small ml-2">User will get Read only privileges.</span>
                                </div>
                                <div class="form-check form-check-danger">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="test" id="" value="3"> Access
                                        Denied

                                    </label>
                                    <span class="text-small ml-2">No access permission</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group row">
                            <div class="col-12">
                                <button type="button" class="btn btn-danger btn-icon-text">
                                    <i class="mdi mdi-upload btn-icon-prepend"></i> Inactive </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<?php


$sql0x = "SELECT * FROM permissions_role where sccode='$sccode' order by sl, id;";
$result0x3n = $conn->query($sql0x);
if ($result0x3n->num_rows > 0) {
    while ($row0x = $result0x3n->fetch_assoc()) {
        $id = $row0x["id"];
        $pagetitle = $row0x["pagetitle"];
        $pagedescrip = $row0x["pagedescrip"];

        $headteacher = $row0x["headteacher"];
        $clsteacher = $row0x["clsteacher"];
        $teacher = $row0x["teacher"];
        $accountants = $row0x["accountants"];
        $officeasstt = $row0x["officeasstt"];
        $labasstt = $row0x["labasstt"];
        $librarian = $row0x["librarian"];
        $guardian = $row0x["guardian"];
        $student = $row0x["student"];
        $smcchairman = $row0x["smcchairman"];
        $smcmember = $row0x["smcmember"];
        $staff = $row0x["staff"];

        ?>

        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <div class="col-12">
                                        <P class="text-secondary"><?php echo $pagetitle; ?></P>
                                        <P class="text-muted text-small"><?php echo $pagedescrip; ?></P>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group row">
                                    <div class="col-12">
                                        <div class="row">
                                            <?php
                                            for ($i = 0; $i < 12; $i++) {
                                                $rolename = $role[$i];
                                                $perma = $$rolename;
                                                ?>


                                                <div class="col-md-3">
                                                    <div class="form-group row">
                                                        <div class="col-12">
                                                            <div class="text-muted text-small "><b><?php echo $role2[$i]; ?></b></div>
                                                        </div>
                                                        <div class="col-12">
                                                            <dfiv class="form-group row">
                                                                <div class="form-check form-check-success">
                                                                    <label class="form-check-label ">
                                                                        <input type="radio" class="form-check-input  "
                                                                            onclick="perma(<?php echo $id; ?>, '<?php echo $rolename; ?>', 3); "
                                                                            name="<?php echo $rolename . $id; ?>"
                                                                            id="<?php echo $rolename . $id; ?>3" value="3" <?php if ($perma == 3) {
                                                                                     echo 'checked';
                                                                                 } else {
                                                                                     echo '';
                                                                                 } ?>>
                                                                    </label>
                                                                </div>
                                                                <div class="form-check form-check-primary">
                                                                    <label class="form-check-label">
                                                                        <input type="radio" class="form-check-input"
                                                                            onclick="perma(<?php echo $id; ?>, '<?php echo $rolename; ?>', 2); "
                                                                            name="<?php echo $rolename . $id; ?>"
                                                                            id="<?php echo $rolename . $id; ?>2" value="2" <?php if ($perma == 2) {
                                                                                     echo 'checked';
                                                                                 } else {
                                                                                     echo '';
                                                                                 } ?>>
                                                                    </label>
                                                                </div>
                                                                <div class="form-check form-check-warning">
                                                                    <label class="form-check-label">
                                                                        <input type="radio" class="form-check-input"
                                                                            onclick="perma(<?php echo $id; ?>, '<?php echo $rolename; ?>', 1); "
                                                                            name="<?php echo $rolename . $id; ?>"
                                                                            id="<?php echo $rolename . $id; ?>1" value="1" <?php if ($perma == 1) {
                                                                                     echo 'checked';
                                                                                 } else {
                                                                                     echo '';
                                                                                 } ?>>
                                                                    </label>
                                                                </div>
                                                                <div class="form-check form-check-danger">
                                                                    <label class="form-check-label">
                                                                        <input type="radio" class="form-check-input"
                                                                            onclick="perma(<?php echo $id; ?>, '<?php echo $rolename; ?>', 0);"
                                                                            name="<?php echo $rolename . $id; ?>"
                                                                            id="<?php echo $rolename . $id; ?>0" value="0" <?php
                                                                                 if ($perma == 0) {
                                                                                     echo 'checked';
                                                                                 } else {
                                                                                     echo '';
                                                                                 }
                                                                                 ?>>
                                                                    </label>
                                                                </div>

                                                            </dfiv>

                                                        </div>
                                                    </div>
                                                    <span class="" id="st<?php echo $rolename . $id; ?>"></span>
                                                </div>

                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <?php
    }
}
?>



<!-- ***************************************************************************************************
***************************************************************************************************
***************************************************************************************************
***************************************************************************************************
***************************************************************************************************
*************************************************************************************************** -->

<?php
include 'footer.php';
?>

<script>
    var uri = window.location.href;
</script>

<script>
    function perma(id, role, val) {
        var infor = 'id=' + id + '&role=' + role + '&val=' + val;
        $("#st" + role + id).html("");

        $.ajax({
            type: "POST",
            url: "backend/update-privileges.php",
            data: infor,
            cache: false,
            beforeSend: function () {
                $('#st' + role + id).html();
            },
            success: function (html) {
                $("#st" + role + id).html(html);
            }
        });
    }
</script>